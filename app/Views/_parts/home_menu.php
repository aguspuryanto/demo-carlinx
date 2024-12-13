
    <!-- chart js areachart-->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-6 col-md-12">
                    <a href="<?= base_url('rate'); ?>" class="card shadow-sm mb-4">
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
                    <a href="<?= base_url('rate/orderlayanan'); ?>" class="card shadow-sm mb-4">
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
                    <a href="<?= base_url('rate/lepaskunci'); ?>" class="card shadow-sm mb-4">
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
                    <a href="<?= base_url('rate/orderbulanan'); ?>" class="card shadow-sm mb-4">
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