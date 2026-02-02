<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Intranet Dashboard</title>

  <!-- Bootstrap & AdminLTE CSS -->
  <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/skins/skin-blue.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/edit.css') ?>">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="<?= base_url('plugins/datatables/DataTables/datatables.min.css') ?>">

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Sri Lanka Customs Intranet</a>
        </div>
    </nav>
  </header>

  <!-- Sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="#" class="load-page" data-url="<?= base_url('dashboard') ?>">Dashboard</a></li>
        <li class="treeview">
            <a href="#">
                <span>Publications</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/departmentalOrders') ?>">
                    Departmental Orders
                  </a>
                </li>
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/ncCommittee') ?>">
                    NC Commitee Decisions
                  </a>
                </li>
                <li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/vcDecisions') ?>">
                    Valuation Committee Decisions
                    </a>
                    </li>  
                <li>
                <a href="#" class="load-page" data-url="<?= base_url('publications/cOrdinance') ?>">
    Customs Ordinance
</a>
<li class="treeview">
      <a href="#">
        <i class="fa fa-legal"></i>
        <span>Legal Uploads</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
              <ul class="treeview-menu">
                <li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/lUploads') ?>">
    Judgements
</a>

</li>      
            </ul>
        </li>
        
        <li><a href="#">Settings</a></li>
      </ul>
    </section>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper" id="main-content">
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>

    <section class="content" id="content-area">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Welcome to AdminLTE + CodeIgniter</h3>
        </div>
        <div class="box-body">
          <p>This is your intranet dashboard. You can add charts, tables, and widgets here.</p>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('plugins/jQuery/jquery-3.6.4.min.js') ?>"></script>
<script src="<?= base_url('dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?= base_url('plugins/datatables/DataTables/datatables.min.js') ?>"></script>



<script>
let currentTable = null;
let currentPageUrl = "<?= base_url('publications/departmentalOrders') ?>";

function initPubTable(startPage = 0) {
    const $table = $('#content-area').find('.pub-table');

    if (!$table.length) return;

    if ($.fn.DataTable.isDataTable($table)) {
        $table.DataTable().destroy();
    }

    currentTable = $table.DataTable({
        pageLength: 10,
        ordering: false,
        searching: true,
        lengthChange: true,
        info: true,
        displayStart: startPage * 10
    });
}



function getCurrentPage() {
    return currentTable ? currentTable.page() : 0;
}

function reloadTable() {
    let page = getCurrentPage();
    $('#content-area').load(currentPageUrl, function() {
        initPubTable(page);
    });
}

// Page load
$(document).on('click', '.load-page', function(e){
    e.preventDefault();
    currentPageUrl = $(this).data('url');
    reloadTable();
});

// Edit
$(document).on('click', '.edit-btn', function () {
    $('#edit-id').val($(this).data('id'));
    $('#edit-no').val($(this).data('no'));
    $('#edit-title').val($(this).data('title'));
    $('#edit-date').val($(this).data('date'));
    $('#editModal').modal('show');
});

$(document).on('submit', '#editForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#editModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
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

// Upload
$(document).on('click', '.upload-btn', function () {
    $('#upload-id').val($(this).data('id'));
    $('#uploadModal').modal('show');
});

$(document).on('submit', '#uploadForm', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#uploadModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            reloadTable();
        }
    });
});

// Delete
$(document).on('click', '.delete-btn', function () {

    if (!confirm('Are you sure you want to delete this record?')) {
        return;
    }

    let id = $(this).data('id');

    $.ajax({
        url: "<?= base_url('publications/delete') ?>",
        type: "POST",
        data: { id: id },
        dataType: 'json',
        success: function () {
            reloadTable(); // ✅ ONLY THIS
        }
    });
});


// Open NC edit modal
$(document).on('click', '.edit-nc-btn', function () {
    $('#edit-nc-id').val($(this).data('id'));
    $('#edit-nc-title').val($(this).data('title'));
    $('#edit-nc-date').val($(this).data('date'));
    $('#editNcModal').modal('show');
});

// Submit NC edit
$(document).on('submit', '#editNcForm', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
            $('#editNcModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keeps page + search + pagination
        }
    });
});

// Open NC upload modal
$(document).on('click', '.upload-nc-btn', function () {
    $('#upload-nc-id').val($(this).data('id'));
    $('#uploadNcModal').modal('show');
});

// Submit NC upload
$(document).on('submit', '#uploadNcForm', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#uploadNcModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keep pagination + search
        }
    });
});

$(document).on('click', '.delete-nc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post("<?= base_url('publications/deleteNc') ?>", {id}, function(){
        reloadTable();
    }, 'json');
});

$(document).on('submit', '#addNcForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addNcModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

// Open VC edit modal
$(document).on('click', '.edit-vc-btn', function () {
    $('#edit-vc-id').val($(this).data('id'));
    $('#edit-vc-date').val($(this).data('date'));
    $('#edit-vc-title').val($(this).data('title'));
    $('#editVcModal').modal('show');
});

// Submit VC edit
$(document).on('submit', '#editVcForm', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
            $('#editVcModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keeps page + search + pagination
        }
    });
});

// Open VC upload modal
$(document).on('click', '.upload-vc-btn', function () {
    $('#upload-vc-id').val($(this).data('id'));
    $('#uploadVcModal').modal('show');
});

// Submit VC upload
$(document).on('submit', '#uploadVcForm', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#uploadVcModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keep pagination + search
        }
    });
});
$(document).on('click', '.delete-vc-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post("<?= base_url('publications/deleteVc') ?>", {id}, function(){
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

// Open C edit modal
$(document).on('click', '.edit-c-btn', function () {
    $('#edit-c-id').val($(this).data('id'));
    $('#edit-c-part_no').val($(this).data('part_no'));
    $('#edit-c-part_desc').val($(this).data('part_desc'));
    $('#edit-c-section_no').val($(this).data('section_no'));
    $('#edit-c-section_desc').val($(this).data('section_desc'));
    $('#editCModal').modal('show');
});

// Submit C edit
$(document).on('submit', '#editCForm', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
            $('#editCModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keeps page + search + pagination
        }
    });
});

// Open C upload modal
$(document).on('click', '.upload-c-btn', function () {
    $('#upload-c-id').val($(this).data('id'));
    $('#uploadCModal').modal('show');
});

// Submit C upload
$(document).on('submit', '#uploadCForm', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#uploadCModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keep pagination + search
        }
    });
});
$(document).on('click', '.delete-c-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post("<?= base_url('publications/deleteC') ?>", {id}, function(){
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

// Open L edit modal
$(document).on('click', '.edit-l-btn', function () {
    $('#edit-l-id').val($(this).data('id'));
    $('#edit-l-date').val($(this).data('date'));
    $('#edit-l-title').val($(this).data('title'));
    $('#editLModal').modal('show');
});

// Submit L edit
$(document).on('submit', '#editLForm', function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
            $('#editLModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keeps page + search + pagination
        }
    });
});

// Open L upload modal
$('body').on('click', '.upload-l-btn', function () {
    $('#upload-l-id').val($(this).data('id'));
    $('#uploadLegalModal').modal('show');
});

// Submit L upload
$('body').on('submit', '#uploadLForm', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#uploadLegalModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            reloadTable(); // keep pagination + search
        }
    });
});
$(document).on('click', '.delete-l-btn', function(){
    if(!confirm('Are you sure?')) return;
    let id = $(this).data('id');
    $.post("<?= base_url('publications/deleteL') ?>", {id}, function(){
        reloadTable();
    }, 'json');
});

$('body').on('submit', '#addLForm', function(e){
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#addLModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        reloadTable();
    }, 'json');
});

$(document).on('show.bs.modal', '.modal', function () {
    $(this).appendTo('body');
});

</script>
</body>
</html>
