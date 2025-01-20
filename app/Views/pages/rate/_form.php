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
        <input type="text" class="form-control" name="tgl_start" id="pickupDate">
      </div>
      <div class="col-6">
        <label for="pickupTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_start" id="pickupTime">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <label for="returnDate" class="form-label">Tgl Selesai</label>
        <input type="text" class="form-control" name="tgl_finish" id="returnDate">
      </div>
      <div class="col-6">
        <label for="returnTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_end" id="returnTime">
      </div>
    </div>
  </div>

  <!-- Rute Perjalanan -->
  <div class="mb-3">
    <label class="form-label">Rute Perjalanan</label>
    <div class="row">
      <div class="col-6">
        <!-- <input type="text" class="form-control" id="lokasiJemput" placeholder="Lokasi Jemput" autocomplete="on">
        <div id="lokasiJemputList"></div> -->
        <!-- <label for="lokasiJemput" class="form-label">Search Location</label> -->
        <select id="lokasiJemput" name="lokasi_jemput" class="form-select" aria-placeholder="Lokasi Jemput" style="width: 100%;"></select>
      </div>
      <div class="col-6">
        <!-- <input type="text" class="form-control" id="lokasiTujuan" placeholder="Lokasi Tujuan">
        <div id="lokasiTujuanList"></div> -->
        <!-- <label for="lokasiTujuan" class="form-label">Search Location</label> -->
        <select id="lokasiTujuan" name="lokasi_tujuan" class="form-select" style="width: 100%;"></select>
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