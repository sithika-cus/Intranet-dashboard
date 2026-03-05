<?php

namespace App\Controllers;

use App\Models\DDCTransfersModel;
use App\Models\SCTransfersModel;
use App\Models\ATransfersModel;
use App\Models\ASCTransfersModel;

class Transfers extends BaseController
{
	public function ddcTransfers()
    {
        $model = new DDCTransfersModel();
        $data['ddc_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('transfers/ddc_transfers', $data);
    }

    public function scTransfers()
    {
        $model = new SCTransfersModel();
        $data['sc_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('transfers/sc_transfers', $data);
    }

    public function apTransfers()
    {
        $model = new ATransfersModel();
        $data['appraiser_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('transfers/ap_transfers', $data);
    }

    public function ascTransfers()
    {
        $model = new ASCTransfersModel();
        $data['asc_transfer_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('transfers/asc_transfers', $data);
    }

    public function updateDdct()
{
    $model = new DDCTransfersModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/ddc_transfers/', $newName);

    $data['url'] = 'uploads/ddc_transfers/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteDdct()
{
    $model = new DDCTransfersModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addDdct()
{
    $model = new DDCTransfersModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateSct()
{
    $model = new SCTransfersModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/sc_transfers/', $newName);

    $data['url'] = 'uploads/sc_transfers/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteSct()
{
    $model = new SCTransfersModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addSct()
{
    $model = new SCTransfersModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateAt()
{
    $model = new ATransfersModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/ap_transfers/', $newName);

    $data['url'] = 'uploads/ap_transfers/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}



   public function deleteAt()
{
    $model = new ATransfersModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addAt()
{
    $model = new ATransfersModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateAsc()
{
    $model = new ASCTransfersModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/asc_transfers/', $newName);

    $data['url'] = 'uploads/asc_transfers/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}

   public function deleteAsc()
{
    $model = new ASCTransfersModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addAsc()
{
    $model = new ASCTransfersModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}
}    