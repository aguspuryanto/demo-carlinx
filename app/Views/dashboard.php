<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- main page content -->
    <div class="main-container container">
        <div class="row">
            <?php
            // echo json_encode($listData);
            // echo json_encode($ListMenu);
            ?>
            <p>Statistik Pengguna</p>
            <span>30 hari terakhir</span>
            <div style="width: 100%; margin: auto;">
                <canvas id="statistikChart"></canvas>
            </div>

            <div style="width: 100%; margin: auto; margin-top: 50px;">
                <canvas id="bestMenuChart"></canvas>
            </div>
        </div>
    </div>
    <!-- end main page content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
        // Data JSON dari server untuk Line Chart
        const jsonDataLine = <?= json_encode($listData) ?>;

        // Ekstrak data untuk Line Chart
        const labelsLine = jsonDataLine.result_statistik.map(item => item.tgl.slice(-2));
        const dataPointsLine = jsonDataLine.result_statistik.map(item => parseInt(item.jml));

        // Konfigurasi Line Chart
        const ctxLine = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labelsLine,
                datasets: [{
                    label: 'Jumlah Statistik Harian',
                    data: dataPointsLine,
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
                        display: false,
                        position: 'top'
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: false,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: false,
                            text: 'Jumlah'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Data JSON dari server untuk Bar Chart
        const jsonDataBar = <?= json_encode($ListMenu) ?>;

        // Ekstrak data untuk Bar Chart
        const labelsBar = jsonDataBar.result_best_menu.map(item => item.nama);
        const dataPointsBar = jsonDataBar.result_best_menu.map(item => parseInt(item.jml));

        // Konfigurasi Bar Chart
        const ctxBar = document.getElementById('bestMenuChart').getContext('2d');
        const bestMenuChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labelsBar,
                datasets: [{
                    label: 'Jumlah Menu Terbaik',
                    data: dataPointsBar,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Mengatur chart menjadi horizontal
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'top'
                    },
                    tooltip: {
                        display: false,
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#000', // Warna label
                        align: 'center', // Posisi horizontal
                        anchor: 'center', // Posisi vertikal
                        font: {
                            size: 14, // Ukuran font
                            weight: 'bold' // Ketebalan font
                        },
                        formatter: function (value, context) {
                            // Mengambil label dari data.labels
                            return context.chart.data.labels[context.dataIndex];
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: false,
                            text: 'Menu'
                        },
                        beginAtZero: true
                    },
                    y: {
                        title: {
                            display: false,
                            text: 'Jumlah'
                        },
                        ticks: {
                            display: false
                        },
                        beginAtZero: true
                    }
                }
            },
            plugins: [ChartDataLabels] // Tambahkan plugin datalabels
        });
    </script>
<?= $this->endSection() ?>