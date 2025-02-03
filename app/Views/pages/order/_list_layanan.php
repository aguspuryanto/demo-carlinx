<?php //echo json_encode($listData['result_unit_order']); ?>
<ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
    <li class="list-group-item active" aria-current="true">Hasil Pencarian <?= count($listData['result_unit_order']) ?></li>
    <?php foreach ($listData['result_unit_order'] as $item) : ?>
    <li class="list-group-item">
        <a href="#" class="list-group-item-action d-flex" id="selectOrder" data-bs-toggle="modal" data-bs-target="#exampleModal" data-item="<?= esc(json_encode($item)) ?>">
            <div class="p-2 flex-shrink-1">
                <img class="avatar avatar-lg" src="<?= getImage($_ENV['API_BASEURL'] . 'images/' . $item['path_foto']) ?>" style="width: 64px; height: 64px;" />
            </div>
            <div class="p-2 w-100">
                <p class="fw-bold mb-0"><?= $item['nama'] ?></p>
                <p class="text-muted mb-0 fs-sm">Tahun <?= $item['tahun'] ?></p>
                <p class="text-muted mb-0 fs-sm"><?= $item['nama_rental'] ?></p>
                <p class="text-muted mb-0 fs-sm"><?= $item['kota_rental'] ?></p>
                <div class="d-flex">
                    <span class="p-0 flex-fill"><i class="fa fa-star text-warning"></i> <?= $item['rating'] ?> | <?= $item['terjual'] ?> Terlayani</span>
                    <span class="p-0 flex-shrink-1">Rp <?= number_format($jns_order == '2' ? $item['hrg_sewa'] : $item['total_hrg_sewa'], 0, ',', '.') ?></span>
                </div>
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
            <th scope="col">Images</th>
            <th scope="col">Rental</th>
            <th scope="col">Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($listData['result_unit_order'] as $item) : ?>
            <tr data-bs-toggle="modal" data-bs-target="#exampleModal" data-item="<?= esc(json_encode($item)) ?>">
                <th scope="row"><?= $no++ ?></th>
                <td>
                    <img class="avatar avatar-lg" src="<?= getImage($_ENV['API_BASEURL'] . 'images/' . $item['path_foto']) ?>" style="width: 64px; height: 64px;" />
                </td>
                <td>
                    <p class="fw-bold mb-0"><?= $item['nama'] ?></p>
                    <p class="text-muted mb-0 fs-sm">Tahun <?= $item['tahun'] ?></p>
                    <p class="text-muted mb-0 fs-sm"><?= $item['nama_rental'] ?></p>
                    <p class="text-muted mb-0 fs-sm"><?= $item['kota_rental'] ?></p>
                    <div class="d-flex">
                        <span class="p-0 flex-fill"><i class="fa fa-star text-warning"></i> <?= $item['rating'] ?> | <?= $item['terjual'] ?> Terlayani</span>
                    </div>
                </td>
                <td>
                    <p class="mb-0 fs-sm">Rp <?= number_format($item['hrg_sewa'], 0, ',', '.') ?></p>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>