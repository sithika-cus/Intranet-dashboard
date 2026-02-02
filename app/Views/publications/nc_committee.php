<section class="content-header">
    <h1>NC Committee Decisions</h1>
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
<?php foreach($ncds_files as $row): ?>
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

        <button class="btn btn-xs btn-warning edit-nc-btn"
            data-id="<?= $row['id'] ?>"
            data-title="<?= esc($row['title']) ?>"
            data-date="<?= esc($row['date']) ?>">
            <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-xs btn-info upload-nc-btn"
        data-id="<?= $row['id'] ?>">
        <i class="fa fa-upload"></i>
    </button> 
    </button>
    <button class="btn btn-xs btn-danger delete-nc-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addNcModal">
            <i class="fa fa-plus"></i>
        </button>


</div>
</div>
<div class="modal fade" id="editNcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editNcForm" action="<?= base_url('publications/updateNc') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit NC Committee Decision</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-nc-id">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-nc-title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" id="edit-nc-date" class="form-control" required>
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

<div class="modal fade" id="uploadNcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="uploadNcForm" action="<?= base_url('publications/uploadNc') ?>" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Upload NC Committee File</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-nc-id">

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

<div class="modal fade" id="addNcModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add NC Committee Decision</h4>
      </div>

      <form id="addNcForm" action="<?= base_url('publications/addNc') ?>" method="post">

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