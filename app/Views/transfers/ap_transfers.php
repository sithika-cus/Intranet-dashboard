<section class="content-header">
    <h1>Appraiser</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
<tr>
    <th>Title</th>
    <th>Date</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($appraiser_transfer_files as $row): ?>
<tr>
    <td><?= esc($row['title']) ?></td>
    <td><?= esc($row['date']) ?></td>
    <td class="text-center">
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>
    <button class="btn btn-xs btn-warning edit-at-btn"
            data-title="<?= esc($row['title']) ?>"
            data-date="<?= esc($row['date']) ?>">
            <i class="fa fa-pencil"></i>
        </button>
        
    
    <button class="btn btn-xs btn-danger delete-at-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addAtModal">
            <i class="fa fa-plus"></i>
        </button>
       </div>
</div>



</section>        