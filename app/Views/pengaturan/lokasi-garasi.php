<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <?php include_once '_alert.php'; ?>
        
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-flex justify-content-between"><?= $title ?>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus"></i> Tambah</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php 
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group">
                        <?php foreach ($listData['result_garasi'] as $item) : ?>                 
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $item['nama'] ?>
                            <span class="remove-item" data-site="<?= $item['kd_site'] ?>" data-kota="<?= $item['kode'] ?>"><i class="bi bi-trash"></i></span>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_garasi.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.remove-item').click(function() {
            var kd_site = $(this).data('site');
            var kd_kota = $(this).data('kota');

            let result = confirm('Apakah anda yakin ingin menghapus data ini?');
            if (result) {
                // Lakukan tindakan sesuai dengan hasil konfirmasi
                $.ajax({
                    url: '<?= base_url('pengaturan/delete-garasi') ?>',
                    type: 'POST',
                    data: {
                        kd_site: kd_site,
                        kd_kota: kd_kota
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    }
                });                   
            }
        });
    });
</script>
<?= $this->endSection() ?>