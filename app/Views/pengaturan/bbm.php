<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <?php include_once '_alert.php'; ?>
                
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left"><?= $title ?></h4>
                    <div class="card-header-action float-right">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group">
                        <?php foreach ($listData as $item) : ?>
                        <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-id="<?= $item['id'] ?>" data-bs-toggle="modal" data-bs-target="#addModal" data-descr="<?= $item['descr'] ?>" data-harga="<?= $item['harga'] ?>">
                                <h5 class="mb-1"><?= $item['descr'] ?></h5> 
                                <p class="mb-0">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_bbm.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#addModal').on('show.bs.modal', function (e) {
            console.log(e.relatedTarget.dataset.id);
            if(e.relatedTarget.dataset.id){
                // edit header modal
                $('#addModalLabel').text('Edit BBM');

                // fill form modal
                $('#nm_bbm').val(e.relatedTarget.dataset.descr);
                $('#hrg_bbm').val(e.relatedTarget.dataset.harga);
                
                // append id into form class modal-body
                // if name id is exist, then set value id
                if($('.modal-body input[name="id"]').length > 0){
                    $('.modal-body input[name="id"]').val(e.relatedTarget.dataset.id);
                } else {
                    $('.modal-body').append('<input type="hidden" name="id" value="' + e.relatedTarget.dataset.id + '">');
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
