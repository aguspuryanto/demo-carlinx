    <!-- Footer -->
    <footer class="footer d-sm-block d-md-block d-lg-none d-xl-none">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('/') ?>">
                        <span>
                            <i class="nav-icon bi bi-house"></i>
                            <span class="nav-text">Home</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('proses') ?>">
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
                            <img src="<?= base_url(); ?>/assets/img/search.png" class="nav-icond" alt="">
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
                    <a class="nav-link" href="<?= base_url('history') ?>">
                        <span>
                            <i class="nav-icon bi bi-stack"></i>
                            <span class="nav-text">History</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('akun') ?>">
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
    <div class="d-none position-fixed bottom-0 start-50 translate-middle-x z-index-10" id="pwaApp">
        <div class="toast mb-3 fade show" role="alert" aria-live="assertive" aria-atomic="true" id="toastinstall" data-bs-animation="true">
            <div class="toast-header">
                <img src="<?= base_url(); ?>/assets/img/carlinx.png" class="rounded me-2" alt="..." height="32">
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
    <script src="<?= base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="<?= base_url(); ?>assets/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script src="<?= base_url(); ?>assets/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="<?= base_url(); ?>assets/js/pwa-services.js"></script>

    <!-- Chart js script -->
    <script src="<?= base_url(); ?>assets/js/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="<?= base_url(); ?>assets/js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="<?= base_url(); ?>assets/js/swiper-bundle.min.js"></script>
    <!-- daterange picker script -->
    <script src="<?= base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>
    <!-- page level custom script -->
    <script src="<?= base_url(); ?>assets/js/app.js"></script>

    <script>
        function getPWADisplayMode() {
            if (document.referrer.startsWith('android-app://'))
                return 'twa';
            if (window.matchMedia('(display-mode: browser)').matches)
                return 'browser';
            if (window.matchMedia('(display-mode: standalone)').matches)
                return 'standalone';
            if (window.matchMedia('(display-mode: minimal-ui)').matches)
                return 'minimal-ui';
            if (window.matchMedia('(display-mode: fullscreen)').matches)
                return 'fullscreen';
            if (window.matchMedia('(display-mode: window-controls-overlay)').matches)
                return 'window-controls-overlay';

            return 'unknown';
        }

        window.addEventListener('DOMContentLoaded', () => {
            // Log launch display mode to analytics
            console.log('DISPLAY_MODE_LAUNCH:', getPWADisplayMode());
            if(getPWADisplayMode() != 'browser'){
                // remove class d-none div#pwaApp
                document.getElementById('pwaApp').classList.remove('d-none');
            }
        });

        window.addEventListener('appinstalled', () => {
            // If visible, hide the install promotion
            // hideInAppInstallPromotion();
            // Log install to analytics
            console.log('INSTALL: Success');
        });
    </script>
    <?= $this->renderSection('scripts') ?>