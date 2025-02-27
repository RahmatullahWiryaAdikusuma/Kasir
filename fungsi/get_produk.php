<?php
include '../config.php';

header('Content-Type: application/json');

if (isset($_GET['kategori_id'])) {
    $kategori_id = $_GET['kategori_id'];
    
    try {
        // Query untuk mengambil produk berdasarkan kategori
        $sql = "SELECT id_produk, kode_produk, nama_produk 
                FROM produk 
                WHERE id_kategori = ? 
                ORDER BY kode_produk ASC";
        
        $stmt = $config->prepare($sql);
        $stmt->execute([$kategori_id]);
        $produkList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($produkList);
    } catch (PDOException $e) {
        echo json_encode([
            'error' => true,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'error' => true,
        'message' => 'Kategori ID tidak ditemukan'
    ]);
}
?> 