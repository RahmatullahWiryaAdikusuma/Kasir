<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Data Kategori</h3>
                <br/>
                <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success">
                    <p>Tambah Data Berhasil !</p>
                </div>
                <?php }?>
                <?php if(isset($_GET['success-edit'])){?>
                <div class="alert alert-success">
                    <p>Update Data Berhasil !</p>
                </div>
                <?php }?>
                <?php if(isset($_GET['remove'])){?>
                <div class="alert alert-danger">
                    <p>Hapus Data Berhasil !</p>
                </div>
                <?php }?>
                <?php 
                    if(!empty($_GET['uid'])){
                    $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
                    $row = $config->prepare($sql);
                    $row->execute(array($_GET['uid']));
                    $edit = $row->fetch();
                ?>
                <form method="POST" action="fungsi/edit/edit.php?kategori=edit">
                    <table>
                        <tr>
                            <td style="width:15pc;">
                                <input type="text" class="form-control" value="<?= $edit['nama_kategori'];?>" required name="kategori" placeholder="Masukan Kategori Barang Baru">
                                <input type="hidden" name="id" value="<?= $edit['id_kategori'];?>">    
                                <input type="text" class="form-control" value="<?= $edit['kode_kategori'];?>" required name="kode_kategori" placeholder="Masukan Kode Kategori Baru">
                            </td>
                            <td style="padding-left:10px;">
                                <button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah Data</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php }else{?>
                <form method="POST" action="fungsi/tambah/tambah.php?kategori=tambah">
                    <table>
                        <tr>
                            <td style="width:15pc;">
                                <input type="text" class="form-control" required name="kategori" placeholder="Masukan Kategori Barang Baru">
                            </td>
                            <td style="width:15pc;">
                                <input type="text" class="form-control" required name="kode_kategori" placeholder="Masukan Kode Kategori Baru">
                            </td>
                            <td style="padding-left:10px;">
                                <button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php }?>
                <br/>
                <table class="table table-bordered" id="kategoriTable">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>Kategori</th>
                            <th>Kode Kategori</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        try {
                            $hasil = $lihat -> kategori();
                            if (empty($hasil)) {
                                echo "<tr><td colspan='4'>No data found...</td></tr>";
                            } else {
                                $data_terbalik = array_reverse($hasil);
                                $no = 1;
                                foreach($data_terbalik as $isi) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $isi['nama_kategori'];?></td>
                            <td><?php echo $isi['kode_kategori'];?></td>
                            <td><?php echo $isi['tgl_input'];?></td>
                            <td>
                                <a href="index.php?page=kategori&uid=<?php echo $isi['id_kategori'];?>"><button class="btn btn-warning">Edit</button></a>
                                <a href="fungsi/hapus/hapus.php?kategori=hapus&id=<?php echo $isi['id_kategori'];?>" onclick="javascript:return confirm('Hapus Data Kategori ?');"><button class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                    <?php }
                            }
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                    </tbody>
                </table>
                <div class="clearfix" style="padding-top:16%;"></div>
            </div>
        </div>
    </section>
</section>

<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#kategoriTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [[0, 'desc']],
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 10,
            "displayStart": 0
        });
    });
    </script>
</head>
