<?php
include 'koneksi.php';
$kode_promo = $_GET['kode_promo'];
$query = mysqli_query($koneksi, "select * from t_diskon where KODE_DISKON='$kode_promo' AND TGL_SELESAI>=CURDATE()");
$barang = mysqli_fetch_array($query);
$data = array(
            'kode_diskon'      =>  $barang['KODE_DISKON'],
            'lain'      =>  $barang['LAIN'],
			'nominal'      =>  $barang['NOMINAL'],);
 echo json_encode($data);
?>