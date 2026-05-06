<?php
namespace App\Controllers;

use App\Models\ActionPermissionModel;

class ActionPermissions extends BaseController
{
    protected $permModel;

    public function __construct()
    {
        $this->permModel = new ActionPermissionModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        $users = $this->permModel->getAllUsersWithPermissions();
        return $this->respondView('permissions/index', ['users' => $users]);
    }

    public function save($userId)
    {
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(403);
        }

        $data = $this->request->getPost();
        $this->permModel->saveForUser($userId, $data);

        // If editing currently logged-in user refresh session live
        if (session()->get('user_id') == $userId) {
            $fresh = $this->permModel->getByUser($userId);
            session()->set('permissions', $fresh);
        }

        return $this->response->setJSON(['success' => true]);
    }
}