<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card p-0">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <?php include_once '_form.php'; ?>
                </div>
            </div>
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
    // Initialize the platform object:
    const platform = new H.service.Platform({
      apikey: "<?= $_ENV['API_KEY_HERE'] ?>"
    });

    const listKota = '<?= json_encode($listKota) ?>';
    let today = new Date(); // - 1 day
    today.setDate(today.getDate() - 1);

    $('#kotaTujuan').select2({
      theme: 'bootstrap-5',
      placeholder: 'Type to search...',
      minimumInputLength: 2,
      data: listKota
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
      const lokasiJemput = $('#lokasiJemput').val();
      const lokasiTujuan = $('#lokasiTujuan').val();
      // append to div#lokasiJemputList
      // if(lokasiJemput != '') {
      //   $('#lokasiJemputList').html('<ul class="list-group"></ul>');
      //   $('#lokasiJemputList ul').html('<li class="list-group-item">' + lokasiJemput.substr(lokasiJemput.lastIndexOf(",") + 1) + '</li>');
      // }
      // if(lokasiTujuan != '') {
      //   $('#lokasiTujuanList').html('<ul class="list-group"></ul>');
      //   $('#lokasiTujuanList ul').html('<li class="list-group-item">' + lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1) + '</li>');
      // }

      // if(lokasiJemput=='') return false;

      // if(lokasiJemput != '' && lokasiTujuan != '' && lokasiTujuan.length > 0) {
      //   $('#ruteList ul').append('<li class="list-group-item">' + lokasiJemput.substr(lokasiJemput.lastIndexOf(",") + 1) + ' - ' + lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1) + '</li>');
      //   $('#ruteList').parent().removeClass('d-none');
      // }
    });

    // Event handler untuk tombol Tambah Rute
    $('#addRute').on('click', function() {
      // Ambil nilai saat ini dari lokasiJemput dan lokasiTujuan
      const lokasiJemput = $('#lokasiJemput').val();
      const lokasiTujuan = $('#lokasiTujuan').val();
      console.log('lokasiJemput:' + lokasiJemput + '; lokasiTujuan:' + lokasiTujuan);

      // Tukar nilai antara lokasiJemput dan lokasiTujuan
      $('#lokasiJemput').val(lokasiTujuan).trigger('change.select2');
      $('#lokasiTujuan').val(lokasiJemput).trigger('change.select2');
    });

    // Event listener untuk tombol Tambah Rute
    $('#tambahRute').click(function() {
        let lokasiJemput = $('#lokasiJemput').val();
        let lokasiTujuan = $('#lokasiTujuan').val();

        // Validasi input
        if (lokasiJemput === lokasiTujuan) {
            alert('Lokasi Jemput dan Tujuan tidak boleh sama.');
            return;
        }

        // Format rute
        if(lokasiJemput!='') {
          lokasiJemput = lokasiJemput.substr(lokasiJemput.lastIndexOf(",") + 1);          
        }
        if(lokasiTujuan!='') {
          lokasiTujuan = lokasiTujuan.substr(lokasiTujuan.lastIndexOf(",") + 1);          
        }
        const rute = `${lokasiJemput} - ${lokasiTujuan}`;

        // Cek apakah rute sudah ada di daftar
        let ruteSudahAda = false;
        $('#listRute li').each(function() {
            if ($(this).text() === rute) {
                ruteSudahAda = true;
                return false; // Hentikan iterasi
            }
        });

        if (ruteSudahAda) {
            alert('Rute sudah ada di daftar.');
        } else {
            // Tambahkan rute ke daftar
            $('#listRute').append(`<li class="list-group-item">${rute}</li>`);

            // hitung jarak
            hitungJarak(lokasiJemput, lokasiTujuan).then(jarak => {
                console.log(jarak, '182_jarak');
                $('#jarak').val(jarak / 1000); // Convert to kilometers
            });
        }
    });

    // Event listener untuk tombol Switch
    $('#switchButton').click(function() {
        // Simpan nilai lokasiJemput ke variabel sementara
        const temp = $('#lokasiJemput').val();

        // Debug untuk memastikan nilai awal
        console.log('Before Switch:');
        console.log('lokasiJemput:', temp);
        console.log('lokasiTujuan:', $('#lokasiTujuan').val());

        // Tukar nilai lokasi
        $('#lokasiJemput').val($('#lokasiTujuan').val()).trigger('change.select2');
        $('#lokasiTujuan').val(temp).trigger('change.select2');

        // Debug untuk memastikan nilai setelah switch
        console.log('After Switch:');
        console.log('lokasiJemput:', $('#lokasiJemput').val());
        console.log('lokasiTujuan:', $('#lokasiTujuan').val());
    });

    // $('#lokasiTujuan').on('change', async function() {
    //     const origin = $('#lokasiJemput').val();
    //     const destination = $('#lokasiTujuan').val();
    //     let totJarak = 0;
        
    //     hitungJarak(origin, destination).then(jarak => {
    //         totJarak += jarak;
    //         console.log(totJarak, 'jarak');
    //         $('#jarak').val(totJarak / 1000); // Convert to kilometers
    //     });
    // });

    // formSearchOrder
    $('#formSearchOrder').on('submit', function(e) {
      e.preventDefault();
      
      // Define validation rules
      const validationRules = [
        {
          field: 'kotaTujuan',
          message: 'Kota Tujuan harus dipilih'
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
        },
        {
          field: 'is_bbm',
          message: 'Is BBm harus dipilih'
        }
      ];

      // Validate all fields
      let isValid = true;
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

      // If validation passes, submit the form
      if (isValid) {
        const origin = $('#lokasiJemput').val();
        const destination = $('#lokasiTujuan').val();
        let totJarak = 0;
        
        hitungJarak(origin, destination).then(jarak => {
            totJarak += jarak;
            console.log(totJarak, '276_jarak');
            $('#jarak').val(totJarak / 1000); // Convert to kilometers
        });

        this.submit();
      }
    });

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
                listRute.push($(this).text());
            });
            console.log(listRute, 'listRute');
            // console.log(listRute.length, 'listRute.length');

            // Calculate route 1 way
            const routeResponse = await fetch(`https://router.hereapi.com/v8/routes?transportMode=car&origin=${originCoords}&destination=${destCoords}&return=summary&apikey=<?= $_ENV['API_KEY_HERE'] ?>`);
            const routeData = await routeResponse.json();

            // const distance = routeData.routes[0].sections[0].summary.length;
            totJarak += routeData.routes[0].sections[0].summary.length;

            // Calculate route 2 way
            const routeResponse2 = await fetch(`https://router.hereapi.com/v8/routes?transportMode=car&origin=${destCoords}&destination=${originCoords}&return=summary&apikey=<?= $_ENV['API_KEY_HERE'] ?>`);
            const routeData2 = await routeResponse2.json();

            // const distance = routeData.routes[0].sections[0].summary.length;
            totJarak += routeData2.routes[0].sections[0].summary.length;

            return totJarak;
            
        } catch (error) {
            console.error('Error calculating route:', error);
        }
    }

  });
</script>
<?= $this->endSection() ?>