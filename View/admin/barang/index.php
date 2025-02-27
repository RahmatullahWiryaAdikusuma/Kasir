<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->

<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Data Merk</h3>
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
                        <table class="table table-bordered table-striped display" id="barangTable">
                            <thead>
                                <tr style="background:#DFF0D8;color:#333;">
                                    <th>No.</th>
                                    <th>Kode Merk</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Merk</th>
                                    <th>Satuan</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Tgl Input</th>
                                    <th>Tgl Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            try {
                                $sql = "SELECT b.*, p.nama_produk, s.satuan 
                                        FROM barang b 
                                        LEFT JOIN produk p ON b.id_produk = p.id_produk 
                                        LEFT JOIN satuan s ON b.id_satuan = s.id_satuan 
                                        ORDER BY b.id_barang DESC";
                                $stmt = $config->prepare($sql);
                                $stmt->execute();
                                $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (empty($hasil)) {
                                    echo "<tr><td colspan='10'>No data found...</td></tr>";
                                } else {
                                    $no = count($hasil);
                                    foreach($hasil as $isi) {
                            ?>
                                <tr>
                                    <td><?php echo $no--; ?></td>
                                    <td><?php echo $isi['kode_barang']; ?></td>
                                    <td><?php echo $isi['nama_produk']; ?></td>
                                    <td><?php echo $isi['nama_barang']; ?></td>
                                    <td><?php echo $isi['satuan']; ?></td>
                                    <td>Rp.<?php echo number_format($isi['harga_jual']); ?></td>
                                    <td><?php echo $isi['stok']; ?></td>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($isi['tgl_input'])); ?></td>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($isi['tgl_update'])); ?></td>
                                    <td>   
                                        <a href="index.php?page=barang/edit&barang=<?php echo $isi['id_barang']; ?>">
                                            <button class="btn btn-warning btn-xs">Edit</button>
                                        </a>
                                        <a href="fungsi/hapus/hapus.php?barang=hapus&id_barang=<?php echo $isi['id_barang']; ?>"
                                            onclick="javascript:return confirm('Hapus Data barang ?');">
                                            <button class="btn btn-danger btn-xs">Hapus</button>
                                        </a>
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
                                <div class="modal-header" style="background:#F90000;color:#fff;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Merk</h4>
                                </div>
                                <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST" onsubmit="return checkForm()">
                                    <input type="hidden" name="id_kategori" value="...">
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                            <tr>
                                                <td>Kategori</td>
                                                <td>
                                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                                        <option value="">Pilih Kategori</option>
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
                                                <td>Kode Barang</td>
                                                <td>
                                                    <select name="id_produk" id="id_produk" class="form-control" required>
                                                        <option value="">Pilih Kode Produk</option>
                                                    </select>
                                                    <input type="hidden" id="kode_produk" name="kode_produk">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Satuan</td>
                                                <td>
                                                    <select name="id_satuan" class="form-control" required>
                                                        <option value="">Pilih Satuan</option>
                                                        <?php 
                                                        $satuan = $lihat->lihat_satuan();
                                                        foreach($satuan as $sat){ 
                                                        ?>
                                                            <option value="<?php echo $sat['id_satuan']; ?>">
                                                                <?php echo $sat['satuan']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Merk</td>
                                                <td><input type="text" placeholder="Masukkan nama merk" required
                                                        class="form-control" name="nama_barang"></td>
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
$(document).ready(function() {
    // Event handler untuk perubahan kategori
    $('#id_kategori').change(function() {
        var kategoriId = $(this).val();
        var kodeProdukSelect = $('#id_produk');
        
        // Reset pilihan kode produk
        kodeProdukSelect.html('<option value="">Pilih Kode Produk</option>');
        
        if(kategoriId) {
            // Ambil data produk berdasarkan kategori
            $.ajax({
                url: 'fungsi/get_produk.php',
                type: 'GET',
                data: { kategori_id: kategoriId },
                dataType: 'json',
                success: function(data) {
                    if(data.length > 0) {
                        // Tambahkan opsi produk ke dropdown
                        data.forEach(function(item) {
                            kodeProdukSelect.append(
                                $('<option></option>')
                                    .attr('value', item.id_produk)
                                    .text(item.kode_produk + ' (' + item.nama_produk + ')')
                            );
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });

    // Event handler untuk perubahan kode produk
    $('#id_produk').change(function() {
        var kodeProduk = $(this).find('option:selected').text().split('(')[0].trim();
        $('#kode_produk').val(kodeProduk);
    });
});
</script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#barangTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "order": [[0, 'desc']],
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 10,
        "pagingType": "simple_numbers",
        "language": {
            "paginate": {
                "next": "Next",
                "previous": "Previous"
            }
        }
    });
});
</script>

<style>
.dataTables_paginate .pagination {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.dataTables_paginate .pagination li {
    display: inline-block;
    margin: 0 2px;
}

.dataTables_paginate .pagination li a {
    padding: 6px 12px;
    border: 1px solid #ddd;
    color: #337ab7;
    text-decoration: none;
    border-radius: 3px;
}

.dataTables_paginate .pagination li.active a {
    background-color: #337ab7;
    color: white;
    border-color: #337ab7;
}

.dataTables_paginate .pagination li.disabled a {
    color: #777;
    cursor: not-allowed;
}

.dataTables_paginate .pagination li:not(.active):not(.disabled) a:hover {
    background-color: #eee;
}
</style>

<script>
function checkForm() {
    var kategori = document.getElementById('id_kategori').value;
    var produk = document.getElementById('id_produk').value;
    var satuan = document.getElementsByName('id_satuan')[0].value;
    var nama = document.getElementsByName('nama_barang')[0].value;
    var harga = document.getElementsByName('harga_jual')[0].value;
    var stok = document.getElementsByName('stok')[0].value;

    if (!kategori || !produk || !satuan || !nama || !harga || !stok) {
        alert('Semua field harus diisi!');
        return false;
    }
    return true;
}
</script>
