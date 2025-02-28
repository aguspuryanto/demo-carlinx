
    <!-- Modal -->
    <div class="modal fade" id="driverModal" tabindex="-1" aria-labelledby="addModalLabel">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="nav-link p-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-arrow-left"></i> Detail Order
                </a>
            </div>
            <div class="modal-body">
                <form id="formPayment" action="#" method="post">
                    <h6 class="mb-3">Data Driver</h6>
                    <div class="mb-3 align-items-center">
                        <label class="form-label visually-hidden">Driver</label>
                        <input type="text" name="nama_driver[]" class="form-control" id="nama_driver" placeholder="Nama Driver">
                    </div>
                    <div class="mb-3 align-items-center">
                        <label class="form-label visually-hidden">No HP</label>
                        <input type="text" name="no_hp_driver[]" class="form-control" id="no_hp_driver" placeholder="No HP">
                    </div>
                    <div class="mb-3 align-items-center">
                        <label class="form-label visually-hidden">Nopol</label>
                        <input type="text" name="nopol_driver[]" class="form-control" id="nopol_driver" placeholder="Nopol">
                    </div>
                    <div class="mb-3 align-items-center">
                        <label class="form-label visually-hidden">Note</label>
                        <input type="text" name="note_driver[]" class="form-control" id="note_driver" placeholder="Note">
                    </div>
                    <input type="hidden" name="id_order" id="id_order" value="">
                    <input type="hidden" name="no" id="no" value="">
                    <button type="submit" class="btn btn-outline-primary w-100 btnDriverSave">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </div>