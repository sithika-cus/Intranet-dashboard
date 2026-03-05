<section class="content-header">
    <h1>Customs Detections</h1>
</section>

<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Directorate</th>
                        <th>Uploaded By</th>
                        <th>Date</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cusdet as $row): ?>
                    <tr>
                        <td><?= esc($row['title']) ?></td>
                        <td><?= esc($row['document_name']) ?></td>
                        <td><?= esc($row['user']) ?></td>
                        <td><?= esc(date('Y-m-d', strtotime($row['date_modified']))) ?></td>
                        <td>
                            <?php if (!empty($row['file_link'])): ?>
        <a href="<?= base_url($row['file_link']) ?>"
           target="_blank"
           class="btn btn-xs btn-success">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif; ?>

                            <button class="btn btn-xs btn-primary edit-cd-btn"
    data-id="<?= $row['id'] ?>"
    data-title="<?= htmlspecialchars($row['title']) ?>"
    data-document_name="<?= $row['document_name'] ?>"
    data-date_modified="<?= date('Y-m-d', strtotime($row['date_modified'])) ?>"
    data-file_link="<?= $row['file_link'] ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
     
     
   
   
    <button class="btn btn-xs btn-danger delete-cd-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

          </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
          </div>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addCdModal">
    <i class="fa fa-plus"></i>
</button>
        </div>
    </div>

    



</section>