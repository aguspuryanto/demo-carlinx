<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Hitung Tarif</h4>
                </div>
                <div class="card-body">
                    <?php include_once '_form.php'; ?>
                </div>
            </div>

            <!-- konfirmasi order -->
            <?php include_once '_form_konfirmasi.php'; ?>
        </div>
    </div>
    <!-- end main page content -->
<?= $this->endSection() ?>

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

            // set konfirmasi
            $('#tanggal').text(result.tgl_start + ' s/d ' + result.tgl_finish); // 20-01-2025 06:00 s/d 20-01-2025 23:59
            $('#tujuan').text(result.lokasi_tujuan + ' - ' + result.lokasi_jemput); // Surabaya - Malang
            $('#namaUnit').text(result.nama); // AVANZA 2017 (TES)
            $('#include').text(result.include); // Mobil, Driver, BBM
            $('#totalBiaya').text(convertRupiah(result.total_hrg_sewa)); // 2375000

            // set data pelanggan
            $('#formSendWhatsapp').find('#tgl_start').val(result.tgl_start);
            // $('#jam_start').val(result.jam_start);
            $('#formSendWhatsapp').find('#tgl_finish').val(result.tgl_finish);
            // $('#jam_end').val(result.jam_end);
            $('#formSendWhatsapp').find('#lokasi_tujuan').val(result.lokasi_tujuan);
            $('#formSendWhatsapp').find('#nama_unit').val(result.nama);
            $('#formSendWhatsapp').find('#include').val(result.include);
            $('#formSendWhatsapp').find('#total_hrg_sewa').val(result.total_hrg_sewa);
            $('#formSendWhatsapp').find('#nama_pelanggan').val(result.nama_pelanggan);
            $('#formSendWhatsapp').find('#no_hp').val(result.no_hp);

            // hide #btnHItung
            // $('#btnHitung').attr('disabled', true);
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

    $('#btnSendWhatsapp').on('click', function (e) {
      e.preventDefault();

      var formWhatsapp = $('#formSendWhatsapp')[0];
      var dataWhatsapp = new FormData(formWhatsapp);

      // validation, nama_pelanggan
      if (!$('#nama_pelanggan').val()) {
        alert('Mohon isi nama pelanggan');
        return;
      }

      // validation, no_hp
      if (!$('#no_hp').val()) {
        alert('Mohon isi no hp');
        return;
      }

      $.ajax({
        url: 'rate/send-whatsapp',
        type: 'POST',
        data: dataWhatsapp,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
          console.log(response);
          if(response.success) {
            // alert(response.message);
            window.open(response.url, '_blank');
          } else {
            alert(response.message);
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