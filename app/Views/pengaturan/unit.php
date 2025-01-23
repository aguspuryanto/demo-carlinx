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
                    // echo json_encode($listData['result_unit']);
                    // echo json_encode($listPaketBbm['result_bbm']);
                    ?>
                    <ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
                        <?php foreach ($listData['result_unit'] as $item) : ?>
                        <li class="list-group-item">
                            <a href="#" class="list-group-item-action d-flex justify-content-start align-items-center" data-id="<?= $item['kode'] ?>" data-item="<?= esc(json_encode($item)) ?>" data-bs-toggle="modal" data-bs-target="#addModal">
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
                                <th scope="col">Merk/Type</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Dalam Kota</th>
                                <th scope="col">Luar Kota</th>
                                <th scope="col">Luar Batas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listData['result_unit'] as $item) : ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><img class="avatar avatar-lg" src="<?= getImage($_ENV['API_BASEURL'] . 'images/' . $item['path_foto']) ?>" style="width: 64px; height: 64px;" /></td>
                                    <td><?= $item['nama'] ?></td>
                                    <td>Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></td>
                                    <td>Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-id="<?= $item['kode'] ?>" data-item="<?= esc(json_encode($item)) ?>" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $item['kode'] ?>"><i class="fas fa-trash"></i></a>
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
     
    <?php include_once '_modal_unit_form.php'; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        const baseUrlImg = "<?= $_ENV['API_BASEURL'] ?>/images/";
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
                $('#kategori option').filter(function() {
                    return $(this).text() == item.kategori;
                }).prop("selected", true);
                $("#bbm option").filter(function() {
                    return $(this).text() == item.bbm;
                }).prop("selected", true);

                $('#kursi').val(item.kursi);
                $('#tahun').val(item.tahun);
                $('#transmisi').val(item.transmisi);
                $('#warna').val(item.warna);
                $('#jarak_tempuh').val(item.jarak_tempuh);
                $('#dlm_kota').val(item.dlm_kota);
                $('#dlm_prop').val(item.dlm_prop);
                $('#luar_prop').val(item.luar_prop);
                $('#drop_in').val(item.drop_in);
                $('#over_time').val(item.over_time);
                $('#stgh_hr').val(item.stgh_hr);
                $('#fee').val(item.fee);
                $('#lepas_kunci').val(item.lepas_kunci);
                $('#bulanan').val(item.bulanan);

                if(item.path_foto.length > 0){
                    $("#path_foto").attr("src", baseUrlImg + item.path_foto);
                }
                if(item.path_foto_2.length > 0){
                    $("#path_foto_2").attr("src", baseUrlImg + item.path_foto_2);
                }
                if(item.path_foto_3.length > 0){
                    $("#path_foto_3").attr("src", baseUrlImg + item.path_foto_3);
                }
                if(item.path_foto_4.length > 0){
                    $("#path_foto_4").attr("src", baseUrlImg + item.path_foto_4);
                }

                if(item.stat == 0){
                    $('#stat').val(item.stat).prop('checked', false);
                } else {
                    $('#stat').val(item.stat).prop('checked', true);
                }

                $('#biaya_antar').val(item.biaya_antar);
                $('#biaya_ambil').val(item.biaya_ambil);
                $('#tuslah').val(item.tuslah);
                $('#is_tuslah').val(item.is_tuslah);
                $('#kons_bbm').val(item.kons_bbm);

                // append id into form class modal-body
                // if name id is exist, then set value id
                if($('.modal-body input[name="id"]').length > 0){
                    $('.modal-body input[name="id"]').val(event.relatedTarget.dataset.id);
                } else {
                    // append id into form class modal-body
                    $('.modal-body').append('<input type="hidden" name="id" value="' + event.relatedTarget.dataset.id + '">');
                }
            } else {
                // reset form
                $('#addModal').find('input').val('');
                $('#addModal').find('textarea').val('');
                $('#addModal').find('select').val('');
            }
        });

        $('.btn-delete').on('click', function(event){
            event.preventDefault();
            console.log($(this).data('id'));
        });
    });
</script>
<?= $this->endSection() ?>