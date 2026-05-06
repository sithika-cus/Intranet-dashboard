<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\WallPostModel;

class Wall extends ResourceController
{
    protected $format = 'json';
    protected $wallModel;

    public function __construct()
    {
        $this->wallModel = new WallPostModel();
    }

    private function addCORSHeaders()
    {
        header('Access-Control-Allow-Origin: http://intranet.local');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
    }

    // GET POSTS WITH ATTACHMENTS
    public function index()
    {
        $this->addCORSHeaders();

        $db = \Config\Database::connect();

        $posts = $db->table('wall_posts')
            ->orderBy('created_at', 'DESC')
            ->get()->getResultArray();

        foreach ($posts as &$post) {
            $attachments = $db->table('wall_attachments')
                ->where('post_id', $post['id'])
                ->get()->getResultArray();

            $post['attachments'] = $attachments;
        }

        return $this->respond($posts);
    }

    // CREATE POST + ATTACHMENT
    public function create()
{
    $this->addCORSHeaders();
    $userId  = session()->get('user_id') ?? 1;
    $content = $this->request->getPost('content');

    // Save post
    $post = $this->wallModel->createPost($userId, $content, null);
    $postId = $post['id'];

    // Handle file
    $db = \Config\Database::connect();
    $files = $this->request->getFiles();
    if (!empty($files['image'])) {
        $file = $files['image'];
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/posts', $newName);
            $db->table('wall_attachments')->insert([
                'post_id'   => $postId,
                'file_name' => $newName,
                'file_path' => 'uploads/posts/' . $newName,
                'mime_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }
    }

    // ✅ Fetch attachments AFTER saving them
    $post['attachments'] = $db->table('wall_attachments')
        ->where('post_id', $postId)
        ->get()->getResultArray();

    return $this->respond($post, 201);
}

    public function delete($id = null)
    {
        $this->addCORSHeaders();

        $postId = $id ?? $this->request->getPost('id');

        if (!$postId) {
            return $this->fail('Post ID is required', 400);
        }

        $this->wallModel->deletePost($postId);

        return $this->respond(['message' => 'Post deleted']);
    }

    public function like()
    {
        $this->addCORSHeaders();

        $postId = $this->request->getPost('postId');
        $post   = $this->wallModel->likePost($postId);

        return $this->respond(['likes' => $post['likes']]);
    }

    public function getComments()
    {
        $this->addCORSHeaders();

        $postId = $this->request->getGet('postId');
        $comments = $this->wallModel->getComments($postId);

        return $this->respond($comments);
    }

    public function getReplies()
{
    $this->addCORSHeaders();
    $commentId = $this->request->getGet('commentId');
    $replies   = $this->wallModel->getReplies($commentId);
    return $this->respond($replies);
}

public function addComment()
{
    $this->addCORSHeaders();
    $postId   = $this->request->getPost('postId');
    $content  = $this->request->getPost('content');
    $parentId = $this->request->getPost('parentId') ?: null;
    $userId   = 1;

    $id = $this->wallModel->addComment($postId, $userId, $content, $parentId);

    return $this->respond([
        'id'         => $id,
        'content'    => $content,
        'parent_id'  => $parentId,
        'reply_count'=> 0,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}
    public function deleteComment()
    {
        $this->addCORSHeaders();

        $commentId = $this->request->getPost('commentId');
        $this->wallModel->deleteComment($commentId);

        return $this->respond(['message' => 'deleted']);
    }

    // Add to your Wall controller
public function getPosts()
{
    $this->addCORSHeaders();
    $offset = (int)($this->request->getGet('offset') ?? 0);
    $limit  = 15;
    $posts  = $this->wallModel->getPostsPaginated($offset, $limit); // ← was $this->postModel
    $total  = $this->wallModel->getTotalPosts();

    return $this->respond([
        'posts'   => $posts,
        'total'   => $total,
        'offset'  => $offset,
        'limit'   => $limit,
        'hasMore' => ($offset + $limit) < $total,
    ]);
}

}