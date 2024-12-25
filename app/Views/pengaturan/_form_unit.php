<?php
helper('form');
?>

<!-- <h4 class="mb-3">Unit</h4> -->
        <?= form_open('pengaturan/unit', []); ?>
            <div class="mb-4">
                <h5>Informasi Umum</h5>
                <div class="mb-3">
                    <label for="merk" class="form-label">Merk/Type</label>
                    <input type="text" class="form-control" id="merk" placeholder="Merk/Type">
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($listPaketDriver as $driver_it) : ?>
                        <option value="<?= $driver_it['id'] ?>" selected><?= $driver_it['nm_kat'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bbm" class="form-label">BBM</label>
                    <select class="form-select" id="bbm">
                        <option value="">Pilih BBM</option>
                        <?php foreach ($listPaketBbm as $bbm_it) : ?>
                        <option value="<?= $bbm_it['id'] ?>" selected><?= $bbm_it['descr'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jml_kursi" class="form-label">Jml Kursi</label>
                    <input type="number" class="form-control" id="jml_kursi" value="0">
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Produksi</label>
                    <input type="text" class="form-control" id="tahun" placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="transmisi" class="form-label">Pilihan Transmisi</label>
                    <input type="text" class="form-control" id="transmisi" placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="warna" class="form-label">Pilihan Warna</label>
                    <input type="text" class="form-control" id="warna" placeholder="-">
                </div>
                <div class="mb-3">
                    <label for="jarak_tempuh" class="form-label">Jarak Tempuh/Liter (km)</label>
                    <input type="number" class="form-control" id="jarak_tempuh" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga dan Biaya Pelayanan</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="dalam_kota" class="form-label">Dalam Kota</label>
                        <input type="number" class="form-control" id="dalam_kota" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="luar_kota" class="form-label">Luar Kota</label>
                        <input type="number" class="form-control" id="luar_kota" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="luar_batas" class="form-label">Luar Batas</label>
                        <input type="number" class="form-control" id="luar_batas" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="transfer" class="form-label">Transfer (%)</label>
                        <input type="number" class="form-control" id="transfer" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="overtime" class="form-label">OverTime (%)</label>
                        <input type="number" class="form-control" id="overtime" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="twelve_hours" class="form-label">12 Jam (%)</label>
                        <input type="number" class="form-control" id="twelve_hours" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="margin" class="form-label">Margin (Rp)</label>
                        <input type="number" class="form-control" id="margin" value="0">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga dan Biaya Lepas Kunci</h5>
                <div class="mb-3">
                    <label for="lepas_kunci" class="form-label">Lepas Kunci</label>
                    <input type="number" class="form-control" id="lepas_kunci" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Harga Sewa Bulanan</h5>
                <div class="mb-3">
                    <label for="bulanan" class="form-label">Bulanan</label>
                    <input type="number" class="form-control" id="bulanan" value="0">
                </div>
            </div>

            <div class="mb-4">
                <h5>Foto Unit</h5>
                <div class="d-flex justify-content-between">
                    <div class="text-center">
                        <img src="placeholder.jpg" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 1">
                    </div>
                    <div class="text-center">
                        <img src="placeholder.jpg" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 2">
                    </div>
                    <div class="text-center">
                        <img src="placeholder.jpg" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 3">
                    </div>
                    <div class="text-center">
                        <img src="placeholder.jpg" class="img-thumbnail" style="width: 80px; height: 80px;" alt="Foto 4">
                    </div>
                </div>
                <small class="form-text text-muted">*Unggah foto setelah data berhasil disimpan</small>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="tersedia">
                <label class="form-check-label text-primary" for="tersedia">Tersedia</label>
                <a href="#" class="float-end text-decoration-underline">tanggal tidak tersedia</a>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
            </div>
        <?php echo form_close(); ?>