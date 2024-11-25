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
    <script src="./demo_files/jquery-3.3.1.min.js"></script>
    <script src="./demo_files/popper.min.js"></script>
    <script src="./demo_files/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="./demo_files/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="./demo_files/main.js"></script>
    <script src="./demo_files/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="./demo_files/pwa-services.js"></script>

    <!-- Chart js script -->
    <script src="./demo_files/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="./demo_files/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="./demo_files/swiper-bundle.min.js"></script>
    <!-- daterange picker script -->
    <script src="./demo_files/moment.min.js"></script>
    <script src="./demo_files/daterangepicker.js"></script>
    <!-- page level custom script -->
    <script src="./demo_files/app.js"></script>