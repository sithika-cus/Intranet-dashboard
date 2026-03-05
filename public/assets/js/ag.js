// ==========================================
// GLOBAL VARIABLE
// ==========================================
let agEditPond = null;

// Open Ag edit modal
$(document).on('click', '.edit-ag-btn', function () {
    $('#edit-ag-id').val($(this).data('id'));
    $('#edit-ag-attorny_gen_ref').val($(this).data('attorny_gen_ref'));
    $('#edit-ag-cus_ref').val($(this).data('cus_ref'));
    $('#edit-ag-title').val($(this).data('title'));
    $('#editAgModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editAgModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (agEditPond) {
        agEditPond.destroy();
        agEditPond = null;
    }

    agEditPond = FilePond.create(
        document.querySelector('#editAgFile'),
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
$(document).on('hidden.bs.modal', '#editAgModal', function () {

    if (agEditPond) {
        agEditPond.destroy();
        agEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editAgForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (agEditPond && agEditPond.getFiles().length > 0) {
        formData.set('file', agEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editAgModal').modal('hide');

            if (agEditPond) {
                agEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});




$(document).on('click', '.delete-ag-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteAg", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addAgForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addAgModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
