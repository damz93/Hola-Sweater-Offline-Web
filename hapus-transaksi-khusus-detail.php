<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$kode_barang   = $_GET['kode_barang'];
$tambahan   = $_GET['tambahan'];
$query="DELETE from t_transaksi_khusus_temp where KODE_BARANG='$kode_barang'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terhapus');window.location.href='input-transaksi.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>