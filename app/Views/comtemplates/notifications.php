<section class="content-header">
  <h1>
    <span class="material-icons" style="vertical-align:middle;">list_alt</span>
    Intranet Notifications
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('wall/page') ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>Notifications</li>
    <li class="active">Intranet Notifications</li>
  </ol>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
<tr>
    <th>Date Added</th>
    <th>Notification Title</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($intranet_notifications as $row): ?>
<tr>
    <td><?= esc(date('Y-m-d', strtotime($row['date_added']))) ?></td>
    <td><?= esc($row['title']) ?></td>
    <td class="text-center">
        <?php if(!empty($row['url']) && ($isAdmin || !empty($perms['can_view']))): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

    <?php if($isAdmin || !empty($perms['can_edit'])): ?>
    <button class="btn btn-xs btn-warning edit-in-btn"
            data-id="<?= $row['id'] ?>"
            data-date_added="<?= date('Y-m-d', strtotime($row['date_added'])) ?>"
            data-title="<?= esc($row['title']) ?>">
            <i class="fa fa-pencil"></i>
        </button>
        <?php endif; ?>
        
    <?php if($isAdmin || !empty($perms['can_delete'])): ?>
    <button class="btn btn-xs btn-danger delete-in-btn"
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
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addInModal">
            <i class="fa fa-plus"></i>
        </button>
        <?php endif; ?>
       </div>
</div>


</section>        