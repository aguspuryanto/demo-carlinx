<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<main class="h-100" style="min-height: 633px; padding-top: 85.7188px; padding-bottom: 70px;">

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
                <img src="/assets/img/logo.png" alt="">
                <h5>CarLinx</h5>
            </div>
        </div>
        <div class="col-auto">
            <a href="/#" target="_self" class="btn btn-light btn-44">
                <i class="bi bi-bell"></i>
                <span class="count-indicator"></span>
            </a>
        </div>
    </div>
</header>
<!-- Header ends -->

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
     <!-- chart js areachart-->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-6 col-md-12">
                    <a href="/#" class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-success text-success rounded-circle">
                                        <i class="bi bi-calculator"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Hitung</p>
                                    <p>RATE</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-12">
                    <a href="/#" class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-danger text-danger rounded-circle">
                                        <i class="bi bi-cart-check-fill"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Order</p>
                                    <p>LAYANAN</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-12">
                    <a href="/#" class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-primary text-primary rounded-circle">
                                        <i class="bi bi-key"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Lepas</p>
                                    <p>KUNCI</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-12">
                    <a href="/#" class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Order</p>
                                    <p>BULANAN</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card mb-4">
                <div class="card-header border-0">
                    <!-- calendar -->
                    <div class="row">
                        <div class="col position-relative align-self-center">
                            <input type="text" placeholder="Select date range" readonly="readonly" id="daterange" class="calendar-daterange">
                            <h6 class="mb-1">Statistik</h6>
                            <p class="small text-muted textdate">1/8/2024 - 7/8/2024</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <button class="btn btn-light btn-44 daterange-btn">
                                <i class="bi bi-calendar-range size-22"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2">
                    <canvas id="areachart"></canvas>
                </div>
            </div>
        </div>
        
    </div>
   
     
    <?php include_once('_parts/connection.php'); ?>

    <!-- offers banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card theme-bg text-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col align-self-center">
                            <h1>15% OFF</h1>
                            <p class="size-12 text-muted">
                                On every bill pay, launch offer get 5% Extra
                            </p>
                            <div class="tag border-dashed border-opac">
                                BILLPAY15OFF
                            </div>
                        </div>
                        <div class="col-6 align-self-center ps-0">
                            <img src="/assets/img/offergraphics.png" alt="" class="mw-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
    <!-- Transactions -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Transaksi<br><small class="fw-normal text-muted">Today, 24 Aug 2024</small>
            </h6>
        </div>
        <div class="col-auto align-self-center">
            <a href="/#" class="small">View all</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 px-0">
            <ul class="list-group list-group-flush bg-none">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-50 shadow rounded-10 ">
                                <img src="/assets/img/company4.jpg" alt="">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-0">Zomato</p>                                   
                            <p class="text-muted size-12">Lepas Kunci</p>
                        </div>                                
                        <div class="col align-self-center text-end">
                            <p class="mb-0">3.450.000</p>                                   
                            <p class="text-muted size-12">Cash</p>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-50 shadow rounded-10">
                                <img src="/assets/img/company5.png" alt="">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-0">Uber</p>                                   
                            <p class="text-muted size-12">Bulanan</p>
                        </div>                                
                        <div class="col align-self-center text-end">
                            <p class="mb-0">5.200.000</p>                                   
                            <p class="text-muted size-12">Credit</p>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-50 shadow rounded-10">
                                <img src="/assets/img/company1.png" alt="">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-0">Starbucks</p>                                   
                            <p class="text-muted size-12">Pelayanan</p>
                        </div>                                
                        <div class="col align-self-center text-end">
                            <p class="mb-0">1.800.000</p>                                   
                            <p class="text-muted size-12">Cash</p>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-50 shadow rounded-10">
                                <img src="/assets/img/company3.jpg" alt="">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-0">Walmart</p>                                   
                            <p class="text-muted size-12">Bulanan</p>
                        </div>                                
                        <div class="col align-self-center text-end">
                            <p class="mb-0">10.000.000</p>                                   
                            <p class="text-muted size-12">Cash</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Blogs -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">News and Updates</h6>
        </div>
        <div class="col-auto align-self-center">
            <a href="/#" class="small">Read more</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <a href="/#" class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-60 shadow-sm rounded-10 coverimg" style="background-image: url(&quot;assets/img/news.jpg&quot;);">
                                <img src="/assets/img/news.jpg" alt="" style="display: none;">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-1">Do share and Earn a lot</p>                                   
                            <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join Carlinx</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-md-6 col-lg-4">
            <a href="/#" class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-60 shadow-sm rounded-10 coverimg" style="background-image: url(&quot;assets/img/news1.jpg&quot;);">
                                <img src="/assets/img/news1.jpg" alt="" style="display: none;">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-1">Walmart news latest picks</p>                                   
                            <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join Carlinx</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-md-6 col-lg-4">
            <a href="/#" class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="avatar avatar-60 shadow-sm rounded-10 coverimg" style="background-image: url(&quot;assets/img/news2.jpg&quot;);">
                                <img src="/assets/img/news2.jpg" alt="" style="display: none;">
                            </div>
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-1">Do share and Help us</p>                                   
                            <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join Carlinx</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- main page content ends -->


</main>

<?= $this->endSection() ?>