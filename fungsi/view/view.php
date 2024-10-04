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

    function member()
    {
        $sql = "select member.*, login.*
      from member inner join login on member.id_member = login.id_member";
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function lihat_member()
    {
        $sql = 'select * from member where id_member != 1';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function detail_member()
    {
        $sql = 'select * from member where id_member != 1';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }
    function detail_login()
    {
        $sql = 'select * from login where id_login = ?';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function member_detail($id)
    {
        $sql = 'select * from member where id_member = ?';
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }

    function member_edit($id)
    {
        $sql = "select member.*, login.*
      from member inner join login on member.id_member = login.id_member
      where member.id_member= ?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }
    function member_edit2($id)
    {
        $sql = "select member.*, login.user, login.pass
      from member left join login on member.id_member = login.id_member
      where member.id_member= ?";
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
        $sql = 'SELECT * FROM kategori';
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
        $sql = "select barang.*, produk.id_produk, produk.kode_produk
      from barang inner join produk  on barang.id_produk = produk.id_produk
      where id_barang=?";
        $row = $this->db->prepare($sql);
        $row->execute([$id]);
        $hasil = $row->fetch();
        return $hasil;
    }

    // function barang_cari($cari){
    // 	$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
    // 			from barang inner join kategori on barang.id_kategori = kategori.id_kategori
    // 			where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
    // 	$row = $this-> db -> prepare($sql);
    // 	$row -> execute();
    // 	$hasil = $row -> fetchAll();
    // 	return $hasil;
    // }

   // function menu()
  //  {
      //  $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
      //from barang inner join kategori on barang.id_kategori = kategori.id_kategori
   //   ORDER BY id DESC";
       // $row = $this->db->prepare($sql);
       // $row->execute();
     //   $hasil = $row->fetchAll();
      //  return $hasil;
   // }

    function barang_id()
    {
        $sql = 'SELECT * FROM barang ORDER BY id_barang DESC';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->fetch();

        $urut = substr($hasil['id_barang'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'BR00' . $tambah . '';
        } elseif (strlen($tambah) == 2) {
            $format = 'BR0' . $tambah . '';
        } else {
            $ex = explode('BR', $hasil['id_barang']);
            $no = (int) $ex[1] + 1;
            $format = 'BR' . $no . '';
        }
        return $format;
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
            // SQL query to select kode_produk and nama_produk from the joined tables
            $sql = 'SELECT barang.*,produk.kode_produk,produk.nama_produk,produk.kode_produk
                    FROM barang
                    LEFT JOIN produk ON barang.id_produk = produk.id_produk';
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




    function lihat_produk()
    {
        $sql = 'SELECT produk.*, kategori.nama_kategori,kategori.kode_kategori 
                FROM produk 
                INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori';
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
        $sql = 'select*from member where id_member != 1';
        $row = $this->db->prepare($sql);
        $row->execute();
        $hasil = $row->rowCount();
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
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
      member.nm_member from nota
        left join barang on barang.id_barang=nota.id_barang
        left join member on member.id_member=nota.id_member
        where nota.periode = ?
        ORDER BY id_nota DESC";
        $row = $this->db->prepare($sql);
        $row->execute([date('m-Y')]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function periode_jual($periode)
    {
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
      member.nm_member from nota
     left join barang on barang.id_barang=nota.id_barang
     left join member on member.id_member=nota.id_member
     WHERE nota.periode = ?
     ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute([$periode]);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    function hari_jual($hari)
    {
        $ex = explode('-', $hari);
        $monthNum = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl . ' ' . $monthName . ' ' . $ex[0];
        $param = "%{$cek}%";
        $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
      member.nm_member from nota
     left join barang on barang.id_barang=nota.id_barang
     left join member on member.id_member=nota.id_member
     WHERE nota.tanggal_input LIKE ?
     ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute([$param]);
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

    // function kategori_jual($kat)
    // {
    //     $sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, member.id_member,
    //   member.nm_member from nota
    //  left join barang on barang.id_barang=nota.id_barang
    //  left join member on member.id_member=nota.id_member WHERE nota.periode = ?
    //  ORDER BY id_nota ASC";
    //     $row = $this->db->prepare($sql);
    //     $row->execute([$kat]);
    //     $hasil = $row->fetchAll();
    //     return $hasil;
    // }

    function penjualan()
    {
        $sql = "SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
      member.nm_member from penjualan
     left join barang on barang.id_barang=penjualan.id_barang
     left join member on member.id_member=penjualan.id_member
     ORDER BY id_penjualan";
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
    // 	function harga() {
    // 		$sql = "SELECT total FROM nota order by id asc";
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
}