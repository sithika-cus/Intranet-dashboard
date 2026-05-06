<?php
namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table      = 'wall_groups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'created_by'];

    public function getAllGroups()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getGroupsWithMemberStatus($userId)
{
    return $this->db->table('wall_groups g')
        ->select('g.*, gm.status as member_status, gm.id as member_id,
                  (SELECT COUNT(*) FROM wall_group_members 
                   WHERE group_id = g.id AND status = "approved") as member_count')
        ->join('wall_group_members gm', "gm.group_id = g.id AND gm.user_id = $userId", 'left')
        ->orderBy('g.created_at', 'DESC')
        ->get()->getResultArray();
}

    public function getMemberStatus($groupId, $userId)
    {
        return $this->db->table('wall_group_members')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get()->getRowArray();
    }

    public function requestJoin($groupId, $userId)
{
    $existing = $this->getMemberStatus($groupId, $userId);
    if ($existing) {
        if ($existing['status'] !== 'approved') {
            $this->db->table('wall_group_members')
                ->where('group_id', $groupId)
                ->where('user_id', $userId)
                ->update(['status' => 'approved']);
        }
        return true;
    }
    $this->db->table('wall_group_members')->insert([
        'group_id'   => $groupId,
        'user_id'    => $userId,
        'status'     => 'approved',  // ← instant approval
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    return true;
}
    public function approveMember($groupId, $userId)
    {
        $this->db->table('wall_group_members')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->update(['status' => 'approved']);
    }

    public function rejectMember($groupId, $userId)
    {
        $this->db->table('wall_group_members')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->update(['status' => 'rejected']);
    }

    public function isMember($groupId, $userId)
    {
        $row = $this->db->table('wall_group_members')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->get()->getRowArray();
        return $row !== null;
    }

    public function getPendingRequests($groupId)
{
    return $this->db->table('wall_group_members gm')
        ->select('gm.*, u.username, CONCAT(u.firstName, " ", u.lastName) as full_name')
        ->join('users u', 'u.id = gm.user_id')
        ->where('gm.group_id', $groupId)
        ->where('gm.status', 'pending')
        ->get()->getResultArray();
}

public function getMembers($groupId)
{
    return $this->db->table('wall_group_members gm')
        ->select('gm.*, u.username, CONCAT(u.firstName, " ", u.lastName) as full_name')
        ->join('users u', 'u.id = gm.user_id')
        ->where('gm.group_id', $groupId)
        ->where('gm.status', 'approved')
        ->get()->getResultArray();
}

    public function deleteGroup($groupId)
{
    $this->db->table('wall_group_members')->where('group_id', $groupId)->delete();
    $this->delete($groupId);
}
}