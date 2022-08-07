<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$id   = $_GET['id'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if($_SESSION['level']!="OWNER") {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_bahan where ID='$id'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terhapus');window.location.href='input-costum';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>