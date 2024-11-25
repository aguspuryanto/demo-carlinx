<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">MyApp</a>
    </nav>
    <div class="container mt-4">
        <?= $this->renderSection('content') ?>
    </div>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<!-- saved from url=(0024)/ -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Carlinx V2.0 - Mobile template</title>

    <!-- manifest meta -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="manifest" href="/manifest.json">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/assets/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="/assets/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/assets/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="/assets/css/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="/assets/css/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll" data-page="index">

    <!-- loader section -->
    <div class="container-fluid loader-wrap" style="display: none;">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">
                    <img src="/assets/img/carlinx.png" alt="carlinx">
                </div>
                <p class="mt-4">It's time for<br><strong>Rent to Rent...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Sidebar main menu -->
    <div class="sidebar-wrap  sidebar-pushcontent">
        <!-- Add overlay or fullmenu instead overlay -->
        <div class="closemenu text-muted">Close Menu</div>
        <div class="sidebar dark-bg">
            <!-- user information -->
            <div class="row my-3">
                <div class="col-12 ">
                    <div class="card shadow-sm bg-opac text-white border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-44 rounded-15">
                                        <img src="/assets/img/user1.jpg" alt="">
                                    </figure>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="mb-1">Muniro KinG</p>
                                    <p class="text-muted size-12">Surabaya, ID</p>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-44 btn-light">
                                        <i class="bi bi-box-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-opac text-white border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="display-4">100</h1>
                                    </div>
                                    <div class="col-auto">
                                        <p class="text-muted">Point rewards</p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="text-muted"><a href="/#">+ Klaim</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- user emnu navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/index.html">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Dashboard</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="/#" role="button" aria-expanded="false">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                                <div class="col">Akun</div>
                                <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="/profile.html">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Profile</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link" href="/#">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-gear"></i>
                                        </div>
                                        <div class="col">Settings</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/chat.html" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-chat-text"></i></div>
                                <div class="col">Pesan</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-bell"></i></div>
                                <div class="col">Notifikasi</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">Informasi</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar-check"></i></div>
                                <div class="col">Event <i class="bi bi-star-fill text-warning small"></i></div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-file-earmark-text"></i></div>
                                <div class="col">Laporan <span class="badge bg-info fw-light">new</span></div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/signin.html" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="col">Logout</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
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
           
			 
            <!-- connection -->
            <div class="row mb-3">
                <div class="col">
                    <h6 class="title">Connections</h6>
                </div>
                <div class="col-auto">
                    <a href="/userlist.html" class="small">View all</a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 px-0">
                    <!-- swiper users connections -->
                    <div class="swiper-container connectionwiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                        <div class="swiper-wrapper" id="swiper-wrapper-f09cbc1045992eaa3" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user4.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Nicolas</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user2.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Shelvey</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" role="group" aria-label="3 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user3.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Amenda</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" role="group" aria-label="4 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user1.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">RXL15</p>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide" role="group" aria-label="5 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user4.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Nicolas</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" role="group" aria-label="6 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user2.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Shelvey</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" role="group" aria-label="7 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user3.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">Amenda</p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" role="group" aria-label="8 / 8">
                                <a href="/profile.html" class="card text-center">
                                    <div class="card-body">
                                        <figure class="avatar avatar-50 shadow-sm mb-1 rounded-10">
                                            <img src="/assets/img/user1.jpg" alt="">
                                        </figure>
                                        <p class="text-color-theme size-12 small">RXL15</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </div>

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
    <!-- Page ends-->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="/index.html">
                        <span>
                            <i class="nav-icon bi bi-house"></i>
                            <span class="nav-text">Home</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#">
                        <span>
                            <i class="nav-icon bi bi-speedometer"></i>
                            <span class="nav-text">Proses</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item centerbutton">
                    <div class="nav-link">
                        <span class="theme-radial-gradient">
                            <i class="close bi bi-x"></i>
                            <img src="/assets/img/search.png" class="nav-icond" alt="">
                        </span>
                        <div class="nav-menu-popover justify-content-between">
                            <button type="button" class="btn btn-lg btn-icon-text">
                                <i class="bi bi-calculator size-32"></i><span>Rate</span>
                            </button>

                            <button type="button" class="btn btn-lg btn-icon-text">
                                <i class="bi bi-cart-check-fill size-32"></i><span>Layanan</span>
                            </button>

                            <button type="button" class="btn btn-lg btn-icon-text">
                                <i class="bi bi-calendar-check size-32"></i><span>Bulanan</span>
                            </button>

                            <button type="button" class="btn btn-lg btn-icon-text">
                                <i class="bi bi-key size-32"></i><span>Lepas Kunci</span>
                            </button>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#">
                        <span>
                            <i class="nav-icon bi bi-stack"></i>
                            <span class="nav-text">History</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/profile.html">
                        <span>
                            <i class="nav-icon bi bi-person"></i>
                            <span class="nav-text">Akun</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <!-- Footer ends-->

    <!-- PWA app install toast message -->
    <div class="position-fixed bottom-0 start-50 translate-middle-x  z-index-10">
        <div class="toast mb-3 fade hide" role="alert" aria-live="assertive" aria-atomic="true" id="toastinstall" data-bs-animation="true">
            <div class="toast-header">
                <img src="/assets/img/carlinx.png" class="rounded me-2" alt="..." height="32">
                <strong class="me-auto">Install PWA App</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="row">
                    <div class="col">
                        Click "Install" to install PWA app &amp; experience indepedent.
                    </div>
                    <div class="col-auto align-self-center ps-0">
                        <button class="btn-default btn btn-sm" id="addtohome">Install</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required jquery and libraries -->
    <script src="./demo_files/jquery-3.3.1.min.js.download"></script>
    <script src="./demo_files/popper.min.js.download"></script>
    <script src="./demo_files/bootstrap.bundle.min.js.download"></script>

    <!-- cookie js -->
    <script src="./demo_files/jquery.cookie.js.download"></script>

    <!-- Customized jquery file  -->
    <script src="./demo_files/main.js.download"></script>
    <script src="./demo_files/color-scheme.js.download"></script>

    <!-- PWA app service registration and works -->
    <script src="./demo_files/pwa-services.js.download"></script>

    <!-- Chart js script -->
    <script src="./demo_files/chart.min.js.download"></script>

    <!-- Progress circle js script -->
    <script src="./demo_files/progressbar.min.js.download"></script>

    <!-- swiper js script -->
    <script src="./demo_files/swiper-bundle.min.js.download"></script>
 <!-- daterange picker script -->
    <script src="./demo_files/moment.min.js.download"></script>
    <script src="./demo_files/daterangepicker.js.download"></script>
    <!-- page level custom script -->
    <script src="./demo_files/app.js.download"></script>

</body>
</html>