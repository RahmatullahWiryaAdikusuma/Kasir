<?php 
	session_start();
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();

	// Ambil data kasir dari session user yang sedang login
	$id_user = $_SESSION['id_user']; // Mengambil id_user dari session
	$sql_kasir = "SELECT nama FROM user WHERE id_user = ? AND role = 'Member'";
	$stmt = $config->prepare($sql_kasir);
	$stmt->execute([$id_user]);
	$kasir = $stmt->fetch();

	// Ambil nilai bayar dan kembali dari parameter URL atau session
	$bayar = isset($_GET['bayar']) ? $_GET['bayar'] : (isset($_SESSION['jumlah_bayar']) ? $_SESSION['jumlah_bayar'] : 0);
	$kembali = isset($_GET['kembali']) ? $_GET['kembali'] : (isset($_SESSION['kembali']) ? $_SESSION['kembali'] : 0);

	// Debug untuk melihat isi session dan hasil query
	error_log("Session Data: " . print_r($_SESSION, true));
	error_log("Kasir Data: " . print_r($kasir, true));
?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
						<p><?php echo $toko['nama_toko'];?></p>
						<p><?php echo $toko['alamat_toko'];?></p>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo isset($kasir['nama']) ? $kasir['nama'] : 'Tidak diketahui'; ?></p>
						<p>Kode Nota : <?php echo $_SESSION['kode_nota'];?></p>
					</center>
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Merk</td>
							<td>Satuan</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<?php $no=1; foreach($hsl as $isi){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $isi['nama_produk'];?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['satuan'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
						</tr>
						<?php $no++; }?>
					</table>
					<div class="pull-right">
						<?php $hasil = $lihat -> jumlah(); ?>
						Total : Rp.<?php echo number_format($hasil['bayar']);?>,-
						<br/>
						Bayar : Rp.<?php echo number_format($bayar);?>,-
						<br/>
						Kembali : Rp.<?php echo number_format($kembali);?>,-
					</div>
					<div class="clearfix"></div>
					<center>
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
</html>
