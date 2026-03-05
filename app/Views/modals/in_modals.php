<div class="modal fade" id="editInModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editInForm" action="<?= base_url('comtemplates/updateIn') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-in-id">

          <div class="form-group">
            <label>Date Added</label>
            <input type="date" name="date_added" id="edit-in-date_added" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Template Title</label>
            <input type="text" name="title" id="edit-in-title" class="form-control" required>
          </div>
          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editInFile"
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


<div class="modal fade" id="addInModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add</h4>
      </div>

      <form id="addInForm" action="<?= base_url('comtemplates/addIn') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_added" class="form-control" required>
          </div>

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
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
