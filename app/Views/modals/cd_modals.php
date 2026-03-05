<!-- Edit Modal -->
<div class="modal fade" id="editCdModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Customs detections</h4>
      </div>

      <form method="post" enctype="multipart/form-data" id="editCdForm" action="<?= base_url('publications/updateCd') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-cd-id">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-cd-title" class="form-control">
          </div>

          <div class="form-group">
            <label>Directorate</label>
            <input type="text" name="document_name" id="edit-cd-document_name" class="form-control">
            
          </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_modified" id="edit-cd-date_modified" class="form-control">
          </div>

          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editCdFile"
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


<div class="modal fade" id="addCdModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customs Detections</h4>
      </div>

      <form id="addCdForm" action="<?= base_url('publications/addCd') ?>" 
      method="post" 
      enctype="multipart/form-data">


        <div class="modal-body">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Directorate</label>
            <input type="text" name="document_name" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Uploaded by</label>
            <input type="text" name="user" class="form-control" required>
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