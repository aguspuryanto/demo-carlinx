<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <?php
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group">
                    <?php foreach ($listData as $item) : ?>
                        <li class="list-group-item">
                            <h6 class="mb-2"><span class="badge <?=($item['grp_penyewa']=='1') ? 'bg-danger' : 'bg-info';?>"><?= $listGroup[$item['grp_penyewa']] ?></span> <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <small><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></small></h6>
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0"><?= $item['nama_unit'] ?></h6>
                                <small class="<?=($item['stat']=='9') ? 'text-success' : 'text-danger'; ?> text-right"><?= $listStatus[$item['stat']]; ?> <br>by <?= $item['nama_cs'] ?></small>
                            </div>
                            <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                            <small>*dipesan oleh: <?= $item['rental_penyewa'] ?></small>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>