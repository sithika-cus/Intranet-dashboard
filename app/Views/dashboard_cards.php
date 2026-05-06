<!-- Dashboard Header -->
<section class="content-header">
    <div class="dashboard-banner">
        <i class="material-icons">home_work</i>
        <h1>Sri Lanka Customs Intranet</h1>
    </div>
</section>

<!-- Dashboard Cards -->
<div class="row dashboard-cards">

    <!-- Card 1: Departmental Orders -->
    <div class="col-lg-4 col-xs-12">
        <div class="small-box card-gradient card-1">
            <div class="inner">
                <h3>DOPL</h3>
                <p>Departmental Orders</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="#" class="small-box-footer load-page" data-url="<?= base_url('publications/departmentalOrders') ?>">
                Go <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Card 2: Legal Judgements -->
    <div class="col-lg-4 col-xs-12">
        <div class="small-box card-gradient card-2">
            <div class="inner">
                <h3>LJ</h3>
                <p>Legal Judgements</p>
            </div>
            <div class="icon">
                <i class="fa fa-gavel"></i>
            </div>
            <a href="#" class="small-box-footer load-page" data-url="<?= base_url('publications/lUploads') ?>">
                Go <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Card 3: Common Uploads -->
    <div class="col-lg-4 col-xs-12">
        <div class="small-box card-gradient card-3">
            <div class="inner">
                <h3>CU</h3>
                <p>Common Uploads</p>
            </div>
            <div class="icon">
                <i class="fa fa-upload"></i>
            </div>
            <a href="#" class="small-box-footer load-page" data-url="<?= base_url('publications/cUploads') ?>">
                Go <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Card 4: Training Materials -->
    <div class="col-lg-4 col-xs-12">
        <div class="small-box card-gradient card-4">
            <div class="inner">
                <h3>TM</h3>
                <p>Training Materials</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer load-page" data-url="<?= base_url('trainings/tMaterials') ?>">
                Go <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>