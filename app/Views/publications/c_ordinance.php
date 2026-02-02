<section class="content-header">
	<h1>Customs Ordinance</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>	
<tr>
    <th>Part No</th>
    <th>Part description</th>
    <th>Section No</th>
    <th>section Description</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($ordinance as $row): ?>
<tr>
    <td><?= esc($row['part_no']) ?></td>
    <td><?= esc($row['part_desc']) ?></td>
    <td><?= esc($row['section_no']) ?></td>
    <td><?= esc($row['section_desc']) ?></td> 
    <td class="text-center">
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

        <button class="btn btn-xs btn-warning edit-c-btn"
    data-id="<?= $row['id'] ?>"
    data-part_no="<?= esc($row['part_no']) ?>"
    data-part_desc="<?= esc($row['part_desc']) ?>"
    data-section_no="<?= esc($row['section_no']) ?>"
    data-section_desc="<?= esc($row['section_desc']) ?>">
    <i class="fa fa-pencil"></i>
</button>

        <button class="btn btn-xs btn-info upload-c-btn"
        data-id="<?= $row['id'] ?>">
        <i class="fa fa-upload"></i>
    </button> 
    <button class="btn btn-xs btn-danger delete-c-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
</div>
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addCModal">
            <i class="fa fa-plus"></i>
        </button>
</div>
</div>       
<div class="modal fade" id="editCModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editCForm" action="<?= base_url('publications/updateC') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit Customs Ordinance</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-c-id">

<div class="form-group">
  <label>Part No</label>
  <input type="text" name="part_no" id="edit-c-part_no" class="form-control" required>
</div>

<div class="form-group">
  <label>Part Description</label>
  <input type="text" name="part_desc" id="edit-c-part_desc" class="form-control" required>
</div>

<div class="form-group">
  <label>Section No</label>
  <input type="text" name="section_no" id="edit-c-section_no" class="form-control">
</div>

<div class="form-group">
  <label>Section Description</label>
  <input type="text" name="section_desc" id="edit-c-section_desc" class="form-control">
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

<div class="modal fade" id="uploadCModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="uploadCForm" action="<?= base_url('publications/uploadC') ?>" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Upload Customs Ordinance File</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-c-id">

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

<div class="modal fade" id="addCModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customs Ordinance</h4>
      </div>

      <form id="addCForm" action="<?= base_url('publications/addC') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
  <label>Part No</label>
  <input type="text" name="part_no" class="form-control" required>
</div>

<div class="form-group">
  <label>Part Description</label>
  <input type="text" name="part_desc" class="form-control" required>
</div>

<div class="form-group">
  <label>Section No</label>
  <input type="text" name="section_no" class="form-control">
</div>

<div class="form-group">
  <label>Section Description</label>
  <input type="text" name="section_desc" class="form-control">
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