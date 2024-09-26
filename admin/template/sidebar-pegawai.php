   <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
   <!--sidebar start-->
   <?php
   $id = $_SESSION['pegawai']['id_member'];
   $hasil_profil = $lihat->member_edit($id);
   ?>
   <aside>
       <div id="sidebar" class="nav-collapse">
           <!-- sidebar menu start-->
           <ul class="sidebar-menu" id="nav-accordion" style="margin-top: 40%;">

               <h5 class="centered"><?php echo $hasil_profil['nm_member']; ?></h5>
               <h5 class="centered">( <?php echo $hasil_profil['NIK']; ?> )</h5>

               <li class="sub-menu">
                   <a href="index.php?page=jual">
                       <i class="fa fa-book"></i>
                       <span>Transaksi Jual</span>
                   </a>
               </li>
           </ul>
           <!-- sidebar menu end-->
       </div>
   </aside>
   <!--sidebar end-->
