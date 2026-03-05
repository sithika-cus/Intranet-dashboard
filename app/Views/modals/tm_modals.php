<div class="modal fade" id="editTmModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editTmForm" action="<?= base_url('trainings/updateTm') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-tm-id">

          <div class="form-group">
            <label>Training Program</label>
            <input type="text" name="training_name" id="edit-tm-training_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Document title</label>
            <input type="text" name="document_name" id="edit-tm-document_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_modified" id="edit-tm-date_modified" class="form-control" required>
          </div>
           <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editTmFile"
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



<div class="modal fade" id="addTmModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add</h4>
      </div>

      <form id="addTmForm" action="<?= base_url('trainings/addTm') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
            <label>Training Program</label>
            <input type="text" name="training_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Document Title</label>
            <input type="text" name="document_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_modified" class="form-control" required>
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