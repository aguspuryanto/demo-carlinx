    <div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Lokasi Garasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('pengaturan/lokasi-garasi') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_kota">Deskripsi</label>
                        <select name="kd_kota" id="kd_kota" class="form-select">
                            <?php foreach ($listkota['result_kota'] as $l) : ?>
                            <option value="<?= $l['kode'] ?>"><?= $l['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
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