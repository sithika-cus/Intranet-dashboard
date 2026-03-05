<?php

namespace App\Controllers;

use App\Models\ARuilingModel;
use App\Models\IRuilingModel;

class ComClassification extends BaseController
{
    public function advanceRuiling()
    {
        $model = new ARuilingModel();
        $data['advrl'] = $model
        ->orderBy('date_modified', 'DESC')
        ->findAll();

        return view('cclassification/advanceruiling', $data);
    }

    public function internalRuiling()
    {
        $model = new IRuilingModel();
        $data['intrl'] = $model
        ->orderBy('issue_date', 'DESC')
        ->findAll();

        return view('cclassification/internalruiling', $data);
    }

    public function updateAr()
{
    $model = new ARuilingModel();

    $id = $this->request->getPost('id');

    $data = [
    
    'title'   => $this->request->getPost('title'),
    'document_name'   => $this->request->getPost('document_name'),
    'date_modified'    => $this->request->getPost('date_modified'),
    
];

$file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/advanceruiling/', $newName);

    $data['file_link'] = 'uploads/advanceruiling/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteAr()
{
    $model = new ARuilingModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addAr()
{
    $model = new ARuilingModel();

    $data = [
   'title'   => $this->request->getPost('title'),
    'document_name'   => $this->request->getPost('document_name'),
    'date_modified'    => $this->request->getPost('date_modified'),
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateIr()
{
    $model = new IRuilingModel();

    $id = $this->request->getPost('id');

    $data = [
    
    'com_desc'   => $this->request->getPost('com_desc'),
    'dec_hs'   => $this->request->getPost('dec_hs'),
    'que_hs'    => $this->request->getPost('que_hs'),
    'codes_balance'    => $this->request->getPost('codes_balance'),
    'gri_ref'    => $this->request->getPost('gri_ref'),
    'key_point'    => $this->request->getPost('key_point'),
    'cc_hs'    => $this->request->getPost('cc_hs'),
    'issue_date'    => $this->request->getPost('issue_date'),
    
];

$file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/internalruiling/', $newName);

    $data['file_link'] = 'uploads/internalruiling/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteIr()
{
    $model = new IRuilingModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addIr()
{
    $model = new IRuilingModel();

    $data = [
   'com_desc'   => $this->request->getPost('com_desc'),
    'dec_hs'   => $this->request->getPost('dec_hs'),
    'que_hs'    => $this->request->getPost('que_hs'),
    'codes_balance'    => $this->request->getPost('codes_balance'),
    'gri_ref'    => $this->request->getPost('gri_ref'),
    'key_point'    => $this->request->getPost('key_point'),
    'cc_hs'    => $this->request->getPost('cc_hs'),
    'issue_date'    => $this->request->getPost('issue_date'),
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}
}