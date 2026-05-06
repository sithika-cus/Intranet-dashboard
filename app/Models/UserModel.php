<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'firstName', 'lastName', 'username',
        'password', 'role', 'full_name', 'email'
    ];

    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
