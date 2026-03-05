// ==========================================
// GLOBAL VARIABLE
// ==========================================
let irEditPond = null;

// Open ar edit modal
$(document).on('click', '.edit-ir-btn', function () {
    $('#edit-ir-id').val($(this).data('id'));
    $('#edit-ir-com_desc').val($(this).data('com_desc'));
    $('#edit-ir-dec_hs').val($(this).data('dec_hs'));
    $('#edit-ir-que_hs').val($(this).data('que_hs'));
    $('#edit-ir-codes_balance').val($(this).data('codes_balance'));
    $('#edit-ir-gri_ref').val($(this).data('gri_ref'));
    $('#edit-ir-key_point').val($(this).data('key_point'));
    $('#edit-ir-cc_hs').val($(this).data('cc_hs'));
    $('#edit-ir-issue_date').val($(this).data('issue_date'));

    
    $('#editIrModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editIrModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (irEditPond) {
        irEditPond.destroy();
        irEditPond = null;
    }

    irEditPond = FilePond.create(
        document.querySelector('#editIrFile'),
        {
            allowMultiple: false,
            instantUpload: false,
            maxFileSize: '10MB',
            acceptedFileTypes: [
                'application/pdf',
                'image/jpeg',
                'image/png'
            ]
        }
    );
});


// When modal closes
$(document).on('hidden.bs.modal', '#editIrModal', function () {

    if (irEditPond) {
        irEditPond.destroy();
        irEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editIrForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (irEditPond && irEditPond.getFiles().length > 0) {
        formData.set('file', irEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editIrModal').modal('hide');

            if (irEditPond) {
                irEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});



$(document).on('click', '.delete-ir-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "cclassification/deleteIr", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addIrForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addIrModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

