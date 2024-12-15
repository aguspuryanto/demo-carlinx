<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- main page content -->
<div class="main-container container">
     
    <!-- money request received -->
    <div class="row mb-4 hideonprogress" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-44 shadow-sm rounded-10">
                                <img src="/assets/img/user1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="small mb-1">
                            <span class="text-muted">Hi </span>
                            <a href="/profile.html" class="fw-medium">Muniro ...</a> </p>
                            <p><small class="text-muted">Selamat Datang kembali...</small>
                            </p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-44 btn-default shadow-sm">
                                <i class="bi bi-arrow-up-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-12">
                        <div class="progress bg-none h-2 hideonprogressbar" data-target="hideonprogress">
                            <div class="progress-bar bg-theme" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 99%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('_parts/content.php'); ?>

    <?php include_once('_parts/blog.php'); ?>

</div>
<!-- main page content ends -->

<?= $this->endSection() ?>