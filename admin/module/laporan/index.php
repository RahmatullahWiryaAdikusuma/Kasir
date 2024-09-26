 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->

 <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>


 <?php
 $bulan_tes = [
     '01' => 'Januari',
     '02' => 'Februari',
     '03' => 'Maret',
     '04' => 'April',
     '05' => 'Mei',
     '06' => 'Juni',
     '07' => 'Juli',
     '08' => 'Agustus',
     '09' => 'September',
     '10' => 'Oktober',
     '11' => 'November',
     '12' => 'Desember',
 ];
 ?>
 <section id="main-content">
     <section class="wrapper">

         <div class="row">
             <div class="col-lg-12 main-chart">
                 <h3>
                     <!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
        <button class="btn btn-danger">RESET</button>
       </a>-->
                     <?php if(!empty($_GET['cari'])){ ?>
                     Data Laporan Penjualan <?= $bulan_tes[$_POST['bln']] ?> <?= $_POST['thn'] ?>
                     <?php }elseif(!empty($_GET['hari'])){?>
                     Data Laporan Penjualan <?= $_POST['hari'] ?>
                     <?php }elseif(!empty($_GET['range'])){?>
                     Data Laporan Penjualan <?= $hari1 = $_POST['hari1'] ?> sampai <?= $hari1 = $_POST['hari2'] ?>
                     <?php }else{?>
                     Data Laporan Penjualan <?= $bulan_tes[date('m')] ?> <?= date('Y') ?>
                     <?php }?>

                 </h3>
                 <br />

                 <!-- <h4>Cari Laporan Dengan Range</h4>
                 <form method="post" action="index.php?page=laporan&range=ok">
                     <table class="table table-striped">
                         <tr>
                             <th>
                                 Dari
                             </th>
                             <th>
                                 Sampai
                             </th>
                             <th>
                                 Aksi
                             </th>
                         </tr>
                         <tr>
                             <td>
                                 <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="hari1">
                             </td>
                             <td>
                                 <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="hari2">
                             </td>
                             <td>
                                 <input type="hidden" name="periode" value="ya">
                                 <button class="btn btn-primary">
                                     <i class="fa fa-search"></i> Cari
                                 </button>
                                 <a href="index.php?page=laporan" class="btn btn-success">
                                     <i class="fa fa-refresh"></i> Refresh</a>

                                 <?php if(!empty($_GET['cari'])){?>
                                 <a href="excel.php?cari=yes&bln=<?= $_POST['bln'] ?>&thn=<?= $_POST['thn'] ?>"
                                     class="btn btn-info"><i class="fa fa-download"></i>
                                     Excel</a>
                                 <?php }else{?>
                                 <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                     Excel</a>
                                 <?php }?>
                             </td>
                         </tr>
                     </table>
                 </form> -->
                 <h4>Cari Laporan Per Bulan</h4>
                 <form method="post" action="index.php?page=laporan&cari=ok">
                     <table class="table table-striped">
                         <tr>
                             <th>
                                 Pilih Bulan
                             </th>
                             <th>
                                 Pilih Tahun
                             </th>
                             <th>
                                 Aksi
                             </th>
                         </tr>
                         <tr>
                             <td>
                                 <select name="bln" class="form-control">
                                     <option selected="selected">Bulan</option>
                                     <?php
                                     $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                     $jlh_bln = count($bulan);
                                     $bln1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                                     $no = 1;
                                     for ($c = 0; $c < $jlh_bln; $c += 1) {
                                         echo "<option value='$bln1[$c]'> $bulan[$c] </option>";
                                         $no++;
                                     }
                                     ?>
                                 </select>
                             </td>
                             <td>
                                 <?php
                                 $now = date('Y');
                                 echo "<select name='thn' class='form-control'>";
                                 echo '<option selected="selected">Tahun</option>';
                                 for ($a = 2017; $a <= $now; $a++) {
                                     echo "<option value='$a'>$a</option>";
                                 }
                                 echo '</select>';
                                 ?>
                             </td>
                             <td>
                                 <input type="hidden" name="periode" value="ya">
                                 <button class="btn btn-primary">
                                     <i class="fa fa-search"></i> Cari
                                 </button>
                                 <a href="index.php?page=laporan" class="btn btn-success">
                                     <i class="fa fa-refresh"></i> Refresh</a>

                                 <?php if(!empty($_GET['cari'])){?>
                                 <a href="excel.php?cari=yes&bln=<?= $_POST['bln'] ?>&thn=<?= $_POST['thn'] ?>"
                                     class="btn btn-info"><i class="fa fa-download"></i>
                                     Excel</a>
                                 <?php }else{?>
                                 <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                     Excel</a>
                                 <?php }?>
                             </td>
                         </tr>
                     </table>
                 </form>


                 <h4>Cari Laporan Per Hari</h4>
                 <div class="container mt-4">
                     <form method="post" action="index.php?page=laporan&hari=cek">
                         <table class="table table-striped">
                             <tr>
                                 <th>
                                     Pilih Hari
                                 </th>
                                 <th>
                                     Aksi
                                 </th>
                             </tr>
                             <tr>
                                 <td>
                                     <input type="date" value="<?= date('Y-m-d') ?>" class="form-control"
                                         name="hari">
                                 </td>
                                 <td>
                                     <input type="hidden" name="periode" value="ya">
                                     <button class="btn btn-primary">
                                         <i class="fa fa-search"></i> Cari
                                     </button>
                                     <a href="index.php?page=laporan" class="btn btn-success">
                                         <i class="fa fa-refresh"></i> Refresh</a>

                                     <?php if(!empty($_GET['hari'])){?>
                                     <a href="excel.php?hari=cek&tgl=<?= $_POST['hari'] ?>" class="btn btn-info"><i
                                             class="fa fa-download"></i>
                                         Excel</a>
                                     <?php }else{?>
                                     <a href="excel.php" class="btn btn-info"><i class="fa fa-download"></i>
                                         Excel</a>
                                     <?php }?>
                                 </td>
                             </tr>
                         </table>
                     </form>
                     <div class="clearfix" style="border-top:1px solid #ccc;"></div>
                     <br />
                     <br />
                     <!-- view barang -->
                     <div class="modal-view">
                         <table class="table table-bordered" id="example">
                             <!-- <thead>
                                 <tr style="background:#DFF0D8;color:#333;">
                                     <th> No</th>
                                     <th> ID Barang</th>
                                     <th> Nama Barang</th>
                                     <th> Nama Barang</th>
                                     <th> Jumlah</th>
                                     <th> Total</th>
                                     <th> Kasir</th>
                                     <th> Tanggal Input</th>
                                 </tr>
                             </thead> -->
                             <thead>
                                 <tr style="background:#DFF0D8;color:#333;">
                                     <th> No</th>
                                     <th> ID Barang</th>
                                     <th> Nama Barang</th>
                                     <!-- <th> Nama kategori</th> -->
                                     <th> Jumlah</th>
                                     <th> Total</th>
                                     <th> Kasir</th>
                                     <th> Tanggal Input</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $no = 1;
                                 if (!empty($_GET['cari'])) {
                                     $periode = $_POST['bln'] . '-' . $_POST['thn'];
                                     $no = 1;
                                     $jumlah = 0;
                                     $bayar = 0;
                                     $hasil = $lihat->periode_jual($periode);
                                 } elseif (!empty($_GET['hari'])) {
                                     $hari = $_POST['hari'];
                                     $no = 1;
                                     $jumlah = 0;
                                     $bayar = 0;
                                     $hasil = $lihat->hari_jual($hari);
                                 } 
                                //  elseif (!empty($_GET['range'])) {
                                //      $hari1 = $_POST['hari1'];
                                //      $hari2 = $_POST['hari2'];
                                //      $no = 1;
                                //      $jumlah = 0;
                                //      $bayar = 0;
                                //      $hasil = $lihat->range_jual($hari1, $hari2);
                                //  } 
                                 else {
                                     $hasil = $lihat->jual();
                                 }
                                 ?>
                                 <?php 
										$bayar = 0;
										$jumlah = 0;
										$modal = 0;
										foreach($hasil as $isi){ 
											$bayar += $isi['total'];
											$modal += $isi['harga_beli']* $isi['jumlah'];
											$jumlah += $isi['jumlah'];
									?>
                                 <tr>
                                     <td><?php echo $no; ?></td>
                                     <td><?php echo $isi['id_barang']; ?></td>
                                     <td><?php echo $isi['nama_barang']; ?></td>
                                     <td><?php echo $isi['jumlah']; ?> </td>
                                     <td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
                                     <td><?php echo $isi['nm_member']; ?></td>
                                     <td><?php echo $isi['tanggal_input']; ?></td>
                                 </tr>
                                 <?php $no++; }?>
                             </tbody>
                             <tfoot>
                                 <tr>
                                     <th colspan="3">Total Terjual</td>
                                     <th><?php echo $jumlah; ?></td>
                                     <th>Rp.<?php echo number_format($bayar); ?>,-</th>
                                     <th style="background:#0bb365;color:#fff;">Penghasilan</th>
                                     <th style="background:#0bb365;color:#fff;">
                                         Rp.<?php echo number_format($bayar); ?>,-</th>
                                 </tr>
                             </tfoot>
                         </table>
                     </div>
                     <div class="clearfix" style="padding-top:5pc;"></div>
                 </div>
             </div>
         </div>
     </section>
 </section>

 <!-- <script>
     $(document).ready(function() {
         $("#example").DataTable({

            ordering: false,

             initComplete: function() {
                 this.api()
                     .columns()
                     .every(function() {
                         var column = this;
                         var select = $('<select><option value=""></option></select>')
                             .appendTo($(column.header()).empty())
                             .on("change", function() {
                                 var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                 column.search(val ? "^" + val + "$" : "", true, false)
                                     .draw();
                             });

                         column
                             .data()
                             .unique()
                             .sort()
                             .each(function(d, j) {
                                 select.append('<option value="' + d + '">' + d +
                                     "</option>");
                             });
                     });
             }
         });
     });
 </script> -->