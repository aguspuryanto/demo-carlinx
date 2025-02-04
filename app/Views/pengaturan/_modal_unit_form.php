    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url('pengaturan/unit') ?>" method="POST">
                <div class="modal-header">
                    <a href="#" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-arrow-left"></i> Unit
                    </a>
                    <!-- <h5 class="modal-title" id="addModalLabel">Tambah Unit</h5> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
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