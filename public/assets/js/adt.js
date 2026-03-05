// ==========================================
// GLOBAL VARIABLE
// ==========================================
let ascEditPond = null;


$(document).on('click', '.edit-asc-btn', function () {
    $('#edit-asc-id').val($(this).data('id'));
    $('#edit-asc-title').val($(this).data('title'));
    $('#edit-asc-date').val($(this).data('date'));
    $('#editAscModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editAscModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (ascEditPond) {
        ascEditPond.destroy();
        ascEditPond = null;
    }

    ascEditPond = FilePond.create(
        document.querySelector('#editAscFile'),
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
$(document).on('hidden.bs.modal', '#editAscModal', function () {

    if (ascEditPond) {
        ascEditPond.destroy();
        ascEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editAscForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (ascEditPond && ascEditPond.getFiles().length > 0) {
        formData.set('file', ascEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editAscModal').modal('hide');

            if (ascEditPond) {
                ascEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.delete-asc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "transfers/deleteAsc", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addAscForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addAscModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
