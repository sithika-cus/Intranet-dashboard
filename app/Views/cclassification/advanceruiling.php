<section class="content-header">
  <h1>
    <span class="material-icons" style="vertical-align:middle;">list_alt</span>
    Advance Ruiling
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('wall/page') ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>Commodity Classification</li>
    <li class="active">Advance Ruiling</li>
  </ol>
</section>

<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Document Title</th>
                        <th>Uploaded By</th>
                        <th>Date</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($advrl as $row): ?>
                    <tr>
                        <td><?= esc($row['title']) ?></td>
                        <td><?= esc($row['document_name']) ?></td>
                        <td><?= esc($row['user']) ?></td>
                        <td><?= esc(date('Y-m-d', strtotime($row['date_modified']))) ?></td>
                        <td>
                            <?php if(!empty($row['file_link']) && ($isAdmin || !empty($perms['can_view']))): ?>
                                <a href="<?= esc($row['file_link']) ?>" target="_blank"class="btn btn-xs btn-info">
            <i class="fa fa-eye"></i></a>
                            <?php endif; ?>

                            <?php if($isAdmin || !empty($perms['can_edit'])): ?>
                            <button class="btn btn-xs btn-primary edit-ar-btn"
    data-id="<?= $row['id'] ?>"
    data-title="<?= htmlspecialchars($row['title']) ?>"
    data-document_name="<?= $row['document_name'] ?>"
    data-date_modified="<?= date('Y-m-d', strtotime($row['date_modified'])) ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
<?php endif; ?>
   
   <?php if($isAdmin || !empty($perms['can_delete'])): ?>
    <button class="btn btn-xs btn-danger delete-ar-btn"
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
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addArModal">
    <i class="fa fa-plus"></i>
</button>
<?php endif; ?>

        </div>
    </div>

    


</section>