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
                    //include_once '_form.php'; 
                    // echo json_encode($listData);
                    ?>
                    <!-- jika $listData kosong, tampilkan data tidak ditemukan else looping -->
                    <?php if (empty($listData['result_list_order'])) : ?>
                        <p>Data tidak ditemukan</p>
                    <?php else : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($listData['result_list_order'] as $data) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->

<?= $this->endSection() ?>