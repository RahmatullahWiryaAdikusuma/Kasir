<?php 
  // Cek role dan set variable yang sesuai
  if(isset($_SESSION['Admin'])) {
    $role = 'Admin';
    $id = $_SESSION['Admin']['id_user'];
    $nama = $hasil_profil['nama'];
    $telp = $hasil_profil['no_telp'];
    $foto = $hasil_profil['gambar'];
  } 
?>
<aside>
    <div style="background: #434343;" id="sidebar" class="nav-collapse">
        <!-- Logo dan Nama -->
        <div style="padding: 10px 0; text-align: center;">
            <div style="width: 70px; height: 40px; margin: 0 auto;">
                <span style="color: white; font-size: 30px;">( )</span>
            </div>
        </div>

        <!-- Profile Section dengan padding yang lebih kecil -->
        <?php if(isset($_SESSION['Admin'])): ?>
            <div class="profile-info text-center" style="padding: 5px 0;">
                <?php
                // Ambil data Admin berdasarkan role
                $sql = "SELECT * FROM user WHERE role = 'Admin' LIMIT 1";
                $row = $config->prepare($sql);
                $row->execute();
                $hasil = $row->fetch();
                
                if($hasil): ?>
                    <img src="assets/img/user/<?php echo !empty($hasil['gambar']) ? $hasil['gambar'] : 'default.jpg'; ?>" 
                         class="img-circle" width="100" height="95" style="margin: 5px auto;">
                    <h5 class="centered" style="margin: 3px 0; font-size: 12px;"><?php echo $hasil['nama'];?></h5>
                    <h5 class="centered" style="margin: 3px 0; font-size: 12px;">( <?php echo $hasil['no_telp'];?> )</h5>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Menu dengan posisi tetap -->
        <ul class="sidebar-menu" id="nav-accordion" style="margin-top: 5px;">
            <?php if($role == 'Admin'): ?>
            <!-- Admin Menu Items -->
            <li class="mt">
                <a href="index.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="index.php?page=laporan">
                    <i class="fa fa-book"></i>
                    <span>Laporan Penjualan</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-desktop"></i>
                    <span>Master <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                </a>
                <ul class="sub">
                    <li><a href="index.php?page=barang">Merk</a></li>
                    <li><a href="index.php?page=produk">Barang</a></li>
                    <li><a href="index.php?page=kategori">Kategori</a></li>
                    <li><a href="index.php?page=satuan">Satuan</a></li>
                    <li><a href="index.php?page=pegawai">Pegawai</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cog"></i>
                    <span>Setting <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                </a>
                <ul class="sub">
                    <li><a href="index.php?page=pengaturan">Pengaturan Toko</a></li>
                    <li><a href="index.php?page=user">Pengaturan User</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>