<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$koder   = $_GET['kode_transaksi'];
// query SQL untuk insert data
session_start();	
	if($_SESSION['status']!="login"){
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV KASIR")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_transaksi where KODE_TRANSAKSI='$koder'";
			if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terhapus');window.location.href='form-transaksi.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>