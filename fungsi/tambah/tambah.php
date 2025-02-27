<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!empty($_SESSION['Admin'])){
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
		$sql = "SELECT kode_produk, nama_produk FROM produk";
		$stmt = $config->prepare($sql);
		$stmt->execute();
		$produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
	        echo '';
	    }
	    exit;
	}

	if (isset($_GET['produk']) && $_GET['produk'] == 'getLastKodeProduk' && isset($_GET['id_kategori'])) {
	    $id_kategori = $_GET['id_kategori'];
	    $sql = "SELECT kode_produk FROM produk WHERE id_kategori = ? ORDER BY kode_produk DESC LIMIT 1";
	    $stmt = $config->prepare($sql);
	    $stmt->execute([$id_kategori]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	    echo $result ? $result['kode_produk'] : '00';
	    exit();
	}

	if (!empty($_GET['produk']) && $_GET['produk'] == 'tambah') {
	    // Validate that all required fields are present
	    if (!isset($_POST['id_kategori']) || !isset($_POST['nama_produk']) || !isset($_POST['kode_kategori'])) {
	        echo "Data tidak lengkap.";
	        exit;
	    }

	    $id_kategori = $_POST['id_kategori'];
	    $nama_produk = $_POST['nama_produk'];
	    $kode_kategori = $_POST['kode_kategori'];

	    // Get the last product code for this category
	    $sql = "SELECT kode_produk FROM produk WHERE id_kategori = ? ORDER BY kode_produk DESC LIMIT 1";
	    $stmt = $config->prepare($sql);
	    $stmt->execute([$id_kategori]);
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	    // Generate new product code
	    if ($result) {
	        $lastKodeProduk = (int)substr($result['kode_produk'], -2);
	        $nextKodeProduk = str_pad($lastKodeProduk + 1, 2, '0', STR_PAD_LEFT);
	    } else {
	        $nextKodeProduk = '01';
	    }

	    $kode_produk = $kode_kategori . $nextKodeProduk;

	    // Insert new product with all required fields
	    $sql = 'INSERT INTO produk (id_kategori, nama_produk, kode_kategori, kode_produk) VALUES (?, ?, ?, ?)';
	    $row = $config->prepare($sql);
	    
	    try {
	        $row->execute([$id_kategori, $nama_produk, $kode_kategori, $kode_produk]);
	        echo '<script>window.location="../../index.php?page=produk&&success=tambah-data"</script>';
	    } catch (PDOException $e) {
	        echo "Error: " . $e->getMessage();
	    }
	}

	if (!empty($_GET['barang']) && $_GET['barang'] == 'tambah') {
	    $id_kategori = $_POST['id_kategori'];
	    $id_produk = $_POST['id_produk'];
	    $id_satuan = $_POST['id_satuan'];
	    $kode_produk = $_POST['kode_produk'];
	    $nama_barang = $_POST['nama_barang'];
	    $harga_jual = $_POST['harga_jual'];
	    $stok = $_POST['stok'];
	    $tgl_input = date('Y-m-d H:i:s');
	    $tgl_update = date('Y-m-d H:i:s');

	    // Validasi semua field yang diperlukan
	    if (!empty($id_kategori) && !empty($id_produk) && !empty($kode_produk) && 
	        !empty($nama_barang) && !empty($id_satuan) && !empty($harga_jual) && !empty($stok)) {
	        
	        // Generate kode barang baru
	        $sql = "SELECT kode_barang FROM barang WHERE id_produk = ? ORDER BY kode_barang DESC LIMIT 1";
	        $stmt = $config->prepare($sql);
	        $stmt->execute([$id_produk]);
	        $result = $stmt->fetch(PDO::FETCH_ASSOC);

	        if ($result) {
	            $last_kode_barang = $result['kode_barang'];
	            $new_kode_barang = $kode_produk . str_pad((int)substr($last_kode_barang, -2) + 1, 2, '0', STR_PAD_LEFT);
	        } else {
	            $new_kode_barang = $kode_produk . '01';
	        }

	        // Insert data barang baru
	        $sql = 'INSERT INTO barang (id_kategori, id_produk, id_satuan, kode_produk, kode_barang, 
	                nama_barang, harga_jual, stok, tgl_input, tgl_update) 
	                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
	        $row = $config->prepare($sql);
	        
	        try {
	            $row->execute([
	                $id_kategori, 
	                $id_produk, 
	                $id_satuan,
	                $kode_produk,
	                $new_kode_barang,
	                $nama_barang,
	                $harga_jual,
	                $stok,
	                $tgl_input,
	                $tgl_update
	            ]);
	            
	            echo '<script>window.location="../../index.php?page=barang&&success=tambah-data"</script>';
	        } catch (PDOException $e) {
	            echo "Error: " . $e->getMessage();
	        }
	    } else {
	        echo "Data tidak lengkap. Pastikan semua field terisi.";
	    }
	}

	if(!empty($_GET['user']) && $_GET['user'] == 'tambah'){
		// Debug untuk melihat data yang diterima
		// echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		
		$username = htmlspecialchars($_POST['username']);
		$password = md5($_POST['password']); 
		$nama = htmlspecialchars($_POST['nama']);
		$email = htmlspecialchars($_POST['email']);
		$no_telp = htmlspecialchars($_POST['no_telp']);
		$alamat = htmlspecialchars($_POST['alamat']);
		$role = 'Member'; // Set langsung sebagai Member

		try {
			// Cek apakah username sudah ada
			$sql_check = "SELECT username FROM user WHERE username = ?";
			$row_check = $config->prepare($sql_check);
			$row_check->execute([$username]);

			if($row_check->rowCount() > 0) {
				echo '<script>alert("Username sudah digunakan!");
					  window.location="../../index.php?page=pegawai"</script>';
			} else {
				// Insert data user baru dengan prepared statement
				$sql = "INSERT INTO user (username, password, nama, email, no_telp, alamat, role) 
						VALUES (:username, :password, :nama, :email, :no_telp, :alamat, :role)";
				$stmt = $config->prepare($sql);
				
				// Bind parameter
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':nama', $nama);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':no_telp', $no_telp);
				$stmt->bindParam(':alamat', $alamat);
				$stmt->bindParam(':role', $role);
				
				// Eksekusi query
				if($stmt->execute()) {
					echo '<script>alert("Data berhasil ditambahkan!");
						  window.location="../../index.php?page=pegawai"</script>';
				} else {
					echo '<script>alert("Gagal menambahkan data!");
						  window.location="../../index.php?page=pegawai"</script>';
				}
			}
		} catch(PDOException $e) {
			// Tampilkan pesan error yang lebih detail
			echo '<script>alert("Error: ' . $e->getMessage() . '");
				  window.location="../../index.php?page=pegawai"</script>';
		}
	}

	// Query untuk upload gambar
	if(!empty($_GET['user']) && $_GET['user'] == 'upload'){
		// Debug untuk melihat file yang diupload
		// var_dump($_FILES); exit;
		
		if(!isset($_FILES['foto'])) {
			echo '<script>alert("Tidak ada file yang diupload!");
				  window.location="../../index.php?page=profil"</script>';
			exit;
		}

		// Handle file upload
		$gambar = $_FILES['foto']['name'];
		$tmp = $_FILES['foto']['tmp_name'];
		$tipe = $_FILES['foto']['type'];
		$size = $_FILES['foto']['size'];
		$error = $_FILES['foto']['error'];

		// Cek error upload
		if($error !== UPLOAD_ERR_OK) {
			$message = match($error) {
				UPLOAD_ERR_INI_SIZE => "Ukuran file terlalu besar",
				UPLOAD_ERR_FORM_SIZE => "Ukuran file terlalu besar",
				UPLOAD_ERR_PARTIAL => "File hanya terupload sebagian",
				UPLOAD_ERR_NO_FILE => "Tidak ada file yang diupload",
				default => "Terjadi kesalahan saat upload"
			};
			echo '<script>alert("' . $message . '");
				  window.location="../../index.php?page=profil"</script>';
			exit;
		}

		// Set allowed file types
		$allowed = array('image/jpeg', 'image/png', 'image/jpg');
		
		if(!in_array($tipe, $allowed)) {
			echo '<script>alert("Format file tidak diizinkan! Gunakan JPG/PNG.");
				  window.location="../../index.php?page=profil"</script>';
			exit;
		}

		// Generate unique filename
		$nama_file = time() . '_' . str_replace(' ', '_', $gambar);
		
		try {
			// Upload file
			$upload_path = '../../assets/img/user/';
			
			// Pastikan direktori upload ada dan bisa ditulis
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, true);
			}
			
			if(!is_writable($upload_path)) {
				echo '<script>alert("Direktori upload tidak bisa ditulis!");
					  window.location="../../index.php?page=profil"</script>';
				exit;
			}

			// Hapus foto lama jika ada
			if(!empty($_POST['foto2'])) {
				$foto_lama = $upload_path . $_POST['foto2'];
				if(file_exists($foto_lama) && $_POST['foto2'] != 'default.jpg') {
					unlink($foto_lama);
				}
			}

			if(move_uploaded_file($tmp, $upload_path . $nama_file)) {
				// Update data user dengan gambar baru
				$sql = "UPDATE user SET gambar = :gambar WHERE id_user = :id_user";
				$stmt = $config->prepare($sql);
				$stmt->bindParam(':gambar', $nama_file);
				$stmt->bindParam(':id_user', $_POST['id']);
				
				if($stmt->execute()) {
					echo '<script>alert("Foto berhasil diupload!");
						  window.location="../../index.php?page=user"</script>';
				} else {
					unlink($upload_path . $nama_file);
					echo '<script>alert("Gagal mengupdate data foto!");
						  window.location="../../index.php?page=user"</script>';
				}
			} else {
				echo '<script>alert("Gagal mengupload file! Error: ' . error_get_last()['message'] . '");
					  window.location="../../index.php?page=user"</script>';
			}
		} catch(PDOException $e) {
			if(isset($nama_file) && file_exists($upload_path . $nama_file)) {
				unlink($upload_path . $nama_file);
			}
			echo '<script>alert("Error Database: ' . $e->getMessage() . '");
				  window.location="../../index.php?page=user"</script>';
		}
	}

	if(!empty($_GET['satuan'])){
		$satuan = htmlspecialchars($_POST['satuan']);

		try {
			$sql = 'INSERT INTO satuan (satuan) VALUES (?)';
			$row = $config->prepare($sql);
			$row->execute(array($satuan));
			
			echo '<script>window.location="../../index.php?page=satuan&success=tambah-data"</script>';
		} catch(PDOException $e) {
			echo '<script>alert("Gagal menambah data: ' . $e->getMessage() . '");
				  window.location="../../index.php?page=satuan"</script>';
		}
	}
}

if(!empty($_SESSION['Member'])){
	require '../../config.php';
	
	// Hapus debug session
	// echo "Session Data:<br>";
	// print_r($_SESSION);
	// echo "<br><br>";
	
	// Handle pembayaran dan generate nota
	if(isset($_GET['bayar'])) {
		try {
			$config->beginTransaction();
			
			// Generate kode nota baru
			$query = "SELECT MAX(CAST(SUBSTRING(kode_nota, 3) AS UNSIGNED)) as max_num 
					 FROM nota";
			$stmt = $config->prepare($query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$next_num = (empty($result['max_num']) || $result['max_num'] === null) ? 1 : ((int)$result['max_num'] + 1);
			$kode_nota = 'TR' . str_pad($next_num, 4, '0', STR_PAD_LEFT);
			
			// Ambil semua item dari keranjang (tabel penjualan) yang belum memiliki kode_nota
			$sql_keranjang = "SELECT * FROM penjualan WHERE id_user = ? AND kode_nota IS NULL";
			$row_keranjang = $config->prepare($sql_keranjang);
			$row_keranjang->execute([$_SESSION['id_user']]);
			$items = $row_keranjang->fetchAll();
			
			$periode = date('m-Y');
			
			// Pindahkan setiap item ke tabel nota
			foreach($items as $item) {
				$sql_nota = 'INSERT INTO nota (id_barang, id_produk, id_user, id_satuan, jumlah, total, tanggal_input, periode, kode_nota) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
				$row_nota = $config->prepare($sql_nota);
				$row_nota->execute([
					$item['id_barang'],
					$item['id_produk'],
					$item['id_user'],
					$item['id_satuan'],
					$item['jumlah'],
					$item['total'],
					$item['tanggal_input'],
					$periode,
					$kode_nota
				]);
			}
			
			// Hapus item dari keranjang
			$sql_delete = "DELETE FROM penjualan WHERE id_user = ? AND kode_nota IS NULL";
			$row_delete = $config->prepare($sql_delete);
			$row_delete->execute([$_SESSION['id_user']]);
			
			$config->commit();
			
			// Simpan kode_nota ke session untuk digunakan di print.php
			$_SESSION['kode_nota'] = $kode_nota;
			
			echo '<script>window.location="../../print.php?kode_nota='.$kode_nota.'"</script>';
			
		} catch (PDOException $e) {
			$config->rollBack();
			echo "Error Database: " . $e->getMessage();
			exit;
		}
	}
	
	// Handle penambahan barang ke keranjang
	if (!empty($_GET['jual']) && isset($_GET['id']) && isset($_POST['jumlah'])) {
		$id_barang = $_GET['id'];
		
		if (!isset($_SESSION['id_user'])) {
			echo '<script>alert("Session tidak valid. Silakan login ulang.");
				  window.location="../../login.php";</script>';
			exit;
		}
		
		$id_user = $_SESSION['id_user'];
		$jumlah = $_POST['jumlah'];

		// Ambil data barang dan produk
		$sql_barang = 'SELECT b.*, p.id_produk, p.nama_produk 
					  FROM barang b 
					  LEFT JOIN produk p ON b.id_produk = p.id_produk 
					  WHERE b.id_barang = ?';
		$row_barang = $config->prepare($sql_barang);
		$row_barang->execute([$id_barang]);
		$barang = $row_barang->fetch();

		if ($barang && $barang['stok'] >= $jumlah) {
			try {
				$config->beginTransaction();
				
				$stok_awal = $barang['stok'];
				$stok_baru = $stok_awal - $jumlah;
				$id_produk = $barang['id_produk'];

				// Update stok barang
				$sql_update_stok = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
				$row_update_stok = $config->prepare($sql_update_stok);
				$row_update_stok->execute([$stok_baru, $id_barang]);

				// Hitung total harga
				$total = $barang['harga_jual'] * $jumlah;
				$tgl = date("Y-m-d H:i:s");

				// Tambahkan ke keranjang tanpa kode_nota
				$sql_keranjang = 'INSERT INTO penjualan (id_barang, id_produk, id_user, jumlah, total, tanggal_input) 
								 VALUES (?, ?, ?, ?, ?, ?)';
				$row_keranjang = $config->prepare($sql_keranjang);
				$result = $row_keranjang->execute([$id_barang, $id_produk, $id_user, $jumlah, $total, $tgl]);

				if ($result) {
					$config->commit();
					echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
				} else {
					throw new PDOException("Gagal insert data penjualan");
				}
			} catch (PDOException $e) {
				$config->rollBack();
				echo "Error Database: " . $e->getMessage();
				exit;
			}
		} else {
			echo '<script>alert("Stok tidak mencukupi.");window.location="../../index.php?page=jual"</script>';
		}
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
			echo '';
		}
		exit;
	}
}

if(!empty($_GET['jual'])){
    require '../../config.php';
    
    // Pastikan semua data yang diperlukan tersedia
    if(isset($_GET['id']) && isset($_POST['jumlah'])) {
        $id = $_GET['id'];
        $jumlah = $_POST['jumlah'];
        $id_user = $_SESSION['Member']['id_user'];
        $tgl = date("j F Y, G:i");
        
        try {
            $config->beginTransaction();
            
            // Ambil data barang
            $sql = "SELECT * FROM barang WHERE id_barang = ?";
            $row = $config->prepare($sql);
            $row->execute(array($id));
            $hasil = $row->fetch();
            
            // Hitung total
            $total = $hasil['harga_jual'] * $jumlah;
            
            // Cek stok
            if($jumlah > $hasil['stok']) {
                echo '<script>alert("Stok tidak mencukupi! Stok tersedia: '.$hasil['stok'].'");
                window.location="../../index.php?page=jual";</script>';
                exit;
            }
            
            // Kurangi stok
            $newStok = $hasil['stok'] - $jumlah;
            $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
            $row_stok = $config->prepare($sql_stok);
            $row_stok->execute(array($newStok, $id));
            
            // Tambah ke keranjang
            $sql_tambah = "INSERT INTO penjualan (id_barang, id_produk, jumlah, total, tanggal_input, id_user) 
                          VALUES (?, ?, ?, ?, ?, ?)";
            $row_tambah = $config->prepare($sql_tambah);
            $row_tambah->execute(array(
                $id, 
                $hasil['id_produk'],
                $jumlah, 
                $total,
                $tgl,
                $id_user
            ));
            
            $config->commit();
            
            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
            
        } catch(PDOException $e) {
            $config->rollBack();
            echo '<script>alert("Error: '.$e->getMessage().'");
            window.location="../../index.php?page=jual";</script>';
        }
    }
}

// Proses pembayaran
if(isset($_GET['nota']) && $_GET['nota'] == 'yes') {
    try {
        $config->beginTransaction();
        
        $total = $_POST['total'];
        $bayar = $_POST['bayar'];
        $kembali = $bayar - $total;
        $kurang = $total - $bayar;
        
        if(empty($bayar)) {
            throw new Exception('Jumlah pembayaran tidak boleh kosong');
        }
        
        if($bayar < $total) {
            throw new Exception('Uang kurang Rp. ' . number_format($kurang));
        }

        // Generate kode nota
        $query = "SELECT MAX(CAST(SUBSTRING(kode_nota, 3) AS UNSIGNED)) as max_num FROM nota";
        $stmt = $config->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $next_num = (empty($result['max_num'])) ? 1 : ((int)$result['max_num'] + 1);
        $kode_nota = 'TR' . str_pad($next_num, 4, '0', STR_PAD_LEFT);

        // Ambil data penjualan dari keranjang
        $sql_keranjang = "SELECT * FROM penjualan WHERE id_user = ?";
        $stmt_keranjang = $config->prepare($sql_keranjang);
        $stmt_keranjang->execute([$_SESSION['Member']['id_user']]);
        $items = $stmt_keranjang->fetchAll(PDO::FETCH_ASSOC);

        if(empty($items)) {
            throw new Exception('Keranjang kosong');
        }

        // Pindahkan data ke nota
        foreach($items as $item) {
            $sql = "INSERT INTO nota (id_barang, id_produk, id_user, jumlah, total, tanggal_input, periode, kode_nota) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $row = $config->prepare($sql);
            $row->execute([
                $item['id_barang'],
                $item['id_produk'],
                $item['id_user'],
                $item['jumlah'],
                $item['total'],
                date('Y-m-d H:i:s'),
                date('m-Y'),
                $kode_nota
            ]);
        }

        // Update status pembayaran di tabel penjualan
        $sql_update = "UPDATE penjualan SET kode_nota = ? WHERE id_user = ? AND kode_nota IS NULL";
        $row_update = $config->prepare($sql_update);
        $row_update->execute([$kode_nota, $_SESSION['Member']['id_user']]);

        $config->commit();
        
        // Simpan ke session
        $_SESSION['kode_nota'] = $kode_nota;
        $_SESSION['total_bayar'] = $total;
        $_SESSION['jumlah_bayar'] = $bayar;
        $_SESSION['kembali'] = $kembali;
        
        // Kembali ke halaman jual dengan status sukses
        echo '<script>
            window.location="../../index.php?page=jual&success=pembayaran-sukses";
        </script>';
        
    } catch(Exception $e) {
        $config->rollBack();
        echo '<script>
            alert("Error: ' . $e->getMessage() . '");
            window.location="../../index.php?page=jual";
        </script>';
    }
    exit;
}
?>  