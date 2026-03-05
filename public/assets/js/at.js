// ==========================================
// GLOBAL VARIABLE
// ==========================================
let atEditPond = null;

$(document).on('click', '.edit-at-btn', function () {
    $('#edit-at-id').val($(this).data('id'));
    $('#edit-at-title').val($(this).data('title'));
    $('#edit-at-date').val($(this).data('date'));
    $('#editAtModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editAtModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (atEditPond) {
        atEditPond.destroy();
        atEditPond = null;
    }

    atEditPond = FilePond.create(
        document.querySelector('#editAtFile'),
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
$(document).on('hidden.bs.modal', '#editAtModal', function () {

    if (atEditPond) {
        atEditPond.destroy();
        atEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editAtForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (atEditPond && atEditPond.getFiles().length > 0) {
        formData.set('file', atEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editAtModal').modal('hide');

            if (atEditPond) {
                atEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});



$(document).on('click', '.delete-at-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "transfers/deleteAt", { id: id }, function(){

        reloadTable();
    }, 'json');
});
$(document).on('submit', '#addAtForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addAtModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
