<?php

namespace App\Controllers;

use App\Models\DoplModel;
use App\Models\NcdsModel;
use App\Models\VcdsModel;
use App\Models\OrdinanceModel;
use App\Models\LUploadsModel;

class Publications extends BaseController
{
    public function departmentalOrders()
    {
        $model = new DoplModel();
        $data['dopl_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

        return view('publications/departmental_orders', $data);
    }

    public function ncCommittee()
{
    $model = new NcdsModel();

    $data['ncds_files'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('publications/nc_committee', $data);
}

    public function vcDecisions()
    {
        $model = new VcdsModel();

        $data['vcds_files'] = $model
          ->orderBy('date', 'DESC')
          ->findAll();

        return view('publications/vc_decisions', $data);   
    }

    public function cOrdinance()
{
    $model = new OrdinanceModel();

    $data['ordinance'] = $model
        ->orderBy('part_no', 'DESC')
        ->findAll();

    return view('publications/c_ordinance', $data);
}

    public function lUploads()
{
    $model = new LUploadsModel();

    $data['legaluploads'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('publications/l_uploads', $data);
}


    public function update()
    {
        $model = new DoplModel();

        $id = $this->request->getPost('id');

        $data = [
            'no' => $this->request->getPost('no'),
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
        ];
            
         $model->update($id, $data);
        
        return $this->response->setJSON([
        'status' => 'success'
    ]);
    }

    public function upload()
{
    $model = new DoplModel();

    $id = $this->request->getPost('id');
    $file = $this->request->getFile('file');

    if ($file && $file->isValid()) {

        $newName = $file->getRandomName();
        $file->move('uploads/dopl', $newName);

        $model->update($id, [
            'url' => base_url('uploads/dopl/' . $newName)
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}

public function add()
{
    $model = new DoplModel();

    $data = [
        'no'    => $this->request->getPost('no'),
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}


   public function delete()
{
    $model = new DoplModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

  public function updateNc()
{
    $model = new NcdsModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}
public function uploadNc()
{
    $model = new \App\Models\NcdsModel();

    $id   = $this->request->getPost('id');
    $file = $this->request->getFile('file');

    if ($file && $file->isValid()) {
        $newName = $file->getRandomName();
        $file->move('uploads/ncds', $newName);

        $model->update($id, [
            'url' => base_url('uploads/ncds/' . $newName),
            'date_modified' => date('Y-m-d')
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteNc()
{
    $model = new NcdsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addNc()
{
    $model = new NcdsModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}


public function updateVc()
{
    $model = new VcdsModel();

    $id = $this->request->getPost('id');

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}
public function uploadVc()
{
    $model = new \App\Models\VcdsModel();

    $id   = $this->request->getPost('id');
    $file = $this->request->getFile('file');

    if ($file && $file->isValid()) {
        $newName = $file->getRandomName();
        $file->move('uploads/vcds', $newName);

        $model->update($id, [
            'url' => base_url('uploads/vcds/' . $newName),
            'date_modified' => date('Y-m-d')
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteVc()
{
    $model = new VcdsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addVc()
{
    $model = new VcdsModel();

    $data = [
        'title' => $this->request->getPost('title'),
        'date'  => $this->request->getPost('date'),
    ];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateC()
{
    $model = new OrdinanceModel();

    $id = $this->request->getPost('id');

    $data = [
        'part_no'      => $this->request->getPost('part_no'),
    'part_desc'    => $this->request->getPost('part_desc'),
    'section_no'   => $this->request->getPost('section_no'),
    'section_desc' => $this->request->getPost('section_desc'),
];

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}
public function uploadC()
{
    $model = new \App\Models\OrdinanceModel();

    $id   = $this->request->getPost('id');
    $file = $this->request->getFile('file');

    if ($file && $file->isValid()) {
        $newName = $file->getRandomName();
        $file->move('uploads/c_ordinance', $newName);

        $model->update($id, [
            'url' => base_url('uploads/c_ordinance/' . $newName),
            'date_modified' => date('Y-m-d')
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteC()
{
    $model = new OrdinanceModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addC()
{
    $model = new OrdinanceModel();

    $data = [
        'part_no'      => $this->request->getPost('part_no'),
    'part_desc'    => $this->request->getPost('part_desc'),
    'section_no'   => $this->request->getPost('section_no'),
    'section_desc' => $this->request->getPost('section_desc'),
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateL()
{
    $model = new LUploadsModel();

    $id = $this->request->getPost('id');

    $data = [
    
    'date'    => $this->request->getPost('date'),
    'title'   => $this->request->getPost('title'),
    
];

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}
public function uploadL()
{
    $model = new \App\Models\LUploadsModel();

    $id   = $this->request->getPost('id');
    $file = $this->request->getFile('file');

    if ($file && $file->isValid()) {
        $newName = $file->getRandomName();
        $file->move('uploads/l_uploads', $newName);

        $model->update($id, [
            'url' => base_url('uploads/l_uploads/' . $newName),
            'date_modified' => date('Y-m-d')
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}


   public function deleteL()
{
    $model = new LUploadsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addL()
{
    $model = new LUploadsModel();

    $data = [
    
    'date'    => $this->request->getPost('date'),
    'title'   => $this->request->getPost('title'),
    
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}
}