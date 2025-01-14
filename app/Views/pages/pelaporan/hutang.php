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
                    // {"success":1,"result_hutang":[{"tgl_jam":"2024-12-05 14:03:55","kd_site":"23050001","kd_rental":"22040001","id_order":"241205000002","nominal":"0","due_date":"2024-12-12","sisa":"0","stat":"1","nama_site":"MCORNER SMSX","nama_rental":"GASIK TRANSXX"}]}
                    $subTotal = 0;
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Rental</th>
                                <th scope="col" style="width: 150px;">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($listData['success'] == '0'): ?>
                            <tr>
                                <td colspan="3">
                                    <p class="text-center text-danger">Data tidak ditemukan</p>
                                </td>
                            </div>
                        <?php else: 
                            foreach ($listData['result_hutang'] as $item): ?>
                            <tr>
                                <td><?= $item['nama_rental'] ?></td>
                                <td class="text-right">
                                    <?= format_rupiah($item['nominal']) ?>
                                    <a href="<?= base_url('pelaporan/hutang/detail/' . $item['kd_rental']) ?>" class="btn btn-sm btn-outline"><i class="fa fa-angle-right"></i></a>
                                </td>
                            </tr>
                            <?php $subTotal += $item['nominal'];
                        endforeach;
                        endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" class="text-right">Sub Total</th>
                                <th scope="col" class="text-right"><?= format_rupiah($subTotal) ?></th>
                            </tr>
                        </tfoot>
                    </table>
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