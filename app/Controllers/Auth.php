<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ActionPermissionModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }
        return view('login');
    }

    public function login()
    {
        $username  = $this->request->getPost('username');
        $password  = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid username or password');
        }

        // Load permissions from DB
        $permModel   = new ActionPermissionModel();
        $permissions = $permModel->getByUser($user['id']);

        session()->set([
            'logged_in'   => true,
            'user_id'     => $user['id'],
            'username'    => $user['username'],
            'full_name'   => $user['firstName'] . ' ' . $user['lastName'],
            'role'        => $user['role'],
            'permissions' => $permissions, // ← new
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}