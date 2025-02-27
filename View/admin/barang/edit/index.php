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
						<h3>Update Merk</h3>
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
						<form method="POST" action="fungsi/edit/edit.php?barang=edit">
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
                <td>Kode Barang</td>
                <td>
                    <select name="id_produk" id="id_produk" class="form-control" required>
                        <?php
                        $produk = $lihat->lihat_produk();
                        foreach($produk as $prod) {
                            $selected = ($prod['id_produk'] == $hasil['id_produk']) ? 'selected' : '';
                            echo "<option value='{$prod['id_produk']}' data-kode='{$prod['kode_produk']}' {$selected}>{$prod['kode_produk']}</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" id="kode_produk" name="kode_produk" value="<?php echo $hasil['kode_produk']; ?>">
                </td>
            </tr>
            <tr>
                <td>Kode Merk</td>
                <td>
                    <input type="text" placeholder="Masukkan kode merk" required class="form-control" name="kode_barang" value="<?php echo $hasil['kode_barang']; ?>">
                </td>
            </tr>
            <tr>
                <td>Nama Merk</td>
                <td><input type="text" placeholder="Masukkan nama merk" required class="form-control" name="nama_barang" value="<?php echo $hasil['nama_barang']; ?>"></td>
            </tr>
            <tr>
                <td>Satuan</td>
                <td>
                    <select name="id_satuan" class="form-control" required>
                        <?php
                        $satuan = $lihat->lihat_satuan();
                        foreach($satuan as $sat) {
                            $selected = ($sat['id_satuan'] == $hasil['id_satuan']) ? 'selected' : '';
                            echo "<option value='{$sat['id_satuan']}' {$selected}>{$sat['satuan']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td><input type="number" placeholder="Masukkan harga jual" required class="form-control" name="harga_jual" value="<?php echo $hasil['harga_jual']; ?>"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="number" placeholder="Masukkan jumlah stok" required class="form-control" name="stok" value="<?php echo $hasil['stok']; ?>"></td>
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
                <td><input type="date" required class="form-control" name="tgl_update" value="<?php echo date('Y-m-d'); ?>"></td>
            </tr>
        </table>
    </div>
    <input type="hidden" name="id_barang" value="<?php echo $hasil['id_barang']; ?>">
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Update Data
        </button>
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
$(document).ready(function() {
    // Set initial kode_produk value
    var initialKodeProduk = $('#id_produk option:selected').data('kode');
    $('#kode_produk').val(initialKodeProduk);

    // Update kode_produk when selection changes
    $('#id_produk').change(function() {
        var selectedKodeProduk = $(this).find('option:selected').data('kode');
        $('#kode_produk').val(selectedKodeProduk);
    });
});
</script>
      </section>