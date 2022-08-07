<?php

	session_start();
	include 'koneksi.php';
	error_reporting(0);
date_default_timezone_set('Asia/Hong_Kong');
// menyimpan data id kedalam variabel
$kode_order   = $_GET['kode_order'];
$waktu_skg = date("d/m/Y h:i:s A");
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="DESIGNER" AND $_SESSION['level']!="OPERATOR"){
		echo "<script>alert('Anda tidak memiliki akses untuk update progress.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
					
		$statu = mysqli_query($koneksi,"SELECT STATUS FROM t_order WHERE KODE_ORDER='".$kode_order."'");
	        	while($data2 = mysqli_fetch_array($statu)){
	        		$status = $data2['STATUS'];					
				}	
		if ($status == "DESIGNER"){
			$status_upd = "OPERATOR";
			$sudh = "BELUM";
		}
		else if ($status == "OPERATOR"){
			$status_upd = "DONE";
			$sudh = "BELUM";
		}
		$query="UPDATE t_order SET WAKTU='$waktu_skg', SUDAH_LIHAT='$sudh', STATUS='$status_upd' where KODE_ORDER='$kode_order'";
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data terupdate');window.location.href='form-order';</script>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>