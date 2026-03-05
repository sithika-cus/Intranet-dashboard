<section class="content-header">
	<h1>Customs Ordinance</h1>
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
        <?php if (!empty($row['url'])): ?>
        <a href="<?= esc($row['url']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

        <button class="btn btn-xs btn-warning edit-c-btn"
    data-id="<?= $row['id'] ?>"
    data-part_no="<?= esc($row['part_no']) ?>"
    data-part_desc="<?= esc($row['part_desc']) ?>"
    data-section_no="<?= esc($row['section_no']) ?>"
    data-section_desc="<?= esc($row['section_desc']) ?>"
    >
    <i class="fa fa-pencil"></i>
</button>

    <button class="btn btn-xs btn-danger delete-c-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
</div>
<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addCModal">
            <i class="fa fa-plus"></i>
        </button>
</div>
</div>       

</section>