// ==========================================
// GLOBAL VARIABLE
// ==========================================
let ctEditPond = null;

$(document).on('click', '.edit-ct-btn', function () {
    $('#edit-ct-id').val($(this).data('id'));
    $('#edit-ct-title').val($(this).data('title'));
    $('#edit-ct-date').val($(this).data('date'));
    $('#editCtModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editCtModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (ctEditPond) {
        ctEditPond.destroy();
        ctEditPond = null;
    }

    ctEditPond = FilePond.create(
        document.querySelector('#editCtFile'),
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
$(document).on('hidden.bs.modal', '#editCtModal', function () {

    if (ctEditPond) {
        ctEditPond.destroy();
        ctEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editCtForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (ctEditPond && ctEditPond.getFiles().length > 0) {
        formData.set('file', ctEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editCtModal').modal('hide');

            if (ctEditPond) {
                ctEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-ct-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + 'comtemplates/deleteCt', { id: id }, function(){
        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addCtForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addCtModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
