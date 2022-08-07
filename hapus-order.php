<?php
   include 'koneksi.php';
    error_reporting(0);
	session_start();	
   // menyimpan data id kedalam variabel
   $koder   = $_GET['kode_order'];     			
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV ADMIN")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {   
		$query="DELETE from t_order where KODE_ORDER='$koder'";
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data terhapus');window.location.href='form-order.php';</script>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}		
	}
?>