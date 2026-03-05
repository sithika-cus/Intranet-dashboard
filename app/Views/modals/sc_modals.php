<div class="modal fade" id="editScModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editScForm" action="<?= base_url('rosters/updateSc') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-sc-id">

          <div class="form-group">
            <label>Airport Rosters</label>
            <input type="text" name="title" id="edit-sc-title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" id="edit-sc-date" class="form-control" required>
          </div>

          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editScFile"
       class="filepond"
       accept="application/pdf,image/jpeg,image/png,image/jpg">
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



<div class="modal fade" id="addScModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add </h4>
      </div>

      <form id="addScForm" action="<?= base_url('rosters/addSc') ?>" method="post">

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