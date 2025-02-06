<?php
helper('form');
?>

<?= form_open('order/search-order', ['id' => 'formSearchOrder', 'class' => 'row g-3 needs-validation', 'novalidate' => '']); ?>
  <!-- Nama Unit -->
  <div class="form-group">
    <label for="kotaTujuan" class="form-label">Kota Tujuan</label>
    <select class="form-control" name="kd_kota" id="kotaTujuan" required>
      <option value="">Pilih Kota Tujuan</option>
      <?php if (!empty($listKota['result_kota'])) : foreach ($listKota['result_kota'] as $kota) : ?>
        <option value="<?= $kota['kode']; ?>"><?= $kota['nama']; ?></option>
      <?php endforeach; endif; ?>
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

  <div class="mb-3">
    <!-- <label class="form-label">Rute Perjalanan</label> -->
    <div class="row g-0">
      <div class="col-6 col-md-6">
        <!-- <div class="input-group"> -->
          <label class="form-label">Rute Perjalanan</label>
          <select id="lokasiJemput" name="lokasi_jemput" class="form-select select2">
            <option value="">Pilih Lokasi Jemput</option>
          </select>
          <!-- <button class="btn btn-outline-primary" type="button" id="switchButton"><i class="fa fa-exchange"></i></button>
        </div> -->
      </div>
      <div class="col-6 col-md-6">
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
    <ul id="listRuteButton" class="list-group d-none">
      <a href="#" class="d-flex justify-content-end list-group-item list-group-item-action list-group-item-light" id="tambahRute">+ Tambah Lokasi Tujuan</a>
    </ul>
  </div>

  <!-- Biaya Tambahan -->
  <div class="mb-3">
    <label class="form-label d-block">Biaya Tambahan</label>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_bbm" id="is_bbm" checked>
      <label class="form-check-label" for="is_bbm">BBM</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_makan" id="is_makan">
      <label class="form-check-label" for="is_makan">Makan Driver</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="is_hotel" id="is_hotel">
      <label class="form-check-label" for="is_hotel">Inap Driver</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_awal" id="drop_awal">
      <label class="form-check-label" for="drop_awal">Transfer In</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" name="drop_akhir" id="drop_akhir">
      <label class="form-check-label" for="drop_akhir">Transfer Out</label>
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