<section class="content-header">
    <h1>Departmental Orders</h1>
</section>

<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>DOPL No</th>
                        <th>Departmental Orders</th>
                        <th>Effective Date</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dopl_files as $row): ?>
                    <tr>
                        <td><?= $row['no'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td>
                            <?php if(!empty($row['url'])): ?>
                                <a href="<?= $row['url'] ?>" target="_blank"class="btn btn-xs btn-info">
            <i class="fa fa-eye"></i></a>
                            <?php endif; ?>

                            <button class="btn btn-xs btn-primary edit-btn"
    data-id="<?= $row['id'] ?>"
    data-no="<?= $row['no'] ?>"
    data-title="<?= htmlspecialchars($row['title']) ?>"
    data-date="<?= $row['date'] ?>"
    data-url="<?= $row['url'] ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
   
   
    <button class="btn btn-xs btn-danger delete-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

                  
                  </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addModal">
    <i class="fa fa-plus"></i>
</button>
        </div>
    </div>

    

</section>



