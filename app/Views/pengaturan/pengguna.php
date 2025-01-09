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
                    echo json_encode($listData['result']);
                    ?>
                    <ul class="list-group">
                        <?php foreach ($listData['result'] as $item) : ?>                 
                        <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-target="#addModal" data-bs-toggle="modal" data-id="<?= $item['kode'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <div class="fw-bold mb-0"><?= $item['nama'] ?></div>
                                <?= $item['username'] ?>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_pengguna.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#addModal').on('show.bs.modal', function (event) {
            console.log(event.relatedTarget.dataset.id);

            if(event.relatedTarget.dataset.id){
                // edit header modal
                $('#addModalLabel').text('Edit Pengguna');
                
                // get data-item
                var item = JSON.parse(event.relatedTarget.dataset.item);
                console.log(item, 'item');

                // set data-item
                $('#addModal').find('#nama').val(item.nama);
                $('#addModal').find('#nohp').val(item.username);

                // set stat
                $('#addModal').find('#stat').val(item.stat);

                // append id into form class modal-body
                // if name id is exist, then set value id
                if($('.modal-body input[name="id"]').length > 0){
                    $('.modal-body input[name="id"]').val(event.relatedTarget.dataset.id);
                } else {
                    // append id into form class modal-body
                    $('.modal-body').append('<input type="hidden" name="id" value="' + event.relatedTarget.dataset.id + '">');
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>