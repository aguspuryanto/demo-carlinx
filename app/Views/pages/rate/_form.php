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

  <!-- konfirmasi order -->
  <?php include_once '_form_konfirmasi.php'; ?>

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100" id="btnHitung">Mulai Perhitungan</button>
<?php echo form_close(); ?>

<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-clustering.js"></script>
<script>
  $(function () {
    // $('#unitName').select2();
    const convertRupiah = (number)=>{
      return new Intl.NumberFormat("id-ID", {
        style: "currency", currency: "IDR", minimumFractionDigits: 0
      }).format(number);
    }

    var listUnit = '<?= json_encode($listUnit) ?>';
    var today = new Date(); // - 1 day
    today.setDate(today.getDate() - 1);

    const isvalid = false

    $('#unitName').select2({
      theme: 'bootstrap-5',
      placeholder: 'Type to search...',
      minimumInputLength: 2,
      data: listUnit
    });
    
    $('#pickupDate').datepicker({
      uiLibrary: 'bootstrap5',
      format: 'dd-mm-yyyy',
      minDate: today,
      maxDate: function () {
        return $('#returnDate').val();
      }
    });

    $('#returnDate').datepicker({
      uiLibrary: 'bootstrap5',
      format: 'dd-mm-yyyy',
      minDate: function () {
        return $('#pickupDate').val();
      }
    });

    // Initialize Select2
    $('#lokasiJemput, #lokasiTujuan').select2({
        theme: 'bootstrap-5',
        placeholder: 'Type to search...',
        minimumInputLength: 2,
        ajax: {
            url: '<?= $_ENV['API_BASEURL_HERE'] ?>/autocomplete',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // Search term
                limit: 5,      // Limit results
                apiKey: '<?= $_ENV['API_KEY_HERE'] ?>'
              };
            },
            processResults: function (data) {
              console.log(data.items);
              return {
                results: data.items.map(item => ({
                  id: item.title,
                  text: item.title
                }))
              };
            },
            cache: true
        }
    });

    $('#btnHitung').on('click', function (e) {
      e.preventDefault();
      var form = $('#formHitung')[0];
      var data = new FormData(form);

      // validation, kd_unit
      if (!$('#unitName').val()) {
        alert('Mohon pilih unit');
        return;
      }

      // validation, pickupDate
      if (!$('#pickupDate').val()) {
        alert('Mohon pilih tanggal jemput');
        return;
      }

      // validation, returnDate
      if (!$('#returnDate').val()) {
        alert('Mohon pilih tanggal kembali');
        return;
      }

      // validation, lokasiJemput
      if (!$('#lokasiJemput').val()) {
        alert('Mohon pilih lokasi jemput');
        return;
      }

      // validation, lokasiTujuan
      if (!$('#lokasiTujuan').val()) {
        alert('Mohon pilih lokasi tujuan');
        return;
      }

      $.ajax({
        url: 'rate/hitung',
        type: 'POST',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response.result_unit_order[0], 'response');
          if (response.success && response.result_unit_order && response.result_unit_order.length > 0) {
            const result = response.result_unit_order[0];
            $('#totalCost').val(convertRupiah(result.total_hrg_sewa));
            // hide #btnHItung
            $('#btnHitung').attr('disabled', true);
            // show #btnKonfirm
            $('#cardKonfirm, #cardPelanggan').show().removeClass('d-none');
          } else {
            console.error("Data tidak ditemukan atau tidak valid.");
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
      });
    });

    $('#btnKonfirm').on('click', function (e) {
      e.preventDefault();
      var form = $('#formHitung')[0];
      var data = new FormData(form);
      $.ajax({
        url: 'rate/konfirm',
        type: 'POST',
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          if (response.success && response.result_unit_order && response.result_unit_order.length > 0) {
            const result = response.result_unit_order[0];
            $('#totalCost').val(convertRupiah(result.total_hrg_sewa));
            // hide #btnHItung
            $('#btnHitung').hide();
            // show #btnKonfirm
            $('#btnKonfirm').show().removeClass('d-none');
          } else {
            console.error("Data tidak ditemukan atau tidak valid.");
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>
<?= $this->endSection() ?>