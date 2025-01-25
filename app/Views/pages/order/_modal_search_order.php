
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= getImage($_ENV['API_BASEURL'] . 'images/') ?>" id="path_foto" style="width: 100%; height: auto;" alt="...">
                <h2 class="text-center mb-4">TOYOTA AVANZA GRAND</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kursi" class="form-label">Kursi</label>
                            <input type="text" class="form-control" id="kursi" value="6 orang" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="transmisi" class="form-label">Transmisi</label>
                            <input type="text" class="form-control" id="transmisi" value="Mt" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control" id="warna" value="Hitam" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="text" class="form-control" id="tahun" value="2016-2017" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="bbm" class="form-label">BBM</label>
                            <input type="text" class="form-control" id=" bbm" value="Pertalite" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Informasi Pemesanan</h4>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                                <input type="number" class="form-control" id="jumlah" value="1" min="1">
                                <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total Biaya</label>
                            <input type="text" class="form-control" id="total" value="Rp. 810.000" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Lanjutkan</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>