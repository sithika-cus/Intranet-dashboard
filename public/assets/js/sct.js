// ==========================================
// GLOBAL VARIABLE
// ==========================================
let sctEditPond = null;

$(document).on('click', '.edit-sct-btn', function () {
    $('#edit-sct-id').val($(this).data('id'));
    $('#edit-sct-title').val($(this).data('title'));
    $('#edit-sct-date').val($(this).data('date'));
    $('#editSctModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editSctModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (sctEditPond) {
        sctEditPond.destroy();
        sctEditPond = null;
    }

    sctEditPond = FilePond.create(
        document.querySelector('#editSctFile'),
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
$(document).on('hidden.bs.modal', '#editSctModal', function () {

    if (sctEditPond) {
        sctEditPond.destroy();
        sctEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editSctForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (sctEditPond && sctEditPond.getFiles().length > 0) {
        formData.set('file', sctEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editSctModal').modal('hide');

            if (sctEditPond) {
                sctEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-sct-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "transfers/deleteSct", { id: id }, function(){

        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addSctForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addSctModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
