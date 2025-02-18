
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="nav-link" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-arrow-left"></i> Detail Order
                </a>
            </div>
            <div class="modal-body">
                <h6 class="mb-3">Ubah Data Pembayaran</h6>
                <form id="formPayment" action="#" method="post">
                    <div class="row mb-3">
                        <div class="col-md-4">Metode</div>
                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jns_byr" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Lunas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jns_byr" id="inlineRadio2" value="3">
                                <label class="form-check-label" for="inlineRadio2">Mundur</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="biaya_1" class="form-label">Over Time (Rp)</label>
                        <input type="text" name="biaya_1" id="biaya_1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="biaya_2" class="form-label">Tol/Parkir (Rp)</label>
                        <input type="text" name="biaya_2" id="biaya_2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="biaya_3" class="form-label">Lain-lain (Rp)</label>
                        <input type="text" name="biaya_3" id="biaya_3" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_tempo" class="form-label">Tgl. Jatuh Tempo</label>
                        <input type="text" name="tgl_tempo" id="tgl_tempo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal_disc" class="form-label">Diskon (Rp)</label>
                        <input type="text" name="nominal_disc" id="nominal_disc" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ketr_byr" class="form-label">Keterangan</label>
                        <textarea name="ketr_byr" cols="30" rows="3" id="ketr_byr" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <!-- <label for="total_tagihan" class="form-label">Total Tagihan</label>
                        <input type="text" name="total_tagihan" id="total_tagihan" class="form-control-plaintext" readonly> -->
                        <h6>Total Tagihan</h6>
                        <h6 id="total_tagihan"></h6 >
                    </div>
                    <input type="hidden" name="id_order" id="id_order">
                    <button type="submit" class="btn btn-outline-primary w-100 btnPaymentSave">Simpan</button>
                </form>
            </div>
            <div class="modal-footer justify-content-between d-none">
                ...
            </div>
        </div>
    </div>
    </div>