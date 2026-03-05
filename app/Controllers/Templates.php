<?php

namespace App\Controllers;

use App\Models\CTModel;
use App\Models\NotificationModel;

class Templates extends BaseController
{
	public function cTemplates()
    {
        $model = new CTModel();
        $data['common_templates'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('comtemplates/templates', $data);
    }

    public function iNotifications()
    {
        $model = new NotificationModel();
        $data['intranet_notifications'] = $model
        ->orderBy('date_added', 'DESC')
        ->findAll();

        return view('comtemplates/notifications', $data);
    }


    public function updateCt()
{
    $model = new CTModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];
    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/templates/', $newName);

    $data['url'] = 'uploads/templates/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteCt()
{
    $model = new CTModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addCt()
{
    $model = new CTModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateIn()
{
    $model = new NotificationModel();

    $id = $this->request->getPost('id');

    $data = [
        'date_added'  => $this->request->getPost('date_added'),
        'title' => $this->request->getPost('title'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/notifications/', $newName);

    $data['url'] = 'uploads/notifications/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteIn()
{
    $model = new NotificationModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addIn()
{
    $model = new NotificationModel();

    $data = [
        'date_added'  => $this->request->getPost('date_added'),
        'title' => $this->request->getPost('title'),
        
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

}    
