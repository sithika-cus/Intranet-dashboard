<?php
namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\GroupPostModel;

class Groups extends BaseController
{
    protected $groupModel;
    protected $postModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->postModel  = new GroupPostModel();
    }

    private function cors()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    // ── Group list page ──────────────────────────────
    public function index()
{
    $userId = session()->get('user_id') ?? 1;
    $groups = $this->groupModel->getGroupsWithMemberStatus($userId);
    return view('groups/index', ['groups' => $groups]);
}

    // ── Group feed page ──────────────────────────────
    public function feed($groupId)
{
    $userId = session()->get('user_id') ?? 1;
    $role   = session()->get('role');
    $group  = $this->groupModel->find($groupId);
    if (!$group) return redirect()->to('/groups');

    $isMember = $this->groupModel->isMember($groupId, $userId);
    $status   = $this->groupModel->getMemberStatus($groupId, $userId);
    $posts    = $isMember ? [] : [];
    $members  = $this->groupModel->getMembers($groupId);
    $pending  = ($role === 'admin')
              ? $this->groupModel->getPendingRequests($groupId)
              : [];

    return $this->respondView('groups/feed', compact('group', 'isMember', 'status', 'posts', 'members', 'pending'));
}

    // ── Admin: create group ──────────────────────────
    public function create()
{
    $this->cors();
    // Remove admin check — any logged in user can create
    $name        = $this->request->getPost('name');
    $description = $this->request->getPost('description') ?? '';
    $userId      = session()->get('user_id') ?? 1;

    if (!$name) {
        return $this->response->setJSON(['error' => 'Name required'])->setStatusCode(400);
    }

    $this->groupModel->insert([
        'name'        => $name,
        'description' => $description,
        'created_by'  => $userId,
        'created_at'  => date('Y-m-d H:i:s'),
    ]);

    $groupId = $this->groupModel->getInsertID();

    // Auto-join the creator as approved member
    $this->groupModel->db->table('wall_group_members')->insert([
        'group_id'   => $groupId,
        'user_id'    => $userId,
        'status'     => 'approved',
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    return $this->response->setJSON(['success' => true, 'id' => $groupId]);
}

    // ── User: request to join ────────────────────────
    public function requestJoin($groupId)
{
    $this->cors();
    $userId = session()->get('user_id') ?? 1;

    // Check if already a member
    $existing = $this->groupModel->getMemberStatus($groupId, $userId);
    if ($existing && $existing['status'] === 'approved') {
        return $this->response->setJSON(['success' => true, 'already' => true]);
    }

    // Insert or update to approved directly — no pending
    if ($existing) {
        $this->groupModel->db->table('wall_group_members')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->update(['status' => 'approved']);
    } else {
        $this->groupModel->db->table('wall_group_members')->insert([
            'group_id'   => $groupId,
            'user_id'    => $userId,
            'status'     => 'approved',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    return $this->response->setJSON(['success' => true]);
}
    // ── Admin: approve member ────────────────────────
    public function approve($groupId, $userId)
    {
        $this->cors();
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(403);
        }
        $this->groupModel->approveMember($groupId, $userId);
        return $this->response->setJSON(['success' => true]);
    }

    // ── Admin: reject member ─────────────────────────
    public function reject($groupId, $userId)
    {
        $this->cors();
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(403);
        }
        $this->groupModel->rejectMember($groupId, $userId);
        return $this->response->setJSON(['success' => true]);
    }

    // ── Group post: create ───────────────────────────
    public function createPost($groupId)
{
    $this->cors();
    $userId = session()->get('user_id') ?? 1;

    // Check membership
    if (!$this->groupModel->isMember($groupId, $userId)) {
        return $this->response->setJSON(['error' => 'Not a member'])->setStatusCode(403);
    }

    // Save post
    $content = $this->request->getPost('content') ?? '';

    $this->postModel->insert([
        'group_id'   => $groupId,
        'user_id'    => $userId,
        'content'    => $content,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    $postId = $this->postModel->getInsertID();

    // ✅ FILE UPLOAD (FIXED VERSION)
    $files = $this->request->getFiles();

    if (!empty($files['attachments'])) {

        $attachments = $files['attachments'];

        // handle single file case
        if (!is_array($attachments)) {
            $attachments = [$attachments];
        }

        foreach ($attachments as $file) {

            if (!$file->isValid()) {
                return $this->response->setJSON([
                    'error' => $file->getErrorString()
                ])->setStatusCode(400);
            }

            if ($file->hasMoved()) continue;

            $newName  = $file->getRandomName();
            $filePath = 'uploads/posts/' . $newName;

            if (!$file->move(FCPATH . 'uploads/posts', $newName)) {
                return $this->response->setJSON([
                    'error' => 'File move failed'
                ])->setStatusCode(500);
            }

            // Save to DB
            $this->postModel->addAttachment(
                $postId,
                $file->getClientName(),
                $filePath,
                $file->getClientMimeType(),
                $file->getSize()
            );
        }
    }

    // Return post with attachments
    $post = $this->postModel->find($postId);
    $post['attachments'] = $this->postModel->getAttachments($postId);
    $post['comments'] = [];

    return $this->response->setJSON($post)->setStatusCode(201);
}

    // ── Group post: delete ───────────────────────────
    public function deletePost($postId)
    {
        $this->cors();
        $this->postModel->deletePost($postId);
        return $this->response->setJSON(['success' => true]);
    }

    // ── Group post: like ─────────────────────────────
    public function likePost($postId)
    {
        $this->cors();
        $post = $this->postModel->likePost($postId);
        return $this->response->setJSON(['likes' => $post['likes']]);
    }

    // ── Group post: comments ─────────────────────────
    public function getComments($postId)
    {
        $this->cors();
        $comments = $this->postModel->getComments($postId);
        return $this->response->setJSON($comments);
    }

    public function addComment($postId)
{
    $this->cors();
    $userId   = session()->get('user_id') ?? 1;
    $content  = $this->request->getPost('content');
    $parentId = $this->request->getPost('parentId') ?: null;
    $id       = $this->postModel->addComment($postId, $userId, $content, $parentId);

    return $this->response->setJSON([
        'id'          => $id,
        'post_id'     => $postId,
        'content'     => $content,
        'parent_id'   => $parentId,
        'reply_count' => 0,
        'created_at'  => date('Y-m-d H:i:s'),
    ])->setStatusCode(201);
}

public function getReplies($commentId)
{
    $this->cors();
    $replies = $this->postModel->getReplies($commentId);
    return $this->response->setJSON($replies);
}

    public function deleteComment($commentId)
    {
        $this->cors();
        $this->postModel->deleteComment($commentId);
        return $this->response->setJSON(['success' => true]);
    }

    // ── API: get all groups ──────────────────────────
    public function apiGroups()
    {
        $this->cors();
        $userId = session()->get('user_id') ?? 1;
        $groups = $this->groupModel->getGroupsWithMemberStatus($userId);
        return $this->response->setJSON($groups);
    }

    public function getPosts($groupId)
{
    $this->cors();
    $userId = session()->get('user_id') ?? 1;

    // Any member can access — not just admin
    $canAccess = $this->groupModel->isMember($groupId, $userId);

    if (!$canAccess) {
        return $this->response->setJSON([])->setStatusCode(403);
    }

    $offset = (int)($this->request->getGet('offset') ?? 0);
    $limit  = 15;
    $posts  = $this->postModel->getPostsByGroupPaginated($groupId, $offset, $limit);
    $total  = $this->postModel->getTotalPostsByGroup($groupId);

    return $this->response->setJSON([
        'posts'   => $posts,
        'total'   => $total,
        'offset'  => $offset,
        'limit'   => $limit,
        'hasMore' => ($offset + $limit) < $total,
    ]);
}

   // ── Admin: delete group ──────────────────────────
public function delete($groupId)
{
    $this->cors();
    if (session()->get('role') !== 'admin') {
        return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(403);
    }
    $this->postModel->deleteByGroup($groupId);
    $this->groupModel->deleteGroup($groupId); // ← was $this->groupModel->delete()
    return $this->response->setJSON(['success' => true]);
} 
}