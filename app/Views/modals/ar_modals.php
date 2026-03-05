<!-- Edit Modal -->
<div class="modal fade" id="editArModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update</h4>
      </div>

      <form method="post" id="editArForm" action="<?= base_url('cclassification/updateAr') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-ar-id">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-ar-title" class="form-control">
          </div>

          <div class="form-group">
            <label>Document Title</label>
            <input type="text" name="document_name" id="edit-ar-document_name" class="form-control">
            
          </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_modified" id="edit-ar-date_modified" class="form-control">
          </div>
          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editArFile"
       class="filepond"
       accept="application/pdf,image/jpeg,image/png,image/jpg">
</div>
</div>
        

        <div class="modal-footer clearfix">

  <button type="button" 
          class="btn btn-default pull-left" 
          data-dismiss="modal">
    <i class="fa fa-times"></i> Cancel
  </button>

  <button type="submit" 
          class="btn btn-primary">
    <i class="fa fa-refresh"></i> 
  </button>

</div>

      </form>

    </div>
  </div>
</div>


<div class="modal fade" id="addArModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add</h4>
      </div>

      <form id="addArForm" action="<?= base_url('cclassification/addAr') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Document Title</label>
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

        <div class="modal-footer clearfix">

  <button type="button" 
          class="btn btn-default pull-left" 
          data-dismiss="modal">
    <i class="fa fa-times"></i> Cancel
  </button>

  <button type="submit" 
          class="btn btn-success">
    <i class="fa fa-save"></i> Save
  </button>

</div>

      </form>

    </div>
  </div>
</div>
