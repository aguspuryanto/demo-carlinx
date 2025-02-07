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
        <div class="col-10 col-md-6 col-lg-6 col-xl-6 mx-auto align-self-center py-4">
            <!-- Notifikasi Error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url(); ?>/login" class="was-validated needs-validation" novalidate="">
                <?= csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="nama" required>
                            <label class="form-control-label" for="nama">Nama Lengkap</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="nama_perush" id="nama_perush" class="form-control" placeholder="nama_perush" required>
                            <label class="form-control-label" for="nama_perush">Nama Perusahaan</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="jabatan" id="jabatan" class="form-select" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <?php if (!empty($jabatan)): foreach ($jabatan as $key => $value): ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-control-label" for="jabatan">Jabatan</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="ijin_perush" id="ijin_perush" class="form-control" placeholder="ijin_perush" required>
                            <label class="form-control-label" for="ijin_perush">NIB/SIUP</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="alamat" required>
                            <label class="form-control-label" for="alamat">Alamat</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="kota" id="kota" class="form-select" required>
                                <option value="">-- Pilih Kota --</option>
                                <?php if (!empty($cityList)): foreach ($cityList['result_kota'] as $key => $value): ?>
                                        <option value="<?= $value['kode']; ?>"><?= $value['nama']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-control-label" for="kota">Kota</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="email" required>
                            <label class="form-control-label" for="email">Email</label>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-3">
                                    <label class="form-control-label">Jenis Usaha</label>
                                </div>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="grup" value="2" id="groupCheckbox1" checked/>
                                        <label class="form-check-label" for="groupCheckbox1">Rental</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="grup" value="4" id="groupCheckbox2" />
                                        <label class="form-check-label" for="groupCheckbox2">Agen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="korwil" id="korwil" class="form-select" required>
                                <option value="">-- Pilih Koordinator --</option>
                                <?php if (!empty($korwilList)): foreach ($korwilList['result_korwil'] as $key => $value): ?>
                                        <option value="<?= $value['kd_korwil']; ?>"><?= $value['nama_korwil']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-control-label" for="koordinator">Koordinator</label>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-3">
                                    <label class="form-control-label" for="jenis_layanan">Jenis Layanan:</label>
                                </div>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="layanan" value="2" id="groupCheckbox1" checked/>
                                        <label class="form-check-label" for="groupCheckbox1">Pelayanan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="layanan" value="4" id="groupCheckbox3" />
                                        <label class="form-check-label" for="groupCheckbox3">Event</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="layanan" value="8" id="groupCheckbox4" />
                                        <label class="form-check-label" for="groupCheckbox4">Bulanan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="layanan" value="16" id="groupCheckbox5" />
                                        <label class="form-check-label" for="groupCheckbox5">Lepas Kunci</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-control-label" for="dokumen_pendukung">Dokumen Pendukung</label>
                            <div class="row">
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Diri" title="Foto Diri"><small>Foto Diri</small>
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control" placeholder="dokumen_pendukung" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Kantor" title="Foto Kantor"><small>Foto Kantor</small>
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control" placeholder="dokumen_pendukung" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Garasi" title="Foto Garasi"><small>Foto Garasi</small>
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control" placeholder="dokumen_pendukung" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Form Order" title="Form Order"><small>Form Order</small>
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control" placeholder="dokumen_pendukung" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="no_hp" required>
                            <label class="form-control-label" for="no_hp">No HP</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control " placeholder="admin123" required>
                            <label class="form-control-label" for="password">Password</label>
                            <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="" id="passworderror" data-bs-original-title="Enter valid Password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control " placeholder="admin123" required>
                            <label class="form-control-label" for="password">Ulangi Password</label>
                            <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="" id="passworderror" data-bs-original-title="Enter valid Password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                    Submit
                </button>
            </form>

        </div>
    </div>
</main>

<?= $this->endSection() ?>