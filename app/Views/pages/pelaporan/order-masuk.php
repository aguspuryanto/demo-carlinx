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
                    <?= form_open('pelaporan/order-masuk', ['class' => 'row g-3']); ?>
                        <div class="col-auto col-sm-4">
                            <label for="inputTglAwal" class="visually-hidden">Tgl Awal</label>
                            <input type="text" name="tgl_awal" class="form-control" id="inputTglAwal" placeholder="Tgl Awal" value="<?= ($curlOpt['tgl_awal']) ?? date('Y-m-d'); ?>">
                        </div>
                        <div class="col-auto col-sm-4">
                            <label for="inputTglAkhir" class="visually-hidden">Tgl Akhir</label>
                            <input type="text" name="tgl_akhir" class="form-control" id="inputTglAkhir" placeholder="Tgl Akhir" value="<?= ($curlOpt['tgl_akhir']) ?? date('Y-m-d'); ?>">
                        </div>
                        <div class="col-auto col-sm-4">
                            <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    <?php echo form_close(); ?>

                    <?php
                    // echo json_encode($listData);
                    $subTotal = 0;
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
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
                            foreach ($listData['result_report_order'] as $item): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($item['tgl_order'])) ?></td>
                                <td><?= $item['nama_rental'] ?></td>
                                <td class="text-right"><?= format_rupiah($item['hrg_sewa_total']) ?></td>
                            </tr>
                            <?php $subTotal += $item['hrg_sewa_total'];
                        endforeach;
                        endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" colspan="2" class="text-right">Sub Total</th>
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