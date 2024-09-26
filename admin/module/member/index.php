<?php 
		  $id = $_SESSION['admin']['id_member'];
		  $hasil = $lihat -> member_edit2($id);
      ?>
 <section id="main-content">
     <section class="wrapper">

         <div class="row">
             <div class="col-lg-12 main-chart">
                 <h3>Data Pegawai</h3>
                 <br />
                 <?php if(isset($_GET['success-stok'])){?>
                 <div class="alert alert-success">
                     <p>Tambah Stok Berhasil !</p>
                 </div>
                 <?php }?>
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



                 <!-- Trigger the modal with a button -->

                 <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal"
                     data-target="#myModal">
                     <i class="fa fa-plus"></i> Insert Data</button>

                 <!-- <a href="index.php?page=barang&stok=yes" style="margin-right :0.5pc;"
       class="btn btn-warning btn-md pull-right">
       <i class="fa fa-list"></i> Sortir Stok Kurang</a> -->

                 <a href="index.php?page=member" style="margin-right :0.5pc;" class="btn btn-success btn-md pull-right">
                     <i class="fa fa-refresh"></i> Refresh Data</a>
                 <div class="clearfix"></div>
                 <br />

                 <!-- view barang -->
                 <div class="modal-view">
                     <table class="table table-bordered table-striped" id="example1">
                         <thead>
                             <tr style="background:#DFF0D8;color:#333;">
                                 <th>No.</th>
                                 <th>Nama Pegawai</th>
                                 <th>Alamat</th>
                                 <th>Telepon</th>
                                 <th>Email</th>
                                 <th>NIK</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>

                             <?php 
									$totalJual = 0;
									$no = 1;
									$hasil = $lihat -> lihat_member();
									foreach($hasil as $isi) {
								?>
                             <tr>
                                 <td><?php echo $no++; ?></td>
                                 <td><?php echo $isi['nm_member']; ?></td>
                                 <td><?php echo $isi['alamat_member']; ?></td>
                                 <td><?php echo $isi['telepon']; ?></td>
                                 <td><?php echo $isi['email']; ?></td>
                                 <td><?php echo $isi['NIK']; ?></td>
                                 <td>
                                     <?php ?>
                                     <a href="index.php?page=member/detail&member=<?php echo $isi['id_member']; ?>"><button
                                             class="btn btn-primary btn-xs">Details</button></a>

                                     <a href="index.php?page=member/edit&member=<?php echo $isi['id_member']; ?>"><button
                                             class="btn btn-warning btn-xs">Edit</button></a>
                                             
                                     <a href="fungsi/hapus/hapus.php?member=hapus&id=<?php echo $isi['id_member']; ?>"
                                         onclick="javascript:return confirm('Hapus Data Member ?');"><button
                                             class="btn btn-danger btn-xs">Hapus</button></a>
                                     <?php }?>


                             </tr>

                     </table>
                 </div>
                 <div class="clearfix" style="margin-top:7pc;"></div>
                 <!-- end view barang -->
                 <!-- tambah barang MODALS-->
                 <!-- Modal -->

                 <div id="myModal" class="modal fade" role="dialog">
                     <div class="modal-dialog">
                         <!-- Modal content-->
                         <div class="modal-content" style=" border-radius:0px;">
                             <div class="modal-header" style="background:#285c64;color:#fff;">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Pegawai</h4>
                             </div>

                             <form method="POST" action="fungsi/tambah/tambah.php?member=tambah">
                                 <div class="modal-body">
                                     <table class="table table-striped bordered">
                                         <tr>
                                             <td>Nama Pegawai</td>
                                             <td><input type="text" placeholder="Nama" required class="form-control"
                                                     name="nama"></td>
                                         </tr>
                                         <tr>
                                             <td>Alamat</td>
                                             <td><input type="text" placeholder="Alamat" required
                                                     class="form-control" name="alamat"></td>
                                         </tr>
                                         <tr>
                                             <td>Telepon</td>
                                             <td><input type="text" placeholder="telepon" required
                                                     class="form-control" name="telepon">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Email</td>
                                             <td><input type="text" placeholder="email" required class="form-control"
                                                     name="email">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Nik</td>
                                             <td><input type="text" placeholder="nik" required class="form-control"
                                                     name="nik">
                                             </td>
                                         </tr>
                                     </table>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="submit" class="btn btn-primary" name="proses"><i
                                             class="fa fa-plus"></i> Insert Data</button>
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                             </form>
                         </div>
                     </div>

                 </div>
             </div>
     </section>
 </section>
