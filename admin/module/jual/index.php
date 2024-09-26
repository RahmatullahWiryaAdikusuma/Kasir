 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php
 $id = $_SESSION['pegawai']['id_member'];
 $hasil = $lihat->member_edit($id);

 ?>
 <section id="main-content">
     <section class="wrapper">
         <div class="row">
             <div class="col-lg-12 main-chart">
                 <?php if(isset($_GET['success'])){?>
                 <div class="alert alert-success">
                     <p>Edit Data Berhasil !</p>
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
                             <table class="table table-bordered table-striped" id="example1">
                                 <thead>
                                 <tr style="background:#DFF0D8;color:#333;">
                        <th width="5%">Id</th>
                        <th width="10%">Kode</th>
                        <th width="20%">Nama Produk</th>
                        <th width="10%">Tipe</th>
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
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['tipe']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td>
                            <form method="POST" action="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $isi['id_barang']; ?>&id_kasir=<?php echo $_SESSION['pegawai']['id_member']; ?>">
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
                                     href="fungsi/hapus/hapus.php?penjualan=jual">
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
                                 <table class="table table-bordered" id="example1">
                                     <thead>
                                         <tr>
                                             <td> No</td>
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
                                             <td><?php echo $isi['nama_barang']; ?></td>
                                             <td><?php echo $isi['jumlah']; ?></td>
                                             <td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
                                             <td><?php echo $isi['nm_member']; ?></td>
                                             <td>
                                                 </form>
                                                 <!-- aksi ke table penjualan -->
                                                 <a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['id_barang']; ?>
														&jml=<?php echo $isi['jumlah']; ?>"
                                                     class="btn btn-danger"><i class="fa fa-times"></i>
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
                                         if (!empty($_GET['nota'] == 'yes')) {
                                             $total = $_POST['total'];
                                             $bayar = $_POST['bayar'];
                                             if (!empty($bayar)) {
                                                 $hitung = $bayar - $total;
                                                 if ($bayar >= $total) {
                                                     $id_barang = $_POST['id_barang'];
                                                     $id_member = $_POST['id_member'];
                                                     $jumlah = $_POST['jumlah'];
                                                     $total = $_POST['total1'];
                                                     $tgl_input = $_POST['tgl_input'];
                                                     $periode = $_POST['periode'];
                                         
                                                     $jumlah_dipilih = count($id_barang);
                                         
                                                     for ($x = 0; $x < $jumlah_dipilih; $x++) {
                                                         $d = [$id_barang[$x], $id_member[$x], $jumlah[$x], $total[$x], $tgl_input[$x], $periode[$x]];
                                                         $sql = 'INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)';
                                                         $row = $config->prepare($sql);
                                                         $row->execute($d);
                                         
                                                         // ubah stok barang
                                                         //  $sql_barang = 'SELECT * FROM barang WHERE id_barang = ?';
                                                         //  $row_barang = $config->prepare($sql_barang);
                                                         //  $row_barang->execute([$id_barang[$x]]);
                                                         //  $hsl = $row_barang->fetch();
                                         
                                                         //  $stok = $hsl['stok'];
                                                         //  $idb = $hsl['id_barang'];
                                         
                                                         //  $total_stok = $stok - $jumlah[$x];
                                                         //  // echo $total_stok;
                                                         //  $sql_stok = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
                                                         //  $row_stok = $config->prepare($sql_stok);
                                                         //  $row_stok->execute([$total_stok, $idb]);
                                                     }
                                                     echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                                 } else {
                                                     echo '<script>alert("Uang Kurang ! Rp.' . $hitung . '");</script>';
                                                 }
                                             }
                                         }
                                         ?>
                                         <!-- aksi ke table nota -->
                                         <form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
                                             <?php foreach($hasil_penjualan as $isi){;?>
                                             <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang']; ?>">
                                             <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member']; ?>">
                                             <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah']; ?>">
                                             <input type="hidden" name="total1[]" value="<?php echo $isi['total']; ?>">
                                             <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input']; ?>">
                                             <input type="hidden" name="periode[]" value="<?php echo date('m-Y'); ?>">
                                             <!-- <input type="hidden" name="tanggal[]" value="<?php echo date('m-d-Y'); ?>"> -->
                                             <?php $no++; }?>
                                             <tr>
                                                 <td>Total Semua </td>
                                                 <td><input type="text" class="form-control" name="total"
                                                         value="<?php echo $total_bayar; ?>"></td>

                                                 <td>Bayar </td>
                                                 <td><input type="text" class="form-control" name="bayar"
                                                         value="<?php echo $bayar; ?>"></td>
                                                 <td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i>
                                                         Bayar</button>
                                                     <?php  if(!empty($_GET['nota'] == 'yes')) {?>
                                                     <a class="btn btn-danger"
                                                         href="fungsi/hapus/hapus.php?penjualan=jual">
                                                         <b>RESET</b></a>
                                                 </td><?php }?></td>
                                             </tr>
                                         </form>
                                         <!-- aksi ke table nota -->
                                         <tr>
                                             <td>Kembali</td>
                                             <td><input type="text" class="form-control"
                                                     value="<?php echo $hitung; ?>"></td>
                                             <td></td>
                                             <td>
                                                 <a href="print.php?nm_member=<?php echo $_SESSION['pegawai']['nm_member']; ?>
													&bayar=<?php echo $bayar; ?>&kembali=<?php echo $hitung; ?>"
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


 <!-- <script>
     // AJAX call for autocomplete 
     $(document).ready(function() {
         $("#cari").change(function() {
             $.ajax({
                 type: "POST",
                 url: "fungsi/edit/edit.php?cari_barang=yes",
                 data: 'keyword=' + $(this).val(),
                 beforeSend: function() {
                     $("#hasil_cari").hide();
                     $("#tunggu").html(
                         '<p style="color:green"><blink>tunggu sebentar</blink></p>');
                 },
                 success: function(html) {
                     $("#tunggu").html('');
                     $("#hasil_cari").show();
                     $("#hasil_cari").html(html);
                 }
             });
         });
     });
     //To select country name
 </script> -->

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [6, 7] } // Kolom 'Jumlah' dan 'Aksi' tidak dapat diurutkan
        ]
    });
});
</script>