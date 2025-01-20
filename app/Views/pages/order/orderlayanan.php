<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card">
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
    // $('#unitName').select2();
    var listKota = '<?= json_encode($listKota) ?>';
    var today = new Date(); // - 1 day
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

    // $('#lokasiJemput').on('change', function() {
    //   console.log($('#lokasiJemput').val());
    // });

    $('#lokasiTujuan').on('change', function() {
        // console.log($('#lokasiTujuan').val());
        var origin = $('#lokasiJemput').val();
        var destination = $('#lokasiTujuan').val();
        console.log(origin, destination);

        // $.ajax({
        //     url: '<?= $_ENV['API_BASEURL_HERE'] ?>/routes',
        //     type: 'GET',
        //     data: {
        //         transportMode: 'car',
        //         origin: origin,
        //         destination: destination,
        //         return: 'summary',
        //         apiKey: '<?= $_ENV['API_KEY_HERE'] ?>'
        //     },
        //     success: function(response) {
        //         console.log(response);
        //     }
        // });
    });

    // https://route.ls.hereapi.com/routing/7.2/calculateroute.xml
    // ?apiKey={YOUR_API_KEY}
    // &waypoint0=geo!52.5,13.4
    // &waypoint1=geo!52.5,13.45
    // &mode=fastest;car;traffic:disabled
    // curl -X GET 'https://router.hereapi.com/v8/routes?transportMode=car&origin=52.5308,13.3847&destination=52.5323,13.3789&return=summary&apikey={YOUR_API_KEY}'
  });
</script>
<?= $this->endSection() ?>