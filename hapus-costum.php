<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	// menyimpan data id kedalam variabel
	$kode_costum   = $_GET['kode_costum'];
	// query SQL untuk insert data
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV KASIR")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_costum where KODE_COSTUM='$kode_costum'";
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data terhapus');window.location.href='form-costum';</script>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>