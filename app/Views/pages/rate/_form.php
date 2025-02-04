<?php
// helper('form');
?>

<?= form_open('rate/hitung', ['id' => 'formHitung']); ?>
  <!-- Nama Unit -->
  <div class="mb-3">
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
    <!-- <label class="form-label">Rute Perjalanan</label> -->
    <div class="row g-0">
      <div class="col-md-6">
        <!-- <div class="input-group"> -->
          <label class="form-label">Rute Perjalanan</label>
          <select id="lokasiJemput" name="lokasi_jemput" class="form-select select2">
            <option value="">Pilih Lokasi Jemput</option>
          </select>
          <!-- <button class="btn btn-outline-primary" type="button" id="switchButton"><i class="fa fa-exchange"></i></button>
        </div> -->
      </div>
      <div class="col-md-6">
        <!-- <div class="input-group"> -->
          <label class="form-label"><input type="checkbox" id="dalamKota" name="dalam_kota" class="form-check-input"> Dalam Kota</label>
          <select id="lokasiTujuan" name="lokasi_tujuan" class="form-select select2">
            <option value="">Pilih Lokasi Tujuan</option>
          </select>
          <!-- <button class="btn btn-outline-primary" type="button" id="tambahRute"><i class="fa fa-plus-square"></i></button>
        </div> -->
      </div>
    </div>

    <ul id="listRute" class="list-group mt-2">
        <!-- Daftar rute akan ditambahkan di sini -->
    </ul>
  </div>

  <!-- Biaya Tambahan -->
  <div class="mb-3">
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
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_awal" id="transferIn">
      <label class="form-check-label" for="transferIn">Transfer In</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_akhir" id="transferOut">
      <label class="form-check-label" for="transferOut">Transfer Out</label>
    </div>
  </div>
  <div class="mb-3">
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
  <input type="hidden" name="origins[]" id="origin">
  <input type="hidden" name="destinations[]" id="destination">
  <input type="hidden" name="jarak" id="jarak">
  <input type="hidden" name="ketr" id="ketr">
  <input type="hidden" name="fee" id="fee">

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100" id="btnHitung">Mulai Perhitungan</button>
<?php echo form_close(); ?>
