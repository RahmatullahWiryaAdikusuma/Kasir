<?php 
/*
  | 
  | @package   : pos-kasir-php
  | @file	   : index.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/read/source-code-aplikasi-penjualan-barang-kasir-dengan-php-amp-mysql-gratis.html
  | 
  | 
  | 
  | 
 */

	@ob_start();
	session_start();

	if(!empty($_SESSION['Admin']) && $_SESSION['role'] == 'Superuser'){
		// Redirect ke dashboard superuser
		echo '<script>window.location="admin/superuser_dashboard.php";</script>';
	}
	else if(!empty($_SESSION['Admin']) && $_SESSION['role'] == 'Admin'){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		// admin view
		include 'template/header.php';
		include 'template/sidebar.php';
		if(!empty($_GET['page'])){
			$page = $_GET['page'];
			if($page == 'satuan'){
				include 'View/admin/satuan/index.php';
			} else if($page == 'satuan/edit'){
				include 'View/admin/satuan/edit/index.php';
			} else {
				include 'View/admin/'.$_GET['page'].'/index.php';
			}
		}else{
			include 'template/home.php';
		}
		include 'View/module/index.php';
		include 'template/footer.php';
	} 

	else if (!empty($_SESSION['Member']) && $_SESSION['role'] == 'Member'){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		
		// Ambil data profil Member yang sedang login
		$id_member = $_SESSION['Member']['id_user'];
		$sql_profil = "SELECT * FROM user WHERE id_user = ? AND role = 'Member'";
		$row = $config->prepare($sql_profil);
		$row->execute([$id_member]);
		$hasil_profil = $row->fetch();
		
		// member/pegawai view
		include 'template/header.php';
		include 'template/sidebar_pegawai.php';
		include 'View/member/jual/index.php';
		include 'template/footer.php';
	}
	
	else {
		echo '<script>window.location="login.php";</script>';
	}
?>

