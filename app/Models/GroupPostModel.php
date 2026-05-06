<?php
namespace App\Models;

use CodeIgniter\Model;

class GroupPostModel extends Model
{
    protected $table      = 'wall_group_posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['group_id', 'user_id', 'content', 'likes', 'created_at'];

    public function getPostsByGroup($groupId)
    {
        $posts = $this->where('group_id', $groupId)
                      ->orderBy('created_at', 'DESC')
                      ->findAll();
        foreach ($posts as &$post) {
            $post['attachments'] = $this->getAttachments($post['id']);
            $post['comments']    = $this->getComments($post['id']);
        }
        return $posts;
    }

    public function getAttachments($postId)
    {
        return $this->db->table('wall_group_attachments')
            ->where('post_id', $postId)
            ->get()->getResultArray();
    }

    public function addAttachment($postId, $fileName, $filePath, $mimeType, $fileSize)
    {
        $this->db->table('wall_group_attachments')->insert([
            'post_id'    => $postId,
            'file_name'  => $fileName,
            'file_path'  => $filePath,
            'mime_type'  => $mimeType,
            'file_size'  => $fileSize,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getComments($postId)
{
    return $this->db->query(
        "SELECT * FROM wall_group_comments 
         WHERE post_id = ? AND parent_id IS NULL 
         ORDER BY created_at ASC",
        [$postId]
    )->getResultArray();
}

public function getReplies($commentId)
{
    return $this->db->query(
        "SELECT * FROM wall_group_comments 
         WHERE parent_id = ? 
         ORDER BY created_at ASC",
        [$commentId]
    )->getResultArray();
}
public function addComment($postId, $userId, $content, $parentId = null)
{
    $this->db->table('wall_group_comments')->insert([
        'post_id'    => $postId,
        'user_id'    => $userId,
        'content'    => $content,
        'parent_id'  => $parentId,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    if ($parentId) {
        $this->db->table('wall_group_comments')
            ->set('reply_count', 'reply_count + 1', false)
            ->where('id', $parentId)
            ->update();
    }

    return $this->db->insertID();
}

    public function deleteComment($commentId)
    {
        $this->db->table('wall_group_comments')->where('id', $commentId)->delete();
    }

    public function likePost($postId)
    {
        $this->db->table('wall_group_posts')
            ->set('likes', 'likes+1', false)
            ->where('id', $postId)
            ->update();
        return $this->find($postId);
    }

    public function deletePost($postId)
    {
        $post = $this->find($postId);
        if (!$post) return false;
        return $this->delete($postId);
    }

    public function deleteByGroup($groupId)
{
    // Get all post IDs for this group
    $posts = $this->where('group_id', $groupId)->findAll();
    $postIds = array_column($posts, 'id');

    if (!empty($postIds)) {
        // Delete attachments and comments for those posts
        $this->db->table('wall_group_attachments')
                 ->whereIn('post_id', $postIds)
                 ->delete();
        $this->db->table('wall_group_comments')
                 ->whereIn('post_id', $postIds)
                 ->delete();
    }

    // Delete the posts themselves
    $this->where('group_id', $groupId)->delete();
}

public function getPostsByGroupPaginated($groupId, $offset = 0, $limit = 15)
{
    $posts = $this->where('group_id', $groupId)
                  ->orderBy('created_at', 'DESC')
                  ->findAll($limit, $offset);

    foreach ($posts as &$post) {
        $post['attachments'] = $this->getAttachments($post['id']);
        $post['comments']    = $this->getComments($post['id']);
        $post['likes']       = $post['likes'] ?? 0;
    }
    return $posts;
}

public function getTotalPostsByGroup($groupId)
{
    return $this->where('group_id', $groupId)->countAllResults();
}
}