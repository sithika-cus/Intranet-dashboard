// ==========================================
// GLOBAL VARIABLE
// ==========================================
let ftEditPond = null;

$(document).on('click', '.edit-ft-btn', function () {
    $('#edit-ft-id').val($(this).data('id'));
    $('#edit-ft-title').val($(this).data('title'));
    $('#edit-ft-date').val($(this).data('date'));
    $('#editFtModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editFtModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (ftEditPond) {
        ftEditPond.destroy();
        ftEditPond = null;
    }

    ftEditPond = FilePond.create(
        document.querySelector('#editFtFile'),
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
$(document).on('hidden.bs.modal', '#editFtModal', function () {

    if (ftEditPond) {
        ftEditPond.destroy();
        ftEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editFtForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (ftEditPond && ftEditPond.getFiles().length > 0) {
        formData.set('file', ftEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editFtModal').modal('hide');

            if (ftEditPond) {
                ftEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-ft-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "trainings/deleteFt", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addFtForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addFtModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
