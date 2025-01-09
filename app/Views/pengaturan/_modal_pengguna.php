    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('pengaturan/pengguna') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nohp">No HP</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" required>
                    </div>
                    
                    <input type="hidden" name="stat" id="stat">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>