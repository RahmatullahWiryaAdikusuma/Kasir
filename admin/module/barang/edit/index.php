 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	$id = $_GET['barang'];
	$hasil = $lihat -> barang_edit($id);
?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Back </button></a>
						<h3>Details Barang</h3>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-striped">
						<form method="POST" action="fungsi/edit/edit.php?barang=edit" >
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                            <tr>
                                                <td>Kategori</td>
                                                <td>
                                                    <select name="id_kategori" class="form-control" required>
                                                        <?php
                                                        $kategori = $lihat->kategori();
                                                        foreach($kategori as $kat) {
                                                            $selected = $kat['id_kategori'] == $hasil['id_kategori'] ? 'selected' : '';
                                                            echo "<option value='{$kat['id_kategori']}' {$selected}>{$kat['nama_kategori']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kode Produk</td>
                                                <td>
                                                    <select name="id_produk" class="form-control" required>
                                                        <?php
                                                        $produk = $lihat->lihat_produk();
                                                        foreach($produk as $kat) {
                                                            $selected = $kat['id_produk'] == $hasil['id_produk'] ? 'selected' : '';
                                                            echo "<option value='{$kat['id_produk']}' {$selected}>{$kat['kode_produk']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" id="kode_produk" name="kode_produk" value="<?php echo $hasil['kode_produk']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td><input type="text" placeholder="Masukkan nama barang" required
                                                        class="form-control" name="nama_barang" value="<?php echo $hasil['nama_barang']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Tipe</td>
                                                <td><input type="text" placeholder="Masukkan tipe produk" required
                                                        class="form-control" name="tipe" value="<?php echo $hasil['tipe']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Jual</td>
                                                <td><input type="number" placeholder="Masukkan harga jual" required
                                                        class="form-control" name="harga_jual" value="<?php echo $hasil['harga_jual']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td><input type="number" placeholder="Masukkan jumlah stok" required
                                                        class="form-control" name="stok" value="<?php echo $hasil['stok']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Input</td>
                                                <td>
                                                    <?php
                                                    // Format nilai tanggal menjadi YYYY-MM-DD
                                                    $tgl_input = date('Y-m-d', strtotime($hasil['tgl_input']));
                                                    ?>
                                                    <input type="date" class="form-control" name="tgl_input" value="<?php echo $tgl_input; ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Update</td>
                                                <td><input type="date" required class="form-control" name="tanggal_update" value="<?php echo $hasil['tanggal_update']; ?>"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" name="proses"></i>
                                            Insert Data</button>
                                        <a href="index.php?page=barang" class="btn btn-default">Close</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</section>

<script>
document.getElementById('id_produk').addEventListener('change', function() {
    var id_produk = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fungsi/tambah/tambah.php?barang=getKode&id_produk=' + id_produk, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('kode_produk').value = xhr.responseText;
        }
    };
    xhr.send();
});
</script>
      </section>