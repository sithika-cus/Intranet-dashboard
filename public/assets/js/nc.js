// ==========================================
// GLOBAL VARIABLE
// ==========================================
let ncEditPond = null;


// Open NC edit modal
$(document).on('click', '.edit-nc-btn', function () {
    $('#edit-nc-id').val($(this).data('id'));
    $('#edit-nc-title').val($(this).data('title'));
    $('#edit-nc-date').val($(this).data('date'));
    $('#editNcModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editNcModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (ncEditPond) {
        ncEditPond.destroy();
        ncEditPond = null;
    }

    ncEditPond = FilePond.create(
        document.querySelector('#editNcFile'),
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
$(document).on('hidden.bs.modal', '#editNcModal', function () {

    if (ncEditPond) {
        ncEditPond.destroy();
        ncEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editNcForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (ncEditPond && ncEditPond.getFiles().length > 0) {
        formData.set('file', ncEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editNcModal').modal('hide');

            if (ncEditPond) {
                ncEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});




$(document).on('click', '.delete-nc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteNc", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addNcForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addNcModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

