// ==========================================
// GLOBAL VARIABLE
// ==========================================
let cdEditPond = null;


// ==========================================
// OPEN EDIT MODAL
// ==========================================
$(document).on('click', '.edit-cd-btn', function () {

    $('#edit-cd-id').val($(this).data('id'));
    $('#edit-cd-title').val($(this).data('title'));
    $('#edit-cd-document_name').val($(this).data('document_name'));
    $('#edit-cd-date_modified').val($(this).data('date_modified'));

    $('#editCdModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editCdModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (cdEditPond) {
        cdEditPond.destroy();
        cdEditPond = null;
    }

    cdEditPond = FilePond.create(
        document.querySelector('#editCdFile'),
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
$(document).on('hidden.bs.modal', '#editCdModal', function () {

    if (cdEditPond) {
        cdEditPond.destroy();
        cdEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editCdForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (cdEditPond && cdEditPond.getFiles().length > 0) {
        formData.set('file', cdEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editCdModal').modal('hide');

            if (cdEditPond) {
                cdEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});





$(document).on('click', '.delete-cd-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteCd", { id: id }, function(){

        reloadTable();
    }, 'json');
});


$(document).on('submit', '#addCdForm', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#addCdModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            reloadTable();
        }
    });
});

