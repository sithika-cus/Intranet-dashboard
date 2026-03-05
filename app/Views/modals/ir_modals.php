<!-- Edit Modal -->
<div class="modal fade" id="editIrModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update</h4>
      </div>

      <form method="post" id="editIrForm" action="<?= base_url('cclassification/updateIr') ?>">

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-ir-id">

          <div class="form-group">
            <label>Commodity Description</label>
            <input type="text" name="com_desc" id="edit-ir-com_desc" class="form-control">
          </div>

          <div class="form-group">
            <label>Declared HS</label>
            <input type="text" name="dec_hs" id="edit-ir-dec_hs" class="form-control">
            
          </div>

        <div class="form-group">
            <label>Queried HS</label>
            <input type="text" name="que_hs" id="edit-ir-que_hs" class="form-control">
          </div>

          <div class="form-group">
            <label>Codes in Balance</label>
            <input type="text" name="codes_balance" id="edit-ir-codes_balance" class="form-control">
            
          </div>

          <div class="form-group">
            <label>GRI Reference</label>
            <input type="text" name="gri_ref" id="edit-ir-gri_ref" class="form-control">
            
          </div>

          <div class="form-group">
            <label>Key points</label>
            <input type="text" name="key_point" id="edit-ir-key_point" class="form-control">
            
          </div>

          <div class="form-group">
            <label>HS Suggested by CC</label>
            <input type="text" name="cc_hs" id="edit-ir-cc_hs" class="form-control">
            
          </div>
          <div class="form-group">
            <label>Issue Date</label>
            <input type="date" name="issue_date" id="edit-ir-issue_date" class="form-control">
            
          </div>

          <div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editIrFile"
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

<div class="modal fade" id="uploadIrModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="uploadIrForm" action="<?= base_url('cclassification/uploadIr') ?>" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 class="modal-title">Uploads</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="upload-ir-id">

          <div class="form-group">
            <label>Select File (PDF)</label>
            <input type="file" name="file" class="form-control" required>
          </div>
      

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>    

<div class="modal fade" id="addIrModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add</h4>
      </div>

      <form id="addIrForm" action="<?= base_url('cclassification/addIr') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
            <label>Commodity Description</label>
            <input type="text" name="com_desc" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Declared HS</label>
            <input type="text" name="dec_hs" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Queried HS</label>
            <input type="text" name="que_hs" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Codes in balance</label>
            <input type="text" name="codes_balance" class="form-control" required>
          </div>

          <div class="form-group">
            <label>GRI Reference</label>
            <input type="text" name="gri_ref" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Key Points</label>
            <input type="text" name="key_point" class="form-control" required>
          </div>

          <div class="form-group">
            <label>HS Suggested by CC</label>
            <input type="text" name="cc_hs" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Issue Date</label>
            <input type="date" name="issue_date" class="form-control" required>
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

