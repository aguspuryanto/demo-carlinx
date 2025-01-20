
<?= form_open('rate/konfirm', ['id' => 'formKonfirm']); ?>
    <div class="mb-3">
        <h4>Detail Order</h4>
        <p>Tanggal: <span id="tanggal"></span></p>
        <p>Tujuan: <span id="tujuan"></span></p>
        <p>Nama Unit: <span id="namaUnit"></span></p>
        <p>Include: <span id="include"></span></p>
        <p>Total Biaya: <span id="totalBiaya"></span></p>
    </div>
    <div class="mb-3">
        <h4>Pelanggan</h4>
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">No. HP</label>
        <input type="text" class="form-control" id="no_hp" placeholder="No. HP">
    </div>
    <button type="submit" class="btn btn-primary w-100" id="btnKonfirm">Konfirmasi Order</button>
<?= form_close(); ?>