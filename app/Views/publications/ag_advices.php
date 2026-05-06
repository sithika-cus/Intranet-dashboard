<section class="content-header">
  <h1>
    <span class="material-icons" style="vertical-align:middle;">list_alt</span>
    Attorny General Advices
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('wall/page') ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>Publications</li>
    <li class="active">Attotny General Advices</li>
  </ol>
</section>
<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Att.Gen Ref</th>
                        <th>Customs.Ref</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($agadvices as $row): ?>
                    <tr>
                        <td><?= $row['attorny_gen_ref'] ?></td>
                        <td><?= $row['cus_ref'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td>
                            <?php if(!empty($row['url']) && ($isAdmin || !empty($perms['can_view']))): ?>
                                <a href="<?= $row['url'] ?>" target="_blank"class="btn btn-xs btn-info">
            <i class="fa fa-eye"></i></a>
                            <?php endif; ?>

                            <?php if($isAdmin || !empty($perms['can_edit'])): ?>
                            <button class="btn btn-xs btn-primary edit-ag-btn"
    data-id="<?= $row['id'] ?>"
    data-attorny_gen_ref="<?= $row['attorny_gen_ref'] ?>"
    data-cus_ref="<?= $row['cus_ref'] ?>"
    data-title="<?= htmlspecialchars($row['title']) ?>"
    data-url="<?= $row['url'] ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
<?php endif; ?>
   
   <?php if($isAdmin || !empty($perms['can_delete'])): ?>
    <button class="btn btn-xs btn-danger delete-ag-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>
<?php endif; ?>

                  
                  </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
          </div>

          <?php if($isAdmin || !empty($perms['can_add'])): ?>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addAgModal">
    <i class="fa fa-plus"></i>
</button>
 <?php endif; ?>
        </div>
    </div>

     

</section>