<?php
namespace App\Models;

use CodeIgniter\Model;

class WallAttachmentModel extends Model
{
    protected $table      = 'wall_attachments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['post_id', 'file_name', 'file_path', 'mime_type', 'file_size'];

    public function getByPost($postId)
    {
        return $this->where('post_id', $postId)->findAll();
    }

    public function deleteByPost($postId)
    {
        $attachments = $this->getByPost($postId);
        foreach ($attachments as $a) {
            if (file_exists(FCPATH . $a['file_path'])) {
                unlink(FCPATH . $a['file_path']);
            }
        }
        return $this->where('post_id', $postId)->delete();
    }
}