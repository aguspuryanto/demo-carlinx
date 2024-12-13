<?php
helper('form');
?>

<?= form_open('rate/hitung', []); ?>
  <!-- Nama Unit -->
  <div class="form-group">
    <label for="unitName" class="form-label">Nama Unit</label>
    <select class="form-control" name="unit" id="unitName">
      <option>Avanza 2017 (Test)</option>
      <option>Avanza 2020 (Test)</option>
      <option>Avanza TSS (Test)</option>
      <option>Big Bus (Test)</option>
    </select>
  </div> 

  <!-- Tanggal/Jam Sewa -->
  <div class="mb-3">
    <label class="form-label">Tanggal/Jam Sewa</label>
    <div class="row">
      <div class="col-6">
        <label for="pickupDate" class="form-label">Tgl Jemput</label>
        <input type="date" class="form-control" id="pickupDate">
      </div>
      <div class="col-6">
        <label for="pickupTime" class="form-label">Jam</label>
        <input type="time" class="form-control" id="pickupTime">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <label for="returnDate" class="form-label">Tgl Selesai</label>
        <input type="date" class="form-control" id="returnDate">
      </div>
      <div class="col-6">
        <label for="returnTime" class="form-label">Jam</label>
        <input type="time" class="form-control" id="returnTime">
      </div>
    </div>
  </div>

  <!-- Rute Perjalanan -->
  <div class="mb-3">
    <label class="form-label">Rute Perjalanan</label>
    <div class="row">
      <div class="col-6">
        <input type="text" class="form-control" placeholder="Lokasi Jemput">
      </div>
      <div class="col-6">
        <input type="text" class="form-control" placeholder="Lokasi Tujuan">
      </div>
    </div>
  </div>

  <!-- Biaya Tambahan -->
  <div class="mb-3">
    <label class="form-label">Biaya Tambahan</label>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="fuel">
      <label class="form-check-label" for="fuel">BBM</label>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="driverMeal">
      <label class="form-check-label" for="driverMeal">Makan Driver</label>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="driverStay">
      <label class="form-check-label" for="driverStay">Inap Driver</label>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="transferIn">
      <label class="form-check-label" for="transferIn">Transfer In</label>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="transferOut">
      <label class="form-check-label" for="transferOut">Transfer Out</label>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <input type="number" class="form-control" placeholder="Tol/Parkir">
      </div>
      <div class="col-6">
        <input type="number" class="form-control" placeholder="Lain-lain">
      </div>
    </div>
  </div>

  <!-- Hasil Perhitungan -->
  <div class="mb-3">
    <label for="totalCost" class="form-label">Hasil Perhitungan</label>
    <input type="text" class="form-control" id="totalCost" placeholder="Total Biaya" readonly>
  </div>

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100">Mulai Perhitungan</button>
</form>

<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?>
<script>
    $(function () {
      // 
      $('#unitName').select2();
    });
</script>
<?= $this->endSection() ?>