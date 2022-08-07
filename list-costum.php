<?php
	include 'koneksi.php';
	$kode_costum = $_GET['kode_costum'];
	$query = mysqli_query($koneksi, "select * from t_costum where KODE_COSTUM='$kode_costum'");
	$barang = mysqli_fetch_array($query);
	$data = array(
				'kode_costum'      =>  $barang['KODE_COSTUM'],
				'jenis_costum'      =>  $barang['KET_COSTUM'],
				'harga'      =>  $barang['HARGA'],);
	 echo json_encode($data);
?>