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
                    echo json_encode($listData);
                    ?>
                    <ul class="list-group">
                        <?php foreach ($listData as $item) : ?>
                        <li class="list-group-item">
                            <p class="mb-0">Dalam Kota Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></p>
                            <p class="mb-0">Luar Kota Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></p>
                            <p class="mb-0">Luar Batas Rp. <?= number_format($item['luar_batas'], 0, ',', '.') ?></p>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>