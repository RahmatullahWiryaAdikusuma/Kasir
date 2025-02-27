<?php
// Cek role Admin
if(!isset($_SESSION['Admin'])) {
    echo '<script>alert("Anda tidak memiliki akses!");window.location="index.php"</script>';
    exit;
}
?>

<section id="main-content">
<section class="wrapper">

<h2>Data User</h2>

<button type="button" class="btn btn-primary btn-md" style="margin-bottom: 10px;" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus"></i> Tambah User
</button>

<?php 
try {
    $sql = "SELECT id_user, username, nama, role, alamat, no_telp, email 
            FROM user 
            where role = 'Member'
            ORDER BY id_user DESC";
    $row = $config->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();

    if(count($hasil) > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr style="background:#DFF0D8;color:#333;">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($hasil as $isi){ ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $isi['nama']; ?></td>
                            <td><?php echo $isi['email']; ?></td>
                            <td><?php echo $isi['no_telp']; ?></td>
                            <td><?php echo $isi['alamat']; ?></td>
                            <td>
                                <a href="index.php?page=pegawai/edit&id=<?php echo $isi['id_user'];?>" 
                                   class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="fungsi/hapus/hapus.php?pegawai=hapus&id=<?php echo $isi['id_user'];?>" 
                                   onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                   class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning">
            Tidak ada data user yang ditemukan
        </div>
    <?php }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius:0px;">
            <div class="modal-header" style="background:#F90000;color:#fff;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah User</h4>
            </div>
            <form action="fungsi/tambah/tambah.php?user=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="text" placeholder="Masukkan username" required 
                                    class="form-control" name="username">
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="password" placeholder="Masukkan password" required 
                                    class="form-control" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>
                                <input type="text" placeholder="Masukkan nama lengkap" required 
                                    class="form-control" name="nama">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="email" placeholder="Masukkan email" required 
                                    class="form-control" name="email">
                            </td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>
                                <input type="text" placeholder="Masukkan nomor telepon" required 
                                    class="form-control" name="no_telp">
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <textarea placeholder="Masukkan alamat" required 
                                    class="form-control" name="alamat" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>
                                <input type="text" class="form-control" name="role" value="Member" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Foto</td>
                            <td>
                                <input type="file" name="gambar" class="form-control" required accept="image/*">
                                <small class="text-muted">Upload foto dengan format JPG/PNG</small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Insert Data
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
</section>

