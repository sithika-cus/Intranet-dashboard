// ==========================================
// GLOBAL VARIABLE
// ==========================================
let tmEditPond = null;

$(document).on('click', '.edit-tm-btn', function () {
    $('#edit-tm-id').val($(this).data('id'));
    $('#edit-tm-training_name').val($(this).data('training_name'));
    $('#edit-tm-document_name').val($(this).data('document_name'));
    $('#edit-tm-date_modified').val($(this).data('date_modified'));
    $('#editTmModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editTmModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (tmEditPond) {
        tmEditPond.destroy();
        tmEditPond = null;
    }

    tmEditPond = FilePond.create(
        document.querySelector('#editTmFile'),
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
$(document).on('hidden.bs.modal', '#editTmModal', function () {

    if (tmEditPond) {
        tmEditPond.destroy();
        tmEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editTmForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (tmEditPond && tmEditPond.getFiles().length > 0) {
        formData.set('file', tmEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editTmModal').modal('hide');

            if (tmEditPond) {
                tmEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-tm-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "trainings/deleteTm", { id: id }, function(){

        reloadTable();
    }, 'json');
});



$(document).on('submit', '#addTmForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addTmModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
