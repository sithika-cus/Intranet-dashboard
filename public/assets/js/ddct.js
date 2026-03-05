// ==========================================
// GLOBAL VARIABLE
// ==========================================
let ddctEditPond = null;

$(document).on('click', '.edit-ddct-btn', function () {
    $('#edit-ddct-id').val($(this).data('id'));
    $('#edit-ddct-title').val($(this).data('title'));
    $('#edit-ddct-date').val($(this).data('date'));
    $('#editDdctModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editDdctModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (ddctEditPond) {
        ddctEditPond.destroy();
        ddctEditPond = null;
    }

    ddctEditPond = FilePond.create(
        document.querySelector('#editDdctFile'),
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
$(document).on('hidden.bs.modal', '#editDdctModal', function () {

    if (ddctEditPond) {
        ddctEditPond.destroy();
        ddctEditPond = null;
    }
});
// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editDdctForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (ddctEditPond && ddctEditPond.getFiles().length > 0) {
        formData.set('file', ddctEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editDdctModal').modal('hide');

            if (ddctEditPond) {
                ddctEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-ddct-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "transfers/deleteDdct", { id: id }, function(){

        reloadTable();
    }, 'json');
});
$(document).on('submit', '#addDdctForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addDdctModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});
