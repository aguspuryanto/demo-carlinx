<div class="modal fade" id="hargaModal" role="dialog" aria-labelledby="hargaModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <a href="#" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-arrow-left"></i> Perkiraan Harga Dasar
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formHargaUnit">
                    <!-- Pilih Wilayah -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Wilayah</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="dalamKota" value="1" checked>
                                <label class="form-check-label" for="dalamKota">Dalam Kota</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="dalamPropinsi" value="2">
                                <label class="form-check-label" for="dalamPropinsi">Dalam Propinsi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="luarBatas" value="3">
                                <label class="form-check-label" for="luarBatas">Luar Batas</label>
                            </div>
                        </div>
                    </div>

                    <!-- Rute Perjalanan -->
                    <div class="mb-3">
                        <label class="form-label">Rute Perjalanan</label>
                        <div class="row g-3">
                            <div class="col-sm-6 col-md-6">
                                <select id="lokasiJemput2" name="lokasi_jemput2" class="form-select select2">
                                    <option value="">Pilih Lokasi Jemput</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <select id="lokasiTujuan2" name="lokasi_tujuan2" class="form-select select2">
                                    <option value="">Pilih Lokasi Tujuan</option>
                                </select>
                            </div>
                        </div>

                        <ul id="listRute" class="list-group mt-2">
                            <!-- Daftar rute akan ditambahkan di sini -->
                        </ul>
                    </div>

                    <!-- Harga Sewa -->
                    <div class="mb-3">
                        <label class="form-label">Harga Sewa yg dikehendaki</label>
                        <div class="mb-2">
                            <label class="form-label small text-muted">Minimal Sewa (hari)</label>
                            <input type="number" class="form-control" name="minimal_sewa" value="1">
                        </div>
                        <div class="mb-2">
                            <label class="form-label small text-muted">Harga (Rp)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="harga" placeholder="0">
                                <button class="btn btn-outline-secondary" type="button" id="btnHitung"><i class="fa fa-arrow-right"></i> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Perhitungan -->
                    <div class="mb-3">
                        <label class="form-label">Hasil Perhitungan</label>
                        <div class="mb-2">
                            <label class="form-label small text-muted">Harga Dasar (Rp)</label>
                            <input type="number" class="form-control" name="harga_dasar" placeholder="0" readonly>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="alert alert-info">
                        <strong>Keterangan:</strong><br>
                        Pilih dan Masukkan parameter di atas, sesuai kondisi Rental sehari-hari, yang sudah anda ketahui/hafal nilai-nilainya<br>
                        <strong>Contoh:</strong><br>
                        Pilih Wilayah : Dalam Kota<br>
                        Rute Perjalanan : Surabaya - Surabaya<br>
                        Harga : 550.000<br>
                        Minimal Sewa : 1<br>
                        Lakukan langkah yg sama untuk Pilihan Wilayah yang lain
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="btnSimpan">SIMPAN HASIL PERHITUNGAN</button>
                </div>
            </form>
        </div>
    </div>
</div>