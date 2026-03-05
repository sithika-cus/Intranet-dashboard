// ==========================================
// GLOBAL VARIABLE
// ==========================================
let inEditPond = null;


$(document).on('click', '.edit-in-btn', function () {
    $('#edit-in-id').val($(this).data('id'));
    $('#edit-in-date_added').val($(this).data('date_added'));
    $('#edit-in-title').val($(this).data('title'));
    $('#editInModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editInModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (inEditPond) {
        inEditPond.destroy();
        inEditPond = null;
    }

    inEditPond = FilePond.create(
        document.querySelector('#editInFile'),
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
$(document).on('hidden.bs.modal', '#editInModal', function () {

    if (inEditPond) {
        inEditPond.destroy();
        inEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editInForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (inEditPond && inEditPond.getFiles().length > 0) {
        formData.set('file', inEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editInModal').modal('hide');

            if (inEditPond) {
                inEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
$(document).on('click', '.delete-in-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "comtemplates/deleteIn", { id: id }, function(){

        reloadTable();
    }, 'json');
});
$(document).on('submit', '#addInForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addInModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
