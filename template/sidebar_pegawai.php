<?php 
  // Cek role dan set variable yang sesuai
  if(isset($_SESSION['Member'])) {
    $role = 'Member';
    $id = $_SESSION['Member']['id_user'];
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

        <!-- Profile Section untuk Member dengan padding tambahan -->
        <?php if(isset($_SESSION['Member'])): ?>
            <div class="profile-info text-center" style="padding: 30px 0 20px 0;">
                <?php
                $sql = "SELECT * FROM user WHERE id_user = ? AND role = 'Member'";
                $row = $config->prepare($sql);
                $row->execute([$_SESSION['Member']['id_user']]);
                $hasil = $row->fetch();
                
                if($hasil): ?>
                    <h5 class="centered" style="margin: 10px 0; font-size: 14px; color: white;"><?php echo $hasil['nama'];?></h5>
                    <h5 class="centered" style="margin: 5px 0; font-size: 12px; color: #aaa;">( <?php echo $hasil['no_telp'];?> )</h5>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Menu dengan posisi tetap -->
        <ul class="sidebar-menu" id="nav-accordion" style="margin-top: 15px;">
            <?php if($role == 'Member'): ?>
                <!-- Member Menu Items -->
                <li class="sub-menu">
                    <a href="index.php?page=jual">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Transaksi Jual</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside> 