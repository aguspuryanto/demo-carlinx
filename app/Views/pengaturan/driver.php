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
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id'] ?>" data-kd_kat="<?= $item['kd_kat'] ?>" data-descr="<?= $item['nm_kat'] ?>" data-dlm_kota="<?= $item['dlm_kota'] ?>" data-dlm_prop="<?= $item['dlm_prop'] ?>" data-luar_prop="<?= $item['luar_prop'] ?>" data-makan="<?= $item['makan'] ?>" data-hotel="<?= $item['hotel'] ?>" data-fee="<?= $item['fee'] ?>">
                                <h5 class="mb-1"><?= $item['nm_kat'] ?></h5>
                                <p class="mb-0">Dalam Kota Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></p>
                                <p class="mb-0">Luar Kota Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></p>
                                <p class="mb-0">Luar Batas Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></p>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="table-responsive d-sm-none d-md-none d-lg-block d-xl-block mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Dalam Kota</th>
                                <th scope="col">Luar Kota</th>
                                <th scope="col">Luar Batas</th>
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

                // fix: use kdKat instead of kd_kat to match HTML data-kd-kat attribute
                const kdKat = event.relatedTarget.dataset.kd_kat;
                const kdKatClean = kdKat ? kdKat.replace('22040001', '') : '';
                $('#kd_kat').val(kdKatClean);
                $('#dlm_kota').val(event.relatedTarget.dataset.dlm_kota);
                $('#dlm_prop').val(event.relatedTarget.dataset.dlm_prop);
                $('#luar_prop').val(event.relatedTarget.dataset.luar_prop);
                $('#makan').val(event.relatedTarget.dataset.makan);
                $('#hotel').val(event.relatedTarget.dataset.hotel);
                $('#fee').val(event.relatedTarget.dataset.fee);

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