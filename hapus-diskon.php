<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	// menyimpan data id kedalam variabel
	$kode_diskon   = $_GET['kode_diskon'];
	// query SQL untuk insert data
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV ADMIN")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_diskon where KODE_DISKON='$kode_diskon'";
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data terhapus');window.location.href='form-diskon.php';</script>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>