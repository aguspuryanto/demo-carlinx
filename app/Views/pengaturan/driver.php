<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <?php include_once '_alert.php'; ?>
        
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left"><?= $title ?></h4>
                    <div class="card-header-action float-right">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
                        <?php foreach ($listData as $item) : ?>
                        <li class="list-group-item">
                            <h5 class="mb-1"><?= $item['nm_kat'] ?></h5>
                            <p class="mb-0">Dalam Kota Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></p>
                            <p class="mb-0">Luar Kota Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></p>
                            <p class="mb-0">Luar Batas Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></p>
                        </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="table-responsive d-sm-none d-md-none d-lg-block d-xl-block mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Dalam Kota</th>
                                <th scope="col">Luar Kota</th>
                                <th scope="col">Luar Batas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listData as $item) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $item['nm_kat'] ?></td>
                                    <td>Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_driver.php'; ?>

<?= $this->endSection() ?>