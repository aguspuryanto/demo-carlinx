    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('pengaturan/bbm') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Batas Wilayah</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="descr">Dalam Kota (km)</label>
                            <input type="number" class="form-control" id="dlm_kota" name="dlm_kota" required>
                        </div>


                        <div class="form-group">
                            <label for="harga">Luar Kota (km)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="hrg_bbm" name="hrg_bbm" required>
                            </div>
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