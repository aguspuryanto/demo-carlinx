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
                    //include_once '_form_order_masuk.php';
                    // echo json_encode($listData);
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Rental</th>
                                <th scope="col">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listData as $data) { ?>
                                <tr>
                                    <td><?= $data['tgl_order'] ?></td>
                                    <td><?= $data['nama_rental'] ?></td>
                                    <td>Rp. <?= number_format($data['hrg_sewa_total'], 0, ',', '.') ?></td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>