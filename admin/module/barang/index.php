<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->

<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Data Barang</h3>
                <br />
                <?php if(isset($_GET['success-stok'])){?>
                <div class="alert alert-success">
                    <p>Tambah Stok Berhasil !</p>
                </div>
                <?php }?>
                <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success">
                    <p>Tambah Data Berhasil !</p>
                </div>
                <?php }?>
                <?php if(isset($_GET['remove'])){?>
                <div class="alert alert-danger">
                    <p>Hapus Data Berhasil !</p>
                </div>
                <?php }?>

                <div>
                    <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal"
                        data-target="#myModal">
                        <i class="fa fa-plus"></i> Insert Data</button>
                    <a href="index.php?page=barang" class="btn btn-success btn-md pull-right"
                        style="margin-right: 1%;">
                        <i class="fa fa-refresh"></i> Refresh Data</a>
                    <div class="clearfix"></div>
                    <br />

                    <!-- view barang -->
                    <div class="modal-view">
                        <table class="table table-bordered table-striped display" id="example">
                            <thead>
                                <tr style="background:#DFF0D8;color:#333;">
                                    <th>Id</th>
                                    <th>Kode Produk</th> <!-- Tambahkan kolom Kode Produk -->
                                    <th>Kode Barang</th> <!-- Tambahkan kolom Kode Barang -->
                                    <th>Nama Produk</th>
                                    <th>Tipe</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Tanggal Input</th>
                                    <th>Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            try {
                                $hasil = $lihat -> lihat_barang();
                                if (empty($hasil)) {
                                    echo "<tr><td colspan='10'>No data found...</td></tr>"; // Update colspan to 10
                                } else {
                                    foreach($hasil as $isi) {
                            ?>
                                <tr>
                                    <td><?php echo $isi['id_barang']; ?></td>
                                    <td><?php echo $isi['kode_produk']; ?></td> <!-- Tampilkan kode_produk -->
                                    <td><?php echo $isi['kode_barang']; ?></td> <!-- Tampilkan kode_barang -->
                                    <td><?php echo $isi['nama_barang']; ?></td>
                                    <td><?php echo $isi['tipe']; ?></td>
                                    <td><?php echo 'Rp. ' . number_format($isi['harga_jual'], 0, ',', '.'); ?></td>
                                    <td><?php echo $isi['stok']; ?></td>
                                    <td><?php echo $isi['tgl_input']; ?></td>
                                    <td><?php echo $isi['tgl_update']; ?></td>
                                    
                                    <td>   
                                        <a href="index.php?page=barang/edit&barang=<?php echo $isi['id_barang']; ?>"><button
                                                class="btn btn-warning btn-xs">Edit</button></a>
                                        <a href="fungsi/hapus/hapus.php?barang=hapus&id_barang=<?php echo $isi['id_barang']; ?>"
                                            onclick="javascript:return confirm('Hapus Data barang ?');"><button
                                                class="btn btn-danger btn-xs">Hapus</button></a>
                                    </td>
                                </tr>
                            <?php 
                                    }
                                }
                            } catch (Exception $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix" style="margin-top:7pc;"></div>
                    <!-- end view barang -->
                    <!-- tambah barang MODALS-->
                    <!-- Modal -->

                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" style=" border-radius:0px;">
                                <div class="modal-header" style="background:#285c64;color:#fff;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Produk</h4>
                                </div>
                                <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST" onsubmit="return checkForm()">
                                    <input type="hidden" name="id_kategori" value="...">
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                            <tr>
                                                <td>Kategori</td>
                                                <td>
                                                    <select name="id_kategori" class="form-control" required>
                                                        <?php
                                                        $kategori = $lihat->kategori();
                                                        foreach($kategori as $kat) {
                                                            echo "<option value='{$kat['id_kategori']}'>{$kat['nama_kategori']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kode Produk</td>
                                                <td>
                                                    <!-- Filter input -->
                                                    <input type="text" id="filterKodeProduk" placeholder="Filter kode produk" class="form-control">
                                                    <select name="id_produk" id="id_produk" class="form-control" required>
                                                        <?php
                                                        $produk = $lihat->lihat_produk();
                                                        foreach($produk as $kat) {
                                                            echo "<option value='{$kat['id_produk']}'>{$kat['kode_produk']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" id="kode_produk" name="kode_produk" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td><input type="text" placeholder="Masukkan nama barang" required
                                                        class="form-control" name="nama_barang"></td>
                                            </tr>
                                            <tr>
                                                <td>Tipe</td>
                                                <td><input type="text" placeholder="Masukkan tipe produk" required
                                                        class="form-control" name="tipe"></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Jual</td>
                                                <td><input type="number" placeholder="Masukkan harga jual" required
                                                        class="form-control" name="harga_jual"></td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td><input type="number" placeholder="Masukkan jumlah stok" required
                                                        class="form-control" name="stok"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" name="proses"></i>
                                            Insert Data</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

document.getElementById('filterKodeProduk').addEventListener('input', function() {
    var filter = this.value.toUpperCase();
    var options = document.querySelectorAll('#id_produk option');
    options.forEach(function(option) {
        var kodeProduk = option.textContent.toUpperCase();
        if (kodeProduk.indexOf(filter) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
});

function checkForm() {
    var kode_produk = document.getElementById('kode_produk').value;
    if (kode_produk === '') {
        alert('Kode produk tidak boleh kosong');
        return false;
    }
    return true;
}
</script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>