<?php

namespace App\Controllers;

use App\Models\FTrainingsModel;
use App\Models\TMaterialsModel;


class Trainings extends BaseController
{
    public function fTrainings()
    {
        $model = new FTrainingsModel();
        $data['foreign_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('trainings/f_trainings', $data);
    }

    public function tMaterials()
    {
        $model = new TMaterialsModel();
        $data['training_materials'] = $model
        ->orderBy('date_modified', 'DESC')
        ->findAll();

        return view('trainings/t_materials', $data);
    }

    public function updateFt()
{
    $model = new FTrainingsModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/f_trainings/', $newName);

    $data['url'] = 'uploads/f_trainings/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}



   public function deleteFt()
{
    $model = new FTrainingsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addFt()
{
    $model = new FTrainingsModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateTm()
{
    $model = new TMaterialsModel();

    $id = $this->request->getPost('id');

    $data = [
        'training_name' => $this->request->getPost('training_name'),
        'document_name' => $this->request->getPost('document_name'),
        'date_modified'  => $this->request->getPost('date_modified'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/t_materials/', $newName);

    $data['file_link'] = 'uploads/t_materials/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteTm()
{
    $model = new TMaterialsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addTm()
{
    $model = new TMaterialsModel();

    $data = [
        'training_name' => $this->request->getPost('training_name'),
        'document_name' => $this->request->getPost('document_name'),
        'date_modified'  => $this->request->getPost('date_modified'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}
}    