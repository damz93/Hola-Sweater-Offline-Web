<?php
session_start();
include 'koneksi.php';
// menyimpan data id kedalam variabel
$kod_bar   = $_GET['kode_barang'];
$qty = $_GET['qty'];
$qty = str_replace(".","",$qty); 
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="UPDATE t_stok_keluar_temp SET QTY='$qty' where KODE_BARANG='$kod_bar'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terupdate');window.location.href='input-stok-keluar.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>