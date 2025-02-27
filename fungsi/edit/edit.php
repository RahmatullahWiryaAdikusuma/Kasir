<?php 
session_start();
if(!empty($_SESSION['Admin'])){
	require '../../config.php';
	if(!empty($_GET['pengaturan'])){
		$nama= htmlentities($_POST['namatoko']);
		$alamat = htmlentities($_POST['alamat']);
		$kontak = htmlentities($_POST['kontak']);
		$pemilik = htmlentities($_POST['pemilik']);
		$id = '1';
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $kontak;
		$data[] = $pemilik;
		$data[] = $id;
		$sql = 'UPDATE toko SET nama_toko=?, alamat_toko=?, tlp=?, nama_pemilik=? WHERE id_toko = ?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if(!empty($_GET['kategori'])){
		$nama= htmlentities($_POST['kategori']);
		$id= htmlentities($_POST['id']);
		$data[] = $nama;
		$data[] = $id;
		$sql = 'UPDATE kategori SET  nama_kategori=? WHERE id_kategori=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&uid='.$id.'&success-edit=edit-data"</script>';
	}

	// if(!empty($_GET['stok'])){
	// 	$restok = htmlentities($_POST['restok']);
	// 	$id = htmlentities($_POST['id']);
	// 	$dataS[] = $id;
	// 	$sqlS = 'select*from barang WHERE id_barang=?';
	// 	$rowS = $config -> prepare($sqlS);
	// 	$rowS -> execute($dataS);
	// 	$hasil = $rowS -> fetch();
		
	// 	$stok = $restok + $hasil['stok'];
		
	// 	$data[] = $stok;
	// 	$data[] = $id;
	// 	$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
	// 	$row = $config -> prepare($sql);
	// 	$row -> execute($data);
	// 	echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	// }


	if ($_GET['barang'] == 'edit') {
		try {
			$id_barang = htmlspecialchars($_POST['id_barang']);
			$id_kategori = htmlspecialchars($_POST['id_kategori']);
			$id_produk = htmlspecialchars($_POST['id_produk']);
			$id_satuan = htmlspecialchars($_POST['id_satuan']);
			$kode_barang = htmlspecialchars($_POST['kode_barang']);
			$nama_barang = htmlspecialchars($_POST['nama_barang']);
			$jual = htmlspecialchars($_POST['harga_jual']);
			$stok = htmlspecialchars($_POST['stok']);
			$tgl_update = date("Y-m-d");

			// Debug
			error_log("Updating barang with ID: " . $id_barang);
			error_log("POST Data: " . print_r($_POST, true));
			
			// Update data barang
			$sql = "UPDATE barang SET 
					id_kategori = ?,
					id_produk = ?,
					id_satuan = ?,
					kode_barang = ?,
					nama_barang = ?,
					harga_jual = ?,
					stok = ?,
					tgl_update = ?
					WHERE id_barang = ?";
					
			$stmt = $config->prepare($sql);
			$result = $stmt->execute([
				$id_kategori,
				$id_produk,
				$id_satuan,
				$kode_barang,
				$nama_barang,
				$jual,
				$stok,
				$tgl_update,
				$id_barang
			]);

			if ($result) {
				echo '<script>
					alert("Edit Data Berhasil"); 
					window.location="../../index.php?page=barang";
				</script>';
			} else {
				throw new Exception("Gagal mengupdate data barang");
			}
		} catch (PDOException $e) {
			error_log("Database Error: " . $e->getMessage());
			echo '<script>
				alert("Error: ' . $e->getMessage() . '");
				window.location="../../index.php?page=barang";
			</script>';
		} catch (Exception $e) {
			error_log("General Error: " . $e->getMessage());
			echo '<script>
				alert("Error: ' . $e->getMessage() . '");
				window.location="../../index.php?page=barang";
			</script>';
		}
	}

	if ($_GET['produk'] == 'edit') {
		require '../../config.php'; // Load konfigurasi database
	
		// Proses penyimpanan data
		if ($_GET['produk'] == 'edit') {
			// Ambil data dari form
			$id_produk = $_POST['id']; // Use 'id' as per the form
			$nama_produk = $_POST['nama'];
			$kode_produk = $_POST['kode'];
			$kategori = $_POST['kategori'];
			

			// Debugging: Tampilkan data yang diterima dari form
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";

			// Cek apakah id_produk null
			if (is_null($id_produk) || empty($id_produk)) {
				die("Error: id_produk tidak boleh null atau kosong.");
			}

			try {
				// Mulai transaksi
				$config->beginTransaction();

				// Update data ke tabel produk
				$sql_produk = 'UPDATE produk SET nama_produk=?, kode_produk=?, id_kategori=? WHERE id_produk=?';
				$data_produk = [$nama_produk, $kode_produk, $kategori, $id_produk];
				$row_produk = $config->prepare($sql_produk);
				$row_produk->execute($data_produk);

				// Commit transaksi
				$config->commit();

				echo "Data produk berhasil disimpan.<br>";
				echo '<script>window.location="../../index.php?page=produk&success=edit-data"</script>';
			} catch (Exception $e) {
				// Rollback jika terjadi kesalahan
				$config->rollBack();
				echo "Gagal menyimpan data: " . $e->getMessage();
			}
		}
	}

	if(!empty($_GET['gambar'])){
		$id = htmlentities($_POST['id']);
		set_time_limit(0);
		$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
		
		if ($_FILES['foto']["error"] > 0) {
			$output['error']= "Error in File";
		} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
			echo "You can only upload JPG, PNG and GIF file";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
			echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

		}else{
			$target_path = '../../assets/img/user/';
			$target_path = $target_path . basename( $_FILES['foto']['name']); 
			if (file_exists("$target_path")){ 
				echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
				<br> Silahkan Rename File terlebih dahulu<br>";

			echo "<font face='Verdana' size='2' ><BR><BR><BR>
					<a href='../../index.php?page=user'>Back to upform</a><BR>";

				}elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)){
					//post foto lama
				$foto2 = $_POST['foto2'];
				//remove foto di direktori
				unlink('../../assets/img/user/'.$foto2.'');
				//input foto
				$id = $_POST['id'];
				$data[] = $_FILES['foto']['name'];
				$data[] = $id;
				$sql = 'UPDATE user SET gambar=?  WHERE user.id_user=? where role = "Admin"';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			}
		}
	}

	if(!empty($_GET['Member'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$username = htmlentities($_POST['username']);
		$password = htmlentities($_POST['password']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['no_telp']);
		$email = htmlentities($_POST['email']);
		
		try {
			// Update data user
			if(!empty($password)) {
				// Jika password diisi, update password juga
				$enc_password = md5($password);
				$sql = 'UPDATE user SET nama=?, alamat=?, no_telp=?, email=?, password=? WHERE id_user=?';
				$row = $config->prepare($sql);
				$row->execute([$nama, $alamat, $tlp, $email, $enc_password, $id]);
			} else {
				// Jika password kosong, update tanpa password
				$sql = 'UPDATE user SET nama=?, alamat=?, no_telp=?, email=? WHERE id_user=?';
				$row = $config->prepare($sql);
				$row->execute([$nama, $alamat, $tlp, $email, $id]);
			}
			
			echo '<script>alert("Data berhasil diupdate!");
				  window.location="../../index.php?page=pegawai"</script>';
		} catch(PDOException $e) {
			echo '<script>alert("Gagal mengupdate data: ' . $e->getMessage() . '");
				  window.location="../../index.php?page=pegawai"</script>';
		}
	}

	if(!empty($_GET['akun'])){
		$username = htmlentities($_POST['username']);
		$password = htmlentities($_POST['password']);
		$id = htmlentities($_POST['id']);
		$enc_pwd = md5($password);
		
		$data[] = $username;
		$data[] = $enc_pwd;
		$sql = 'UPDATE login SET username=?,password=?,id_user=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=pegawai&success=edit-data"</script>';
	}

	if(!empty($_GET['profil'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['no_telp']);
		$email = htmlentities($_POST['email']);

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $id;
		$sql = 'UPDATE user SET nama=?,alamat=?,no_telp=?,email=? WHERE id_user=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
}

if(!empty($_SESSION['Member'])){
	require '../../config.php';
	if(!empty($_GET['jual'])){
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlah']);
		
		$sql_tampil = "select *from barang where barang.id_barang=?";
		$row_tampil = $config -> prepare($sql_tampil);
		$row_tampil -> execute(array($id_barang));
		$hasil = $row_tampil -> fetch();

		$jual = $hasil['harga_jual'];
			$total = $jual * $jumlah;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);
			echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
	}

	if(!empty($_GET['Superuser'])){
		$id = htmlentities($_POST['id']);
		$username = htmlentities($_POST['username']);
		$nama = htmlentities($_POST['nama']);
		$role = htmlentities($_POST['role']);
		
		$data[] = $username;
		$data[] = $nama;
		$data[] = $role;
		$data[] = $id;
		$sql = 'UPDATE user SET username=?,nama=?,role=? WHERE id_user=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=superuser&success=edit-data"</script>';
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id_user = $_POST['id_user'];
		$username = $_POST['username'];
		$nama = $_POST['nama'];
		$role = $_POST['role'];
	
		$sql = "UPDATE user SET username = ?, nama = ?, role = ? WHERE id_user = ?";
		$row = $config->prepare($sql);
		$row->execute([$username, $nama, $role, $id_user]);
	
		// Redirect kembali ke halaman dashboard
		header("Location: ../../superuser_dashboard.php");
		exit;
	}
}

if(!empty($_GET['satuan'])){
	$id = $_POST['id_satuan'];
	$satuan = htmlspecialchars($_POST['satuan']);
	
	try {
		$sql = 'UPDATE satuan SET satuan=? WHERE id_satuan=?';
		$row = $config->prepare($sql);
		$row->execute(array($satuan, $id));
		
		echo '<script>window.location="../../index.php?page=satuan&success-edit=edit-data"</script>';
	} catch(PDOException $e) {
		echo '<script>alert("Gagal mengupdate data: ' . $e->getMessage() . '");
			  window.location="../../index.php?page=satuan"</script>';
	}
}
