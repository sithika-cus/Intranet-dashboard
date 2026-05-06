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
  
  <!-- jQuery DateTimePicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    <nav class="navbar navbar-static-top">
  <div class="navbar-header">
    
    <a class="navbar-brand" href="#">Sri Lanka Customs Intranet</a>
  </div>

  <!-- ADD THIS -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li>
        <a href="#" style="color:#fff; padding:15px;">
          <i class="fa fa-user-circle"></i>
          <?= session()->get('full_name') ?? 'Guest' ?>
          <?php if(session()->get('role') === 'admin'): ?>
            <span class="label label-danger" style="margin-left:4px;">Admin</span>
          <?php endif; ?>
        </a>
      </li>
      <li>
        <a href="<?= base_url('logout') ?>" style="color:#fff; padding:15px;">
          <i class="fa fa-sign-out"></i> Logout
        </a>
      </li>
    </ul>
  </div>

</nav>

  </header>

  <!-- Sidebar -->
  <!-- <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="#" class="load-page" data-url="<?= base_url('wall/page') ?>">
    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
</a>
      </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i> <span>Publications</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/departmentalOrders') ?>"><i class="fa fa-file-text-o"></i>
                    Departmental Orders
                  </a>
                </li>
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/ncCommittee') ?>"><i class="fa fa-file-text-o"></i>
                    NC Commitee Decisions
                  </a>
                </li>
                <li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/vcDecisions') ?>"><i class="fa fa-file-text-o"></i>
                    Valuation Committee Decisions
                    </a>
                    </li>  
                <li>
                <a href="#" class="load-page" data-url="<?= base_url('publications/cOrdinance') ?>"><i class="fa fa-file-text-o"></i>
    Customs Ordinance
</a>
</li>
<li class="treeview">
      <a href="#">
        <i class="fa fa-file-text-o"></i>
        <span>Legal Uploads</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
              <ul class="treeview-menu">
                <li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/lUploads') ?>"><i class="fa fa-gavel"></i>
    Judgements
</a>

</li>      
<li>
                    <a href="#" class="load-page" data-url="<?= base_url('publications/aGadvices') ?>"><i class="fa fa-file-text-o"></i>
    AG Advices
</a>

</li>      
            </ul>
        </li>
         <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/cUploads') ?>"><i class="fa fa-file-text-o"></i>
                    Common Uploads
                  </a>
                </li>
                <li>
                  <a href="#" class="load-page" data-url="<?= base_url('publications/cDetections') ?>"><i class="fa fa-file-text-o"></i>
                    Customs Detections
                  </a>
                </li>

        
        <li><a href="#">Settings</a></li>

      </ul>

      <li class="treeview">
  <a href="#">
    <i class="fa fa-cubes"></i> <span>Commodity Classification</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('cclassification/advanceRuiling') ?>"><i class="fa fa-file-text-o"></i>
        Advance Ruiling
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('cclassification/internalRuiling') ?>"><i class="fa fa-file-text-o"></i>
        Internal Ruiling
      </a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i> <span>Rosters</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('rosters/wRoasters') ?>"><i class="fa fa-file-text-o"></i>
        Warehouse (ASC)
      </a>
    </li>

    <li class="treeview">
  <a href="#"><i class="fa fa-file-text-o"></i>
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
  <a href="#"><i class="fa fa-file-text-o"></i>
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
      <a href="#" class="load-page" data-url="<?= base_url('rosters/aTransfer') ?>"> <i class="fa fa-file-text-o"></i>Appraiser
        
      </a>
    </li>
  </ul>
</li>

<li class="treeview">
  <a href="#">
    <i class="fa fa-exchange"></i> <span>Transfers</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/ddcTransfers') ?>"><i class="fa fa-file-text-o"></i>
        DDC Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/scTransfers') ?>"><i class="fa fa-file-text-o"></i>
         SC Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/apTransfers') ?>"><i class="fa fa-file-text-o"></i>
         Appraiser Transfers
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('transfers/ascTransfers') ?>"><i class="fa fa-file-text-o"></i>
         ASC & DSC Transfers
      </a>
    </li>
  </ul>
</li>

  <li class="treeview">
  <a href="#">
    <i class="fa fa-graduation-cap"></i> <span>Training Programs</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/fTrainings') ?>"><i class="fa fa-file-text-o"></i>
        Foreign Training Programs
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/') ?>"><i class="fa fa-file-text-o"></i>
         Local Training Programs
      </a>
    </li>
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('trainings/tMaterials') ?>"><i class="fa fa-file-text-o"></i>
         Training Materials
      </a>
    </li>
    
  </ul>
</li>
<li><a href="#" class="load-page" data-url="<?= base_url('comtemplates/cTemplates') ?>"><i class="fa fa-file"></i> <span>Common Templates</span></a></li>

  <li class="treeview">
  <a href="#">
    <i class="fa fa-bell"></i> <span>Notifications</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('comtemplates/iNotifications') ?>"><i class="fa fa-file-text-o"></i>Intranet Notifications
        
      </a>
    </li>
    </ul>
</li>

 
    </section>
  </aside> --> 

  <!-- Content Wrapper -->
  <div class="content-wrapper" id="main-content">
    <section class="content-header">
      
    </section>

    <section class="content" id="content-area">
    <?= view('socket_test') ?>
</section>
  

<!-- Scripts -->
<script src="<?= base_url('plugins/jQuery/jquery-3.6.4.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?= base_url('plugins/datatables/DataTables/datatables.min.js') ?>"></script>
<script src="<?= base_url('dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script> 

<script src="<?= base_url('assets/filepond/filepond.min.js') ?>"></script>
<script src="<?= base_url('assets/filepond/filepond-plugin-file-validate-type.min.js') ?>"></script>
<script src="<?= base_url('assets/filepond/filepond-plugin-file-validate-size.min.js') ?>"></script>

<!-- jQuery DateTimePicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


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

<?= view('modals/cd_modals') ?>
<?= view('modals/cu_modals') ?>
<?= view('modals/ag_modals') ?>
<?= view('modals/l_modals') ?>
<?= view('modals/or_modals') ?>
<?= view('modals/vc_modals') ?>
<?= view('modals/nc_modals') ?>
<?= view('modals/dopl_modals') ?>
<?= view('modals/ar_modals') ?>
<?= view('modals/ir_modals') ?>
<?= view('modals/sc_modals') ?>
<?= view('modals/ra_modals') ?>
<?= view('modals/wr_modals') ?>
<?= view('modals/ddc_modals') ?>
<?= view('modals/sct_modals') ?>
<?= view('modals/at_modals') ?>
<?= view('modals/asc_modals') ?>
<?= view('modals/ftp_modals') ?>
<?= view('modals/tm_modals') ?>
<?= view('modals/ct_modals') ?>
<?= view('modals/in_modals') ?>


</body>
</html>
