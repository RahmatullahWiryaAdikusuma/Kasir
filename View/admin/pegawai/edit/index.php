<?php 
// Cek role Admin
if(!isset($_SESSION['Admin'])) {
    echo '<script>alert("Anda tidak memiliki akses!");window.location="index.php"</script>';
    exit;
}

// Ambil id dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$id) {
    echo '<script>alert("ID User tidak valid!");window.location="index.php?page=pegawai"</script>';
    exit;
}

try {
    // Query untuk mendapatkan data user berdasarkan id
    $sql = "SELECT * FROM user WHERE id_user = ?";
    $row = $config->prepare($sql);
    $row->execute(array($id));
    $hasil = $row->fetch();

    // Cek apakah data ditemukan
    if(!$hasil) {
        echo '<script>alert("Data user tidak ditemukan!");window.location="index.php?page=pegawai"</script>';
        exit;
    }
?>

<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <a href="index.php?page=pegawai" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Kembali 
                </a>
                <h3>Edit Data User: <?php echo $hasil['nama']; ?></h3>
            </div>

            <div class="col-lg-12 main-chart">
                <div class="col-lg-6">
                    <form action="fungsi/edit/edit.php?Member=edit" method="POST">
                        <input type="hidden" name="id" value="<?php echo $hasil['id_user'];?>">
                        <input type="hidden" name="username" value="<?php echo $hasil['username'];?>">
                        <table class="table table-striped">
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" value="<?php echo $hasil['nama'];?>" name="nama" required></td>
                            </tr>
                            <tr>
                                <td>Password Baru</td>
                                <td><input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="email" class="form-control" value="<?php echo $hasil['email'];?>" name="email" required></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td><input type="text" class="form-control" value="<?php echo $hasil['no_telp'];?>" name="no_telp"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><textarea name="alamat" class="form-control"><?php echo $hasil['alamat'];?></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-edit"></i> Update Data
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>

<?php 
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
