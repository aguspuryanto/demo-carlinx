<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card p-0">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body p-0">
                    <?php //echo json_encode($listData); ?>
                    <?php include_once '_list_layanan.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_search_order.php'; ?>
    <?php include_once '_modal_confirm_order.php'; ?>

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
    const baseUrlImg = "<?= base_url('proxy.php?url=' . $_ENV['API_BASEURL'] . 'images/') ?>";
    $('#exampleModal').on('show.bs.modal', function (e) {
        console.log(e.relatedTarget.dataset.item);
                
        // get data-item
        var item = JSON.parse(e.relatedTarget.dataset.item);
        console.log(item, '52_item');

        // nama
        $(this).find('.modal-body h2').text(item.nama);

        // table detail
        $(this).find('.modal-body table tbody tr td.detail_kursi').text(item.kursi);
        $(this).find('.modal-body table tbody tr td.detail_tahun').text(item.tahun);
        $(this).find('.modal-body table tbody tr td.detail_transmisi').text(item.transmisi);
        $(this).find('.modal-body table tbody tr td.detail_bbm').text(item.bbm);
        $(this).find('.modal-body table tbody tr td.detail_warna').text(item.warna);

        // penyedia layanan
        let penyedia_layanan = '<div class="mb-3"><p class="lead h6">Penyedia Layanan</p>' + item.nama_rental + '<br />' + item.kota_rental + '<br /><i class="fa fa-star text-warning"></i> ' + item.rating + ' | Terlayani: ' + item.terjual + '</div>';
        penyedia_layanan += '<div class="mb-3"><p class="h6 lead">Catatan</p>' + (item.ketr ?? '-') + '</div>';

        $(this).find('.modal-body .penyedia_layanan').html(penyedia_layanan);

        // kode
        $(this).find('.modal-body input[name="kode"]').val(item.kode);
        $(this).find('.modal-body input[name="item"]').val(JSON.stringify(item));

        // form jenis transmisi dan warna
        $(this).find('.modal-body input#jenis_transmisi').val(item.transmisi);
        $(this).find('.modal-body input#warna').val(item.warna);

        // total
        const formatRupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(item.hrg_sewa).replace('Rp', 'Rp ');
        
        $(this).find('.modal-footer p#total').text(formatRupiah);

        if(item.path_foto.length > 0){
            $('#path_foto').attr('src', baseUrlImg + item.path_foto);
        }
        if(item.path_foto2){
            $('#path_foto2').attr('src', baseUrlImg + item.path_foto2);
        }
        if(item.path_foto3){
            $('#path_foto3').attr('src', baseUrlImg + item.path_foto3);
        }
        if(item.path_foto4){
            $('#path_foto4').attr('src', baseUrlImg + item.path_foto4);
        }
    });

    // formSearchOrder
    $('.btnSubmit').on('click', function(e) {
      e.preventDefault();

      const form = $('#formSearchOrder')[0];
      form.classList.remove('was-validated');

      // Validate the form
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');

      // get data-item
      var item = JSON.parse(form.item.value);
      console.log(item, '117_item');

      // if pass validation
      if(form.checkValidity()){
        $.ajax({
          url: '<?= base_url('order/select-order') ?>',
          type: 'POST',
          data: $('#formSearchOrder').serialize(),
          success: function(response) {
            console.log(response, 'response');
            const parseResponse = JSON.parse(response);
            console.log(parseResponse.jenis_pembayaran, '_jenis_pembayaran');

            var html = '<div class="table-responsive">';
            html += '<table class="table table-bordered">';
            html += '<tbody>';
            html += '<tr><th width="150">Tgl.Mulai</th><td>' + item.tgl_start + '</td></tr>';
            html += '<tr><th>Tgl.Selesai</th><td>' + item.tgl_finish + '</td></tr>';
            html += '<tr><th>Tujuan</th><td>' + item.lokasi_tujuan + '</td></tr>';
            html += '<tr><th>Unit</th><td>' + item.nama + '</td></tr>';
            html += '<tr><th>Tahun</th><td>' + item.tahun + '</td></tr>';
            html += '<tr><th>BBM</th><td>' + item.bbm + '</td></tr>';
            html += '<tr><th>Transmisi</th><td>' + (parseResponse.jenis_transmisi) + '</td></tr>';
            html += '<tr><th>Warna</th><td>' + (parseResponse.warna) + '</td></tr>';
            html += '<tr><th>Jml.Order</th><td>' + (parseResponse.jumlah) + '</td></tr>';
            html += '<tr><th>Include</th><td>' + (parseResponse.include ?? '-') + '</td></tr>';
            html += '<tr><th>Biaya</th><td>Rp. ' + numberFormat(item.hrg_sewa) + '</td></tr>';
            html += '<tr><th>Pembayaran</th><td>' + (parseResponse.jenis_pembayaran == '1' ? 'Tunai' : 'Mundur') + '</td></tr>';
            html += '<tr><th>Catatan</th><td>' + (parseResponse.catatan ?? '-') + '</td></tr>';
            html += '<tr><th>Voucher</th><td>' + (parseResponse.voucher ?? '-') + '</td></tr>';
            html += '</tbody>';
            html += '</table>';
            html += '</div>';

            // append form hidden
            const newForm = document.createElement('form'); // Create a new form
            newForm.method = 'POST';
            newForm.action = '<?= base_url('order/select-order') ?>';
            
            newForm.innerHTML = '<input type="hidden" name="item" value="' + JSON.stringify(parseResponse) + '">'; // Add the hidden input
            // $('#formSearchOrder').append(newForm);
            
            $('#confirmModal .modal-body').html(html).append(newForm);
            $('#confirmModal').modal('show');
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data order');
          }
        });        
      }
    });

    // Helper function for number formatting
    function numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(number);
    }
  });
</script>
<?= $this->endSection() ?>