<?php
error_reporting(0);	
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
$oleh = $_SESSION['username'];
$bahan = $_POST['bahan'];
// query SQL untuk insert data
$query="INSERT INTO t_bahan(BAHAN,NOTES)VALUES('$bahan','$oleh')";
	$cekdulu= "select * from t_bahan where BAHAN='$bahan'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		echo "<script>alert('Bahan sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='input-pengeluaran';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>