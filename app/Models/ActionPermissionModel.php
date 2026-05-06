<?php
namespace App\Models;
use CodeIgniter\Model;

class ActionPermissionModel extends Model
{
    protected $table      = 'user_action_permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'can_add', 'can_edit', 'can_delete', 'can_view'
    ];

    public function getByUser($userId)
    {
        $row = $this->where('user_id', $userId)->first();
        if (!$row) {
            return [
                'can_add'    => false,
                'can_edit'   => false,
                'can_delete' => false,
                'can_view'   => false,
            ];
        }
        return [
            'can_add'    => (bool)$row['can_add'],
            'can_edit'   => (bool)$row['can_edit'],
            'can_delete' => (bool)$row['can_delete'],
            'can_view'   => (bool)$row['can_view'],
        ];
    }

    public function saveForUser($userId, $data)
    {
        $existing = $this->where('user_id', $userId)->first();
        $payload  = [
            'user_id'    => $userId,
            'can_add'    => isset($data['can_add'])    ? 1 : 0,
            'can_edit'   => isset($data['can_edit'])   ? 1 : 0,
            'can_delete' => isset($data['can_delete']) ? 1 : 0,
            'can_view'   => isset($data['can_view'])   ? 1 : 0,
        ];
        if ($existing) {
            $this->update($existing['id'], $payload);
        } else {
            $this->insert($payload);
        }
        return $payload;
    }

    public function getAllUsersWithPermissions()
{
    return $this->db->table('users u')
        ->select("u.id, u.username, u.email, u.role,
                  COALESCE(
                    NULLIF(TRIM(CONCAT(u.firstName, ' ', u.lastName)), ''),
                    u.username,
                    u.email
                  ) as display_name,
                  COALESCE(p.can_add, 0)    as can_add,
                  COALESCE(p.can_edit, 0)   as can_edit,
                  COALESCE(p.can_delete, 0) as can_delete,
                  COALESCE(p.can_view, 0)   as can_view")
        ->join('user_action_permissions p', 'p.user_id = u.id', 'left')
        ->orderBy('display_name', 'ASC')
        ->get()->getResultArray();
}
}