<?php
error_reporting(0);	
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
$oleh = $_SESSION['username'];
$kategori = $_POST['kategori'];
// query SQL untuk insert data
$query="INSERT INTO t_kategori_pengeluaran(KATEGORI,NOTES)VALUES('$kategori','$oleh')";
	$cekdulu= "select * from t_kategori_pengeluaran where KATEGORI='$kategori'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		echo "<script>alert('Kategori sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='input-pengeluaran';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>