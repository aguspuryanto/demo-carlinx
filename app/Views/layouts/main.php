<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Carlinx V2.0 - Mobile template</title>

    <!-- manifest meta -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="manifest" href="<?= base_url(); ?>manifest.json">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="<?= base_url(); ?>assets/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= base_url(); ?>assets/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

    <?= $this->renderSection('styles') ?>
    <style>
        .body-scroll {
            overflow: auto !important;
        }
    </style>
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

    <?= $this->include('layouts/sidebar'); ?>

    <!-- Begin page -->
    <main class="h-100" style="">

        <?= $this->include('_parts/header') ?>
        
        <?= $this->renderSection('content') ?>
    
    </main>
    <!-- Page ends-->

    <?= $this->include('layouts/footer') ?>

</body>
</html>