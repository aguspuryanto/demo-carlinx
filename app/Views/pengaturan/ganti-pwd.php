<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <?php include_once '_alert.php'; ?>

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <?php 
                    //include_once '_form.php';
                    // echo json_encode($sessionUser);
                    ?>
                    <form action="<?= base_url('pengaturan/ganti-password') ?>" method="POST">
                        <div class="form-group">
                            <label for="passwd">Password Baru</label>
                            <input type="password" class="form-control" id="passwd" name="passwd" required>
                        </div>
                        <div class="form-group">
                            <label for="passwd1">Ulang Password Baru</label>
                            <input type="password" class="form-control" id="passwd1" name="passwd1" required>
                        </div>
                        
                        <input type="hidden" id="usernm" name="usernm" value="<?= $sessionUser['username'] ?>">
                        <!-- <button type="button" class="btn btn-secondary">Batal</button> -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>