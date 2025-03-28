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
    const jns_order = '<?= $jns_order ?>';
    let payment_type = {
        1: 'Lunas',      // Full payment
        2: 'Uang Muka', // Down payment
        3: 'Mundur'    // Deferred payment
    };
    // payment_type[1]

    $('#exampleModal').on('show.bs.modal', function (e) {
        // console.log(e.relatedTarget.dataset.item);                
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
        const totalhrgsewa = item.total_hrg_sewa; //jns_order == '2' ? item.hrg_sewa : item.total_hrg_sewa;
        const formatRupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(totalhrgsewa).replace('Rp', 'Rp ');
        
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

    function incrementValue(e) {
        e.preventDefault();
        var currentVal = parseInt($('#jumlah').val(), 10);
        if (!isNaN(currentVal)) {
            $('#jumlah').val(currentVal + 1);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var currentVal = parseInt($('#jumlah').val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $('#jumlah').val(currentVal - 1);
        }
    }

    $('.input-group').on('click', '.button-plus', function(e) {
        e.preventDefault();
        console.log('plus');
        incrementValue(e);

        // clone <li class="list-group-item">
        const listGroup = document.querySelector("#data_pemesanan");
        const lastItem = listGroup.lastElementChild;
        // console.log(lastItem, '124_lastItem');
        if (lastItem) {
            const newItem = lastItem.cloneNode(true);
            listGroup.appendChild(newItem);
        }
    });

    $('.input-group').on('click', '.button-minus', function(e) {
        e.preventDefault();
        console.log('minus');
        decrementValue(e);

        // remove <li class="list-group-item">
        const listGroup = document.querySelector("#data_pemesanan");
        const lastItem = listGroup.lastElementChild;
        // console.log(lastItem, '139_lastItem');
        // Only remove if there's more than one item in the list
        if (lastItem && listGroup.children.length > 1) {
            listGroup.removeChild(lastItem);
        }
    });

    // jenis_pembayaran
    $('input[name="jenis_pembayaran"]').on('change', function() {
        const jenis_pembayaran = $(this).val();
        console.log(jenis_pembayaran, 'jenis_pembayaran');
        if(jenis_pembayaran == '3'){
            $('#tempobayar').removeClass('d-none');
            $('input[name="tempo_bayar"]').val('7');
        } else {
            $('#tempobayar').addClass('d-none');
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

      let listInclude = 'Mobil, Driver';

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

            if(item.is_bbm == '1') listInclude += ', BBM';
            if(item.is_makan == '1') listInclude += ', Makan Driver';
            if(item.is_hotel == '1') listInclude += ', Hotel';

            if(jns_order == '2'){
                listInclude = 'Mobil Lepas Kunci';
            }

            // text Pembayaran
            if(parseResponse.jenis_pembayaran == '3'){
                textPayment = payment_type[parseResponse.jenis_pembayaran] + ' ' + parseResponse.tempo_bayar + ' hari';
            } else {
                textPayment = payment_type[parseResponse.jenis_pembayaran];
            }

            var html = '<div class="table-responsive mb-3">';
            html += '<table class="table table-sm table-bordered">';
            html += '<tbody>';
            html += '<tr><th width="150">Tgl.Mulai</th><td>' + item.tgl_start + '</td></tr>';
            html += '<tr><th>Tgl.Selesai</th><td>' + item.tgl_finish + '</td></tr>';
            if(jns_order == '4'){
                html += '<tr><th>Jumlah Bulan</th><td>' + (item.jml_bln) + '</td></tr>';
            } else if(jns_order == '2'){
                // html += '<tr><th>Jumlah Bulan</th><td>' + (item.jml_bln) + '</td></tr>';
            } else {                
                lokasi_jemput = item.lokasi_jemput.substr(item.lokasi_jemput.lastIndexOf(",") + 1);
                lokasi_tujuan = item.lokasi_tujuan.substr(item.lokasi_tujuan.lastIndexOf(",") + 1);
                html += '<tr><th>Tujuan</th><td>' + (lokasi_tujuan == '' ? 'Dalam Kota' : lokasi_jemput + ' - ' + lokasi_tujuan) + '</td></tr>';
            }
            html += '<tr><th>Unit</th><td>' + item.nama + '</td></tr>';
            html += '<tr><th>Tahun</th><td>' + item.tahun + '</td></tr>';
            html += '<tr><th>BBM</th><td>' + item.bbm + '</td></tr>';
            html += '<tr><th>Transmisi</th><td>' + (parseResponse.jenis_transmisi) + '</td></tr>';
            html += '<tr><th>Warna</th><td>' + (parseResponse.warna) + '</td></tr>';
            html += '<tr><th>Jml.Order</th><td>' + (parseResponse.jumlah) + '</td></tr>';
            html += '<tr><th>Include</th><td>' + (listInclude) + '</td></tr>';
            html += '<tr><th>Biaya</th><td>Rp. ' + numberFormat(item.total_hrg_sewa) + '</td></tr>';
            html += '<tr><th>Pembayaran</th><td>' + textPayment + '</td></tr>';
            html += '<tr><th>Catatan</th><td>' + (parseResponse.catatan ?? '-') + '</td></tr>';
            html += '<tr><th>Voucher</th><td>' + (parseResponse.voucher ?? '-') + '</td></tr>';
            if (['2', '4'].includes(jns_order)) {
                html += '<tr><th>Penanggung Jawab</th><td>' + (item.tg_jwb == '1' ? 'Rental Pemesan' : 'Pelanggan') + '</td></tr>';
            }
            html += '</tbody>';
            html += '</table>';
            html += '</div>';
            html += '<div class="mb-3"><p class="h6 lead">* Pastikan data order sudah benar</p></div>';

            // append form hidden
            const newForm = document.createElement('form'); // Create a new form
            newForm.method = 'POST';
            newForm.action = '<?= base_url('order/select-order') ?>';
            
            newForm.innerHTML = '<input type="hidden" name="item" value="' + encodeURIComponent(JSON.stringify(parseResponse)) + '">'; // Add the hidden input
            newForm.innerHTML += '<input type="hidden" name="jns_order" value="' + jns_order + '">'; // Add the hidden input
            newForm.innerHTML += '<input type="hidden" name="form_step" value="2">'; // Add the hidden input
            newForm.innerHTML += '<div class="mb-3 align-items-center"><button type="submit" class="btn btn-primary w-100 btnConfirmOrder">Submit</button></div>'; // Add the hidden input
            // $('#formSearchOrder').append(newForm);
            
            $('#confirmModal .modal-body').html(html).append(newForm);
            $('#exampleModal').modal('hide');
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