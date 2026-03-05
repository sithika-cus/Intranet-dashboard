<!-- Edit Modal -->
<div class="modal fade" id="editAgModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update AG advices</h4>
      </div>

      <form method="post" id="editAgForm" action="<?= base_url('publications/updateAg') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-ag-id">

          <div class="form-group">
            <label>Att.Gen Ref</label>
            <input type="text" name="attorny_gen_ref" id="edit-ag-attorny_gen_ref" class="form-control">
          </div>

          <div class="form-group">
            <label>Customs.Ref</label>
            <input type="text" name="cus_ref" id="edit-ag-cus_ref" class="form-control">
            
          </div>

          

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit-ag-title" class="form-control">
          </div>

          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editAgFile"
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



<div class="modal fade" id="addAgModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add AG Advices</h4>
      </div>

      <form id="addAgForm" method="post" action="<?= base_url('publications/addAg') ?>">

        <div class="modal-body">

          <div class="form-group">
            <label>Att.Gen Ref</label>
            <input type="text" name="attorny_gen_ref" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Customs.Ref</label>
            <input type="text" name="cus_ref" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
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

