<?php
	error_reporting(0);	
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s A");		
	$level = $_SESSION['level'];
	if (($level == "OWNER") OR ($level == "OWNER")){
		$tgl_saja = $_POST['tgl_transaksi'];
	}
	else{
		$tgl_saja = date("Y/m/d");
	}
	$oleh = $_SESSION['username'];
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$kode_pengeluaran = $_POST['KODE_PENGELUARAN'];
	$kategori = $_POST['KATEGORIX'];
	$keterangan = $_POST['KETERANGAN'];
	
	$satuan = $_POST['HARGA_SATUAN'];
	$satuan_x = str_replace(".","",$satuan); 

	$qty = $_POST['QTY'];
	$qty_x = str_replace(".","",$qty); 

	$nominal = (int)$satuan_x * (int)$qty_x;
	$query="UPDATE t_pengeluaran SET QTY='$qty_x',PERITEM='$satuan_x',KATEGORI='$kategori',NOTES='$keterangan',KETERANGAN='$keter',NOMINAL='$nominal' where KODE_PENGELUARAN='$kode_pengeluaran'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-pengeluaran.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>