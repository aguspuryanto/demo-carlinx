<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Hitung Tarif</h4>
                </div>
                <div class="card-body">
                    <?php include_once '_form.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
<?= $this->endSection() ?>