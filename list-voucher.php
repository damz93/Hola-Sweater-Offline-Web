<?php
	include 'koneksi.php';
	error_reporting(0);
	$kode_promo = $_GET['kode_voucher'];
	$query = mysqli_query($koneksi, "select * from t_voucher where KODE_VOUCHER='$kode_promo' AND STATUS='AKTIF'");
	$barang = mysqli_fetch_array($query);
	$data = array(
				'kode_voucher'      =>  $barang['KODE_VOUCHER'],
				'nama_voucher2'      =>  $barang['NAMA_VOUCHER'],);			
	 echo json_encode($data);
?>