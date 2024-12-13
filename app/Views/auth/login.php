<?= $this->extend('layouts/login') ?>

<?= $this->section('content') ?>
<main class="container-fluid h-100" style="min-height: 945px;">
        <div class="row h-100 overflow-auto">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto"></div>
                        <div class="col">
                            <div class="logo-small">
                                <img src="assets/img/logo.png" alt="">
                                <h5>Carlinx</h5>
                            </div>
                        </div>
                        <div class="col-auto"></div>
                    </div>
                </header>
            </div>
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center text-center py-4">
                <!-- Notifikasi Error -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
                
                <h1 class="mb-4 text-color-theme">Login</h1>
                <form method="post" action="/login" class="was-validated needs-validation" novalidate="">
                    <?= csrf_field(); ?>
                    <div class="form-group form-floating mb-3 is-valid">
                        <input type="email" name="email" id="email" class="form-control" placeholder="test@test.com" required>
                        <label class="form-control-label" for="email">Username</label>
                    </div>

                    <div class="form-group form-floating is-invalid mb-3">
                        <input type="password" name="password" id="password" class="form-control " placeholder="admin123" required>
                        <label class="form-control-label" for="password">Password</label>
                        <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="" id="passworderror" data-bs-original-title="Enter valid Password">
                            <i class="bi bi-info-circle"></i>
                        </button>
                    </div>
                    <p class="mb-3 text-center">
                        <a href="#" class="">
                            Lupa password?
                        </a>
                    </p>

                    <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                       Login
                    </button>
                </form>
                <p class="mb-2 text-muted">Belum punya Akun ?</p>
                <a href="#" target="_self" class="">
                    Register <i class="bi bi-arrow-right"></i>
                </a>

            </div>
            <div class="col-12 text-center mt-auto">
                <div class="row justify-content-center footer-info">
                    <div class="col-auto">
                        <p class="text-muted">Atau login menggunakan </p>
                    </div>
                    <div class="col-auto ps-0">
                        
                        <a href="#" class="p-1"><i class="bi bi-google"></i></a>
                        <a href="#" class="p-1"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?= $this->endSection() ?>