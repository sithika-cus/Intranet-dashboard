<?php

namespace App\Controllers;

use App\Models\WRoasterModel;
use App\Models\ARosterModel;
use App\Models\ASCRosterModel;
use App\Models\ATransferModel;

class Rosters extends BaseController
{

public function wRoasters()
{
    $model = new WRoasterModel();

    $data['warehouse_roster_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('rosters/w_rosters', $data);
}

public function aRosters()
{
    $model = new ARosterModel();

    $data['airport_roster_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('rosters/a_roster', $data);
}

public function ascRosters()
{
    $model = new ASCRosterModel();

    $data['airport_roster_files_sc'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('rosters/a_roster_sc', $data);
}

public function aTransfer()
{
    $model = new ATransferModel();

    $data['appraiser_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('rosters/a_transfer', $data);
}

public function updateWr()
{
    $model = new WRoasterModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/w_rosters/', $newName);

    $data['url'] = 'uploads/w_rosters/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteWr()
{
    $model = new WRoasterModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addWr()
{
    $model = new WRoasterModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateRa()
{
    $model = new ARosterModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/a_rosters/', $newName);

    $data['url'] = 'uploads/a_rosters/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteRa()
{
    $model = new ARosterModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addRa()
{
    $model = new ARosterModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateSc()
{
    $model = new ASCRosterModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/a_roster_sc/', $newName);

    $data['url'] = 'uploads/a_roster_sc/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteSc()
{
    $model = new ASCRosterModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addSc()
{
    $model = new ASCRosterModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}
}