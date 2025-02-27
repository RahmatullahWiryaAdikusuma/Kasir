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
                        <table class="table table-bordered table-striped display" id="barangTable">
                            <thead>
                                <tr style="background:#DFF0D8;color:#333;">
                                    <th>No.</th> <!-- Tambahkan kolom No -->                   
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            try {
                                $hasil = $lihat->lihat_satuan();
                                if (empty($hasil)) {
                                    echo "<tr><td colspan='10'>No data found...</td></tr>"; // Update colspan to 11
                                } else {
                                    $no = count($hasil); // Inisialisasi nomor urut dari jumlah total data
                                    foreach($hasil as $isi) {
                            ?>
                                <tr>
                                    <td><?php echo $no--; ?></td> <!-- Tampilkan nomor urut -->
                                    <td><?php echo $isi['satuan']; ?></td>            
                                    <td>   
                                        <button class="btn btn-warning btn-xs" onclick="editSatuan('<?php echo $isi['id_satuan']; ?>', '<?php echo $isi['satuan']; ?>')">Edit</button>
                                        <a href="fungsi/hapus/hapus.php?satuan=hapus&id_satuan=<?php echo $isi['id_satuan']; ?>"
                                            onclick="javascript:return confirm('Hapus Data satuan ?');"><button
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
                                <div class="modal-header" style="background:#F90000;color:#fff;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Satuan</h4>
                                </div>
                                <form action="fungsi/tambah/tambah.php?satuan=tambah" method="POST" onsubmit="return checkForm()">
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                            <tr>
                                                <td>Nama Satuan</td>
                                                <td><input type="text" placeholder="Masukkan nama satuan" required
                                                        class="form-control" name="satuan"></td>
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

                    <div id="editModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" style="border-radius:0px;">
                                <div class="modal-header" style="background:#F90000;color:#fff;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Satuan</h4>
                                </div>
                                <form action="fungsi/edit/edit.php?satuan=edit" method="POST" onsubmit="return checkForm()">
                                    <div class="modal-body">
                                        <table class="table table-striped bordered">
                                            <tr>
                                                <td>Nama Satuan</td>
                                                <td>
                                                    <input type="hidden" name="id_satuan" id="edit_id_satuan">
                                                    <input type="text" placeholder="Masukkan nama satuan" required
                                                        class="form-control" name="satuan" id="edit_satuan">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</section>

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
        "autoWidth": true,
        "responsive": true,
        "pageLength": 10,
        "pagingType": "simple_numbers",
        "language": {
            "paginate": {
                "next": "Next",
                "previous": "Previous"
            }
        },
        "drawCallback": function(settings) {
            var api = this.api();
            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate .pagination');
            var currentPage = api.page();
            var totalPages = api.page.info().pages;
            
            // Sembunyikan semua nomor halaman terlebih dahulu
            pagination.find('li.paginate_button:not(.next):not(.previous)').hide();
            
            // Logika untuk menampilkan halaman berdasarkan posisi current page
            if (currentPage <= 2) { // Jika di halaman 1 atau 2
                // Tampilkan 3 halaman pertama
                pagination.find('li.paginate_button:not(.next):not(.previous)').slice(0, 3).show();
            } else if (currentPage >= totalPages - 2) { // Jika di 2 halaman terakhir
                // Tampilkan 3 halaman terakhir
                pagination.find('li.paginate_button:not(.next):not(.previous)').slice(-3).show();
            } else { // Jika di tengah
                // Tampilkan halaman sebelum, current, dan sesudah
                pagination.find('li.paginate_button:not(.next):not(.previous)').each(function(index) {
                    if (index >= currentPage - 1 && index <= currentPage + 1) {
                        $(this).show();
                    }
                });
            }
            
            // Tampilkan halaman terakhir
            pagination.find('li.paginate_button:not(.next):not(.previous)').last().show();
            
            // Tambahkan ellipsis di awal jika diperlukan
            if (currentPage > 2) {
                pagination.find('li.paginate_button:not(.next):not(.previous)').first().show();
                var ellipsis = $('<li class="paginate_button disabled"><a href="#">...</a></li>');
                pagination.find('li.paginate_button:visible:not(.next):not(.previous)').first().after(ellipsis);
            }
        }
    });
});

function editSatuan(id_satuan, satuan) {
    // Set values to the edit form
    document.getElementById('edit_id_satuan').value = id_satuan;
    document.getElementById('edit_satuan').value = satuan;
    
    // Show the modal
    $('#editModal').modal('show');
}
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
