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
                    // echo json_encode($listData['result_driver']);
                    ?>
                    <ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
                        <?php foreach ($listData['result_driver'] as $item) : ?>
                        <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <h5 class="mb-1"><?= $item['nm_kat'] ?></h5>
                                <p class="mb-0">Dalam Kota Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></p>
                                <p class="mb-0">Luar Kota Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></p>
                                <p class="mb-0">Luar Batas Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></p>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="d-none table-responsive d-sm-none d-md-none d-lg-block d-xl-block mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Dalam Kota</th>
                                <th scope="col">Luar Kota</th>
                                <th scope="col">Luar Batas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listData['result_driver'] as $item) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $item['nm_kat'] ?></td>
                                    <td>Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $item['id'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_driver.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#addModal').on('show.bs.modal', function (event) {
            console.log(event.relatedTarget.dataset.id);

            if(event.relatedTarget.dataset.id){
                // edit header modal
                $('#addModalLabel').text('Edit Driver');
                
                // get data-item
                var item = JSON.parse(event.relatedTarget.dataset.item);
                console.log(item, 'item');

                // fix: use kdKat instead of kd_kat to match HTML data-kd-kat attribute
                const kdKat = item.kd_kat;
                const kdKatClean = kdKat ? kdKat.replace('22040001', '') : '';
                $('#kd_kat').val(kdKatClean);
                $('#dlm_kota').val(item.dlm_kota);
                $('#dlm_prop').val(item.dlm_prop);
                $('#luar_prop').val(item.luar_prop);
                $('#makan').val(item.makan);
                $('#hotel').val(item.hotel);
                $('#fee').val(item.fee);

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

        $('.btn-delete').on('click', function(event){
            event.preventDefault();
            console.log($(this).data('id'));
        });
    });
</script>
<?= $this->endSection() ?>