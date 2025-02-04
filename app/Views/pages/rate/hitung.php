<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card mb-3">
                <div class="card-header">
                    <h4><?= $title ?></h4>
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
    
    let lokasiJemputArr = [];
    let lokasiTujuanArr = [];

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

    var listTujuan = [];
    // Initialize Select2
    $('#lokasiJemput, #lokasiTujuan').select2({
        theme: 'bootstrap-5',
        placeholder: 'Type to search...',
        minimumInputLength: 3,
        ajax: {
          url: '<?= $_ENV['API_BASEURL_HERE'] ?>/autocomplete',
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // Search term
              limit: 5,      // Limit results
              in: 'countryCode:IDN',
              apiKey: '<?= $_ENV['API_KEY_HERE'] ?>'
            };
          },
          processResults: function (data) {
            console.log(data.items);
            listTujuan = data.items.map(item => ({
              id: item.title,
              text: item.title.substr(item.title.lastIndexOf(",") + 1)
            }));

            return {
              more: false,
              results: listTujuan
            };
          },
          cache: true
        }, 
        onSelect: function(e) {
          // console.log(e);
          var data = e.params.data;
          console.log(data);
        }, 
        data: listTujuan
    }).on('change', function() {
      // console.log($('#lokasiJemput').val());
    });

    // Event listener untuk tombol Tambah Rute
    $('#tambahRute').click(function() {
      tambahRute();
    });

    // Event listener untuk tombol Switch
    $('#switchButton').click(function() {
        // Simpan nilai lokasi ke variabel sementara
        const tempLocJemput = $('#lokasiJemput').val();
        const tempLocTujuan = $('#lokasiTujuan').val();
        console.log('tempLocJemput:' + tempLocJemput + ', tempLocTujuan:' + tempLocTujuan);

        // Pastikan kedua lokasi telah dipilih
        if (!tempLocJemput || !tempLocTujuan) {
            alert('Silakan pilih lokasi jemput dan tujuan terlebih dahulu');
            return;
        }

        // Tukar nilai lokasi
        $('#lokasiJemput').select2("trigger", "select", {
          data: { id: tempLocTujuan, text: tempLocTujuan.substr(tempLocTujuan.lastIndexOf(",") + 1) }
        });

        $('#lokasiTujuan').select2("trigger", "select", {
          data: { id: tempLocJemput, text: tempLocJemput.substr(tempLocJemput.lastIndexOf(",") + 1) }
        });
    });

    $('#dalamKota').on('change', function() {
      if($(this).is(':checked')) {
        $('#lokasiJemput, #lokasiTujuan').val('').trigger('change.select2');
        $('#lokasiJemput, #lokasiTujuan').attr('disabled', true);
      } else {
        $('#lokasiJemput, #lokasiTujuan').attr('disabled', false);
      }
    });

    $('#lokasiTujuan').on('change', async function() {
      tambahRute();
    });

    $('#btnHitung').on('click', function (e) {
      e.preventDefault();
      var form = $('#formHitung')[0];
      var data = new FormData(form);
      
      // Define validation rules
      const validationRules = [
        {
          field: 'unitName',
          message: 'Unit harus dipilih'
        },
        {
          field: 'pickupDate',
          message: 'Tanggal/Jam Sewa harus dipilih'
        },
        {
          field: 'returnDate',
          message: 'Tanggal/Jam Sewa harus dipilih'
        },
        {
          field: 'lokasiJemput',
          message: 'Lokasi Jemput harus dipilih'
        },
        {
          field: 'lokasiTujuan',
          message: 'Lokasi Tujuan harus dipilih'
        }
      ];

      // Validate all fields
      let isValid = true;
      // Skip validation if dalamKota is checked
      if ($('#dalamKota').is(':checked')) {
        isValid = true;
      } else {
        for (const rule of validationRules) {
          if ($(`#${rule.field}`).val() === '') {
            if($(`#${rule.field}`).parent().hasClass('invalid-feedback')) {
              $(`#${rule.field}`).parent().removeClass('invalid-feedback');
            } else {
              $(`#${rule.field}`).parent().append('<div class="invalid-feedback">' + rule.message + '</div>');
            }
            $(`#${rule.field}`).addClass('is-invalid');
            isValid = false;
          } else {
            $(`#${rule.field}`).removeClass('is-invalid');
          }
        }
      }

      if(isValid) {
        $.ajax({
          url: 'rate/hitung',
          type: 'POST',
          data: data,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (response) {
            // console.log(response.result_unit_order[0], 'response');
            if (response.success && response.result_unit_order && response.result_unit_order.length > 0) {
              const result = response.result_unit_order[0];
              $('#totalCost').val(convertRupiah(result.total_hrg_sewa));

              // Set tujuan text only if both locations are available
              let lokasi_jemput = result.lokasi_jemput;
              let lokasi_tujuan = result.lokasi_tujuan;
              if (lokasi_jemput && lokasi_tujuan) {
                lokasi_jemput = lokasi_jemput.substr(lokasi_jemput.lastIndexOf(",") + 1);
                lokasi_tujuan = lokasi_tujuan.substr(lokasi_tujuan.lastIndexOf(",") + 1);
                $('#tujuan').text(lokasi_jemput + ' - ' + lokasi_tujuan);
              }

              $('#tanggal').text(result.tgl_start + ' s/d ' + result.tgl_finish); // 20-01-2025 06:00 s/d 20-01-2025 23:59
              $('#namaUnit').text(result.nama); // AVANZA 2017 (TES)
              $('#include').text(result.include); // Mobil, Driver, BBM
              $('#totalBiaya').text(convertRupiah(result.total_hrg_sewa)); // 2375000

              // set data pelanggan
              $('#formSendWhatsapp').find('#tgl_start').val(result.tgl_start);
              let jam_start = getHourAndMinute(result.tgl_start);
              $('#jam_start').val(jam_start);

              $('#formSendWhatsapp').find('#tgl_finish').val(result.tgl_finish);
              let jam_finish = getHourAndMinute(result.tgl_finish);
              $('#jam_finish').val(jam_finish);

              $('#formSendWhatsapp').find('#lokasi_jemput').val(lokasi_jemput);
              $('#formSendWhatsapp').find('#lokasi_tujuan').val(lokasi_tujuan);
              $('#formSendWhatsapp').find('#nama_unit').val(result.nama);
              $('#formSendWhatsapp').find('#include').val(result.include);
              $('#formSendWhatsapp').find('#total_hrg_sewa').val(result.total_hrg_sewa);
              // $('#formSendWhatsapp').find('#nama_pelanggan').val(result.nama_pelanggan);
              $('#formSendWhatsapp').find('#no_hp').attr('placeholder', '+62');

              // hide #btnHItung
              // $('#btnHitung').attr('disabled', true);
              // show #btnKonfirm
              $('#cardKonfirm, #cardPelanggan').show().removeClass('d-none');
              scrollTo($('#cardKonfirm').offset().top, 500);
            } else {
              console.error("Data tidak ditemukan atau tidak valid.");
            }
          },
          error: function (xhr, status, error) {
            console.error(error);
          }
        });
      }
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

      // check country code
      if(!$('#no_hp').val().startsWith('+62')) {
        alert('Mohon isi no hp dengan benar');
        return;
      }

      // check phone number
      if($('#no_hp').val().length < 10) {
        alert('Mohon isi no hp dengan benar');
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

    function tambahRute() {
      let lokasiJemput = $('#lokasiJemput').val();
      let lokasiTujuan = $('#lokasiTujuan').val();

      // Validasi input, tidak boleh kosong
      if (lokasiJemput=='' || lokasiTujuan=='') {
          alert('Lokasi Jemput dan Tujuan tidak boleh kosong.');
          return;
      }

      // if not exists, then push to lokasiJemputArr
      if(!lokasiJemputArr.includes(lokasiJemput)) {
        lokasiJemputArr.push(lokasiJemput);
      }
      console.log(lokasiJemputArr, 'lokasiJemputArr');

      // if not exists, then push to lokasiTujuanArr
      if(!lokasiTujuanArr.includes(lokasiTujuan)) {
        lokasiTujuanArr.push(lokasiTujuan);
      }
      console.log(lokasiTujuanArr, 'lokasiTujuanArr');
      
      const rute = `${lokasiJemput.substr(lokasiJemput.lastIndexOf(",") + 1)} - ${lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1)}`;

      // Cek apakah rute sudah ada di daftar
      let ruteSudahAda = false;
      $('#listRute li').each(function() {
          if ($(this).text() === rute) {
              ruteSudahAda = true;
              return false; // Hentikan iterasi
          }
      });

      if (ruteSudahAda) {
          console.log('Rute sudah ada di daftar.');
          // set lokasi jemput with tujuan
          $('#lokasiJemput').select2("trigger", "select", {
            data: { id: lokasiTujuan, text: lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1) }
          });
          // reset lokasi tujuan
          $('#lokasiTujuan').select2("trigger", "select", {
            data: { id: '', text: '' }
          });
      } else {
          if(lokasiJemput=='' || lokasiTujuan=='') return false;

          // Tambahkan rute ke daftar
          $('#listRute').append(`<li class="list-group-item">${rute}</li>`);

          // hitung jarak
          hitungJarak(lokasiJemput, lokasiTujuan).then(jarak => {
              console.log(jarak, '182_jarak');
              $('#jarak').val(jarak / 1000); // Convert to kilometers
          });
      }
    }

    async function hitungJarak(origin, destination) {
        let totJarak = 0;
        
        if (!origin || !destination) return;

        try {
            // Get coordinates for origin
            const originResponse = await fetch(`https://geocode.search.hereapi.com/v1/geocode?q=${encodeURIComponent(origin)}&apiKey=<?= $_ENV['API_KEY_HERE'] ?>`);
            const originData = await originResponse.json();
            
            // Get coordinates for destination
            const destResponse = await fetch(`https://geocode.search.hereapi.com/v1/geocode?q=${encodeURIComponent(destination)}&apiKey=<?= $_ENV['API_KEY_HERE'] ?>`);
            const destData = await destResponse.json();

            if (!originData.items.length || !destData.items.length) {
                console.error('Location not found');
                return;
            }

            const originCoords = `${originData.items[0].position.lat},${originData.items[0].position.lng}`;
            const destCoords = `${destData.items[0].position.lat},${destData.items[0].position.lng}`;

            // cek listRute
            let listRute = [];
            $('#listRute li').each(function() {
                listRute.push($(this).text().trim());
            });
            console.log(listRute, 'listRute');
            console.log(listRute.length, 'jumlah listRute');
            
            // Calculate route 1 way
            const routeResponse = await fetch(`https://router.hereapi.com/v8/routes?transportMode=car&origin=${originCoords}&destination=${destCoords}&return=summary&apikey=<?= $_ENV['API_KEY_HERE'] ?>`);
            const routeData = await routeResponse.json();

            // const distance = routeData.routes[0].sections[0].summary.length;
            totJarak += routeData.routes[0].sections[0].summary.length;

            if(listRute.length == 1) {
                // Calculate route 2 way
                const routeResponse2 = await fetch(`https://router.hereapi.com/v8/routes?transportMode=car&origin=${destCoords}&destination=${originCoords}&return=summary&apikey=<?= $_ENV['API_KEY_HERE'] ?>`);
                const routeData2 = await routeResponse2.json();

                const distance = routeData.routes[0].sections[0].summary.length;
                totJarak += routeData2.routes[0].sections[0].summary.length;
            } else if(listRute.length > 1) {
              // lokasiJemputArr = ['Indonesia, 60261, Surabaya', 'Indonesia, 65119, Malang Kota', 'Indonesia, 64126, Kediri Kota']
              // remove firt element
              lokasiJemputArr.shift();

              // re-calculate
              for (let i = 0; i < lokasiJemputArr.length; i++) {
                const origin = lokasiJemputArr[i];
                const destination = lokasiTujuanArr[i];
                console.log('origin:' + origin + ', destination:' + destination);

                // Calculate route 2 way
                // const routeResponse2 = await fetch(`https://router.hereapi.com/v8/routes?transportMode=car&origin=${destination}&destination=${origin}&return=summary&apikey=<?= $_ENV['API_KEY_HERE'] ?>`);
                // const routeData2 = await routeResponse2.json();

                // const distance = routeData.routes[0].sections[0].summary.length;
                // totJarak += routeData2.routes[0].sections[0].summary.length;
              }
            }

            let roundedDown = Math.round(parseFloat(totJarak));
            return roundedDown; // return in kilometers
            
        } catch (error) {
            console.error('Error calculating route:', error);
        }
    }

    function getHourAndMinute(dateString) {
      // Konversi string ke objek Date
      let dateObj = new Date(dateString);

      // Ambil jam dan menit
      let hours = dateObj.getHours();
      let minutes = dateObj.getMinutes();

      return { hours, minutes };
    }
  });
</script>
<?= $this->endSection() ?>