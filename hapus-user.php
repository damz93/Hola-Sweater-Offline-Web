<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$id   = $_GET['id'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV GUDANG")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_user where ID='$id'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terhapus');window.location.href='form-user.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>