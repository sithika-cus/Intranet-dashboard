// ==========================================
// GLOBAL VARIABLE
// ==========================================
let wrEditPond = null;


// Open NC edit modal
$(document).on('click', '.edit-wr-btn', function () {
    $('#edit-wr-id').val($(this).data('id'));
    $('#edit-wr-title').val($(this).data('title'));
    $('#edit-wr-date').val($(this).data('date'));
    $('#editWrModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editWrModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (wrEditPond) {
        wrEditPond.destroy();
        wrEditPond = null;
    }

    wrEditPond = FilePond.create(
        document.querySelector('#editWrFile'),
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
$(document).on('hidden.bs.modal', '#editWrModal', function () {

    if (wrEditPond) {
        wrEditPond.destroy();
        wrEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editWrForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (wrEditPond && wrEditPond.getFiles().length > 0) {
        formData.set('file', wrEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editWrModal').modal('hide');

            if (wrEditPond) {
                wrEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-wr-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "rosters/deleteWr", { id: id }, function(){

        reloadTable();
    }, 'json');
});
$(document).on('submit', '#addWrForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addWrModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

