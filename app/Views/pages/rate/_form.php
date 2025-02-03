<?php
// helper('form');
?>

<?= form_open('rate/hitung', ['id' => 'formHitung']); ?>
  <!-- Nama Unit -->
  <div class="form-group">
    <label for="unitName" class="form-label">Nama Unit</label>
    <select class="form-control" name="kd_unit" id="unitName">
      <option value="">Pilih Nama Unit</option>
      <?php foreach ($listUnit['result_unit'] as $unit) : ?>
        <option value="<?= $unit['kode']; ?>"><?= $unit['nama']; ?></option>
      <?php endforeach; ?>
    </select>
  </div> 

  <!-- Tanggal/Jam Sewa -->
  <div class="mb-3">
    <label class="form-label">Tanggal/Jam Sewa</label>
    <div class="row">
      <div class="col-6">
        <label for="pickupDate" class="form-label">Tgl Jemput</label>
        <input type="text" class="form-control" name="tgl_start" id="pickupDate" autocomplete="off" value="<?= date('d-m-Y') ?>">
      </div>
      <div class="col-6">
        <label for="pickupTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_start" id="pickupTime" value="<?= date('06:00') ?>">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <label for="returnDate" class="form-label">Tgl Selesai</label>
        <input type="text" class="form-control" name="tgl_finish" id="returnDate" autocomplete="off" value="<?= date('d-m-Y') ?>">
      </div>
      <div class="col-6">
        <label for="returnTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_end" id="returnTime" value="<?= date('23:59') ?>">
      </div>
    </div>
  </div>

  <!-- Rute Perjalanan -->
  <div class="mb-3">
    <label class="form-label">Rute Perjalanan</label>
    <div class="row">
      <div class="col-6">
        <select class="form-control" name="lokasi_jemput" id="lokasiJemput">
          <option value="">Pilih Lokasi Jemput</option>
        </select>
        <div id="lokasiJemputList" class="mt-2"></div>
      </div>
      <div class="col-6">
        <select class="form-control" name="lokasi_tujuan" id="lokasiTujuan">
          <option value="">Pilih Lokasi Tujuan</option>
        </select>
        <div id="lokasiTujuanList" class="mt-2"></div>
      </div>
    </div>
  </div>

  <!-- Biaya Tambahan -->
  <div class="mb-0">
    <label class="form-label d-block">Biaya Tambahan</label>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_bbm" id="fuel" checked>
      <label class="form-check-label" for="fuel">BBM</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_makan" id="driverMeal">
      <label class="form-check-label" for="driverMeal">Makan Driver</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_hotel" id="driverStay">
      <label class="form-check-label" for="driverStay">Inap Driver</label>
    </div>
  </div>
  <div class="mb-3">
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_awal" id="transferIn">
      <label class="form-check-label" for="transferIn">Transfer In</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_akhir" id="transferOut">
      <label class="form-check-label" for="transferOut">Transfer Out</label>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <input type="number" class="form-control" name="tolparkir" placeholder="Tol/Parkir">
      </div>
      <div class="col-6">
        <input type="number" class="form-control" name="lainlain" placeholder="Lain-lain">
      </div>
    </div>
  </div>

  <!-- Hasil Perhitungan -->
  <div class="mb-3">
    <label for="totalCost" class="form-label">Hasil Perhitungan</label>
    <input type="text" class="form-control" id="totalCost" placeholder="Total Biaya" readonly>
  </div>

  <!-- hidden -->
  <input type="hidden" name="jarak" id="jarak">
  <input type="hidden" name="ketr" id="ketr">
  <input type="hidden" name="fee" id="fee">

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100" id="btnHitung">Mulai Perhitungan</button>
<?php echo form_close(); ?>