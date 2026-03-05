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
          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editDFile"
       class="filepond"
       accept="application/pdf,image/jpeg,image/png,image/jpg">
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
