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
        $data['dopl_files'] = $model->orderBy('date', 'DESC')->findAll();
        return $this->respondView('publications/departmental_orders', $data);
    }

    public function ncCommittee()
    {
        $model = new NcdsModel();
        $data['ncds_files'] = $model->orderBy('date', 'DESC')->findAll();
        return $this->respondView('publications/nc_committee', $data);
    }

    public function vcDecisions()
    {
        $model = new VcdsModel();
        $data['vcds_files'] = $model->orderBy('date', 'DESC')->findAll();
        return $this->respondView('publications/vc_decisions', $data);
    }

    public function cOrdinance()
    {
        $model = new OrdinanceModel();
        $data['ordinance'] = $model->orderBy('part_no', 'DESC')->findAll();
        return $this->respondView('publications/c_ordinance', $data);
    }

    public function lUploads()
    {
        $model = new LUploadsModel();
        $data['legaluploads'] = $model->orderBy('date', 'DESC')->findAll();
        return $this->respondView('publications/l_uploads', $data);
    }

    public function aGadvices()
    {
        $model = new AGadvicesModel();
        $data['agadvices'] = $model->orderBy('date', 'DESC')->findAll();
        return $this->respondView('publications/ag_advices', $data);
    }

    public function cUploads()
    {
        $model = new CUploadsModel();
        $data['cu'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respondView('publications/c_uploads', $data);
    }

    public function cDetections()
    {
        $model = new CDetectionsModel();
        $data['cusdet'] = $model->orderBy('date_modified', 'DESC')->findAll();
        return $this->respondView('publications/c_detections', $data);
    }

    // ── DOPL ─────────────────────────────────────────────
    public function update()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new DoplModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'no'    => $this->request->getPost('no'),
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/dopl/', $newName);
            $data['url'] = 'uploads/dopl/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function add()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new DoplModel();
        $data  = [
            'no'    => $this->request->getPost('no'),
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new DoplModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── NC Committee ─────────────────────────────────────
    public function updateNc()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new NcdsModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/ncds/', $newName);
            $data['url'] = 'uploads/ncds/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteNc()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new NcdsModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addNc()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new NcdsModel();
        $data  = [
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── VC Decisions ─────────────────────────────────────
    public function updateVc()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new VcdsModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/vcds/', $newName);
            $data['url'] = 'uploads/vcds/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteVc()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new VcdsModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addVc()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new VcdsModel();
        $data  = [
            'title' => $this->request->getPost('title'),
            'date'  => $this->request->getPost('date'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── Customs Ordinance ────────────────────────────────
    public function updateC()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new OrdinanceModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'part_no'      => $this->request->getPost('part_no'),
            'part_desc'    => $this->request->getPost('part_desc'),
            'section_no'   => $this->request->getPost('section_no'),
            'section_desc' => $this->request->getPost('section_desc'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/c_ordinance/', $newName);
            $data['url'] = 'uploads/c_ordinance/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteC()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new OrdinanceModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addC()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new OrdinanceModel();
        $data  = [
            'part_no'      => $this->request->getPost('part_no'),
            'part_desc'    => $this->request->getPost('part_desc'),
            'section_no'   => $this->request->getPost('section_no'),
            'section_desc' => $this->request->getPost('section_desc'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── Legal Uploads ────────────────────────────────────
    public function updateL()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new LUploadsModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'date'  => $this->request->getPost('date'),
            'title' => $this->request->getPost('title'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/l_uploads/', $newName);
            $data['url'] = 'uploads/l_uploads/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteL()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new LUploadsModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addL()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new LUploadsModel();
        $data  = [
            'date'  => $this->request->getPost('date'),
            'title' => $this->request->getPost('title'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── AG Advices ───────────────────────────────────────
    public function updateAg()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new AGadvicesModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'attorny_gen_ref' => $this->request->getPost('attorny_gen_ref'),
            'cus_ref'         => $this->request->getPost('cus_ref'),
            'title'           => $this->request->getPost('title'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/ag_advices/', $newName);
            $data['url'] = 'uploads/ag_advices/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteAg()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new AGadvicesModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addAg()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new AGadvicesModel();
        $data  = [
            'attorny_gen_ref' => $this->request->getPost('attorny_gen_ref'),
            'cus_ref'         => $this->request->getPost('cus_ref'),
            'date'            => $this->request->getPost('date'),
            'title'           => $this->request->getPost('title'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── Common Uploads ───────────────────────────────────
    public function updateCu()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new CUploadsModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'date_modified' => $this->request->getPost('date_modified'),
            'title'         => $this->request->getPost('title'),
            'document_name' => $this->request->getPost('document_name'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/c_uploads/', $newName);
            $data['file_link'] = 'uploads/c_uploads/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteCu()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new CUploadsModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addCu()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new CUploadsModel();
        $data  = [
            'date_modified' => date('Y-m-d'),
            'title'         => $this->request->getPost('title'),
            'document_name' => $this->request->getPost('document_name'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    // ── Customs Detections ───────────────────────────────
    public function updateCd()
    {
        if ($deny = $this->requirePermission('edit')) return $deny;

        $model = new CDetectionsModel();
        $id    = $this->request->getPost('id');
        $data  = [
            'title'         => $this->request->getPost('title'),
            'document_name' => $this->request->getPost('document_name'),
            'date_modified' => $this->request->getPost('date_modified'),
        ];

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName   = $file->getRandomName();
            $file->move('uploads/c_detections/', $newName);
            $data['file_link'] = 'uploads/c_detections/' . $newName;
        }

        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteCd()
    {
        if ($deny = $this->requirePermission('delete')) return $deny;

        $model = new CDetectionsModel();
        $model->delete($this->request->getPost('id'));
        return $this->response->setJSON(['status' => 'success']);
    }

    public function addCd()
    {
        if ($deny = $this->requirePermission('add')) return $deny;

        $model = new CDetectionsModel();
        $data  = [
            'title'         => $this->request->getPost('title'),
            'document_name' => $this->request->getPost('document_name'),
            'date_modified' => $this->request->getPost('date_modified'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }
}