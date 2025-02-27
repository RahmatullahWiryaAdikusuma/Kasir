<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php
 $id = $_SESSION['Member']['id_user'];
 $hasil = $lihat->user_edit($id);

 ?>
 
 <section id="main-content">
     <section class="wrapper">
         <div class="row">
             <div class="col-lg-12 main-chart">
                 <?php if(isset($_GET['success'])){?>
                 <div class="alert alert-success">
                     <p>Tambah Data Berhasil !</p>
                 </div>
                 <?php }?>
                 <?php if(isset($_GET['remove'])){?>
                 <div class="alert alert-danger">
                     <p>Hapus Data Berhasil !</p>
                 </div>
                 <?php }?>
                 <div class="col-sm-12">
                     <div class="panel panel-primary">
                         <div class="panel-heading">
                            <h4>Keranjang Penjualan</h4>
                         </div>

                         <div class="modal-view" style="padding: 2%;">
                             <table class="table table-bordered table-striped" id="jualTable">
                                 <thead>
                                 <tr style="background:#DFF0D8;color:#333;">
                        <th width="5%">Id</th>
                        <th width="10%">Kode</th>
                        <th width="15%">Nama Produk</th>
                        <th width="20%">Nama Barang</th>
                        <th width="10%">Satuan</th>
                        <th width="10%">Harga Jual</th>
                        <th width="10%">Stok</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    try {
                        $hasil = $lihat->lihat_barang();
                        if (empty($hasil)) {
                            echo "<tr><td colspan='8'>No data found...</td></tr>";
                        } else {
                            foreach($hasil as $isi) {
                                if ($isi['stok'] > 0) { // Sembunyikan barang dengan stok 0
                    ?>
                    <tr>
                        <td><?php echo $isi['id_barang']; ?></td>
                        <td><?php echo $isi['kode_produk']; ?></td>
                        <td><?php echo $isi['nama_produk']; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['satuan']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td>
                            <form method="POST" action="fungsi/tambah/tambah.php?jual=true&id=<?php echo $isi['id_barang']; ?>">
                                <input type="number" name="jumlah" value="1" min="1" max="<?php echo $isi['stok']; ?>" class="form-control">
                                <button type="submit" class="btn btn-success" style="margin-top: 5px;">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                                }
                            }
                        }
                    } catch (Exception $e) {
                        echo "<tr><td colspan='8'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                             </table>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm-12">
                     <div class="panel panel-primary">
                         <div class="panel-heading">
                             <h4><i class="fa fa-shopping-cart"></i> KASIR
                                 <a class="btn btn-danger pull-right" style="margin-top:-0.5pc;"
                                     href="fungsi/hapus/hapus.php?penjualan=hapus&id=<?php echo $_SESSION['Member']['id_user']; ?>"
                                     onclick="return confirm('Apakah anda yakin ingin mereset keranjang?');">
                                     <b>RESET KERANJANG</b></a>
                             </h4>
                         </div>
                         <div class="panel-body">
                             <div id="keranjang">
                                 <table class="table table-bordered">
                                     <tr>
                                         <td><b>Tanggal</b></td>
                                         <td><input type="text" readonly="readonly" class="form-control"
                                                 value="<?php echo date('j F Y, G:i'); ?>" name="tgl"></td>
                                     </tr>
                                 </table>
                                 <table class="table table-bordered" id="jualTable">
                                     <thead>
                                         <tr>
                                             <td> No</td>
                                             <td> Nama Produk</td>
                                             <td> Nama Barang</td>
                                             <td> Jumlah</td>
                                             <td> Total</td>
                                             <td> Kasir</td>
                                             <td> Aksi</td>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $total_bayar = 0;
                                         $no = 1;
                                         $hasil_penjualan = $lihat->penjualan(); ?>
                                         <?php foreach($hasil_penjualan  as $isi){;?>
                                         <tr>
                                             <td><?php echo $no; ?></td>
                                             <td><?php echo $isi['nama_produk']; ?></td>
                                             <td><?php echo $isi['nama_barang']; ?></td>
                                             <td><?php echo $isi['jumlah']; ?></td>
                                             <td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
                                             <td><?php echo $isi['nama']; ?></td>
                                             <td>
                                                 </form>
                                                 <!-- aksi ke table penjualan -->
                                                 <a href="fungsi/hapus/hapus.php?penjualan=hapus&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['id_barang']; ?>&jml=<?php echo $isi['jumlah']; ?>" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah anda yakin ingin membatalkan item ini?');">
                                                     <i class="fa fa-times"></i>
                                                 </a>
                                             </td>
                                         </tr>
                                         <?php $no++; $total_bayar += $isi['total'];}?>
                                     </tbody>
                                 </table>
                                 <br />
                                 <?php $hasil = $lihat->jumlah(); ?>
                                 <div id="kasirnya">
                                     <table class="table table-stripped">
                                         <?php
                                         // proses bayar dan ke nota
                                         if (isset($_GET['nota']) && $_GET['nota'] == 'yes') {
                                             header('Content-Type: application/json');
                                             $total = $_POST['total'];
                                             $bayar = $_POST['bayar'];
                                             
                                             if (!empty($bayar)) {
                                                 $hitung = $bayar - $total;
                                                 if ($bayar >= $total) {
                                                     try {
                                                         $config->beginTransaction();
                                                         
                                                         // Generate kode nota
                                                         $query = "SELECT MAX(CAST(SUBSTRING(kode_nota, 3) AS UNSIGNED)) as max_num FROM nota";
                                                         $stmt = $config->prepare($query);
                                                         $stmt->execute();
                                                         $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                         
                                                         $next_num = (empty($result['max_num']) || $result['max_num'] === null) ? 1 : ((int)$result['max_num'] + 1);
                                                         $kode_nota = 'TR' . str_pad($next_num, 4, '0', STR_PAD_LEFT);

                                                         $id_barang = $_POST['id_barang'];
                                                         $id_produk = $_POST['id_produk'];
                                                         $id_user = $_POST['id_user'];
                                                         $jumlah = $_POST['jumlah'];
                                                         $total = $_POST['total1'];
                                                         $tgl_input = $_POST['tgl_input'];
                                                         $periode = $_POST['periode'];
                                                         
                                                         $jumlah_dipilih = count($id_barang);
                                                         
                                                         for ($x = 0; $x < $jumlah_dipilih; $x++) {
                                                             $sql = 'INSERT INTO nota (id_barang, id_produk, id_user, jumlah, total, tanggal_input, periode, kode_nota) 
                                                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
                                                             $row = $config->prepare($sql);
                                                             $row->execute([
                                                                 $id_barang[$x], 
                                                                 $id_produk[$x], 
                                                                 $id_user[$x], 
                                                                 $jumlah[$x], 
                                                                 $total[$x], 
                                                                 $tgl_input[$x], 
                                                                 $periode[$x],
                                                                 $kode_nota
                                                             ]);
                                                         }

                                                         // Hapus data dari keranjang setelah pembayaran berhasil
                                                         $sql_delete = "DELETE FROM penjualan WHERE id_user = ?";
                                                         $row_delete = $config->prepare($sql_delete);
                                                         $row_delete->execute([$_SESSION['id_user']]);

                                                         $config->commit();
                                                         $_SESSION['kode_nota'] = $kode_nota;
                                                         
                                                         echo json_encode(['success' => true, 'kode_nota' => $kode_nota]);
                                                         exit;
                                                     } catch (PDOException $e) {
                                                         $config->rollBack();
                                                         echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                                                         exit;
                                                     }
                                                 } else {
                                                     echo json_encode(['success' => false, 'message' => 'Uang kurang!']);
                                                     exit;
                                                 }
                                             }
                                         }
                                         ?>
                                         <!-- aksi ke table nota -->
                                         <form method="POST" action="fungsi/tambah/tambah.php?nota=yes" onsubmit="return validatePayment()">
                                             <tr>
                                                 <td>Total Semua</td>
                                                 <td><input type="text" class="form-control" name="total" id="total" value="<?php echo $total_bayar; ?>" readonly></td>
                                                 <td>Bayar</td>
                                                 <td><input type="text" class="form-control" name="bayar" id="bayar" onkeyup="hitungKembalian()"></td>
                                                 <td><button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button></td>
                                             </tr>
                                         </form>
                                         <!-- aksi ke table nota -->
                                         <tr>
                                             <td>Kembali</td>
                                             <td><input type="text" class="form-control" id="kembalian" readonly></td>
                                             <td></td>
                                             <td>
                                                 <a href="print.php?nama=<?php echo $_SESSION['Member']['nama']; ?>
													&bayar=<?php echo $_SESSION['jumlah_bayar']; ?>&kembali=<?php echo $_SESSION['kembali']; ?>"
                                                     target="_blank">
                                                     <button class="btn btn-default">
                                                         <i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
                                                     </button></a>
                                             </td>
                                         </tr>
                                     </table>
                                     <br />
                                     <br />
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
     </section>
 </section>


<script>
$(document).ready(function() {
    $('#jualTable').DataTable({
        "columnDefs": [
            { "orderable": false } // Kolom 'Jumlah' dan 'Aksi' tidak dapat diurutkan
        ]
    });
});
</script>

<script>
function hitungKembalian() {
    var total = parseFloat(document.getElementById('total').value) || 0;
    var bayar = parseFloat(document.getElementById('bayar').value) || 0;
    var kembalian = bayar - total;
    document.getElementById('kembalian').value = kembalian.toLocaleString('id-ID');
}

function validatePayment() {
    var total = parseFloat(document.getElementById('total').value) || 0;
    var bayar = parseFloat(document.getElementById('bayar').value) || 0;
    var kurang = total - bayar;
    
    if (bayar < total) {
        alert("Uang kurang Rp. " + kurang.toLocaleString('id-ID'));
        return false;
    }
    return true;
}
</script>

<style>
.table td {
    vertical-align: middle; /* Memastikan elemen di tengah secara vertikal */
}

.table .form-inline {
    display: flex;
    align-items: center; /* Menyelaraskan elemen secara vertikal */
}

.table .form-control {
    width: auto; /* Sesuaikan lebar input */
    margin-right: 5px; /* Memberi jarak antara input dan tombol */
}
</style>

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.login-form {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-form img {
    display: block;
    margin: 0 auto 20px;
    max-width: 200px;
}

.login-form input {
    margin-bottom: 15px;
}
</style>