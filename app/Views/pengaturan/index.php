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
                        <li class="list-group-item"><a href="<?= base_url('pengaturan/'. strtolower(url_title($item, '-', true))); ?>"><?= $item ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>