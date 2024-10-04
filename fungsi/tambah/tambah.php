<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!empty($_SESSION['admin'])){
	require '../../config.php';
	try {
		$config->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Koneksi database gagal: " . $e->getMessage();
		exit;
	}

	if(!empty($_GET['kategori'])){
		$nama= $_POST['kategori'];
		$kode= $_POST['kode_kategori'];
		$tgl= date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $kode;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,kode_kategori,tgl_input) VALUES(?,?,?)';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
	}

	if (isset($_GET['get_produk'])) {
		// Ambil data kode_produk dari tabel produk
		$sql = "SELECT kode_produk, nama_produk FROM produk";
		$stmt = $config->prepare($sql);
		$stmt->execute();
		$produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		// Kembalikan data dalam format JSON
		echo json_encode($produk);
		exit;
	}

	if (isset($_GET['barang']) && $_GET['barang'] == 'getKode') {
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
	    exit;
	}

	if (isset($_GET['produk']) && $_GET['produk'] == 'getLastKodeProduk' && isset($_GET['id_kategori'])) {
	    $id_kategori = $_GET['id_kategori'];
	    $sql = "SELECT kode_produk FROM produk WHERE id_kategori = ? ORDER BY kode_produk DESC LIMIT 1";
	    $stmt = $config->prepare($sql);
	    $stmt->execute([$id_kategori]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	    echo $result ? $result['kode_produk'] : '00'; // Jika tidak ditemukan, kembalikan nilai '00'
	    exit(); // Hentikan eksekusi script setelah menampilkan output
	}

	if (!empty($_GET['produk']) && $_GET['produk'] == 'tambah') {
	    $id_kategori = $_POST['id_kategori'];
	    $nama_produk = $_POST['nama_produk'];
	    $kode_kategori = $_POST['kode_kategori'];

	    // Generate new product code
	    $sql = "SELECT kode_produk FROM produk WHERE id_kategori = ? ORDER BY kode_produk DESC LIMIT 1";
	    $stmt = $config->prepare($sql);
	    $stmt->execute([$id_kategori]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	    if ($result) {
	        $lastKodeProduk = (int)substr($result['kode_produk'], -2);
	        $nextKodeProduk = str_pad($lastKodeProduk + 1, 2, '0', STR_PAD_LEFT);
	    } else {
	        $nextKodeProduk = '01';
	    }

	    $kode_produk = $kode_kategori . $nextKodeProduk;

	    // Debugging
	    echo "id_kategori: $id_kategori<br>";
	    echo "nama_produk: $nama_produk<br>";
	    echo "kode_kategori: $kode_kategori<br>";
	    echo "kode_produk: $kode_produk<br>";

	    if (!empty($id_kategori) && !empty($nama_produk) && !empty($kode_kategori) && !empty($kode_produk)) {
	        $sql = 'INSERT INTO produk (id_kategori, nama_produk, kode_kategori, kode_produk) VALUES (?, ?, ?, ?)';
	        $row = $config->prepare($sql);
	        $row->execute([$id_kategori, $nama_produk, $kode_kategori, $kode_produk]);

	        echo '<script>window.location="../../index.php?page=produk&&success=tambah-data"</script>';
	    } else {
	        echo "Data tidak lengkap.";
	    }
	}

	// Logika untuk tabel barang tetap ada di sini
	if (!empty($_GET['barang']) && $_GET['barang'] == 'tambah') {
	    $id_kategori = $_POST['id_kategori'];
	    $id_produk = $_POST['id_produk'];
	    $kode_produk = $_POST['kode_produk'];
	    $nama_barang = $_POST['nama_barang'];
	    $tipe = $_POST['tipe'];
	    $harga_jual = $_POST['harga_jual'];
	    $stok = $_POST['stok'];
	    $tgl_input = date('Y-m-d H:i:s');
	    $tgl_update = date('Y-m-d H:i:s');

	    // Debugging
	    echo "id_kategori: $id_kategori<br>";
	    echo "id_produk: $id_produk<br>";
	    echo "kode_produk: $kode_produk<br>";
	    echo "nama_barang: $nama_barang<br>";
	    echo "tipe: $tipe<br>";
	    echo "harga_jual: $harga_jual<br>";
	    echo "stok: $stok<br>";

	    if (!empty($id_kategori) && !empty($id_produk) && !empty($kode_produk) && !empty($nama_barang) && !empty($tipe) && !empty($harga_jual) && !empty($stok)) {
	        // Ambil kode_barang terakhir untuk produk yang sama
	        $sql = "SELECT kode_barang FROM barang WHERE id_produk = ? ORDER BY kode_barang DESC LIMIT 1";
	        $stmt = $config->prepare($sql);
	        $stmt->execute([$id_produk]);
	        $result = $stmt->fetch(PDO::FETCH_ASSOC);

	        if ($result) {
	            // Jika ada kode_barang sebelumnya, tambahkan 1
	            $last_kode_barang = $result['kode_barang'];
	            $new_kode_barang = $kode_produk . str_pad((int)substr($last_kode_barang, -2) + 1, 2, '0', STR_PAD_LEFT);
	        } else {
	            // Jika tidak ada, mulai dari 01
	            $new_kode_barang = $kode_produk . '01';
	        }

	        $sql = 'INSERT INTO barang (id_kategori, id_produk, kode_produk, kode_barang, nama_barang, tipe, harga_jual, stok, tgl_input, tgl_update) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
	        $row = $config->prepare($sql);
	        $row->execute([$id_kategori, $id_produk, $kode_produk, $new_kode_barang, $nama_barang, $tipe, $harga_jual, $stok, $tgl_input, $tgl_update]);

	        echo '<script>window.location="../../index.php?page=barang&&success=tambah-data"</script>';
	    } else {
	        echo "Data tidak lengkap.";
	    }
	}

 	
	if(!empty($_GET['member'])){
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		$nik = $_POST['nik'];
		
		$sql = "INSERT INTO member (nm_member,alamat_member,telepon,email,NIK) 
			    VALUES ('$nama','$alamat','$telepon','$email','$nik') ";
		$row = $config -> prepare($sql);
		$row -> execute();
		echo '<script>window.location="../../index.php?page=member&success=tambah-data"</script>';
	}

	if(!empty($_GET['akun'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$id = $_POST['id'];
		
		$enc_pwd = md5($pass);

		$sql = "INSERT INTO login (user,pass,id_member) 
			    VALUES ('$user','$enc_pwd','$id')";
		$row = $config -> prepare($sql);
		$row->execute();
		echo '<script>window.location="../../index.php?page=member&success=tambah-data"</script>';
	}

	
}

if(!empty($_SESSION['pegawai'])){
	require '../../config.php';
	if (!empty($_GET['jual']) && isset($_GET['id']) && isset($_GET['id_kasir']) && isset($_POST['jumlah'])) {
        $id_barang = $_GET['id'];
        $id_kasir = $_GET['id_kasir'];
        $jumlah = $_POST['jumlah'];

        // Kurangi stok barang
        $sql_barang = 'SELECT stok, harga_jual FROM barang WHERE id_barang = ?';
        $row_barang = $config->prepare($sql_barang);
        $row_barang->execute([$id_barang]);
        $barang = $row_barang->fetch();

        if ($barang['stok'] >= $jumlah) {
            $stok_awal = $barang['stok'];
            $stok_baru = $stok_awal - $jumlah;

            // Update stok barang
            $sql_update_stok = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
            $row_update_stok = $config->prepare($sql_update_stok);
            $row_update_stok->execute([$stok_baru, $id_barang]);

            // Hitung total harga
            $total = $barang['harga_jual'] * $jumlah;
            $tgl = date("j F Y, G:i");

            // Tambahkan barang ke keranjang (penjualan)
            $sql_keranjang = 'INSERT INTO penjualan (id_barang, id_member, jumlah, total, tanggal_input, stok_awal) VALUES (?, ?, ?, ?, ?, ?)';
            $row_keranjang = $config->prepare($sql_keranjang);
            $row_keranjang->execute([$id_barang, $id_kasir, $jumlah, $total, $tgl, $stok_awal]);

            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo "Stok tidak mencukupi.";
        }
    }

	require '../../config.php';
	
	

	if (isset($_GET['barang']) && $_GET['barang'] == 'getKode') {
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
	    exit;
	}
}
?>