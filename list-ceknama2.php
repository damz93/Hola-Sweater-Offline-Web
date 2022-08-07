<?php
include 'koneksi.php';
$kode_barang = $_GET['kode_barang'];
$query = mysqli_query($koneksi, "select * from t_stok where KODE_BARANG='$kode_barang'");
$barang = mysqli_fetch_array($query);
$data = array(
            'kode_barang'      =>  $barang['KODE_BARANG'],
			'harga'      =>  $barang['HARGA'],
			'jenis_barang'      =>  $barang['JENIS_BARANG'],
			'warna'      =>  $barang['WARNA'],
			'qty'      =>  $barang['QTY'],);
 echo json_encode($data);
?>