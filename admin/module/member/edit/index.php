
      <?php 
	$id = $_GET['member'];
	$hasil = $lihat -> member_edit2($id);
?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
				<div class="col-lg-12 main-chart">
				<a href="index.php?page=member"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Edit Member</h3>
						<div class="row">
                 <div class="col-lg-6">
                     <h3>Details Member</h3>
                 </div>
                 <div class="col-lg-6">
                     <h3>Member Login Akun</h3>
                 </div>
             </div>
				</div>
                  <div class="col-lg-6 main-chart">
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

						<table class="table table-striped">
							<form action="fungsi/edit/edit.php?member=edit" method="POST">
								<tr>
									<td>ID Menu</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_member'];?>" name="id"></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['nm_member'];?>" name="nama"></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['alamat_member'];?>" name="alamat"></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['telepon'];?>" name="telepon"></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['email'];?>" name="email"></td>
								</tr>
								<tr>
									<td>NIK</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['NIK'];?>" name="nik"></td>
								</tr>

								<tr>
									<td>Tanggal Update</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
								</tr>
								<tr>
									<td></td>
									<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data Member</button></td>
								</tr>
							</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>

				  <div class="col-lg-6 main-chart">
                 <form method="POST" action="fungsi/tambah/tambah.php?akun=edit">
                     <div>
                         <label>Username</label>
                         <input type="text" class="form-control" required name="user"
                             placeholder="Masukan Username" value="<?php echo $hasil['user']; ?>">
                         <label style="margin-top: 3%;">Password</label>
                         <input type="password" class="form-control" required name="pass"
                             placeholder="Masukan Password" value="<?php echo $hasil['pass']; ?>">
                         <label style="margin-top: 3%;">ID Member</label>
                         <input type="text" class="form-control" readonly name="id"
                             value="<?php echo $hasil['id_member']; ?>">


                         <center>
                             <button id="tombol-simpan" class="btn btn-primary" style="margin-top: 3%;"><i
                                     class="fa fa-plus"></i> Tambah Member Login</button>
                         </center>
                     </div>

                 </form>

             </div>
              </div>
          </section>
      </section>
