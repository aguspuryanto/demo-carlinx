    <div class="modal fade" id="hargaModal" tabindex="-1" role="dialog" aria-labelledby="hargaModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url('pengaturan/unit') ?>" method="POST">
                <div class="modal-header">
                    <a href="#" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-arrow-left"></i> Perkiraan Harga Pasar
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="wilayah" class="col-sm-3 col-form-label">Pilih Wilayah</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="dalamKota" value="dalamKota" checked>
                                <label class="form-check-label" for="dalamKota">Dalam Kota</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="dalamPropinsi" value="dalamPropinsi">
                                <label class="form-check-label" for="dalamPropinsi">Dalam Propinsi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="wilayah" id="luarBatas" value="luarBatas">
                                <label class="form-check-label" for="luarBatas">Luar Batas</label>
                            </div>
                        </div>
                    </div>

                    <div class ="form-group row">
                        <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="harga" placeholder="Masukkan Harga">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
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