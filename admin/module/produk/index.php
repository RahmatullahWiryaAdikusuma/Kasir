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
                <?php if(isset($_GET['remove']) && $_GET['remove'] === 'success'){ ?>
                    <div class="alert alert-success">
                        <p>Hapus Data Berhasil!</p>
                    </div>
                <?php } elseif(isset($_GET['remove']) && $_GET['remove'] === 'fail'){ ?>
                    <div class="alert alert-danger">
                        <p>Hapus Data Gagal!</p>
                    </div>
                <?php } elseif(isset($_GET['remove']) && $_GET['remove'] === 'invalid'){ ?>
                    <div class="alert alert-warning">
                        <p>Permintaan tidak valid!</p>
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
                                     <th>Nama Kategori </th>    
                                     <th>Kode Kategori</th>
                                     <th>Nama Produk</th>
                                     <th>Kode Produk</th>
                                     <th>Aksi</th>
                                 </tr>
                            </thead>
                            <tbody>
                            <?php 
				
                $hasil = $lihat -> lihat_produk();
                foreach($hasil as $isi) {
            ?>
             <tr>
                    <td><?php echo $isi['id_produk']; ?></td>
                    <td><?php echo $isi['nama_kategori']; ?></td>
                    <td><?php echo $isi['kode_kategori']; ?></td>
                    <td><?php echo $isi['nama_produk']; ?></td>
                    <td><?php echo $isi['kode_produk']; ?></td>
                    <td>   
                 <?php ?>
                     <a href="index.php?page=produk/edit&produk=<?php echo $isi['id_produk']; ?>"><button
                             class="btn btn-warning btn-xs">Edit</button></a>
                             <a href="fungsi/hapus/hapus.php?produk=hapus&id_produk=<?php echo $isi['id_produk']; ?>">
    <button class="btn btn-danger btn-xs">Hapus</button>
</a>
                 </td>
             </tr>
             <?php }?>
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
                                <form method="POST" action="fungsi/tambah/tambah.php?produk=tambah">
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
                                                 <td><input type="text" placeholder="Kode Kategori" required
                                                         class="form-control" name="kode_kategori" id="kode_kategori" readonly></td>
                                             </tr>
                                             <tr>
                                                 <td>Kode Produk</td>
                                                 <td><input type="text" placeholder="Kode Produk" required
                                                         class="form-control" name="kode_produk" id="kode_produk" readonly></td>
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
document.addEventListener('DOMContentLoaded', function() {
    // Isi kode kategori secara otomatis saat kategori dipilih
    document.getElementById('id_kategori').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let kodeKategori = selectedOption.getAttribute('data-kode');
        document.getElementById('kode_kategori').value = kodeKategori;

        // Generate new product code when category changes
        fetch('fungsi/tambah/tambah.php?produk=getLastKodeProduk&id_kategori=' + this.value)
            .then(response => response.text())
            .then(data => {
                let lastKodeProduk = data.match(/\d+$/);
                lastKodeProduk = lastKodeProduk ? parseInt(lastKodeProduk[0]) : 0;
                let nextKodeProduk = (lastKodeProduk + 1).toString().padStart(2, '0');
                document.getElementById('kode_produk').value = kodeKategori + nextKodeProduk;
            });
    });

    // Check if product name already exists
    document.getElementById('nama_produk').addEventListener('input', function() {
        let namaProduk = this.value;

        if (namaProduk) {
            fetch('fungsi/tambah/tambah.php?produk=checkNamaProduk&nama_produk=' + namaProduk)
                .then(response => response.text())
                .then(data => {
                    if (data === 'exists') {
                        alert('Nama produk sudah ada!');
                        document.getElementById('kode_produk').value = '';
                    }
                });
        }
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        let namaProduk = document.getElementById('nama_produk').value;

        // Check if product name already exists
        fetch('fungsi/tambah/tambah.php?produk=checkNamaProduk&nama_produk=' + namaProduk)
            .then(response => response.text())
            .then(data => {
                if (data === 'exists') {
                    alert('Nama produk sudah ada!');
                } else {
                    this.submit(); // Submit the form if product name does not exist
                }
            });
    });
});
</script>