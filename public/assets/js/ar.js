// ==========================================
// GLOBAL VARIABLE
// ==========================================
let arEditPond = null;

// Open ar edit modal
$(document).on('click', '.edit-ar-btn', function () {
    $('#edit-ar-id').val($(this).data('id'));
    $('#edit-ar-title').val($(this).data('title'));
    $('#edit-ar-document_name').val($(this).data('document_name'));
    $('#edit-ar-date_modified').val($(this).data('date_modified'));
    $('#editArModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editArModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (arEditPond) {
        arEditPond.destroy();
        arEditPond = null;
    }

    arEditPond = FilePond.create(
        document.querySelector('#editArFile'),
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
$(document).on('hidden.bs.modal', '#editArModal', function () {

    if (arEditPond) {
        arEditPond.destroy();
        arEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editArForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (arEditPond && arEditPond.getFiles().length > 0) {
        formData.set('file', arEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editArModal').modal('hide');

            if (arEditPond) {
                arEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});



$(document).on('click', '.delete-ar-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "cclassification/deleteAr", { id: id }, function(){

        reloadTable();
    }, 'json');
});


$(document).on('submit', '#addArForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addArModal').modal('hide');
        reloadTable();
    }, 'json');
});

// Reset any modal form automatically when closed
$(document).on('hidden.bs.modal', '.modal', function () {
    const form = $(this).find('form')[0];
    if (form) form.reset();
});