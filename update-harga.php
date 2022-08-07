<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$oleh = $_SESSION['username'];
	$kode_barang = $_POST['KODE_BARANG'];
	$kategori = $_POST['KATEGORIX'];
	$keterangan = $_POST['KETERANGAN'];
	$nominal = $_POST['NOMINAL'];
	$nominal = str_replace(".","",$nominal); 
	$query="UPDATE t_pengeluaran SET KATEGORI='$kategori',NOTES='$keterangan',KETERANGAN='$keter',NOMINAL='$nominal' where KODE_PENGELUARAN='$kode_pengeluaran'";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-pengeluaran.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>