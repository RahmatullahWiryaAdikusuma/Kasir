<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->

<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Data Produk</h3>
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
                    <a href="index.php?page=produk" class="btn btn-success btn-md pull-right"
                        style="margin-right: 1%;">
                        <i class="fa fa-refresh"></i> Refresh Data</a>
                    <div class="clearfix"></div>
                    <br />

                    <!-- view barang -->
                    <div class="modal-view">
                        <table class="table table-bordered table-striped display" id="example">
                            <thead>
                                <tr style="background:#DFF0D8;color:#333;">
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Kode Kategori</th>
                                <th>Nama Produk</th>
                                <th>Kode Produk</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            try {
                                $hasil = $lihat -> lihat_produk();
                                if (empty($hasil)) {
                                    echo "<tr><td colspan='10'>No data found...</td></tr>"; // Update colspan to 10
                                } else {
                                    foreach($hasil as $isi) {
                            ?>
                                <tr>
                                <td><?php echo $isi['id_produk']; ?></td>
                                <td><?php echo $isi['nama_kategori']; ?></td>
                                <td><?php echo $isi['kode_kategori']; ?></td>
                                <td><?php echo $isi['nama_produk']; ?></td>
                                <td><?php echo $isi['kode_produk']; ?></td>
                                    <td>   
                                        <a href="index.php?page=produk/edit&produk=<?php echo $isi['id_produk']; ?>"><button
                                                class="btn btn-warning btn-xs">Edit</button></a>
                                        <a href="fungsi/hapus/hapus.php?produk=hapus&id_produk=<?php echo $isi['id_produk']; ?>"
                                            onclick="javascript:return confirm('Hapus Data Produk ?');"><button
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
                                <form action="fungsi/tambah/tambah.php?produk=tambah" method="POST" onsubmit="return checkForm()">
                                    <input type="hidden" name="id_kategori" value="...">
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                        <tr>
                                                <td>Kategori</td>
                                                <td>
                                                <select name="id_kategori" class="form-control" required id="id_kategori">
                                                <?php
                                                    $kategori = $lihat->kategori();
                                                    foreach($kategori as $kat) {
                                                        echo "<option value='{$kat['id_kategori']}' data-kode='{$kat['kode_kategori']}'>{$kat['nama_kategori']}</option>";
                                                    }
                                                    ?>
                                            </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                 <td>Nama Produk</td>
                                                 <td><input type="text" placeholder="Nama Produk" required
                                                         class="form-control" name="nama_produk" id="nama_produk"></td>
                                             </tr>
                                             <tr>
                                                 <td>Kode Kategori</td>
                                                 <td><input type="text" placeholder="Kode Kategori" required class="form-control" name="kode_kategori" id="kode_kategori" readonly></td>
                                             </tr>
                                             <tr>
                                                 <td>Kode Produk</td>
                                                 <td><input type="text" placeholder="Kode Produk" required class="form-control" name="kode_produk" id="kode_produk" readonly></td>
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

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('id_kategori').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let kodeKategori = selectedOption.getAttribute('data-kode');
        document.getElementById('kode_kategori').value = kodeKategori;

        // Generate new product code when category is selected
        generateKodeProduk();
    });

    function generateKodeProduk() {
        let id_kategori = document.getElementById('id_kategori').value;
        let kodeKategori = document.getElementById('kode_kategori').value;

        if (id_kategori && kodeKategori) {
            fetch('fungsi/tambah/tambah.php?produk=getLastKodeProduk&id_kategori=' + id_kategori)
                .then(response => response.text())
                .then(data => {
                    let lastKodeProduk = parseInt(data.match(/\d+$/)[0]);
                    if (isNaN(lastKodeProduk)) {
                        lastKodeProduk = 0;
                    }
                    let nextKodeProduk = (lastKodeProduk + 1).toString().padStart(2, '0');
                    document.getElementById('kode_produk').value = kodeKategori + nextKodeProduk;
                });
        }
    }
});
</script>
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