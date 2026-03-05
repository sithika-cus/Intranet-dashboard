<section class="content-header">
    <h1>Training Materials</h1>
</section>

<section class="content">
<div class="box box-primary">
<div class="box-body table-responsive">
  <div class="datatable-fix">

<table class="pub-table table table-bordered table-striped">
<thead>
<tr>
    <th>Training Program</th>
    <th>Document Title</th>
    <th>Uploaded By</th>
    <th>Date</th>
    <th style ="width: 200px;">Actions</th>
    
</tr>
</thead>

<tbody>
<?php foreach($training_materials as $row): ?>
<tr>
    <td><?= esc($row['training_name']) ?></td>
    <td><?= esc($row['document_name']) ?></td>
    <td><?= esc($row['user']) ?></td>
    <td><?= esc(date('Y-m-d', strtotime($row['date_modified']))) ?></td>

    <td class="text-center">
        <?php if (!empty($row['file_link'])): ?>
        <a href="<?= esc($row['file_link']) ?>" 
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>
    <button class="btn btn-xs btn-warning edit-tm-btn"
            data-id="<?= $row['id'] ?>"
            data-training_name="<?= esc($row['training_name']) ?>"
            data-document_name="<?= esc($row['document_name']) ?>"
            data-date_modified="<?= date('Y-m-d', strtotime($row['date_modified'])) ?>">

            <i class="fa fa-pencil"></i>
        </button>
        
    
    <button class="btn btn-xs btn-danger delete-tm-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addTmModal">
            <i class="fa fa-plus"></i>
        </button>
       </div>
</div>



</section>        