<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$query="DELETE from t_transaksi_temp";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data clear...');window.location.href='input-transaksi.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>