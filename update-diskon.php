<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	
	$waktu_skg = date("d/m/Y h:i:s A");
	$tgl_saja = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kode_diskon = $_POST['KODE_DISKON'];
	$notes = $_POST['NOTES'];
	$nominal = $_POST['NOMINAL'];	
	$nominal = str_replace(".","",$nominal);
	$minimal = $_POST['MINIMAL'];	
	$minimal = str_replace(".","",$minimal);
	$query="UPDATE t_diskon SET MINIMAL='$minimal',KETERANGAN='$keter',WAKTU='$waktu_skg',OLEH='$oleh',LAIN='$notes',NOMINAL='$nominal' where KODE_DISKON='$kode_diskon'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-diskon';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>