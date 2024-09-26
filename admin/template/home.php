<?php
// Panggil fungsi jumlah_nota untuk mendapatkan total pendapatan
$hasil_nota = $lihat->jumlah_nota();
$total_pendapatan = $hasil_nota['bayar'];
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
                                    <h5> Hasil Penjualan</h5>
                                </div>
                                <div class="panel-body">
                                    <center>
                                        <h1>Rp.<?php echo number_format($total_pendapatan); ?>,-</h1>
                                    </center>
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
                                    <h1><?php echo number_format($hasil_penjualan); ?> Transaksi</h1>
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
                                        <h1><?php echo number_format($hasil_barang); ?> Barang</h1>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h5>STOCK</h5>
                                </div>
                                <div class="panel-body">
                                    <center>
                                        <h1>1 Produk</h1>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales History Table -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Riwayat Penjualan</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $penjualan = $lihat->penjualan();
                                    foreach ($penjualan as $item) {
                                        echo "<tr>
                                                <td>{$no}</td>
                                                <td>{$item['nama_produk']}</td>
                                                <td>{$item['jumlah']}</td>
                                                <td>Rp." . number_format($item['harga']) . "</td>
                                                <td>{$item['tanggal']}</td>
                                              </tr>";
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="padding-top:18%;"></div>
    </section>
</section>