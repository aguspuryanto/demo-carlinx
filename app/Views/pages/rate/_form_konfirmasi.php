
<!-- konfirmasi order -->
<div class="card mb-3" id="cardKonfirm">
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

<div class="card mb-3" id="cardPelanggan">
    <div class="card-header">
        <h4>Pelanggan</h4>
    </div>
    <div class="card-body">
        <?= form_open('rate/send-whatsapp', ['id' => 'formSendWhatsapp']); ?>
            <input type="hidden" name="tgl_start" id="tgl_start">
            <input type="hidden" name="jam_start" id="jam_start">
            <input type="hidden" name="tgl_finish" id="tgl_finish">
            <input type="hidden" name="jam_end" id="jam_end">
            <input type="hidden" name="lokasi_tujuan" id="lokasi_tujuan">
            <input type="hidden" name="nama_unit" id="nama_unit">
            <input type="hidden" name="include" id="include">
            <input type="hidden" name="total_hrg_sewa" id="total_hrg_sewa">
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan">
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP">
                    <button class="btn btn-primary" id="btnSendWhatsapp">Kirim</button>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>