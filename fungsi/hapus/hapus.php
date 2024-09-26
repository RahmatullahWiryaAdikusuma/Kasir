<?php
session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
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
        $id = $_GET['id'];
        $data[] = $id;
        $sql = 'DELETE FROM barang WHERE id=?';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>
            window.location = "../../index.php?page=barang&&remove=hapus-data"
        </script>';
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

// ... existing code ...
if (!empty($_GET['produk'])) {
    $id = $_GET['id_produk'];
    $data[] = $id;
    $sql = 'DELETE FROM produk WHERE id_produk=?';
    $row = $config->prepare($sql);
    $row->execute($data);
    echo '<script>
        window.location = "../../index.php?page=produk&&remove=hapus-data"
    </script>';
}

?>