// ==========================================
// GLOBAL VARIABLE
// ==========================================
let vcEditPond = null;


// Open VC edit modal
$(document).on('click', '.edit-vc-btn', function () {
    $('#edit-vc-id').val($(this).data('id'));
    $('#edit-vc-date').val($(this).data('date'));
    $('#edit-vc-title').val($(this).data('title'));
    $('#editVcModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editVcModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (vcEditPond) {
        vcEditPond.destroy();
        vcEditPond = null;
    }

    vcEditPond = FilePond.create(
        document.querySelector('#editVcFile'),
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
$(document).on('hidden.bs.modal', '#editVcModal', function () {

    if (vcEditPond) {
        vcEditPond.destroy();
        vcEditPond = null;
    }
});


// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editVcForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (vcEditPond && vcEditPond.getFiles().length > 0) {
        formData.set('file', vcEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editVcModal').modal('hide');

            if (vcEditPond) {
                vcEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.delete-vc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteVc", { id: id }, function(){

        reloadTable();
    }, 'json');
});


$(document).on('submit', '#addVcForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addVcModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

