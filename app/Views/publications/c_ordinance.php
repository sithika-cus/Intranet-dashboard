<section class="content-header">
  <h1>
    <span class="material-icons" style="vertical-align:middle;">list_alt</span>
    Customs Ordinance
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="#" class="load-page" data-url="<?= base_url('wall/page') ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>Publications</li>
    <li class="active">Customs Ordinance</li>
  </ol>
</section>
<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>	
<tr>
    <th>Part No</th>
    <th>Part description</th>
    <th>Section No</th>
    <th>section Description</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($ordinance as $row): ?>
<tr>
    <td><?= esc($row['part_no']) ?></td>
    <td><?= esc($row['part_desc']) ?></td>
    <td><?= esc($row['section_no']) ?></td>
    <td><?= esc($row['section_desc']) ?></td> 
    <td class="text-center">
        <?php if(!empty($row['url']) && ($isAdmin || !empty($perms['can_view']))): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>


        <?php if($isAdmin || !empty($perms['can_edit'])): ?>
        <button class="btn btn-xs btn-warning edit-c-btn"
    data-id="<?= $row['id'] ?>"
    data-part_no="<?= esc($row['part_no']) ?>"
    data-part_desc="<?= esc($row['part_desc']) ?>"
    data-section_no="<?= esc($row['section_no']) ?>"
    data-section_desc="<?= esc($row['section_desc']) ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
<?php endif; ?>

    <?php if($isAdmin || !empty($perms['can_delete'])): ?>
    <button class="btn btn-xs btn-danger delete-c-btn"
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
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addCModal">
            <i class="fa fa-plus"></i>
        </button>
        <?php endif; ?>
</div>
</div>       

</section>