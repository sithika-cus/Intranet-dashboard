<section class="content-header">
	<h1>Legal Uploads</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
	<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Title</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($legaluploads as $row): ?>
<tr>
    <td><?= esc($row['id']) ?></td>
    <td><?= esc($row['date']) ?></td>
    <td><?= esc($row['title']) ?></td>
    <td class="text-center">
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

    <button class="btn btn-xs btn-warning edit-l-btn"
    data-id="<?= esc($row['id']) ?>"
    data-date="<?= esc($row['date']) ?>"
    data-title="<?= esc($row['title']) ?>">
    <i class="fa fa-pencil"></i>
</button>

<button class="btn btn-xs btn-info upload-l-btn"
        data-id="<?= $row['id'] ?>">
        <i class="fa fa-upload"></i>
    </button> 
    <button class="btn btn-xs btn-danger delete-l-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>
</td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
</div>
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addLModal">
            <i class="fa fa-plus"></i>
        </button>
</div>
</div>       
<div class="modal fade" id="editLModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editLForm" action="<?= base_url('publications/updateL') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit Legal Uploads</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-l-id">
        


<div class="form-group">
  <label>Date</label>
  <input type="text" name="date" id="edit-l-date" class="form-control" required>
</div>

<div class="form-group">
  <label>Title</label>
  <input type="text" name="title" id="edit-l-title" class="form-control">
</div>        

<div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="uploadLegalModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="uploadLForm" method="post" action="<?= base_url('publications/uploadL') ?>" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Upload Legal File</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-l-id">

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

<div class="modal fade" id="addLModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="addLForm" action="<?= base_url('publications/addL') ?>" method="post">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Legal Uploads</h4>
      </div>

        <div class="modal-body">

          

<div class="form-group">
  <label>Date</label>
  <input type="text" name="date" class="form-control" required>
</div>

<div class="form-group">
  <label>Title</label>
  <input type="text" name="title" class="form-control">
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

