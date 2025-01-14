<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <?php
            echo json_encode($listData);
            ?>
        </div>
    </div>
    <!-- end main page content -->
<?= $this->endSection() ?>