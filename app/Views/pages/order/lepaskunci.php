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
                    <?php include_once '_form_lepaskunci.php'; ?>
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
    var listKota = '<?= json_encode($listKota) ?>';
    var today = new Date(); // - 1 day
    // today.setDate(today.getDate() - 1);

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
        this.submit();
      }
    });

  });
</script>
<?= $this->endSection() ?>