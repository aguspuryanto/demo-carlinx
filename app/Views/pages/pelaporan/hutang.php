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
                    <!-- <form action="" method="POST" class="row g-3"> -->
                    <?= form_open('pelaporan/hutang', ['class' => 'row g-3']); ?>
                        <div class="col-auto">
                            <label for="inputTglAwal" class="visually-hidden">Tgl Awal</label>
                            <input type="text" name="tgl_awal" class="form-control" id="inputTglAwal" placeholder="Tgl Awal" value="<?= ($curlOpt['tgl_awal']) ?? date('Y-m-d'); ?>">
                        </div>
                        <div class="col-auto">
                            <label for="inputTglAkhir" class="visually-hidden">Tgl Akhir</label>
                            <input type="text" name="tgl_akhir" class="form-control" id="inputTglAkhir" placeholder="Tgl Akhir" value="<?= ($curlOpt['tgl_akhir']) ?? date('Y-m-d'); ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    <?php echo form_close(); ?>

                    <?php
                    // echo json_encode($listData);
                    ?>

                    <ul class="list-group">
                        <?php if ($listData['success'] == '0'): ?>
                            <div class="mt-3">
                                <p class="text-center text-danger">Data tidak ditemukan</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($listData as $item): ?>
                            <li class="list-group-item">
                                <h6>
                                    <span class="badge <?= ($item['grp_penyewa'] == '1') ? 'bg-danger' : 'bg-info'; ?>"><?= $listGroup[$item['grp_penyewa']] ?></span>
                                    <span class="badge bg-secondary"><?= $listOrder[$item['jns_order']] ?></span> <?= $item['tgl_order'] ?>
                                </h6>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-0"><?= $item['nama_unit'] ?></h5>
                                    <small class="<?= ($item['stat'] == '9') ? 'text-success' : 'text-danger'; ?>"><?= $listStatus[$item['stat']]; ?> <br>by <?= $item['nama_cs'] ?></small>
                                </div>
                                <p class="mb-0">Rp. <?= number_format($item['hrg_sewa_total'], 0, ',', '.') ?></p>
                                <small>*dipesan oleh: <?= $item['rental_penyewa'] ?></small>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $('#inputTglAwal').datepicker({
        uiLibrary: 'bootstrap5', format: 'dd-mm-yyyy'
    });

    $('#inputTglAkhir').datepicker({
        uiLibrary: 'bootstrap5', format: 'dd-mm-yyyy'
    });
</script>
<?= $this->endSection() ?>