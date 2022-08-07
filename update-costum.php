<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	
	$waktu_skg = date("d/m/Y h:i:s A");
	$tgl_saja = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kode_costum = $_POST['KODE_COSTUM'];
	$notes = $_POST['KETERANGAN'];
	$harga = $_POST['HARGA'];
	$bahanx = $_POST['BAHANX'];
	$jenis_sweaterx= $_POST['JENIS_SWEATER'];
	$status = $_POST['STATUSX'];
	$harga = str_replace(".","",$harga);
	// query SQL untuk insert data
	$query="UPDATE t_costum SET BAHAN='$bahanx',JENIS_SWEATER='$jenis_sweaterx',KETERANGAN='$keter',WAKTU='$waktu_skg',OLEH='$oleh',KET_COSTUM='$notes',HARGA='$harga',STATUS='$status' where KODE_COSTUM='$kode_costum'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-costum.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>