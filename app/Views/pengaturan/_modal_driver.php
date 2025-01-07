    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Driver</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pengaturan/driver') ?>" method="POST">
                        <!-- kategory -->
                        <div class="form-group">
                            <label for="kd_kat">Kategori</label>
                            <select class="form-control" id="kd_kat" name="kd_kat" required>
                                <?php foreach ($listKategori['result_kategori'] as $item) : ?>
                                    <option value="<?= $item['kode'] ?>"><?= $item['descr'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!-- dalam kota harga -->
                        <div class="form-group">
                            <label for="dlm_kota">Harga Dalam Kota</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="dlm_kota" name="dlm_kota" required>
                            </div>
                        </div>
                        <!-- luar kota harga -->
                        <div class="form-group">
                            <label for="dlm_prop">Harga Luar Kota</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="dlm_prop" name="dlm_prop" required>
                            </div>
                        </div>
                        <!-- luar batas kota -->
                        <div class="form-group">
                            <label for="luar_prop">Harga Luar Batas Kota</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="luar_prop" name="luar_prop" required>
                            </div>
                        </div>
                        <!-- Biaya Makan -->
                        <div class="form-group">
                            <label for="makan">Biaya Makan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="makan" name="makan" required>
                            </div>
                        </div>

                        <!-- Biaya Inap -->
                        <div class="form-group">
                            <label for="hotel">Biaya Inap</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="hotel" name="hotel" required>
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