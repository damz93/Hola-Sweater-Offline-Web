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
	$tgawal = $_POST['TGL_AWAL'];
	$tgakhir = $_POST['TGL_AKHIR'];
	$nominal = $_POST['NOMINAL'];
	$persen = $_POST['PERSEN'];
	$status = $_POST['STATUSX'];
	$nominal = str_replace(".","",$nominal);
	$persen = str_replace(".","",$persen);
	// query SQL untuk insert data
	$query="UPDATE t_diskon SET KETERANGAN='$keter',TGL_MULAI='$tgawal',TGL_SELESAI='$tgakhir',WAKTU='$waktu_skg',OLEH='$oleh',LAIN='$notes',NOMINAL='$nominal',PERSEN='$persen',STATUS='$status' where KODE_DISKON='$kode_diskon'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-diskon.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>