<section class="content-header">
    <h1>Departmental Orders</h1>
</section>

<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>DOPL No</th>
                        <th>Departmental Orders</th>
                        <th>Effective Date</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dopl_files as $row): ?>
                    <tr>
                        <td><?= $row['no'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td>
                            <?php if(!empty($row['url'])): ?>
                                <a href="<?= $row['url'] ?>" target="_blank"class="btn btn-xs btn-info">
            <i class="fa fa-eye"></i></a>
                            <?php endif; ?>

                            <button class="btn btn-xs btn-primary edit-btn"
    data-id="<?= $row['id'] ?>"
    data-no="<?= $row['no'] ?>"
    data-title="<?= htmlspecialchars($row['title']) ?>"
    data-date="<?= $row['date'] ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
   
   <button class="btn btn-xs btn-success upload-btn"
    data-id="<?= $row['id'] ?>"
    data-toggle="modal"
    data-target="#uploadModal">
    <i class="fa fa-upload"></i>
</button>
    <button class="btn btn-xs btn-danger delete-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

                  
                  </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addModal">
    <i class="fa fa-plus"></i>
</button>
        </div>
    </div>

    <!-- Edit Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Departmental Order</h4>
      </div>

      <form method="post" id="editForm" action="<?= base_url('publications/update') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">

          <div class="form-group">
            <label>DOPL No</label>
            <input type="text" name="no" id="edit-no" class="form-control">
          </div>

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-title" class="form-control">
            
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" id="edit-date" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Departmental Order</h4>
      </div>

      <form id="uploadForm" enctype="multipart/form-data" action="<?= base_url('publications/upload') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-id">

          <div class="form-group">
            <label>Select File (PDF)</label>
            <input type="file" name="file" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Departmental Order</h4>
      </div>

      <form method="post" id="addForm" action="<?= base_url('publications/add') ?>">

        <div class="modal-body">
          <div class="form-group">
            <label>DOPL No</label>
            <input type="text" name="no" class="form-control" required>
          </div>

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
          <button type="submit" class="btn btn-success">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>


</section>



