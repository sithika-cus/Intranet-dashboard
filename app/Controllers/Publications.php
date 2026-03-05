<?php

namespace App\Controllers;

use App\Models\DoplModel;
use App\Models\NcdsModel;
use App\Models\VcdsModel;
use App\Models\OrdinanceModel;
use App\Models\LUploadsModel;
use App\Models\AGadvicesModel;
use App\Models\CUploadsModel;
use App\Models\CDetectionsModel;

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
    
    public function aGadvices()
{
    $model = new AGadvicesModel();

    $data['agadvices'] = $model
        ->orderBy('date', 'DESC')
        ->findAll();

    return view('publications/ag_advices', $data);
}
    
    public function cUploads()
{
    $model = new CUploadsModel();

    $data['cu'] = $model
        ->orderBy('id', 'DESC')
        ->findAll();

    return view('publications/c_uploads', $data);
}
    
    public function cDetections()
{
    $model = new CDetectionsModel();

    $data['cusdet'] = $model
        ->orderBy('date_modified', 'DESC')
        ->findAll();

    return view('publications/c_detections', $data);
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

        $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/dopl/', $newName);

    $data['url'] = 'uploads/dopl/' . $newName;
}

            
         $model->update($id, $data);
        
        return $this->response->setJSON([
        'status' => 'success'
    ]);
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

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/ncds/', $newName);

    $data['url'] = 'uploads/ncds/' . $newName;
}

    $model->update($id, $data);

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

    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/vcds/', $newName);

    $data['url'] = 'uploads/vcds/' . $newName;
}


    $model->update($id, $data);

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

   $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/c_ordinance/', $newName);

    $data['url'] = 'uploads/c_ordinance/' . $newName;
}


    $model->update($id, $data);

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
  $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/l_uploads/', $newName);

    $data['url'] = 'uploads/l_uploads/' . $newName;
}


    $model->update($id, $data);

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

public function updateAg()
{
    $model = new AGadvicesModel();

    $id = $this->request->getPost('id');

    $data = [
    
    'attorny_gen_ref'    => $this->request->getPost('attorny_gen_ref'),
    'cus_ref'    => $this->request->getPost('cus_ref'),
    'title'   => $this->request->getPost('title'),
    
];
  $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/ag_advices/', $newName);

    $data['url'] = 'uploads/ag_advices/' . $newName;
}


    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}



   public function deleteAg()
{
    $model = new AGadvicesModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addAg()
{
    $model = new AGadvicesModel();

    $data = [
    
    'attorny_gen_ref'    => $this->request->getPost('attorny_gen_ref'),
    'cus_ref'    => $this->request->getPost('cus_ref'),
    'date'   => $this->request->getPost('date'),
    'title'   => $this->request->getPost('title'),
    
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateCu()
{
    $model = new CUploadsModel();

    $id = $this->request->getPost('id');

    $data = [
    
    'date_modified'    => $this->request->getPost('date_modified'),
    'title'   => $this->request->getPost('title'),
    'document_name'   => $this->request->getPost('document_name'),
    
];

   $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/c_uploads/', $newName);

    $data['file_link'] = 'uploads/c_uploads/' . $newName;
}

    $model->update($id, $data);

    return $this->response->setJSON(['status' => 'success']);
}



   public function deleteCu()
{
    $model = new CUploadsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addCu()
{
    $model = new CUploadsModel();

    $data = [
    
    'date_modified'    => $this->request->getPost('date_modified'),
    'title'   => $this->request->getPost('title'),
    
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}

public function updateCd()
{
    $model = new \App\Models\CDetectionsModel();

    $id = $this->request->getPost('id');
    $data = [
        'title'         => $this->request->getPost('title'),
        'document_name' => $this->request->getPost('document_name'),
        'date_modified' => $this->request->getPost('date_modified'),
    ];
    
    $file = $this->request->getFile('file');

if ($file && $file->isValid() && !$file->hasMoved()) {

    $newName = $file->getRandomName();
    $file->move('uploads/c_detections/', $newName);

    $data['file_link'] = 'uploads/c_detections/' . $newName;
}
    
    $model->update($id, $data);
    
    return $this->response->setJSON(['status' => 'success']);
}



   public function deleteCd()
{
    $model = new CDetectionsModel();
    $id = $this->request->getPost('id');

    $model->delete($id);

    return $this->response->setJSON([
        'status' => 'success'
    ]);
}

public function addCd()
{
    $model = new CDetectionsModel();

    $data = [
    
   'title'         => $this->request->getPost('title'),
        'document_name' => $this->request->getPost('document_name'),
        'date_modified' => $this->request->getPost('date_modified'),
];

    $model->insert($data);

    return $this->response->setJSON(['status' => 'success']);
}


}