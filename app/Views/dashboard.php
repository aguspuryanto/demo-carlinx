<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <?php
            // echo json_encode($listData);
            ?>
            <div style="width: 80%; margin: auto;">
                <canvas id="statistikChart"></canvas>
            </div>
        </div>
    </div>
    <!-- end main page content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Data JSON dari server
        const jsonData = <?= json_encode($listData) ?>;

        // Ekstrak data untuk chart
        const labels = jsonData.result_statistik.map(item => item.tgl);
        const dataPoints = jsonData.result_statistik.map(item => parseInt(item.jml));

        // Konfigurasi chart
        const ctx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Statistik Harian',
                    data: dataPoints,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?= $this->endSection() ?>