// ==========================================
// GLOBAL VARIABLE
// ==========================================
let lEditPond = null;

// Open L edit modal
$(document).on('click', '.edit-l-btn', function () {
    $('#edit-l-id').val($(this).data('id'));
    $('#edit-l-date').val($(this).data('date'));
    $('#edit-l-title').val($(this).data('title'));
    $('#editLModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editLModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (lEditPond) {
        lEditPond.destroy();
        lEditPond = null;
    }

    lEditPond = FilePond.create(
        document.querySelector('#editLFile'),
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
$(document).on('hidden.bs.modal', '#editLModal', function () {

    if (lEditPond) {
        lEditPond.destroy();
        lEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editLForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (lEditPond && lEditPond.getFiles().length > 0) {
        formData.set('file', lEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editLModal').modal('hide');

            if (lEditPond) {
                lEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.delete-l-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post(BASE_URL + "publications/deleteL", { id: id }, function(){

        reloadTable();
    }, 'json');
});


$(document).on('submit', '#addLForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addLModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

