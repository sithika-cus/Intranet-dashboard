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
          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editVcFile"
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
