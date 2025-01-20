
<!-- konfirmasi order -->
<div class="card mt-3 d-none" id="cardKonfirm">
    <div class="card-header">
        <h4>Detail Pesanan</h4>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <p>Tanggal: <span id="tanggal"></span></p>
            <p>Tujuan: <span id="tujuan"></span></p>
            <p>Nama Unit: <span id="namaUnit"></span></p>
            <p>Include: <span id="include"></span></p>
            <p>Total Biaya: <span id="totalBiaya"></span></p>
        </div>
    </div>
</div>

<div class="card mt-3 d-none" id="cardPelanggan">
    <div class="card-header">
        <h4>Pelanggan</h4>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No. HP</label>
            <div class="input-group">
                <input type="text" class="form-control" id="no_hp" placeholder="No. HP">
                <button class="btn btn-primary" id="btnSendWhatsapp">Kirim</button>
            </div>
        </div>
    </div>
</div>