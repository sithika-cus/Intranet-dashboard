<div class="modal fade" id="editWrModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editWrForm" action="<?= base_url('rosters/updateWr') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-wr-id">

          <div class="form-group">
            <label>Warehouse Rosters</label>
            <input type="text" name="title" id="edit-wr-title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" id="edit-wr-date" class="form-control" required>
          </div>
          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editWrFile"
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


<div class="modal fade" id="addWrModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add WR</h4>
      </div>

      <form id="addWrForm" action="<?= base_url('rosters/addWr') ?>" method="post">

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