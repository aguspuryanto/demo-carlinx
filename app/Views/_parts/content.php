     
    <!-- chart js areachart-->
    <div class="row justify-content-md-center text-center mb-4">
        <div class="col-12">
            <!-- app\Views\pengaturan\_alert.php -->
            <?php  $file = __DIR__ . '/../_alert.php'; include($file); ?>

            <div class="row">
                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('dashboard'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-success text-success rounded-circle">
                                        <i class="bi bi-clipboard-data"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Dashboard</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('rate'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-success text-success rounded-circle">
                                        <i class="bi bi-calculator"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Penawaran</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('order/orderlayanan'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-danger text-danger rounded-circle">
                                        <i class="bi bi-cart-check-fill"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Pelayanan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('order/lepaskunci'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-primary text-primary rounded-circle">
                                        <i class="bi bi-key"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Lepas Kunci</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('order/orderbulanan'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-calendar-month"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Bulanan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('event'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Event</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('inbox'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Inbox</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('proses'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Proses</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('riwayat'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Riwayat</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('pelaporan'); ?>" class="card shadow-sm mb-4">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Pelaporan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('pengaturan'); ?>" class="card shadow-sm mb-0">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-warning text-warning rounded-circle">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Pengaturan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-4 col-md-4 col-lg-3">
                    <a href="<?= base_url('rate/orderbulanan'); ?>" class="card shadow-sm mb-0">
                        <div class="card-body px-1">
                            <div class="xrow">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 alert-success text-success rounded-circle">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="text-muted size-12 mb-0">Bantuan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- <div class="col-12 col-md-4 d-none">
            <div class="card mb-4" style="height: 100%;">
                <div class="card-header border-0">
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
        </div> -->
        
    </div>