<?php
helper('form');
?>

<?= form_open('order/lepaskunci', ['id' => 'formSearchOrder', 'class' => 'row g-3']); ?>
  <!-- Nama Unit -->
  <div class="form-group">
    <label for="kotaTujuan" class="form-label">Kota Tujuan</label>
    <select class="form-control" name="kd_kota" id="kotaTujuan" required>
      <option value="">Pilih Kota Tujuan</option>
      <?php foreach ($listKota['result_kota'] as $kota) : ?>
        <option value="<?= $kota['kode']; ?>"><?= $kota['nama']; ?></option>
      <?php endforeach; ?>
    </select>
  </div> 

  <!-- Tanggal/Jam Sewa -->
  <div class="mb-3">
    <label class="form-label">Tanggal/Jam Sewa</label>
    <div class="row">
      <div class="col-6">
        <label for="pickupDate" class="form-label">Tgl Jemput</label>
        <input type="text" class="form-control" name="tgl_start" id="pickupDate" value="<?= date('d-m-Y') ?>" autocomplete="off" required>
      </div>
      <div class="col-6">
        <label for="pickupTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_start" id="pickupTime" value="<?= date('06:00') ?>">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <label for="returnDate" class="form-label">Tgl Selesai</label>
        <input type="text" class="form-control" name="tgl_finish" id="returnDate" autocomplete="off" value="<?= date('d-m-Y') ?>" required>
      </div>
      <div class="col-6">
        <label for="returnTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_finish" id="returnTime" value="<?= date('23:59') ?>">
      </div>
    </div>
  </div>

  <!-- Penanggung Jawab -->
  <div class="mb-3">
    <label class="form-label d-block">Penanggung Jawab</label>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tg_jwb" id="inlineRadio1" value="1" checked>
      <label class="form-check-label" for="inlineRadio1">Rental Pemesan</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tg_jwb" id="inlineRadio2" value="2">
      <label class="form-check-label" for="inlineRadio2">Pelanggan</label>
    </div>
  </div>
  
  <!-- Syarat & Ketentuan -->
  <div class="mb-3">
    <p class="fw-bold">Syarat dan Ketentuan</p>
    <ol style="list-style-type: decimal; font-size: 12px;">
      <li>Lengkapi syarat/dokumen yang dibutuhkan</li>
      <li>Periksa kondisi unit saat penerimaan dan pengembalian.</li>
      <li>Kembalikan posisi jarum BBM sama dengan saat penerimaan.</li>
      <li>Keterlambatan pengembalian akan dikenakan biaya keterlambatan.</li>
      <li>Segala risiko yang terjadi selama waktu peminjaman, menjadi tanggung jawab Rental Pemesan/Pelanggan.</li>
    </ol>
  </div>

  <!-- Nama Unit -->
  <div class="mb-3">
    <label for="unitName" class="form-label">Nama Unit</label>
    <input type="text" class="form-control" name="search" id="unitName" placeholder="Nama Unit" style="text-transform: uppercase">
  </div>

  <input type="hidden" name="jns_order" value="<?=$jns_order ?>">

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100">MULAI PENCARIAn</button>
<?php echo form_close(); ?>