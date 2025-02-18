
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="false" aria-modal="true">
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
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="lunas">
                                <label class="form-check-label" for="inlineRadio1">Lunas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="mundur">
                                <label class="form-check-label" for="inlineRadio2">Mundur</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <label for="overtime" class="form-label">Over Time (Rp)</label>
                        <input type="text" name="overtime" id="overtime" class="form-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="tol_parkir" class="form-label">Tol/Parkir (Rp)</label>
                        <input type="text" name="tol_parkir" id="tol_parkir" class="form-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="lain_lain" class="form-label">Lain-lain (Rp)</label>
                        <input type="text" name="lain_lain" id="lain_lain" class="form-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="tgl_jatuh_tempo" class="form-label">Tgl. Jatuh Tempo</label>
                        <input type="date" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" class="form-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="diskon" class="form-label">Diskon (Rp)</label>
                        <input type="text" name="diskon" id="diskon" class="form-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" cols="30" rows="3" id="keterangan" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="total_tagihan" class="form-label">Total Tagihan</label>
                        <input type="text" name="total_tagihan" id="total_tagihan" class="form-control-plaintext" readonly>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100">Simpan</button>
                </form>
            </div>
            <div class="modal-footer justify-content-between d-none">
                ...
            </div>
        </div>
    </div>
    </div>