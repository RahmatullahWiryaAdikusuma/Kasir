<?php
	$host 	= 'localhost'; // host server
	$user 	= 'root';  // username server
	$pass 	= ''; // password server, kalau pakai xampp kosongin saja
	$dbname = 'db_toko'; // nama database anda
	
  
	try{
		$config = new PDO("mysql:host=$host;dbname=$dbname;", $user,$pass);
		//echo 'sukses';
	}catch(PDOException $e){
		echo 'KONEKSI GAGAL' .$e -> getMessage();
	}
// Proses hapus user
if(isset($_POST['hapus'])) {
    $id = $_POST['id_user'];
    $sql = "DELETE FROM user WHERE id_user = ?";
    $row = $config->prepare($sql);
    $row->execute([$id]);
    header("Location: superuser_dashboard.php");
    exit;
}

// Tambahkan proses edit user
if(isset($_POST['edit'])) {
    $id = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    
    $sql = "UPDATE user SET username=?, nama=?, role=? WHERE id_user=?";
    $row = $config->prepare($sql);
    $row->execute([$username, $nama, $role, $id]);
    header("Location: superuser_dashboard.php");
    exit;
}

// Proses tambah user baru
if(isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password dengan MD5
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    
    // Cek apakah username sudah ada
    $check = $config->prepare("SELECT * FROM user WHERE username = ?");
    $check->execute([$username]);
    
    if($check->rowCount() > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        $sql = "INSERT INTO user (username, password, nama, role) VALUES (?, ?, ?, ?)";
        $row = $config->prepare($sql);
        $row->execute([$username, $password, $nama, $role]);
        
        if($row) {
            echo "<script>alert('User berhasil ditambahkan!');</script>";
            header("Location: superuser_dashboard.php");
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan user!');</script>";
        }
    }
}

// Ambil data user dari database
$sql = "SELECT * FROM user ORDER BY id_user ASC";
$row = $config->prepare($sql);
$row->execute();
$hasil = $row->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superuser Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .modal-dialog {
            max-width: 500px;
        }
        .table-container {
            padding: 20px;
        }
        .navbar {
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            display: flex;
            align-items: center;
        }
        .btn-danger {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Superuser</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link text-light mr-3">Welcome, <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Superuser'; ?></span>
                    </li>
                    <li class="nav-item">
                        <a href="../../logout.php" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan logout?')">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                
                <!-- Tambah tombol untuk membuka modal tambah user -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($hasil as $isi) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['username']; ?></td>
                        <td><?php echo $isi['nama']; ?></td>
                        <td><?php echo $isi['role']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#editModal<?php echo $isi['id_user']; ?>">
                                Edit
                            </button>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="id_user" value="<?php echo $isi['id_user']; ?>">
                                <button type="submit" name="hapus" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?php echo $isi['id_user']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_user" value="<?php echo $isi['id_user']; ?>">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" 
                                                   value="<?php echo $isi['username']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama" 
                                                   value="<?php echo $isi['nama']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role" required>
                                                <option value="superadmin" <?php echo ($isi['role'] == 'superadmin') ? 'selected' : ''; ?>>Superadmin</option>
                                                <option value="admin" <?php echo ($isi['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                <option value="member" <?php echo ($isi['role'] == 'member') ? 'selected' : ''; ?>>Member</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="tambah" class="btn btn-success">Tambah User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.btn-close, [data-dismiss="modal"]').click(function() {
                $('#tambahModal').modal('hide');
            });
        });
    </script>
</body>
</html>
