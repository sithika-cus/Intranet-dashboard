// ==========================================
// GLOBAL VARIABLE
// ==========================================
let dEditPond = null;

// Edit
$(document).on('click', '.edit-btn', function () {
    $('#edit-id').val($(this).data('id'));
    $('#edit-no').val($(this).data('no'));
    $('#edit-title').val($(this).data('title'));
    $('#edit-date').val($(this).data('date'));
    $('#editModal').modal('show');
});

// ==========================================
// INITIALIZE FILEPOND WHEN MODAL OPENS
// (AJAX SAFE)
// ==========================================
// When modal opens
$(document).on('shown.bs.modal', '#editModal', function () {

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Destroy old instance if exists
    if (dEditPond) {
        dEditPond.destroy();
        dEditPond = null;
    }

    dEditPond = FilePond.create(
        document.querySelector('#editDFile'),
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
$(document).on('hidden.bs.modal', '#editModal', function () {

    if (dEditPond) {
        dEditPond.destroy();
        dEditPond = null;
    }
});

// ==========================================
// EDIT FORM SUBMIT
// ==========================================
$(document).on('submit', '#editForm', function (e) {

    e.preventDefault();

    let formData = new FormData(this);

    // 🔥 Append file manually from FilePond
    if (dEditPond && dEditPond.getFiles().length > 0) {
        formData.set('file', dEditPond.getFiles()[0].file);
    }

    $.ajax({
        url: this.action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#editModal').modal('hide');

            if (dEditPond) {
                dEditPond.removeFiles();
            }

            reloadTable();
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


// Add
$(document).on('submit', '#addForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});


// Delete
$(document).on('click', '.delete-btn', function () {

    if (!confirm('Are you sure you want to delete this record?')) {
        return;
    }

    let id = $(this).data('id');

    $.ajax({
        url: BASE_URL + 'publications/delete',
        type: "POST",
        data: { id: id },
        dataType: 'json',
        success: function () {
            reloadTable(); // ✅ ONLY THIS
        }
    });
});
