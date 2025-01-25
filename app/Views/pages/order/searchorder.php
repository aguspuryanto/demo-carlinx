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
    //   $('#exampleModal').find('.modal-body').html(e.relatedTarget.dataset.item);
                
        // get data-item
        var item = JSON.parse(e.relatedTarget.dataset.item);
        console.log(item, 'item');
        
        if(item.path_foto.length > 0){
            $('#path_foto').attr('src', baseUrlImg + item.path_foto);
        }
    });
  });
</script>
<?= $this->endSection() ?>