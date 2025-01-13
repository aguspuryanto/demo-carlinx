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
                        <!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Tambah</a> -->
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                    //include_once '_form.php';
                    // echo json_encode($listData);
                    ?>
                    <ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
                        <?php foreach ($listData['result_wilayah'] as $item) : ?>
                        <li class="list-group-item">
                            <a href="#" class="list-group-item-action" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?= $item['id'] ?>" data-item="<?= esc(json_encode($item)) ?>">
                                <p class="mb-0">Dalam Kota <?= ($item['dlm_kota']) ?> Km</p>
                                <p class="mb-0">Luar Kota <?= ($item['dlm_prop']) ?> Km</p>
                                <p class="mb-0">Luar Batas <?= ($item['luar_batas']) ?> Km</p>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="d-none table-responsive d-sm-none d-md-none d-lg-block d-xl-block mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Dalam Kota</th>
                                <th scope="col">Luar Kota</th>
                                <th scope="col">Luar Batas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listData['result_wilayah'] as $item) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= ($item['dlm_kota']) ?> KM</td>
                                    <td><?= ($item['dlm_prop']) ?> KM</td>
                                    <td><?= ($item['luar_batas']) ?> KM</td>
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
     
    <?php include_once '_modal_wilayah.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        const dataObj = <?= json_encode($listData['result_wilayah']) ?>;
        // console.log(dataObj);
        
        $('#addModal').on('show.bs.modal', function (event) {
            console.log(event.relatedTarget.dataset.id);

            if(event.relatedTarget.dataset.id){
                // edit header modal
                $('#addModalLabel').text('Edit Batas Wilayah');
                
                // get data-item
                var item = JSON.parse(event.relatedTarget.dataset.item);
                // console.log(item);

                $('#dlm_kota').val(item.dlm_kota);
                $('#dlm_prop').val(item.dlm_prop);
                // $('#luar_batas').val(item.luar_batas);
                $('#batas_1').val(item.batas_1);
                $('#batas_2').val(item.batas_2);
                $('#batas_3').val(item.batas_3);
                $('#batas_4').val(item.batas_4);
                $('#batas_5').val(item.batas_5);
                $('#batas_6').val(item.batas_6);

                $('#hari_1').val(item.hari_1);
                $('#hari_2').val(item.hari_2);
                $('#hari_3').val(item.hari_3);
                $('#hari_4').val(item.hari_4);
                $('#hari_5').val(item.hari_5);
                $('#hari_6').val(item.hari_6);

                $('#ketr').val(item.ketr);

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