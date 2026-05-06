<?php
namespace App\Models;

use CodeIgniter\Model;

class WallPostModel extends Model
{
    protected $table = 'wall_posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'content', 'created_at'];

    public function getAllPosts()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function createPost($userId, $content, $image = null)
    {
        error_log($userId);
        $this->insert([
            'user_id'    => $userId,
            'content'    => $content,
            // 'image'      => $image,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->find($this->getInsertID());
    }

    

    public function likePost($postId)
    {
        // For simplicity, just increment a likes column
        // You may want a separate likes table for multiple users
        $this->db->table($this->table)
            ->set('likes', 'likes+1', false)
            ->where('id', $postId)
            ->update();

        return $this->find($postId);
    }

    public function deletePost($postId)
{
    // Optional: check if post exists
    $post = $this->find($postId);
    if (!$post) {
        return false; // post not found
    }

    return $this->delete($postId); // deletes by primary key
}

    public function addComment($postId, $userId, $content, $parentId = null)
{
    $this->db->table('wall_comments')->insert([
        'post_id'    => $postId,
        'user_id'    => $userId,
        'content'    => $content,
        'parent_id'  => $parentId,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    // Update reply count on parent
    if ($parentId) {
        $this->db->table('wall_comments')
            ->set('reply_count', 'reply_count + 1', false)
            ->where('id', $parentId)
            ->update();
    }

    return $this->db->insertID();
}
    public function getComments($postId)
{
    return $this->db->query(
        "SELECT * FROM wall_comments 
         WHERE post_id = ? AND parent_id IS NULL 
         ORDER BY created_at ASC",
        [$postId]
    )->getResultArray();
}

public function getReplies($commentId)
{
    return $this->db->query(
        "SELECT * FROM wall_comments 
         WHERE parent_id = ? 
         ORDER BY created_at ASC",
        [$commentId]
    )->getResultArray();
}

public function deleteComment($commentId)
{
    return $this->db->table('wall_comments')
        ->where('id', $commentId)
        ->delete();
}

    public function deleteByGroup($groupId)
{
    $this->db->table('group_post_attachments')
             ->whereIn('post_id', function($q) use ($groupId) {
                 $q->select('id')->from('group_posts')->where('group_id', $groupId);
             })->delete();
    $this->db->table('group_post_comments')
             ->whereIn('post_id', function($q) use ($groupId) {
                 $q->select('id')->from('group_posts')->where('group_id', $groupId);
             })->delete();
    $this->db->table('group_posts')->where('group_id', $groupId)->delete();
}

    // WallPostModel.php
public function getPostsPaginated($offset = 0, $limit = 15)
{
    $posts = $this->orderBy('created_at', 'DESC')
                  ->findAll($limit, $offset);
    foreach ($posts as &$post) {
        $post['attachments'] = $this->getAttachments($post['id']);
        $post['comments']    = []; // ← don't embed, load via AJAX
        $post['likes']       = $post['likes'] ?? 0;
    }
    return $posts;
}


public function getTotalPosts()
{
    return $this->countAll();
}

     public function getAttachments($postId)
{
    return $this->db->table('wall_attachments')
        ->where('post_id', $postId)
        ->get()->getResultArray();
}
}
