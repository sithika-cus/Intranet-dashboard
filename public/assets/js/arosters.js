// ==========================================
// GLOBAL VARIABLE
// ==========================================
let raEditPond = null;


// Open NC edit modal
$(document).on('click', '.edit-ra-btn', function () {
    $('#edit-ra-id').val($(this).data('id'));
    $('#edit-ra-title').val($(this).data('title'));
    $('#edit-ra-date').val($(this).data('date'));
    $('#editRaModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editRaModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (raEditPond) {
        raEditPond.destroy();
        raEditPond = null;
    }

    raEditPond = FilePond.create(
        document.querySelector('#editRaFile'),
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
$(document).on('hidden.bs.modal', '#editRaModal', function () {

    if (raEditPond) {
        raEditPond.destroy();
        raEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editRaForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (raEditPond && raEditPond.getFiles().length > 0) {
        formData.set('file', raEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editRaModal').modal('hide');

            if (raEditPond) {
                raEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});



$(document).on('click', '.delete-ra-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "rosters/deleteRa", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addRaForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addRaModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

