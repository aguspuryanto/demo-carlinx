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
                    // include_once '_form_unit.php';
                    // echo json_encode($listData);
                    ?>

                    <?php foreach ($listData as $item) : ?>
                    <div class="media mb-3">
                        <img class="mr-3" src="<?= $_ENV['API_BASEURL'] . 'images/' . $item['path_foto'] ?>" alt="Generic placeholder image" style="width: 64px; height: 64px;">
                        <div class="media-body">
                            <h5 class="mt-0"><?= $item['nama'] ?></h5>
                            <div class="table-responsive d-sm-none d-md-none d-lg-block d-xl-block mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Dalam Kota</th>
                                        <th scope="col">Luar Kota</th>
                                        <th scope="col">Luar Batas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <?= number_format($item['dlm_kota'], 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($item['dlm_prop'], 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($item['luar_prop'], 0, ',', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page content -->
     
    <?php include_once '_modal_unit_form.php'; ?>

<?= $this->endSection() ?>


<script>
    $(document).ready(function () {
        // Fungsi untuk preview gambar
        $('#imageInput').on('change', function (event) {
            const files = event.target.files; // Ambil file dari input
            const previewContainer = $('#previewContainer');

            // Kosongkan container sebelum menampilkan preview baru
            previewContainer.empty();

            // Iterasi setiap file yang diunggah
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    // Ketika file berhasil dibaca
                    reader.onload = function (e) {
                        const img = $(
                            `<div class="text-center">
                                <img src="${e.target.result}" class="img-thumbnail" style="width: 100px; height: 100px;" alt="Preview">
                                <p class="text-muted" style="font-size: 0.8rem;">${file.name}</p>
                            </div>`
                        );
                        previewContainer.append(img);
                    };

                    // Mulai membaca file sebagai DataURL
                    reader.readAsDataURL(file);
                }
            });
        });

        // Fungsi submit form
        $('#imageForm').on('submit', function (e) {
            e.preventDefault(); // Cegah reload halaman

            const formData = new FormData();
            const files = $('#imageInput')[0].files;

            // Tambahkan file ke FormData
            Array.from(files).forEach(file => {
                formData.append('images[]', file);
            });

            // Simulasi proses upload
            alert('Gambar berhasil dipilih, siap di-upload!');
            // Anda bisa menambahkan kode AJAX untuk mengirim data ke server di sini
        });
    });
</script>