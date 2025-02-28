    <div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Batas Wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('pengaturan/batas-wilayah') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dlm_kota">Dalam Kota (km)</label>
                        <input type="number" class="form-control" id="dlm_kota" name="dlm_kota" required>
                    </div>
                    <div class="form-group">
                        <label for="dlm_prop">Luar Kota (km)</label>
                        <input type="number" class="form-control" id="dlm_prop" name="dlm_prop" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_1">Zona 1 (km)</label>
                            <input type="number" class="form-control" id="batas_1" name="batas_1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_1">Min. Sewa (hari)</label>
                            <input type="number" step=".01" class="form-control" id="hari_1" name="hari_1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_2">Zona 2 (km)</label>
                            <input type="number" class="form-control" id="batas_2" name="batas_2" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_2">Min. Sewa (hari)</label>
                            <input type="number" class="form-control" id="hari_2" name="hari_2" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_3">Zona 3 (km)</label>
                            <input type="number" class="form-control" id="batas_3" name="batas_3" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_3">Min. Sewa (hari)</label>
                            <input type="number" class="form-control" id="hari_3" name="hari_3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_4">Zona 4 (km)</label>
                            <input type="number" class="form-control" id="batas_4" name="batas_4" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_4">Min. Sewa (hari)</label>
                            <input type="number" class="form-control" id="hari_4" name="hari_4" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_5">Zona 5 (km)</label>
                            <input type="number" class="form-control" id="batas_5" name="batas_5" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_5">Min. Sewa (hari)</label>
                            <input type="number" class="form-control" id="hari_5" name="hari_5" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="batas_6">Zona 6 (km)</label>
                            <input type="number" class="form-control" id="batas_6" name="batas_6" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hari_6">Min. Sewa (hari)</label>
                            <input type="number" class="form-control" id="hari_6" name="hari_6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ketr">Catatan Form Order (opsional)</label>
                        <textarea class="form-control" id="ketr" name="ketr" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>