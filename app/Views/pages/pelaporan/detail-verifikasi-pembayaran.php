<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <?php
                    // echo json_encode($listData); die();
                    // $subTotal = 0;
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Rental</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($listData['success'] == '0'): ?>
                            <tr>
                                <td colspan="3">
                                    <p class="text-center text-danger">Data tidak ditemukan</p>
                                </td>
                            </div>
                        <?php else: 
                            foreach ($listData['result_stat_bayar'] as $item): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($item['tgl_jam'])) ?></td>
                                <td><?= $item['nama_site'] ?></td>
                                <td>
                                    <?= ($item['stat'] == '3') ? 'Lunas' : 'Belum Lunas' ?>
                                    <a href="<?= base_url('pelaporan/verifikasi-pembayaran/detail/' . $item['no_tiket']) ?>" class="btn btn-sm btn-outline"><i class="fa fa-angle-right"></i></a>
                                </td>
                            </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
<?= $this->endSection() ?>