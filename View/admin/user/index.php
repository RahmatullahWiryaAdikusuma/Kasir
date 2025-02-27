<?php 

// Cek role Admin
if(!isset($_SESSION['Admin'])) {
    echo '<script>alert("Anda tidak memiliki akses!");window.location="index.php"</script>';
    exit;
}

// Ambil data Admin
try {
    $sql = "SELECT * FROM user WHERE role = 'Admin' LIMIT 1";
    $row = $config->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
?>

<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Profil Pengguna</h3>
                <br>
                <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success">
                    <p>Edit Data Berhasil!</p>
                </div>
                <?php }?>
                
                <div class="row">
                    <!-- Kolom Foto -->
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-user"></i> Foto Profil</h4>
                            </div>
                            <div class="panel-body">
                                <center>
                                    <img src="assets/img/user/<?php echo !empty($hasil['gambar']) ? $hasil['gambar'] : 'default.jpg'; ?>" 
                                         class="img-circle" style="border: 3px solid #888;" width="200" height="200"/>
                                </center>
                                <br/>
                                <form action="fungsi/edit/edit.php?gambar=edit" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="foto" class="form-control" required>
                                    <input type="hidden" name="foto2" value="<?php echo $hasil['gambar'];?>">
                                    <input type="hidden" name="id" value="<?php echo $hasil['id_user'];?>">
                                    <br/>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-image"></i> Ganti Foto
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kolom Data Profil -->
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-user"></i> Data Profil</h4>
                            </div>
                            <div class="panel-body">
                                <form action="fungsi/edit/edit.php?profil=edit" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $hasil['id_user'];?>">
                                    
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="nama" 
                                                   value="<?php echo $hasil['nama'];?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control" name="email" 
                                                   value="<?php echo $hasil['email'];?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" name="no_telp" 
                                                   value="<?php echo $hasil['no_telp'];?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="3" required><?php echo $hasil['alamat'];?></textarea>
                                    </div>

                                    <button class="btn btn-primary pull-right" type="submit">
                                        <i class="fa fa-pencil"></i> Update Profil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php 
} catch(PDOException $e) {
    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
}
?>
	
