<section class="content-header">
    <h1>Valuation Committee Decisions</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>Title</th>
    <th>Date</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($vcds_files as $row): ?>
<tr>
    <td><?= esc($row['id']) ?></td>
    <td><?= esc($row['title']) ?></td>
    <td><?= esc($row['date']) ?></td>
    <td class="text-center">
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>
    <button class="btn btn-xs btn-warning edit-vc-btn"
            data-id="<?= $row['id'] ?>"
            data-title="<?= esc($row['title']) ?>"
            data-date="<?= esc($row['date']) ?>">
            <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-xs btn-info upload-vc-btn"
        data-id="<?= $row['id'] ?>">
        <i class="fa fa-upload"></i>
    </button> 
    
    <button class="btn btn-xs btn-danger delete-vc-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addVcModal">
            <i class="fa fa-plus"></i>
        </button>
       </div>
</div>
<div class="modal fade" id="editVcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editVcForm" action="<?= base_url('publications/updateVc') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit VC Committee Decision</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-vc-id">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-vc-title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" id="edit-vc-date" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div> 

<div class="modal fade" id="uploadVcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="uploadVcForm" action="<?= base_url('publications/uploadVc') ?>" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Upload VC File</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-vc-id">

          <div class="form-group">
            <label>Select File (PDF)</label>
            <input type="file" name="file" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="addVcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add VC Committee Decision</h4>
      </div>

      <form id="addVcForm" action="<?= base_url('publications/addVc') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Save
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancel
          </button>
        </div>

      </form>

    </div>
  </div>
</div>


</section>        