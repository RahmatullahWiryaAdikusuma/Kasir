<?php
/*
 * PROSES TAMPIL
 */
class view
{
    protected $db;
    function __construct($db)
    {
        $this->db = $db;
    }


    function lihat_user()
    {
        $sql = "SELECT id_user, username, nama, role, alamat, no_telp, email 
                FROM user
                ORDER BY id_user DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }


    function user_detail($id)
    {
        $sql = "SELECT id_user, username, nama, role, alamat, no_telp, email 
                FROM user 
                WHERE id_user = ?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }

    function user_edit($id)
    {
        $sql = "SELECT id_user, username, password, nama, role, alamat, no_telp, email 
                FROM user 
                WHERE id_user = ?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }

    function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    function kategori()
    {
        $sql = 'SELECT * FROM kategori ORDER BY id_kategori DESC';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function barang()
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
      from barang inner join kategori on barang.id_kategori = kategori.id_kategori
      ORDER BY id DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    // function barang_stok()
    // {
    //     $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
    //   from barang inner join kategori on barang.id_kategori = kategori.id_kategori
    //   where stok <= 3
    //   ORDER BY id DESC";
    //     $row = $this->db->prepare($sql);
    //     $row->execute();
    //     $hasil = $row->fetchAll();
    //     return $hasil;
    // }

    function barang_edit($id)
    {
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori,
                produk.id_produk, produk.kode_produk, produk.nama_produk,
                satuan.id_satuan, satuan.satuan
                FROM barang 
                LEFT JOIN kategori ON barang.id_kategori = kategori.id_kategori
                LEFT JOIN produk ON barang.id_produk = produk.id_produk
                LEFT JOIN satuan ON barang.id_satuan = satuan.id_satuan
                WHERE barang.id_barang = ?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }

    
    function produk_edit($id)
    {
        $sql = "select produk.*, kategori.id_kategori, kategori.nama_kategori
      from produk inner join kategori  on produk.id_kategori = kategori.id_kategori
      where id_produk=?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }
    function kategori_edit($id)
    {
        $sql = 'SELECT * FROM kategori WHERE id_kategori=?';
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }
    function kategori_row()
    {
        $sql = 'select*from kategori';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    function barang_row()
    {
        $sql = 'select*from barang';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    function lihat_barang()
    {
        try {
            // Update SQL query untuk mengambil nama kategori
            $sql = 'SELECT barang.*, produk.kode_produk, produk.nama_produk, 
                    kategori.nama_kategori, satuan.satuan
                    FROM barang
                    LEFT JOIN produk ON barang.id_produk = produk.id_produk
                    LEFT JOIN kategori ON barang.id_kategori = kategori.id_kategori
                    LEFT JOIN satuan ON barang.id_satuan = satuan.id_satuan
                    ORDER BY id_barang DESC';
            
            // Prepare the SQL statement
            $row = $this->db->prepare($sql);

            // Execute the query
            $row->execute();

            // Fetch all results
            $hasil = $row->fetchAll(PDO::FETCH_ASSOC);

            // Return the results
            return $hasil;
        } catch (PDOException $e) {
            // Display error message if the query fails
            echo "SQL error: " . $e->getMessage();
            echo "Error occurred in query: " . $sql;
        }
    }


     function total_stok() {
        $query = $this->db->query("SELECT SUM(stok) as total_stok FROM barang");
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function lihat_produk()
    {
        $sql = 'SELECT produk.*, kategori.nama_kategori,kategori.kode_kategori 
                FROM produk 
                INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
                ORDER BY id_produk DESC';
       $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function penjualan_row()
    {
        $sql = 'select*from nota';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
        return $hasil;
    }

    function member_row()
    {
        $sql = "SELECT COUNT(*) FROM user WHERE role = 'Member'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchColumn();
        return $hasil;
    }

    function jual_row()
    {
        $sql = 'SELECT SUM(jumlah) as stok FROM nota';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    function jual()
    {
        $sql = "SELECT nota.*, 
                COALESCE(b.id_barang, d.id_barang, nota.id_barang) as id_barang,
                COALESCE(b.kode_barang, d.kode_barang) as kode_barang,
                COALESCE(b.nama_barang, d.nama_barang) as nama_barang,
                COALESCE(s.satuan, 'N/A') as satuan,
                COALESCE(p.id_produk, d.id_produk) as id_produk,
                COALESCE(p.nama_produk, d.nama_produk) as nama_produk,
                user.id_user, user.nama,
                DATE_FORMAT(nota.tanggal_input, '%d-%m-%Y %H:%i:%s') as tanggal_input
                FROM nota
                LEFT JOIN barang b ON b.id_barang = nota.id_barang
                LEFT JOIN deleted_products d ON d.id_barang = nota.id_barang AND b.id_barang IS NULL
                LEFT JOIN produk p ON p.id_produk = b.id_produk
                LEFT JOIN satuan s ON s.id_satuan = b.id_satuan
                LEFT JOIN user ON user.id_user = nota.id_user 
                WHERE user.role = 'Member' AND nota.periode = ?
                ORDER BY id_nota DESC";
        
        $row = $this->db->prepare($sql);
        $row->execute([date('m-Y')]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function periode_jual($periode)
    {
        $sql = "SELECT nota.*, 
                COALESCE(b.id_barang, d.id_barang, nota.id_barang) as id_barang,
                COALESCE(b.kode_barang, d.kode_barang) as kode_barang,
                COALESCE(b.nama_barang, d.nama_barang) as nama_barang,
                COALESCE(s.satuan, 'N/A') as satuan,
                COALESCE(p.id_produk, d.id_produk) as id_produk,
                COALESCE(p.nama_produk, d.nama_produk) as nama_produk,
                user.id_user, user.nama,
                DATE_FORMAT(nota.tanggal_input, '%d-%m-%Y %H:%i:%s') as tanggal_input
                FROM nota
                LEFT JOIN barang b ON b.id_barang = nota.id_barang
                LEFT JOIN deleted_products d ON d.id_barang = nota.id_barang AND b.id_barang IS NULL
                LEFT JOIN produk p ON p.id_produk = b.id_produk
                LEFT JOIN satuan s ON s.id_satuan = b.id_satuan
                LEFT JOIN user ON user.id_user = nota.id_user
                WHERE nota.periode = ?
                ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute([$periode]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function hari_jual($hari)
    {
        $sql = "SELECT nota.*, 
                COALESCE(b.id_barang, d.id_barang, nota.id_barang) as id_barang,
                COALESCE(b.kode_barang, d.kode_barang) as kode_barang,
                COALESCE(b.nama_barang, d.nama_barang) as nama_barang,
                COALESCE(s.satuan, 'N/A') as satuan,
                COALESCE(p.id_produk, d.id_produk) as id_produk,
                COALESCE(p.nama_produk, d.nama_produk) as nama_produk,
                user.id_user, user.nama,
                DATE_FORMAT(nota.tanggal_input, '%d-%m-%Y %H:%i:%s') as tanggal_input
                FROM nota 
                LEFT JOIN barang b ON b.id_barang = nota.id_barang
                LEFT JOIN deleted_products d ON d.id_barang = nota.id_barang AND b.id_barang IS NULL
                LEFT JOIN produk p ON p.id_produk = b.id_produk
                LEFT JOIN satuan s ON s.id_satuan = b.id_satuan
                LEFT JOIN user ON user.id_user = nota.id_user
                WHERE DATE(nota.tanggal_input) = ?
                ORDER BY nota.id_nota ASC";
        
        $row = $this->db->prepare($sql);
        $row->execute([$hari]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    // function range_jual($hari1, $hari2)
    // {
    //     $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
    //   member.nm_member from nota
    //  left join barang on barang.id_barang=nota.id_barang
    //  left join member on member.id_member=nota.id_member
    //  WHERE nota.tanggal WHERE '$hari1' AND '$hari2'
    //  ORDER BY id_nota ASC";
    //     $row = $this->db->prepare($sql);
    //     $row->execute([$hari1, $hari2]);
    //     $hasil = $row->fetchAll();
    //     return $hasil;
    // }
    function penjualan()
    {
        $sql = "SELECT penjualan.*, 
                COALESCE(b.id_barang, d.id_barang) as id_barang,
                COALESCE(b.nama_barang, d.nama_barang) as nama_barang,
                COALESCE(b.kode_barang, d.kode_barang) as kode_barang,
                COALESCE(b.harga_jual, 0) as harga_jual,
                COALESCE(s.satuan, 'N/A') as satuan,
                COALESCE(p.id_produk, d.id_produk) as id_produk,
                COALESCE(p.nama_produk, d.nama_produk) as nama_produk,
                user.id_user, user.nama,
                penjualan.kode_nota
                FROM penjualan 
                LEFT JOIN barang b ON penjualan.id_barang = b.id_barang
                LEFT JOIN deleted_products d ON d.id_barang = penjualan.id_barang AND b.id_barang IS NULL
                LEFT JOIN produk p ON p.id_produk = b.id_produk
                LEFT JOIN satuan s ON s.id_satuan = b.id_satuan
                LEFT JOIN user ON penjualan.id_user = user.id_user
                ORDER BY penjualan.id_penjualan DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function jumlah()
    {
        $sql = 'SELECT SUM(total) as bayar FROM penjualan';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    function jumlah_nota()
    {
        $sql = 'SELECT SUM(total) as bayar FROM nota';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    function jml()
    {
        $sql = 'SELECT SUM(harga_beli*stok) as byr FROM barang';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    function keyword()
    {
        $sql = 'SELECT id_kategori,nama_kategori FROM kategori where id_kategori = ?';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    // function periode() {
    //     $sql = 'SELECT periode FROM nota';
    //     $row = $this->db->prepare($sql);
    //     $row->execute();
    //     $hasil = $row->fetch();
    //     return $hasil;
    // }

    // 	function nota() {
    // 		$sql = "SELECT tanggal_input FROM nota order by id asc";
    // 		$row = $this->db->prepare($sql);
    //         $row->execute();
    //         $hasil = $row->fetch();
    //         return $hasil;
    // 	}
    function get_kode_kategori($id_kategori)
    {
        $query = "SELECT kode_kategori FROM kategori WHERE id_kategori = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_kategori]);
        $row = $stmt->fetch();
        return $row ? $row['kode_kategori'] : null;
    }

    public function grafik_penjualan($periode = 'hari') {
        $data = array();
        
        if ($periode == 'hari') {
            $query = "SELECT DATE(tanggal_jual) as tanggal, 
                      SUM(total) as total_penjualan,
                      COUNT(*) as jumlah_transaksi 
                      FROM penjualan 
                      WHERE MONTH(tanggal_jual) = MONTH(CURRENT_DATE())
                      GROUP BY DATE(tanggal_jual)
                      ORDER BY tanggal_jual ASC";
        } else if ($periode == 'bulan') {
            $query = "SELECT DATE_FORMAT(tanggal_jual, '%Y-%m') as tanggal,
                      SUM(total) as total_penjualan,
                      COUNT(*) as jumlah_transaksi 
                      FROM penjualan 
                      WHERE YEAR(tanggal_jual) = YEAR(CURRENT_DATE())
                      GROUP BY DATE_FORMAT(tanggal_jual, '%Y-%m')
                      ORDER BY tanggal_jual ASC";
        } else {
            $query = "SELECT YEAR(tanggal_jual) as tanggal,
                      SUM(total) as total_penjualan,
                      COUNT(*) as jumlah_transaksi 
                      FROM penjualan 
                      GROUP BY YEAR(tanggal_jual)
                      ORDER BY tanggal_jual ASC";
        }
        
        $result = $this->db->query($query);
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function lihat_pegawai()
    {
        $sql = "SELECT id_user, username, nama, role, alamat, no_telp, email 
                FROM user 
                WHERE role = 'Member'
                ORDER BY id_user DESC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    // Tambahkan fungsi baru untuk mengambil transaksi berdasarkan kode_nota
    function get_transaksi_by_kode_nota($kode_nota)
    {
        $sql = "SELECT nota.*, 
                COALESCE(b.id_barang, d.id_barang, nota.id_barang) as id_barang,
                COALESCE(b.nama_barang, d.nama_barang) as nama_barang,
                COALESCE(b.kode_barang, d.kode_barang) as kode_barang,
                COALESCE(b.tipe, d.tipe) as tipe,
                COALESCE(p.id_produk, d.id_produk) as id_produk,
                COALESCE(p.nama_produk, d.nama_produk) as nama_produk,
                user.id_user, user.nama,
                DATE_FORMAT(nota.tanggal_input, '%d-%m-%Y %H:%i:%s') as tanggal_input
                FROM nota 
                LEFT JOIN barang b ON b.id_barang = nota.id_barang
                LEFT JOIN deleted_products d ON d.id_barang = nota.id_barang AND b.id_barang IS NULL
                LEFT JOIN produk p ON p.id_produk = b.id_produk
                LEFT JOIN user ON user.id_user = nota.id_user
                WHERE nota.kode_nota = ?
                ORDER BY nota.id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute([$kode_nota]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function lihat_satuan()
    {
        $sql = "SELECT id_satuan, satuan 
                FROM satuan 
                ORDER BY satuan ASC";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function satuan_edit($id)
    {
        $sql = "SELECT id_satuan, nama_satuan, DATE_FORMAT(tgl_input, '%d-%m-%Y') as tgl_input 
                FROM satuan 
                WHERE id_satuan=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        return $hasil;
    }

    // Remove or comment out the old satuan() function since we'll use lihat_satuan() instead
    /*
    public function satuan()
    {
        $sql = "SELECT * FROM satuan ORDER BY nama_satuan ASC";
        $hasil = $this->db->query($sql);
        $data = array();
        while ($row = $hasil->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    */
}