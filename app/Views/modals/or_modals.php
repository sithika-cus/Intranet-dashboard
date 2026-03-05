<div class="modal fade" id="editCModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="editCForm" action="<?= base_url('publications/updateC') ?>">

        <div class="modal-header">
          <h4 class="modal-title">Edit Customs Ordinance</h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="edit-c-id">

<div class="form-group">
  <label>Part No</label>
  <input type="text" name="part_no" id="edit-c-part_no" class="form-control" required>
</div>

<div class="form-group">
  <label>Part Description</label>
  <input type="text" name="part_desc" id="edit-c-part_desc" class="form-control" required>
</div>

<div class="form-group">
  <label>Section No</label>
  <input type="text" name="section_no" id="edit-c-section_no" class="form-control">
</div>

<div class="form-group">
  <label>Section Description</label>
  <input type="text" name="section_desc" id="edit-c-section_desc" class="form-control">
</div>

<div class="form-group">
    <label>Upload File (PDF)</label>
    <input type="file" 
       name="file"
       id="editCFile"
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


</div>

<div class="modal fade" id="addCModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customs Ordinance</h4>
      </div>

      <form id="addCForm" action="<?= base_url('publications/addC') ?>" method="post">

        <div class="modal-body">

          <div class="form-group">
  <label>Part No</label>
  <input type="text" name="part_no" class="form-control" required>
</div>

<div class="form-group">
  <label>Part Description</label>
  <input type="text" name="part_desc" class="form-control" required>
</div>

<div class="form-group">
  <label>Section No</label>
  <input type="text" name="section_no" class="form-control">
</div>

<div class="form-group">
  <label>Section Description</label>
  <input type="text" name="section_desc" class="form-control">
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