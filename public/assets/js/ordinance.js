// ==========================================
// GLOBAL VARIABLE
// ==========================================
let cEditPond = null;


// Open C edit modal
$(document).on('click', '.edit-c-btn', function () {
    $('#edit-c-id').val($(this).data('id'));
    $('#edit-c-part_no').val($(this).data('part_no'));
    $('#edit-c-part_desc').val($(this).data('part_desc'));
    $('#edit-c-section_no').val($(this).data('section_no'));
    $('#edit-c-section_desc').val($(this).data('section_desc'));
    $('#editCModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editCModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (cEditPond) {
        cEditPond.destroy();
        cEditPond = null;
    }

    cEditPond = FilePond.create(
        document.querySelector('#editCFile'),
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
$(document).on('hidden.bs.modal', '#editCModal', function () {

    if (cEditPond) {
        cEditPond.destroy();
        cEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editCForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (cEditPond && cEditPond.getFiles().length > 0) {
        formData.set('file', cEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editCModal').modal('hide');

            if (cEditPond) {
                cEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-c-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteC", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addCForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addCModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
