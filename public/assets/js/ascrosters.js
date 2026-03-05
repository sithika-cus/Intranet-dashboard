// ==========================================
// GLOBAL VARIABLE
// ==========================================
let scEditPond = null;

// Open NC edit modal
$(document).on('click', '.edit-sc-btn', function () {
    $('#edit-sc-id').val($(this).data('id'));
    $('#edit-sc-title').val($(this).data('title'));
    $('#edit-sc-date').val($(this).data('date'));
    $('#editScModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editScModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (scEditPond) {
        scEditPond.destroy();
        scEditPond = null;
    }

    scEditPond = FilePond.create(
        document.querySelector('#editScFile'),
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
$(document).on('hidden.bs.modal', '#editScModal', function () {

    if (scEditPond) {
        scEditPond.destroy();
        scEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editScForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (scEditPond && scEditPond.getFiles().length > 0) {
        formData.set('file', scEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editScModal').modal('hide');

            if (scEditPond) {
                scEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});



$(document).on('click', '.delete-sc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "rosters/deleteSc", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addScForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addScModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

