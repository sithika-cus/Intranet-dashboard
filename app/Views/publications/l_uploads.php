<section class="content-header">
	<h1>Legal Uploads</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
	<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Title</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($legaluploads as $row): ?>
<tr>
    <td><?= esc($row['id']) ?></td>
    <td><?= esc($row['date']) ?></td>
    <td><?= esc($row['title']) ?></td>
    <td class="text-center">
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

    <button class="btn btn-xs btn-warning edit-l-btn"
    data-id="<?= esc($row['id']) ?>"
    data-date="<?= esc($row['date']) ?>"
    data-title="<?= esc($row['title']) ?>"
    data-url="<?= esc($row['url']) ?>">
    <i class="fa fa-pencil"></i>
</button>


    <button class="btn btn-xs btn-danger delete-l-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>
</td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
</div>
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addLModal">
            <i class="fa fa-plus"></i>
        </button>
</div>
</div>       

</section>

