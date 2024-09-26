<?php 
session_start();
if(!empty($_SESSION['admin'])){
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
		require '../../config.php'; // Load konfigurasi database
	
		// Jika permintaan adalah untuk mendapatkan kode_produk berdasarkan id_produk
		if ($_GET['barang'] == 'getKode' && isset($_GET['id_produk'])) {
			$id_kategori = $_GET['id_kategori'];
			$id_produk = $_GET['id_produk'];
			$sql = "SELECT kode_produk FROM produk WHERE id_produk = ?";
			$stmt = $config->prepare($sql);
			$stmt->execute([$id_produk]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($result) {
				echo $result['kode_produk'];
			} else {
				echo ''; // Jika tidak ditemukan, kembalikan nilai kosong
			}
			exit(); // Hentikan eksekusi script setelah menampilkan output
		}
	
		// Proses penyimpanan data
		if ($_GET['barang'] == 'edit') {
			// Ambil data dari form
			$id_kategori = $_POST['id_kategori'];
			$id_produk = $_POST['id_produk']; // Ambil id_produk dari form
			$nama_barang = $_POST['nama_barang'];
			$tipe = $_POST['tipe'];
			$jual = $_POST['harga_jual'];
			$stok = $_POST['stok'];
			$tgl_input = date("Y-m-d H:i:s");
			$tgl_update = date("Y-m-d H:i:s");

			// Debugging: Tampilkan data yang diterima dari form
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";

			// Cek apakah id_produk null
			if (is_null($id_produk) || empty($id_produk)) {
				die("Error: id_produk tidak boleh null atau kosong.");
			}

			try {
				// Ambil kode_produk berdasarkan id_produk
				$sql_fetch_kode = "SELECT kode_produk FROM produk WHERE id_produk = ?";
				$stmt_fetch_kode = $config->prepare($sql_fetch_kode);
				$stmt_fetch_kode->execute([$id_produk]);
				$result_fetch_kode = $stmt_fetch_kode->fetch(PDO::FETCH_ASSOC);

				if (!$result_fetch_kode) {
					die("Error: id_produk tidak ditemukan di tabel produk.");
				}

				$kode_produk = $result_fetch_kode['kode_produk'];

				// Mulai transaksi
				$config->beginTransaction();

				// Update data ke tabel barang
				$sql_barang = 'UPDATE barang SET id_kategori=?, id_produk=?, nama_barang=?, tipe=?, harga_jual=?, stok=?, tgl_input=?, tgl_update=? WHERE id_barang=?';
				$data_barang = [$id_kategori, $id_produk, $nama_barang, $tipe, $jual, $stok, $tgl_input, $tgl_update, $id_produk]; // Pastikan id_barang diisi dengan benar
				$row_barang = $config->prepare($sql_barang);
				$row_barang->execute($data_barang);

				// Commit transaksi
				$config->commit();

				echo "Data barang berhasil disimpan.<br>";
				echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
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
				$sql = 'UPDATE member SET gambar=?  WHERE member.id_member=?';
				$row = $config -> prepare($sql);
				$row -> execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			}
		}
	}

	if(!empty($_GET['member'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['telepon']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=member&success=edit-data"</script>';
	}

	if(!empty($_GET['akun'])){
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);
		$id = htmlentities($_POST['id']);
		$enc_pwd = md5($pass);
		
		$data[] = $user;
		$data[] = $enc_pwd;
		$sql = 'UPDATE login SET user=?,pass=?,id_member=? WHERE id_login=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=member&success=edit-data"</script>';
	}

	if(!empty($_GET['profil'])){
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$tlp = htmlentities($_POST['tlp']);
		$email = htmlentities($_POST['email']);
		$nik = htmlentities($_POST['nik']);
		
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $tlp;
		$data[] = $email;
		$data[] = $nik;
		$data[] = $id;
		$sql = 'UPDATE member SET nm_member=?,alamat_member=?,telepon=?,email=?,NIK=? WHERE id_member=?';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
}
if(!empty($_SESSION['pegawai'])){
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
}