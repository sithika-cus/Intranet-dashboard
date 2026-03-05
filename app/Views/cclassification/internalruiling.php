<section class="content-header">
    <h1>Internal Ruiling</h1>
</section>

<section class="content">
    <div class="box box-primary">
       <div class="box-body table-responsive">
        <div class="datatable-fix">
            <table class="pub-table table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Commodity Description</th>
                        <th>Photo</th>
                        <th>Declared HS</th>
                        <th>Queried HS</th>
                        <th>Codes in Balance</th>
                        <th>GRI Reference</th>
                        <th>Key Points</th>
                        <th>HS Suggested by CC</th>
                        <th>Issue Date</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($intrl as $row): ?>
                    <tr>
                        <td><?= esc($row['com_desc']) ?></td>
                        <td><?= esc($row['photo']) ?></td>
                        <td><?= esc($row['dec_hs']) ?></td>
                        <td><?= esc($row['que_hs']) ?></td>
                        <td><?= esc($row['codes_balance']) ?></td>
                        <td><?= esc($row['gri_ref']) ?></td>
                        <td><?= esc($row['key_point']) ?></td>
                        <td><?= esc($row['cc_hs']) ?></td>
                        <td><?= esc($row['issue_date']) ?></td>
                        <td>
                            <?php if(!empty($row['file_link'])): ?>
                                <a href="<?= esc($row['file_link']) ?>" target="_blank"class="btn btn-xs btn-info">
            <i class="fa fa-eye"></i></a>
                            <?php endif; ?>

                            <button class="btn btn-xs btn-primary edit-ir-btn"
    data-id="<?= $row['id'] ?>"
    data-com_desc="<?= $row['com_desc'] ?>"
    data-dec_hs="<?= htmlspecialchars($row['dec_hs']) ?>"
    data-que_hs="<?= $row['que_hs'] ?>"
    data-codes_balance="<?= $row['codes_balance'] ?>"
    data-gri_ref="<?= $row['gri_ref'] ?>"
    data-key_point="<?= $row['key_point'] ?>"
    data-cc_hs="<?= $row['cc_hs'] ?>"
    data-issue_date="<?= $row['issue_date'] ?>"
    >
    <i class="fa fa-pencil"></i>
</button>
   
   
    <button class="btn btn-xs btn-danger delete-ir-btn"
    data-id="<?= $row['id'] ?>">
    <i class="fa fa-trash"></i>
</button>

          </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
          </div>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addIrModal">
    <i class="fa fa-plus"></i>
</button>
        </div>
    </div>

    

</section>