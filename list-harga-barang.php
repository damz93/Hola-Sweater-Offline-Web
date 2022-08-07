<?php
include 'koneksi.php';
$warna = $_GET['warna'];
$jenis_barang = $_GET['jenis_barang'];
$size_ = $_GET['size_'];
$query = mysqli_query($koneksi, "select * from t_stok where WARNA='$warna' AND JENIS_BARANG='$jenis_barang' AND SIZE_='$size_'");
$barang = mysqli_fetch_array($query);
if (mysqli_num_rows($query) <> null){
	$data = array(
				'kode_barang'      =>  $barang['KODE_BARANG'],
				'harga_satuan'      =>  $barang['HARGA'],);
	 echo json_encode($data);
}
else {	
	$data = array(
				'harga_satuan'      =>  '0',);
	 echo json_encode($data);
}
?>