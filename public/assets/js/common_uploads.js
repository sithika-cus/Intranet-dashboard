// ==========================================
// GLOBAL VARIABLE
// ==========================================
let cuEditPond = null;

// Open Cu edit modal
$(document).on('click', '.edit-cu-btn', function () {
    $('#edit-cu-id').val($(this).data('id'));
    $('#edit-cu-date_modified').val($(this).data('date_modified'));
    $('#edit-cu-title').val($(this).data('title'));
    $('#edit-cu-document_name').val($(this).data('document_name'));
    $('#edit-cu-user').val($(this).data('user'));
    $('#editCuModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editCuModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (cuEditPond) {
        cuEditPond.destroy();
        cuEditPond = null;
    }

    cuEditPond = FilePond.create(
        document.querySelector('#editCuFile'),
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
$(document).on('hidden.bs.modal', '#editCuModal', function () {

    if (cuEditPond) {
        cuEditPond.destroy();
        cuEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editCuForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (cuEditPond && cuEditPond.getFiles().length > 0) {
        formData.set('file', cuEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editCuModal').modal('hide');

            if (cuEditPond) {
                cuEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-cu-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteCu", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addCuForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addCuModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

