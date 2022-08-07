<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$notes   = $_GET['notes'];
$query="DELETE from t_order_temp where NOTES='$notes'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terhapus');window.location.href='input-order.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>