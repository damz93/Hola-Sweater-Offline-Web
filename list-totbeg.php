<?php
include 'koneksi.php';
$jenis = $_GET['jenisx'];
$query = mysqli_query($koneksi, "select * from t_stok where JENIS_BARANG='$jenis'");
$barang = mysqli_fetch_array($query);
$data = array(
            'jenis_barang'      =>  $barang['JENIS_BARANG'],
			'harga_satuan'      =>  $barang['HARGA'],);
 echo json_encode($data);
?>