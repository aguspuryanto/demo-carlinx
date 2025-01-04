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
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    // jika listData kosong atau array empty maka tampilkan pesan
                    if ($listData['success']=='0') {
                        echo '<div class="mt-3">
                            <p class="text-center text-danger">Data tidak ditemukan</p>
                        </div>';
                    }
                    // if (empty($listData) && ) echo '<p class="text-center text-danger">Data tidak ditemukan.</p>';
                    ?>
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