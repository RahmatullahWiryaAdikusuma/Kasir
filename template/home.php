<?php
// Panggil fungsi jumlah_nota untuk mendapatkan total pendapatan
$hasil_nota = $lihat->jumlah_nota();
$total_pendapatan = $hasil_nota['bayar'];

$hasil_total_stok = $lihat->total_stok();
$total_stok = $hasil_total_stok['total_stok'];
?>


<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="margin-left:1pc;margin-right:1pc;">
                    <h1>DASHBOARD</h1>
                    <hr>
                    <?php $hasil_barang = $lihat->barang_row(); ?>
                    <?php $hasil_kategori = $lihat->kategori_row(); ?>
                    <?php $hasil_penjualan = $lihat->penjualan_row(); ?>
                    <?php $hasil_member = $lihat->member_row(); ?>
                    <?php $jual = $lihat->jual_row(); ?>

                    <div class="row">
                        <!--STATUS PANELS -->
                        <div class="col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5> HASIL PENJUALAN </h5>
                                </div>
                                <div class="panel-body text-align=center">
                                    
                                        <h1>Rp.<?php echo number_format($total_pendapatan); ?></h1>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h5>TOTAL TRANSAKSI</h5>
                                </div>
                                <div class="panel-body">
                                    <center>
                                    <h1><?php echo number_format($hasil_penjualan); ?></h1>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h5>BARANG</h5>
                                </div>
                                <div class="panel-body">
                                    <center>
                                        <h1><?php echo number_format($hasil_barang); ?></h1>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h5>STOK</h5>
                                </div>
                                <div class="panel-body">
                                    <center>
                                    <h1><?php echo number_format($total_stok); ?></h1>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4>Grafik Penjualan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <select id="filterType" class="form-control mb-2">
                                                <option value="daily">Per Hari</option>
                                                <option value="monthly">Per Bulan</option>
                                                <option value="yearly">Per Tahun</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" id="monthFilter" style="display:none;">
                                            <select id="filterMonth" class="form-control">
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" id="yearFilter">
                                            <select id="filterYear" class="form-control">
                                                <?php 
                                                $currentYear = date('Y');
                                                for($i = $currentYear; $i >= $currentYear - 4; $i--) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="height: 300px;">
                                        <canvas id="salesChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
let salesChart;

function formatChartData(data) {
    return {
        labels: data.labels,
        datasets: [{
            label: 'Hasil Penjualan',
            data: data.values,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    };
}

function loadChartData() {
    const type = document.getElementById('filterType').value;
    const month = document.getElementById('filterMonth').value;
    const year = document.getElementById('filterYear').value;

    fetch(`fungsi/get_sales_data.php?type=${type}&month=${month}&year=${year}`)
        .then(response => response.json())
        .then(data => {
            if (salesChart) {
                salesChart.destroy();
            }
            
            const ctx = document.getElementById('salesChart').getContext('2d');
            salesChart = new Chart(ctx, {
                type: 'line',
                data: formatChartData(data),
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)',
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error:', error));
}

// Event listeners untuk filter
document.getElementById('filterType').addEventListener('change', function() {
    const monthFilter = document.getElementById('monthFilter');
    monthFilter.style.display = this.value === 'daily' ? 'block' : 'none';
    loadChartData();
});

document.getElementById('filterMonth').addEventListener('change', loadChartData);
document.getElementById('filterYear').addEventListener('change', loadChartData);

// Set bulan saat ini saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const currentMonth = new Date().getMonth() + 1;
    document.getElementById('filterMonth').value = currentMonth;
    loadChartData();
});
</script>
