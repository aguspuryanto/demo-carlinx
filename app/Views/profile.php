<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<main class="h-100" style="min-height: 945px; padding-top: 85.7188px; padding-bottom: 70px;">

        <!-- Header -->
       <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
                <div class="col align-self-center text-center">
                    <div class="logo-small">
                        <img src="assets/img/logo.png" alt="">
                        <h5>CarLinx</h5>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#" target="_self" class="btn btn-light btn-44">
                        <i class="bi bi-bell"></i>
                        <span class="count-indicator"></span>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container pt-0">
            <!-- user information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-60 rounded-10">
                                <img src="assets/img/user1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col px-0 align-self-center">
                            <h3 class="mb-0 text-color-theme">Muniro</h3>
                            <p class="text-muted ">Surabaya, ID</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sollicitudin dignissim
                        nisi, eget malesuada ligula ultricies sit amet. Suspendisse efficitur ex eu est placerat mattis.
                    </p>
                    <div class="row">
                        <div class="col d-grid">
                            <button class="btn btn-default btn-lg shadow-sm">Invite</button>
                        </div>
                        <div class="col d-grid">
                            <a href="#" class="btn btn-light btn-lg shadow-sm">Chat</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- followers and connections -->
            <div class="row mb-4 text-center py-4 bg-theme-light">
                <div class="col">
                    <h6 class="mb-0">+254</h6>
                    <p class="text-muted small">Unit Armada</p>
                </div>
                <div class="col">
                    <h6 class="mb-0">+124</h6>
                    <p class="text-muted small">Driver</p>
                </div>
                <div class="col">
                    <h6 class="mb-0">+1456</h6>
                    <p class="text-muted small">Layanan</p>
                </div>
            </div>

            <!-- summary -->
            <div class="row mb-3">
                
                <div class="col-6 col-md-6">
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto px-0">
                                    <div class="avatar avatar-40 bg-success text-white shadow-sm rounded-10-end">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted size-12 mb-0">Transaksi</p>
                                    <p>15,6 jt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-6 col-md-6">
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto px-0">
                                    <div class="avatar avatar-40 bg-warning text-white shadow-sm rounded-10-end">
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="text-muted size-12 mb-0">Point</p>
                                    <p>100  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- map location -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h6 class="my-1">Lokasi</h6>
                        </div>
                        <div class="card-body">
                            <figure class="w-100">
                                <img src="assets/img/map@2x.png" class="mw-100" alt="">
                            </figure>
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-1">Wisatajatim</h6>
                                    <p class="text-muted small">Tour &amp; Travel</p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-link p-0">
                                        <i class="bi bi-arrow-up-right-circle fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <p class="text-muted">Tirta Akasia No. 29, Waru - Sidoarjo Jawa Timur</p>
                        </div>
                    </div>
                </div>
            </div>

             <!-- summary swiper carousel -->
             <div class="row">
                <div class="col-12 px-0">
                    <div class="swiper-container summayswiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                        <div class="swiper-wrapper" id="swiper-wrapper-8ebc40a3fafc9d57" aria-live="polite">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4">
                                <div class="card shadow-sm mb-4 alert-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-40 bg-primary text-white rounded-circle">
                                                    <i class="bi bi-clock"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">+155</h6>
                                                <p class="text-muted small">Transaksi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 4">
                                <div class="card shadow-sm mb-4 alert-warning">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-40 bg-warning text-white rounded-circle">
                                                    <i class="bi bi-cpu"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">+365</h6>
                                                <p class="text-muted small">Proses</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" role="group" aria-label="3 / 4">
                                <div class="card shadow-sm mb-4 alert-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-40 bg-success text-white rounded-circle">
                                                    <i class="bi bi-folder"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">+658</h6>
                                                <p class="text-muted small">Sukses</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" role="group" aria-label="4 / 4">
                                <div class="card shadow-sm mb-4 alert-danger">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-40 bg-danger text-white rounded-circle">
                                                    <i class="bi bi-bar-chart"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">+248</h6>
                                                <p class="text-muted small">Batal</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </div>
 
		</div>
        <!-- main page content ends -->


    </main>

<?= $this->endSection() ?>