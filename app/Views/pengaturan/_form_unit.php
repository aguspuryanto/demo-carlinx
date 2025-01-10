
            <div class="mb-4">
                <h5>Informasi Umum</h5>
                <div class="mb-3">
                    <label for="nama" class="form-label">Merk/Type</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Merk/Type">
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($listPaketDriver['result_driver'] as $driver_it) : ?>
                        <option value="<?= $driver_it['id'] ?>" selected><?= $driver_it['nm_kat'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bbm" class="form-label">BBM</label>
                    <select class="form-select" id="bbm" name="bbm">
                        <option value="">Pilih BBM</option>
                        <?php foreach ($listPaketBbm['result_bbm'] as $bbm_it) : ?>
                        <option value="<?= $bbm_it['id'] ?>" selected><?= $bbm_it['descr'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kursi" class="form-label">Jml Kursi</label>
                    <input type="number" class="form-control" id="kursi" name="kursi" value="0">
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Produksi</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="transmisi" class="form-label">Pilihan Transmisi</label>
                    <input type="text" class="form-control" id="transmisi" name="transmisi"  placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="warna" class="form-label">Pilihan Warna</label>
                    <input type="text" class="form-control" id="warna" name="warna" placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="jarak_tempuh" class="form-label">Jarak Tempuh/Liter (km)</label>
                    <input type="number" class="form-control" id="jarak_tempuh" name="jarak_tempuh" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga dan Biaya Pelayanan</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="dlm_kota" class="form-label">Dalam Kota</label>
                        <input type="number" class="form-control" id="dlm_kota" name="dlm_kota"  value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="dlm_prop" class="form-label">Luar Kota</label>
                        <input type="number" class="form-control" id="dlm_prop" name="dlm_prop"  value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="luar_prop" class="form-label">Luar Batas</label>
                        <input type="number" class="form-control" id="luar_prop" name="luar_prop" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="drop_in" class="form-label">Transfer (%)</label>
                        <input type="number" class="form-control" id="drop_in" name="drop_in"  value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="over_time" class="form-label">OverTime (%)</label>
                        <input type="number" class="form-control" id="over_time" name="over_time" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="stgh_hr" class="form-label">12 Jam (%)</label>
                        <input type="number" class="form-control" id="stgh_hr" name="stgh_hr" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="fee" class="form-label">Margin (Rp)</label>
                        <input type="number" class="form-control" id="fee" name="fee" value="0">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga dan Biaya Lepas Kunci</h5>
                <div class="mb-3">
                    <label for="lepas_kunci" class="form-label">Lepas Kunci</label>
                    <input type="number" class="form-control" id="lepas_kunci" name="lepas_kunci" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga Sewa Bulanan</h5>
                <div class="mb-3">
                    <label for="bulanan" class="form-label">Bulanan</label>
                    <input type="number" class="form-control" id="bulanan" name="bulanan" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Foto Unit</h5>
                <div class="grid gap-0 row-gap-3 d-flex justify-content-between">
                    <div class="g-col-3 text-center">
                        <label for="imageInput" class="form-label sr-only">Pilih Gambar</label>
                        <input type="file" class="form-control" id="imageInput" accept="image/*">
                        <div id="previewContainer" class="d-flex flex-wrap gap-3 mb-3 justify-content-center">
                            <img src="<?= $_ENV['API_BASEURL'] . 'images/car_75.png' ?>" id="path_foto" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 1">
                        </div>
                    </div>
                    <div class="g-col-3 text-center">
                        <label for="imageInput" class="form-label sr-only">Pilih Gambar</label>
                        <input type="file" class="form-control" id="imageInput" accept="image/*">
                        <div id="previewContainer" class="d-flex flex-wrap gap-3 mb-3 justify-content-center">
                            <img src="<?= $_ENV['API_BASEURL'] . 'images/car_75.png' ?>" id="path_foto_2" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 2">
                        </div>
                    </div>
                    <div class="g-col-3 text-center">
                        <label for="imageInput" class="form-label sr-only">Pilih Gambar</label>
                        <input type="file" class="form-control" id="imageInput" accept="image/*">
                        <div id="previewContainer" class="d-flex flex-wrap gap-3 mb-3 justify-content-center">
                            <img src="<?= $_ENV['API_BASEURL'] . 'images/car_75.png' ?>" id="path_foto_3" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 3">
                        </div>
                    </div>
                    <div class="g-col-3 text-center">
                        <label for="imageInput" class="form-label sr-only">Pilih Gambar</label>
                        <input type="file" class="form-control" id="imageInput" accept="image/*">
                        <div id="previewContainer" class="d-flex flex-wrap gap-3 mb-3 justify-content-center">
                            <img src="<?= $_ENV['API_BASEURL'] . 'images/car_75.png' ?>" id="path_foto_4" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 4">
                        </div>
                    </div>
                </div>
                <small class="form-text text-muted">*Unggah foto setelah data berhasil disimpan</small>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="stat" name="stat">
                <label class="form-check-label text-primary" for="stat">Tersedia</label>
                <a href="#" class="float-end text-decoration-underline">tanggal tidak tersedia</a>
            </div>