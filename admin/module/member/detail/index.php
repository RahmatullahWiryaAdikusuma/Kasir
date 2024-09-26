 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php
 $id = $_GET['member'];
 $hasil = $lihat->member_edit2($id);
 ?>
 <section id="main-content">
     <section class="wrapper">

         <div class="col-lg-12 main-chart">
             <a href="index.php?page=member"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik
                 </button></a>
             <div class="row">
                 <div class="col-lg-6">
                     <h3>Details Member</h3>
                 </div>
                 <div class="col-lg-6">
                     <h3>Member Login Member</h3>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-lg-6 main-chart">
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
                 <table class="table table-striped">
                     <tr>
                         <td>ID</td>
                         <td><?php echo $hasil['id_member']; ?></td>
                     </tr>
                     <tr>
                         <td>Nama</td>
                         <td><?php echo $hasil['nm_member']; ?></td>
                     </tr>
                     <tr>
                         <td>Alamat</td>
                         <td><?php echo $hasil['alamat_member']; ?></td>
                     </tr>
                     <tr>
                         <td>Telepon</td>
                         <td><?php echo $hasil['telepon']; ?></td>
                     </tr>
                     <tr>
                         <td>Email</td>
                         <td><?php echo $hasil['email']; ?></td>
                     </tr>
                     <tr>
                         <td>NIK</td>
                         <td><?php echo $hasil['NIK']; ?></td>
                     </tr>
                 </table>
                 <div class="clearfix" style="padding-top:16%;"></div>
             </div>


             <div class="col-lg-6 main-chart">
                 <form method="POST" action="fungsi/tambah/tambah.php?akun=tambah">
                     <div>
                         <label>Username</label>
                         <input type="text" class="form-control" readonly name="user"
                             placeholder="Masukan Username" value="<?php echo $hasil['user']; ?>">
                         <label style="margin-top: 3%;">Password</label>
                         <input type="password" class="form-control" readonly name="pass"
                             placeholder="Masukan Password" value="<?php echo $hasil['pass']; ?>">
                         <label style="margin-top: 3%;">ID Member</label>
									
                         <input type="text" class="form-control" readonly name="id"
                             value="<?php echo $hasil['id_member']; ?>">
                     </div>

                 </form>

             </div>
         </div>
     </section>
 </section>
