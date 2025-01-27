<?php
helper('form');
?>

<?= form_open('order/search-order', ['id' => 'formSearchOrder', 'class' => 'row g-3 needs-validation', 'novalidate' => '']); ?>
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
        <input type="time" class="form-control" name="jam_finish" id="returnTime" value="<?= date('23:59') ?>">
      </div>
    </div>
  </div>

  <!-- Rute Perjalanan -->
  <!-- <div class="mb-3" id="rutePerjalanan">
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
      <div class="col-12 text-start d-none">
        <div id="ruteList">
          <ul class="list-group"></ul>
        </div>
        <div class="text-end mt-2">
          <a href="#rutePerjalanan" class="link-primary" id="addRute">+ Tambah Rute</a>
        </div>
      </div>
    </div>
  </div> -->

  <div class="mb-3">
    <label class="form-label">Rute Perjalanan</label>
    <div class="row g-0">
      <div class="col-md-6">
        <div class="input-group">
          <select id="lokasiJemput" name="lokasi_jemput" class="form-select select2">
            <option value="">Pilih Lokasi Jemput</option>
          </select>
          <button class="btn btn-outline-primary" type="button" id="switchButton"><i class="fa fa-exchange"></i></button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group">
          <select id="lokasiTujuan" name="lokasi_tujuan" class="form-select select2">
            <option value="">Pilih Lokasi Tujuan</option>
          </select>
          <button class="btn btn-outline-primary" type="button" id="tambahRute"><i class="fa fa-plus-square"></i></button>
        </div>
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
      <input type="checkbox" class="form-check-input" name="is_bbm" id="fuel">
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

  <!-- Hasil Perhitungan -->
  <div class="mb-3">
    <label for="unitName" class="form-label">Nama Unit</label>
    <input type="text" class="form-control" name="search" id="unitName" placeholder="Nama Unit" style="text-transform: uppercase">
  </div>

  <!-- Jarak Tempuh -->
  <input type="hidden" name="jarak" id="jarak">

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100">MULAI PENCARIAn</button>
<?php echo form_close(); ?>