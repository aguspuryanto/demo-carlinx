<?php
helper('form');
?>

<?= form_open('rate/hitung', []); ?>
  <!-- Nama Unit -->
  <div class="form-group">
    <label for="kotaTujuan" class="form-label">Kota Tujuan</label>
    <select class="form-control" name="kd_kota" id="kotaTujuan">
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
        <input type="date" class="form-control" name="tgl_start" id="pickupDate">
      </div>
      <div class="col-6">
        <label for="pickupTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_start" id="pickupTime">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6">
        <label for="returnDate" class="form-label">Tgl Selesai</label>
        <input type="date" class="form-control" name="tgl_finish" id="returnDate">
      </div>
      <div class="col-6">
        <label for="returnTime" class="form-label">Jam</label>
        <input type="time" class="form-control" name="jam_finish" id="returnTime">
      </div>
    </div>
  </div>

  <!-- Rute Perjalanan -->
  <div class="mb-3">
    <label class="form-label">Rute Perjalanan</label>
    <div class="row">
      <div class="col-6">
        <input type="text" class="form-control" name="lokasi_jemput" id="lokasiJemput" placeholder="Lokasi Jemput" autocomplete="on">
        <div id="lokasiJemputList"></div>
      </div>
      <div class="col-6">
        <input type="text" class="form-control" name="lokasi_tujuan" id="lokasiTujuan" placeholder="Lokasi Tujuan">
        <div id="lokasiTujuanList"></div>
      </div>
    </div>
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
    <label for="totalCost" class="form-label">Nama Unit</label>
    <input type="text" class="form-control" id="totalCost" placeholder="Total Biaya" readonly>
  </div>

  <!-- Tombol -->
  <button type="submit" class="btn btn-primary w-100">Mulai Perhitungan</button>
<?php echo form_close(); ?>

<?= $this->section('styles') ?>
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- <?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script>
  $(function () {
    // $('#unitName').select2();
    $('#unitName').select2({
      theme: 'bootstrap-5',
      placeholder: 'Type to search...',
      minimumInputLength: 2,
      data: listUnit
    });

    // $('#lokasiJemput').on('input', function() {
    //   var textAddress = $(this).val();
    //   console.log(textAddress.length);
    //   if(textAddress.length > 2) {
    //     fetch("https://autocomplete.search.hereapi.com/v1/autocomplete?q=" + textAddress + "&countryCode=INA&apiKey=Cikgr94iiQ3Z3EwJG43WSoYhgBpyVw3XtHrI-CsM0Is", requestOptions)
    //     .then(response => response.json())
    //     .then(function (result) {
    //       console.log(result);
    //       // looping data
    //       var data = result.items;
    //       if(data) {
    //         var selectOptions = '<select class="form-control">';
    //         $.each(data, function (index, item) {
    //           selectOptions += '<option value="' + item.address.label + '">' + item.address.label + '</option>';
    //         });
    //         selectOptions += '</select>';

    //         $('#lokasiJemputList').html(selectOptions);
    //         // $(this).html(selectOptions);
    //       } else {
    //         $('#lokasiJemputList').html('');
    //       }
    //     })
    //     .catch(function (error) {
    //       console.log('error', error)
    //     });
    //   }
    // });

    $("#lokasiJemput").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: '/rate/placeid',
          type: 'GET',
          dataType: "json",
          data: {
            term: request.term,
          },
          success: function(data) {
            // response(data);
            console.log(data);                  
            // looping data
            // var data = result.items;
            if(data.items) {
              var selectOptions = '<select class="form-control">';
              $.each(data.items, function (index, item) {
                selectOptions += '<option value="' + item.address.label + '">' + item.address.label + '</option>';
              });
              selectOptions += '</select>';

              $('#lokasiJemputList').html(selectOptions);
              // $(this).html(selectOptions);
            } else {
              $('#lokasiJemputList').html('');
            }
          }
        });
      },
      minLength: 3,
      select: function(event, ui) {
        // console.log(ui.item.value);
        console.log(ui.item.address.label);
      }
    });
  });
</script>
<?= $this->endSection() ?>