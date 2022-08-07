<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$kod_bar   = $_GET['notes'];
$qty = $_GET['qty'];
$qty = str_replace(".","",$qty); 
$query="UPDATE t_order_temp SET QTY='$qty' where NOTES='$kod_bar'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='input-order.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>