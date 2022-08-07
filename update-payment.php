<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$koder   = $_GET['kode_transaksi'];
$paym   = $_GET['paym'];
$pesan = 'Berhasil mengupdate Metode Payment ('.$koder.') ke '.$paym;
// query SQL untuk insert data
session_start();	
	if($_SESSION['status']!="login"){
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV KASIR")) {		
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="UPDATE t_transaksi set PAYMENT='$paym' WHERE KODE_TRANSAKSI='$koder'";
			if (mysqli_query($koneksi, $query)) {
			//	echo "<script>alert('data terupdate');window.location.href='form-transaksi.php';</script>";		
				echo "<script>alert('".$pesan."');window.location.href='form-transaksi.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>