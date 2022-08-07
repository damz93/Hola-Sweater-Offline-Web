<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$kode_pengeluaran   = $_GET['kode_pengeluaran'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if($_SESSION['level']!="OWNER") {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_pengeluaran where KODE_PENGELUARAN='$kode_pengeluaran'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terhapus');window.location.href='form-pengeluaran.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>