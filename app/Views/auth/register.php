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
            
            <form method="post" class="was-validated needs-validation" novalidate="">
                <?= csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="nama" required>
                            <label class="form-label" for="nama">Nama Lengkap</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="nama_perush" id="nama_perush" class="form-control" placeholder="nama_perush" required>
                            <label class="form-label" for="nama_perush">Nama Perusahaan</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="jabatan" id="jabatan" class="form-select" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <?php if (!empty($jabatan)): foreach ($jabatan as $key => $value): ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-label" for="jabatan">Jabatan</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="ijin_perush" id="ijin_perush" class="form-control" placeholder="ijin_perush" required>
                            <label class="form-label" for="ijin_perush">NIB/SIUP</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="alamat" required>
                            <label class="form-label" for="alamat">Alamat</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="kd_kota" id="kd_kota" class="form-select" required>
                                <option value="">-- Pilih Kota --</option>
                                <?php if (!empty($cityList)): foreach ($cityList['result_kota'] as $key => $value): ?>
                                        <option value="<?= $value['kode']; ?>"><?= $value['nama']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-label" for="kd_kota">Kota</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="email" required>
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-3">
                                    <label class="form-label">Jenis Usaha</label>
                                </div>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="grup_rental" value="2" id="grupRental" checked/>
                                        <label class="form-check-label" for="grupRental">Rental</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="grup_agen" value="4" id="grupAgen" />
                                        <label class="form-check-label" for="grupAgen">Agen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select name="kd_korwil" id="kd_korwil" class="form-select" required>
                                <option value="">-- Pilih Koordinator --</option>
                                <?php if (!empty($korwilList)): foreach ($korwilList['result_korwil'] as $key => $value): ?>
                                        <option value="<?= $value['kd_korwil']; ?>"><?= $value['nama_korwil']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label class="form-label" for="kd_korwil">Koordinator</label>
                        </div>
                        <div class="form-group mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-3">
                                    <label class="form-label" for="jenis_layanan">Jenis Layanan:</label>
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
                            <label class="form-label" for="dokumen_pendukung">Dokumen Pendukung</label>
                            <div class="row">
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Diri" title="Foto Diri"><small>Foto Diri</small>
                                    <input type="file" name="foto_diri" id="foto_diri" class="form-control" placeholder="foto_diri" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Kantor" title="Foto Kantor"><small>Foto Kantor</small>
                                    <input type="file" name="foto_kantor" id="foto_kantor" class="form-control" placeholder="foto_kantor" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Foto Garasi" title="Foto Garasi"><small>Foto Garasi</small>
                                    <input type="file" name="foto_garasi" id="foto_garasi" class="form-control" placeholder="foto_garasi" required>
                                </div>
                                <div class="col-3">
                                    <img class="mr-3 img-thumbnail" src="<?= getImage($_ENV['API_BASEURL'] . 'images/car_75.png') ?>" alt="Form Order" title="Form Order"><small>Form Order</small>
                                    <input type="file" name="form_order" id="form_order" class="form-control" placeholder="form_order" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group form-floating mb-3">
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="no_hp" required>
                            <label class="form-label" for="no_hp">No HP</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control " placeholder="admin123" required>
                            <label class="form-label" for="password">Password</label>
                            <button type="button" class="text-danger tooltip-btn">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="password" name="repassword" id="repassword" class="form-control " placeholder="admin123" required>
                            <label class="form-label" for="repassword">Ulangi Password</label>
                            <button type="button" class="text-danger tooltip-btn">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow" id="btnSubmit">
                    Submit
                </button>
            <?= form_close(); ?>

        </div>
    </div>
</main>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script>
    $(function () {
        $('#btnSubmit').on('click', function (e) {
            e.preventDefault();
            var form = $('#registrationForm')[0];
            var data = new FormData(form);
            
            // Define base validation rules
            const baseValidationRules = [
                { field: 'nama', message: 'Nama harus diisi' },
                { field: 'nama_perush', message: 'Nama Perusahaan harus diisi' },
                { field: 'jabatan', message: 'Jabatan harus diisi' },
                { field: 'ijin_perush', message: 'Ijin Perusahaan harus diisi' },
                { field: 'alamat', message: 'Alamat harus diisi' },
                { field: 'kd_kota', message: 'Kota harus diisi' },
                { field: 'email', message: 'Email harus diisi' },
                { field: 'grup', message: 'Jenis Usaha harus diisi' },
                { field: 'kd_korwil', message: 'Koordinator harus diisi' },
                { field: 'no_hp', message: 'No HP harus diisi' },
                { field: 'password', message: 'Password harus diisi' }
            ];

            // Validate all fields
            let isValid = true;
            let errors = [];
            
            let validationRules = [...baseValidationRules]; // Copy base rules

            // Validate each field
            for (const rule of validationRules) {
                const $field = $(`#${rule.field}`);

                // Pastikan elemen ditemukan sebelum membaca nilainya
                if ($field.length === 0) {
                    console.warn(`Elemen dengan ID '${rule.field}' tidak ditemukan.`);
                    continue; // Lewati iterasi jika elemen tidak ada
                }

                const $parent = $field.parent(); // Pastikan ini sesuai dengan struktur HTML Anda
                const fieldValue = $field.val()?.trim() || ''; // Cegah error undefined

                if (fieldValue === '') {
                    // Hapus pesan error lama jika sudah ada
                    $parent.find('.invalid-feedback').remove();

                    // Tambahkan pesan error
                    $parent.append(`<div class="invalid-feedback">${rule.message}</div>`);

                    // Tambahkan class untuk menandai error
                    $field.addClass('is-invalid');

                    isValid = false;
                } else {
                    // Hapus error jika input sudah benar
                    $field.removeClass('is-invalid');
                    $parent.find('.invalid-feedback').remove();
                }
            }

            // Tampilkan pesan error jika ada
            if (!isValid) {
                errors.push('Silakan perbaiki error diatas.');
            }
            
            return;
        });
    });
</script>
<?= $this->endSection() ?>