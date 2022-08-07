<?php
include 'koneksi.php';
$bahanx = $_GET['bahanx'];
$jenis_sweaterx = $_GET['jenis_sweaterx'];
$query = mysqli_query($koneksi, "select * from t_costum where BAHAN='$bahanx' AND JENIS_SWEATER='$jenis_sweaterx'");
$barang = mysqli_fetch_array($query);
if (mysqli_num_rows($query) <> null){
	$data = array(
				'kode_costum'      =>  $barang['KODE_COSTUM'],
				'harga_satuan'      =>  $barang['HARGA'],);
	 echo json_encode($data);
}
else{
	$data = array(
				'harga_satuan'      =>  '0',);
	 echo json_encode($data);
}
?>