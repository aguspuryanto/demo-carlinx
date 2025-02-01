
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" aria-modal="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
            <div class="modal-body">
                <div class="detail_img">
                    <img src="<?= getImage($_ENV['API_BASEURL'] . 'images/') ?>" id="path_foto" style="width: 100%; max-height: 30%;" alt="...">
                </div>
                <div class="mb-0 detail_content">
                    <h2 class="mb-4">TOYOTA AVANZA GRAND</h2>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Kursi</th>
                                <td class="detail_kursi"> 6 orang</td>
                                <th scope="row">Tahun</th>
                            <td class="detail_tahun"> 2024</td>
                        </tr>
                        <tr>
                            <th scope="row">Transmisi</th>
                            <td class="detail_transmisi"> Manual</td>
                            <th scope="row">BBM</th>
                            <td class="detail_bbm"> Pertalite</td>
                        </tr>
                        <tr>
                            <th scope="row">Warna</th>
                            <td class="detail_warna" colspan="3"> Hitam</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="mb-0 penyedia_layanan">

                </div>
                <hr>
                <?= form_open('order/select-order', ['id' => 'formSearchOrder'], ['kode' => '', 'item' => '']) ?>
                <div class="mb-0 jenis_transmisi">
                    <div class="mb-3">
                        <label for="jenis_transmisi" class="form-label">Jenis Transmisi</label>
                        <input type="text" name="jenis_transmisi" class="form-control" id="jenis_transmisi" placeholder="Masukkan jenis transmisi">
                    </div>
                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <input type="text" name="warna" class="form-control" id="warna" placeholder="Masukkan warna">
                    </div>
                    <span>* Jika tidak diisi, akan diplih sesuai ketersediaan unit</span>
                </div>
                <hr>
                <div class="mb-0 jumlah_order">
                    <div class="row g-3">
                        <div class="col-auto">
                            <label for="staticEmail2" class="visually-hidden">Jumlah Order (Unit)</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Jumlah Order (Unit)">
                        </div>
                        <div class="col-auto">
                            <label for="jumlah" class="visually-hidden">Password</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary button-minus" type="button">-</button>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" value="1">
                                <button class="btn btn-outline-secondary button-plus" type="button">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-0 data_order">
                    <p class="lead">Data Pemesanan</p>
                    <ul class="list-group" id="data_pemesanan">
                    <li class="list-group-item">
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama[]" class="form-control" id="nama" placeholder="Masukkan nama" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_hp[]" class="form-control" id="no_hp" placeholder="Masukkan no. hp" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" name="nik[]" class="form-control" id="nik" placeholder="Masukkan NIK" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="note" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <input type="text" name="note[]" class="form-control" id="note" placeholder="Masukkan note">
                            </div>
                        </div>
                    </li>
                    </ul>
                </div>
                <hr>
                <div id="pembayaran" class="mb-3">
                    <p class="lead">Jenis Pembayaran</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_pembayaran" id="inlineRadio1" value="1" checked required>
                        <label class="form-check-label" for="inlineRadio1">Lunas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_pembayaran" id="inlineRadio2" value="2" required>
                        <label class="form-check-label" for="inlineRadio2">Mundur</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" name="catatan" class="form-control" id="catatan" placeholder="Masukkan catatan">
                </div>
                <div class="mb-3">
                    <label for="voucher" class="form-label">Voucher</label>
                    <input type="text" name="voucher" class="form-control" id="voucher" placeholder="Masukkan voucher">
                </div>
                <?= form_close() ?>
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <div id="total_biaya">
                    <label for="total" class="form-label">Total Biaya</label>
                    <p class="fw-bold mb-0" id="total">Rp 615.000</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btnSubmit">LANJUT</button>
                </div>
            </div>
            </div>
        </div>
    </div>