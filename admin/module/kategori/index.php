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
                <table class="table table-bordered" id="example1">
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
                        $hasil = $lihat->kategori();
                        $no=1;
                        foreach($hasil as $isi){
                    ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $isi['nama_kategori'];?></td>
                            <td><?php echo $isi['kode_kategori'];?></td>
                            <td><?php echo $isi['tgl_input'];?></td>
                            <td>
                                <a href="index.php?page=kategori&uid=<?php echo $isi['id_kategori'];?>"><button class="btn btn-warning">Edit</button></a>
                                <a href="fungsi/hapus/hapus.php?kategori=hapus&id=<?php echo $isi['id_kategori'];?>" onclick="javascript:return confirm('Hapus Data Kategori ?');"><button class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                    <?php $no++; 
                }?>
                    </tbody>
                </table>
                <div class="clearfix" style="padding-top:16%;"></div>
            </div>
        </div>
    </section>
</section>

<head>
    <!-- ... existing code ... -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- ... existing code ... -->
</head>