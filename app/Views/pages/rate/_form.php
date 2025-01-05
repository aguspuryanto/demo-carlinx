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
        <!-- <input type="text" class="form-control" id="lokasiJemput" placeholder="Lokasi Jemput" autocomplete="on">
        <div id="lokasiJemputList"></div> -->
        <!-- <label for="lokasiJemput" class="form-label">Search Location</label> -->
        <select id="lokasiJemput" class="form-select" aria-placeholder="Lokasi Jemput" style="width: 100%;"></select>
      </div>
      <div class="col-6">
        <!-- <input type="text" class="form-control" id="lokasiTujuan" placeholder="Lokasi Tujuan">
        <div id="lokasiTujuanList"></div> -->
        <!-- <label for="lokasiTujuan" class="form-label">Search Location</label> -->
        <select id="lokasiTujuan" class="form-select" style="width: 100%;"></select>
      </div>
    </div>
  </div>

  <!-- Biaya Tambahan -->
  <div class="mb-3">
    <label class="form-label d-block">Biaya Tambahan</label>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" id="fuel">
      <label class="form-check-label" for="fuel">BBM</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" id="driverMeal">
      <label class="form-check-label" for="driverMeal">Makan Driver</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" id="driverStay">
      <label class="form-check-label" for="driverStay">Inap Driver</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="checkbox" class="form-check-input" id="transferIn">
      <label class="form-check-label" for="transferIn">Transfer In</label>
    </div>
    <div class="form-check form-check-inline">
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
<?php echo form_close(); ?>

<?= $this->section('styles') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css"> -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= registerJsUrl("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"); ?>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script>
  $(function () {
    // $('#unitName').select2();
    var requestOptions = {
      method: 'GET',
    };

    // $("#lokasiJemput").autocomplete({
    //   source: function(request, response) {
    //     $.ajax({
    //       url: '/rate/placeid',
    //       type: 'GET',
    //       dataType: "json",
    //       data: {
    //         term: request.term,
    //       },
    //       success: function(data) {
    //         // response(data);
    //         console.log(data);                  
    //         // looping data
    //         // var data = result.items;
    //         if(data.items) {
    //           var selectOptions = '<select class="form-control">';
    //           $.each(data.items, function (index, item) {
    //             selectOptions += '<option value="' + item.address.label + '">' + item.address.label + '</option>';
    //           });
    //           selectOptions += '</select>';

    //           $('#lokasiJemputList').html(selectOptions);
    //           // $(this).html(selectOptions);
    //         } else {
    //           $('#lokasiJemputList').html('');
    //         }
    //       }
    //     });
    //   },
    //   minLength: 3,
    //   select: function(event, ui) {
    //     // console.log(ui.item.value);
    //     console.log(ui.item.address.label);
    //   }
    // });

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
                return {
                    results: data.items.map(item => ({
                        id: item.id,
                        text: item.title
                    }))
                };
            },
            cache: true
        }
    });
  });
</script>
<?= $this->endSection() ?>