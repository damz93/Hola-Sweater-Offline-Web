<?php
	include 'koneksi.php';
	include "excel_reader2.php";
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	//$all_kode_akses = '';
	//require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require('spreadsheet-reader-master/SpreadsheetReader.php');

	$target = basename($_FILES['berkas_akses']['name']) ;
	move_uploaded_file($_FILES['berkas_akses']['tmp_name'], $target);

	$Reader = new SpreadsheetReader($target);

	// beri permisi agar file xls dapat di baca
	chmod($_FILES['berkas_akses']['name'],0777);

	// mengambil isi file xls
	$berhasil = 0;
	//mysqli_query($koneksi,"DELETE FROM t_akses");
	foreach ($Reader as $Key => $Row){
	   // import data excel mulai baris ke-2 (karena ada header pada baris 1)
	   if ($Key < 1) continue;   
	   $query = mysqli_query($koneksi,"INSERT into t_akses(KODE_AKSES,NAMA_AKSES,STATUS)values('".$Row[0]."','".$Row[1]."','".$Row[2]."')");
	   $berhasil++;	
	}
	  if ($query) {
			
		$selamat = 'Data terupload ('.$berhasil.' data)';
		echo "<script>alert('".$selamat."');window.location.href='upload-akses.php';</script>";
		mysqli_query($koneksi,"DELETE FROM t_akses WHERE KODE_AKSES=''");
		/*$oleh = $_SESSION['username'];
		$keterangan = $oleh." - UPLOAD BARANG - ".$all_kode_akses;
		$queryx="INSERT INTO tbl_log(TANDA,KETERANGAN,OLEH)VALUES('UPLOAD','$keterangan','$oleh')";
		if (mysqli_query($koneksi, $queryx)) {			
		}*/
		//header("location:form_laporan.php?berhasil=$berhasil");
	  }else{
		echo mysql_error();
	   } 
?>