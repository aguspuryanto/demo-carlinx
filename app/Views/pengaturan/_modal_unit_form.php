    <div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" class="nav-link p-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-arrow-left"></i> Unit
                    </a>
                </div>
                <form action="<?= base_url('pengaturan/unit') ?>" method="POST">
                <div class="modal-body">
                    <?php include_once '_form_unit.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>