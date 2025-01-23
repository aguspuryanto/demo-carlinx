<?php //echo json_encode($listData['result_unit_order']); ?>
<ul class="list-group d-sm-block d-md-block d-lg-none d-xl-none">
    <li class="list-group-item active" aria-current="true">Hasil Pencarian <?= count($listData['result_unit_order']) ?></li>
    <?php foreach ($listData['result_unit_order'] as $item) : ?>
    <li class="list-group-item">
        <a href="<?= base_url('order/search-order/' . $item['koderental']) ?>" class="list-group-item-action d-flex">
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
                    <span class="p-0 flex-shrink-1">Rp <?= number_format($item['total_hrg_sewa'], 0, ',', '.') ?></span>
                </div>
            </div>
        </a>
    </li>
    <?php endforeach ?>
</ul>