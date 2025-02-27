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
?>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
print_r($_GET);
if (!empty($_SESSION['Admin'])) {
    if (!empty($_GET['kategori'])) {
        $id = $_GET['id'];
        $data[] = $id;
        $sql = 'DELETE FROM kategori WHERE id_kategori=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>
            window.location = "../../index.php?page=kategori&&remove=hapus-data"
        </script>';
    }

    if (!empty($_GET['barang'])) {
        $id = $_GET['id_barang'];
        
        try {
            // First backup the product information with satuan
            $sql_backup = "INSERT INTO deleted_products (id_barang, kode_barang, nama_barang, id_produk, nama_produk, tipe)
                           SELECT b.id_barang, b.kode_barang, b.nama_barang, b.id_produk, p.nama_produk, s.satuan
                           FROM barang b
                           LEFT JOIN produk p ON b.id_produk = p.id_produk
                           LEFT JOIN satuan s ON b.id_satuan = s.id_satuan
                           WHERE b.id_barang = ?";
            $row_backup = $config->prepare($sql_backup);
            $row_backup->execute([$id]);

            // Then delete from barang table
            $sql = 'DELETE FROM barang WHERE id_barang = ?';
            $row = $config->prepare($sql);
            $row->execute([$id]);
            
            echo '<script>
                window.location = "../../index.php?page=barang&&remove=hapus-data"
            </script>';
        } catch (PDOException $e) {
            echo '<script>
                alert("Error: ' . str_replace("'", "\'", $e->getMessage()) . '");
                window.location = "../../index.php?page=barang&&remove=error"
            </script>';
        }
    }

    if (!empty($_GET['laporan'])) {
        $sql = 'DELETE FROM nota';
        $row = $config->prepare($sql);
        $row->execute();
        echo '<script>
            window.location = "../../index.php?page=laporan&remove=hapus"
        </script>';
    }

    if (!empty($_GET['member'])) {
		$id = $_GET['id'];
        // $data[] = $id;
        $sql = "DELETE login,member from member left join login on login.id_member = member.id_member where member.id_member = '$id'";
        $row = $config->prepare($sql);
        $row->execute();
        echo '<script>
            window.location = "../../index.php?page=member&remove=hapus"
        </script>';
    }

    if (!empty($_GET['produk'])) {
        $id = $_GET['id_produk'];
        
        try {
            // Cek apakah produk masih digunakan di tabel barang
            $check_sql = 'SELECT COUNT(*) FROM barang WHERE id_produk = ?';
            $check_row = $config->prepare($check_sql);
            $check_row->execute([$id]);
            $count = $check_row->fetchColumn();
    
            if ($count > 0) {
                echo '<script>
                    alert("Produk tidak dapat dihapus karena masih digunakan dalam data barang!");
                    window.location = "../../index.php?page=produk&&remove=gagal"
                </script>';
            } else {
                // Jika tidak ada relasi, lakukan penghapusan
                $sql = 'DELETE FROM produk WHERE id_produk = ?';
                $row = $config->prepare($sql);
                $row->execute([$id]);
    
                if ($row->rowCount() > 0) {
                    echo '<script>
                        window.location = "../../index.php?page=produk&&remove=hapus-data"
                    </script>';
                } else {
                    echo '<script>
                        alert("Produk tidak ditemukan!");
                        window.location = "../../index.php?page=produk&&remove=tidak-ditemukan"
                    </script>';
                }
            }
        } catch (PDOException $e) {
            echo '<script>
                alert("Error: ' . str_replace("'", "\'", $e->getMessage()) . '");
                window.location = "../../index.php?page=produk&&remove=error"
            </script>';
        }
    }
}


    if (!empty($_SESSION['pegawai'])) {
        require '../../config.php';
    if (!empty($_GET['jual'])) {
        $dataI[] = $_GET['brg'];
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config->prepare($sqlI);
        $rowI->execute($dataI);
        $hasil = $rowI->fetch();

        /*$jml = $_GET['jml'] + $hasil['stok'];
  
  $dataU[] = $jml;
  $dataU[] = $_GET['brg'];
  $sqlU = 'UPDATE barang SET stok =? where id_barang=?';
  $rowU = $config->prepare($sqlU);
  $rowU -> execute($dataU);*/

        $id = $_GET['id'];
        $data[] = $id;
        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>
            window.location = "../../index.php?page=jual"
        </script>';
    }
    
    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];
        $brg = $_GET['brg'];
        $jml = $_GET['jml'];
    
        // Kembalikan stok
        $sql_stok = 'UPDATE barang SET stok = stok + ? WHERE id_barang = ?';
        $row_stok = $config->prepare($sql_stok);
        $row_stok->execute([$jml, $brg]);
    
        // Hapus item dari keranjang
        $sql = 'DELETE FROM penjualan WHERE id_penjualan = ?';
        $row = $config->prepare($sql);
        $row->execute([$id]);

        /*$jml = $_GET['jml'] + $hasil['stok'];
  
  $dataU[] = $jml;
  $dataU[] = $_GET['brg'];
  $sqlU = 'UPDATE barang SET stok =? where id_barang=?';
  $rowU = $config->prepare($sqlU);
  $rowU -> execute($dataU);*/

        $id = $_GET['id'];
        $data[] = $id;
        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>
            window.location = "../../index.php?page=jual"
        </script>';
    }
    
    if (!empty($_GET['penjualan'])) {
        $sql = 'DELETE FROM penjualan';
        $row = $config->prepare($sql);
        $row->execute();
        echo '<script>
            window.location = "../../index.php?page=jual"
        </script>';
    }
}

if (isset($_GET['jual'])) {
    $id_penjualan = $_GET['id'];
    $id_barang = $_GET['brg'];
    $jumlah = $_GET['jml'];

    try {
        // Mulai transaksi
        $config->beginTransaction();

        // Ambil stok barang dari tabel barang
        $sql_barang = 'SELECT stok FROM barang WHERE id_barang = ?';
        $row_barang = $config->prepare($sql_barang);
        $row_barang->execute([$id_barang]);
        $hsl_barang = $row_barang->fetch();

        $stok_sekarang = $hsl_barang['stok'];

        // Tambahkan jumlah yang dibatalkan ke stok barang
        $stok_baru = $stok_sekarang + $jumlah;

        // Update stok barang
        $sql_stok = 'UPDATE barang SET stok = ? WHERE id_barang = ?';
        $row_stok = $config->prepare($sql_stok);
        $row_stok->execute([$stok_baru, $id_barang]);

        // Hapus data penjualan
        $sql = 'DELETE FROM penjualan WHERE id_penjualan = ?';
        $row = $config->prepare($sql);
        $row->execute([$id_penjualan]);

        // Commit transaksi
        $config->commit();

        header('Location: ../../admin/module/jual/index.php?remove=success');
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $config->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}

if(!empty($_GET['penjualan'])){
    if($_GET['penjualan'] == 'hapus'){
        try {
            $id_penjualan = $_GET['id'];
            $id_barang = $_GET['brg'];
            $jumlah = $_GET['jml'];

            // Ambil stok saat ini
            $sql_barang = "SELECT stok FROM barang WHERE id_barang = ?";
            $row_barang = $config->prepare($sql_barang);
            $row_barang->execute([$id_barang]);
            $barang = $row_barang->fetch();

            // Kembalikan stok
            $stok_baru = $barang['stok'] + $jumlah;
            
            // Update stok barang
            $sql_update = "UPDATE barang SET stok = ? WHERE id_barang = ?";
            $row_update = $config->prepare($sql_update);
            $row_update->execute([$stok_baru, $id_barang]);

            // Hapus data penjualan
            $sql_delete = "DELETE FROM penjualan WHERE id_penjualan = ?";
            $row_delete = $config->prepare($sql_delete);
            $row_delete->execute([$id_penjualan]);

            echo '<script>window.location="../../index.php?page=jual"</script>';
        } catch(PDOException $e) {
            echo '<script>alert("Error: '.$e->getMessage().'");
                  window.location="../../index.php?page=jual"</script>';
        }
    }

    if($_GET['penjualan'] == 'reset'){
        try {
            $config->beginTransaction();

            // Get all items in the penjualan table that have been paid
            $sql_paid = "SELECT p.*, n.id_nota 
                        FROM penjualan p 
                        LEFT JOIN nota n ON (p.id_barang = n.id_barang AND p.jumlah = n.jumlah)
                        WHERE n.id_nota IS NOT NULL";
            $row_paid = $config->prepare($sql_paid);
            $row_paid->execute();
            $paid_items = $row_paid->fetchAll();

            // Get all items in the penjualan table that haven't been paid
            $sql_unpaid = "SELECT p.*, n.id_nota 
                          FROM penjualan p 
                          LEFT JOIN nota n ON (p.id_barang = n.id_barang AND p.jumlah = n.jumlah)
                          WHERE n.id_nota IS NULL";
            $row_unpaid = $config->prepare($sql_unpaid);
            $row_unpaid->execute();
            $unpaid_items = $row_unpaid->fetchAll();

            // For unpaid items, return stock to barang table
            foreach($unpaid_items as $item) {
                $sql_update = "UPDATE barang SET stok = stok + ? WHERE id_barang = ?";
                $row_update = $config->prepare($sql_update);
                $row_update->execute([$item['jumlah'], $item['id_barang']]);
            }

            // For paid items, reduce stock in barang table
            foreach($paid_items as $item) {
                $sql_update = "UPDATE barang SET stok = stok - ? WHERE id_barang = ?";
                $row_update = $config->prepare($sql_update);
                $row_update->execute([$item['jumlah'], $item['id_barang']]);
            }

            // Delete all items from penjualan table
            $sql_delete = "DELETE FROM penjualan";
            $row_delete = $config->prepare($sql_delete);
            $row_delete->execute();

            $config->commit();
            echo '<script>window.location="../../index.php?page=jual&remove=reset"</script>';
        } catch (PDOException $e) {
            $config->rollBack();
            echo '<script>alert("Error: '.$e->getMessage().'");
                  window.location="../../index.php?page=jual"</script>';
        }
    }
}

if(!empty($_SESSION['Admin'])){
    require '../../config.php';
    
    if(!empty($_GET['pegawai'])){
        $id = $_GET['id'];
        
        try {
            // Mulai transaksi
            $config->beginTransaction();
            
            // Hapus data user
            $sql = "DELETE FROM user WHERE id_user = ?";
            $row = $config->prepare($sql);
            $row->execute(array($id));
            
            // Commit transaksi
            $config->commit();
            
            echo '<script>alert("Data user berhasil dihapus!");
                  window.location="../../index.php?page=pegawai"</script>';
        } catch(PDOException $e) {
            // Rollback jika terjadi error
            $config->rollBack();
            echo '<script>alert("Gagal menghapus data: ' . $e->getMessage() . '");
                  window.location="../../index.php?page=pegawai"</script>';
        }
    }
}

function hapus_barang($id)
{
    try {
        // First backup the product information with satuan
        $sql_backup = "INSERT INTO deleted_products (id_barang, kode_barang, nama_barang, id_produk, nama_produk, tipe)
                       SELECT b.id_barang, b.kode_barang, b.nama_barang, b.id_produk, p.nama_produk, s.satuan
                       FROM barang b
                       LEFT JOIN produk p ON b.id_produk = p.id_produk
                       LEFT JOIN satuan s ON b.id_satuan = s.id_satuan
                       WHERE b.id_barang = ?";
        $row_backup = $config->prepare($sql_backup);
        $row_backup->execute([$id]);

        // Then proceed with deletion
        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $row = $config->prepare($sql);
        $row->execute([$id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

if(!empty($_GET['satuan'])){
    $id = $_GET['id_satuan'];
    
    try {
        $sql = 'DELETE FROM satuan WHERE id_satuan=?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        
        echo '<script>window.location="../../index.php?page=satuan&remove=hapus-data"</script>';
    } catch(PDOException $e) {
        echo '<script>alert("Gagal menghapus data: ' . $e->getMessage() . '");
              window.location="../../index.php?page=satuan"</script>';
    }
}

if(!empty($_SESSION['Member'])){
    require '../../config.php';
    
    if(!empty($_GET['penjualan'])){
        if($_GET['penjualan'] == 'hapus'){
            // Jika ini adalah reset keranjang (menghapus semua)
            if(isset($_GET['id'])) {
                $sql = "DELETE FROM penjualan WHERE id_user = ?";
                $row = $config->prepare($sql);
                $row->execute([$_GET['id']]);
                echo '<script>window.location="../../index.php?page=jual";</script>';
            }
        } else {
            // Jika menghapus item individual dan belum dibayar
            $id = $_GET['id'];
            $id_barang = $_GET['brg'];
            $jumlah = $_GET['jml'];
            
            // Cek apakah item sudah dibayar
            $sql_cek = "SELECT kode_nota FROM penjualan WHERE id_penjualan = ?";
            $row_cek = $config->prepare($sql_cek);
            $row_cek->execute([$id]);
            $penjualan = $row_cek->fetch();
            
            // Hanya kembalikan stok jika belum dibayar (belum ada kode_nota)
            if(empty($penjualan['kode_nota'])) {
                // Kembalikan stok
                $sql_barang = "SELECT stok FROM barang WHERE id_barang = ?";
                $row_barang = $config->prepare($sql_barang);
                $row_barang->execute([$id_barang]);
                $stok = $row_barang->fetch();

                $newStok = $stok['stok'] + $jumlah;
                
                $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                $row_stok = $config->prepare($sql_stok);
                $row_stok->execute([$newStok, $id_barang]);
            }
            
            // Hapus item dari keranjang
            $sql_delete = "DELETE FROM penjualan WHERE id_penjualan = ?";
            $row_delete = $config->prepare($sql_delete);
            $row_delete->execute([$id]);
            
            echo '<script>window.location="../../index.php?page=jual";</script>';
        }
    }
}

?>
