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
  <link rel="stylesheet" href="<?= base_url('assets/filepond/filepond.min.css') ?>">

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
        <li><a href="#" class="load-page" data-url="<?= base_url('') ?>">Dashboard</a></li>
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
</li>
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
<li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/aGadvices') ?>">
    AG Advices
</a>

</li>      
            </ul>
        </li>
         <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/cUploads') ?>">
                    Common Uploads
                  </a>
                </li>
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/cDetections') ?>">
                    Customs Detections
                  </a>
                </li>

        
        <li><a href="#">Settings</a></li>

      </ul>

      <li class="treeview">
  <a href="#">
    <span>Commodity Classification</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('cclassification/advanceRuiling') ?>">
        Advance Ruiling
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('cclassification/internalRuiling') ?>">
        Internal Ruiling
      </a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <span>Rosters</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/wRoasters') ?>">
        Warehouse (ASC)
      </a>
    </li>

    <li class="treeview">
  <a href="#">
    <span>SO</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/aRosters') ?>">Airport/Import/Export
      </a>
    </li>
    
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/aRoasters') ?>">
        
      </a>
    </li>
  </ul>
</li>
<li class="treeview">
  <a href="#">
    <span>SC</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/ascRosters') ?>">Airport/Import/Export 
      </a>
    </li>
    
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/aRoasters') ?>">RCT
        
      </a>
    </li>
  </ul>
</li>

    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/aTransfer') ?>"> Appraiser
        
      </a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <span>Transfers</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/ddcTransfers') ?>">
        DDC Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/scTransfers') ?>">
         SC Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/apTransfers') ?>">
         Appraiser Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/ascTransfers') ?>">
         ASC & DSC Transfers
      </a>
    </li>
  </ul>
</li>

  <li class="treeview">
  <a href="#">
    <span>Training Programs</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/fTrainings') ?>">
        Foreign Training Programs
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/') ?>">
         Local Training Programs
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/tMaterials') ?>">
         Training Materials
      </a>
    </li>
    
  </ul>
</li>
<li><a href="#" class="load-page" data-url="<?= base_url('comtemplates/cTemplates') ?>">Common Templates</a></li>

  <li class="treeview">
  <a href="#">
    <span>Notifications</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('comtemplates/iNotifications') ?>">Intranet Notifications
        
      </a>
    </li>
    </ul>
</li>

    </section>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper" id="main-content">
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>

    <section class="content" id="content-area">
      <div class="row">
        <!-- DDC Transfers -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>DOPL</h3>
              <p>Departmental Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <a href="#" 
   class="small-box-footer load-page" 
   data-url="<?= base_url('publications/departmentalOrders') ?>">
  Go <i class="fa fa-arrow-circle-right"></i>
</a>
          </div>
        </div>

  
    

<!-- Scripts -->
<script src="<?= base_url('plugins/jQuery/jquery-3.6.4.min.js') ?>"></script>
<script src="<?= base_url('dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?= base_url('plugins/datatables/DataTables/datatables.min.js') ?>"></script>

<script src="<?= base_url('assets/filepond/filepond.min.js') ?>"></script>
<script src="<?= base_url('assets/filepond/filepond-plugin-file-validate-type.min.js') ?>"></script>
<script src="<?= base_url('assets/filepond/filepond-plugin-file-validate-size.min.js') ?>"></script>


<script>
  const BASE_URL = "<?= base_url() ?>";
</script>

<script src="<?= base_url('assets/js/core.js') ?>"></script>
<script src="<?= base_url('assets/js/departmental.js') ?>"></script>
<script src="<?= base_url('assets/js/nc.js') ?>"></script>
<script src="<?= base_url('assets/js/vc.js') ?>"></script>
<script src="<?= base_url('assets/js/legal.js') ?>"></script>
<script src="<?= base_url('assets/js/ag.js') ?>"></script>
<script src="<?= base_url('assets/js/common_uploads.js') ?>"></script>
<script src="<?= base_url('assets/js/detections.js') ?>"></script>
<script src="<?= base_url('assets/js/ar.js') ?>"></script>
<script src="<?= base_url('assets/js/ir.js') ?>"></script>
<script src="<?= base_url('assets/js/wh.js') ?>"></script>
<script src="<?= base_url('assets/js/arosters.js') ?>"></script>
<script src="<?= base_url('assets/js/ascrosters.js') ?>"></script>
<script src="<?= base_url('assets/js/ddct.js') ?>"></script>
<script src="<?= base_url('assets/js/sct.js') ?>"></script>
<script src="<?= base_url('assets/js/at.js') ?>"></script>
<script src="<?= base_url('assets/js/adt.js') ?>"></script>
<script src="<?= base_url('assets/js/ftp.js') ?>"></script>
<script src="<?= base_url('assets/js/tm.js') ?>"></script>
<script src="<?= base_url('assets/js/ct.js') ?>"></script>
<script src="<?= base_url('assets/js/in.js') ?>"></script>

<?php include 'modals/cd_modals.php'; ?>
<?php include 'modals/cu_modals.php'; ?>
<?php include 'modals/ag_modals.php'; ?>
<?php include 'modals/l_modals.php'; ?>
<?php include 'modals/or_modals.php'; ?>
<?php include 'modals/vc_modals.php'; ?>
<?php include 'modals/nc_modals.php'; ?>
<?php include 'modals/dopl_modals.php'; ?>
<?php include 'modals/ar_modals.php'; ?>
<?php include 'modals/ir_modals.php'; ?>
<?php include 'modals/sc_modals.php'; ?>
<?php include 'modals/ra_modals.php'; ?>
<?php include 'modals/wr_modals.php'; ?>
<?php include 'modals/ddc_modals.php'; ?>
<?php include 'modals/sct_modals.php'; ?>
<?php include 'modals/at_modals.php'; ?>
<?php include 'modals/asc_modals.php'; ?>
<?php include 'modals/ftp_modals.php'; ?>
<?php include 'modals/tm_modals.php'; ?>
<?php include 'modals/ct_modals.php'; ?>
<?php include 'modals/in_modals.php'; ?>



</body>
</html>
