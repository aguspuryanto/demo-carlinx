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
                    echo json_encode($listData['result_unit']);
                    ?>
                    <ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
                        <?php foreach ($listData['result_unit'] as $item) : ?>
                        <li class="list-group-item">
                            <a href="#" class="list-group-item d-flex justify-content-start align-items-center" data-id="<?= $item['kode'] ?>" data-item="<?= esc(json_encode($item)) ?>" data-bs-toggle="modal" data-bs-target="#addModal">
                                <img class="avatar avatar-lg" src="<?= $_ENV['API_BASEURL'] . 'images/' . $item['path_foto'] ?>" style="width: 64px; height: 64px;" />
                                <div class="ms-3">
                                    <!-- <h5 class="mb-1"><?= $item['nama'] ?></h5> -->
                                    <p class="fw-bold mb-0"><?= $item['nama'] ?></p>
                                    <p class="text-muted mb-0 fs-sm">Dalam Kota Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></p>
                                    <p class="text-muted mb-0 fs-sm">Luar Kota Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></p>
                                    <p class="text-muted mb-0 fs-sm">Luar Batas Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></p>
                                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listData['result_unit'] as $item) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $item['nama'] ?></td>
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
     
    <?php include_once '_modal_unit_form.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#addModal').on('show.bs.modal', function (event) {
            console.log(event.relatedTarget.dataset.id);

            if(event.relatedTarget.dataset.id){
                // edit header modal
                $('#addModalLabel').text('Edit Unit');
                
                // get data-item
                var item = JSON.parse(event.relatedTarget.dataset.item);
                console.log(item, 'item');

                // set value into form
                $('#nama').val(item.nama);
                $('#dlm_kota').val(item.dlm_kota);
                $('#dlm_prop').val(item.dlm_prop);
                $('#luar_prop').val(item.luar_prop);
                // $('#makan').val(item.makan);
                // $('#hotel').val(item.hotel);
                // $('#fee').val(item.fee);

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