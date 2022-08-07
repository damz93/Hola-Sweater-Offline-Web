<?php
include 'koneksi.php';
$kode_transaksi = $_GET['kode_transaksi'];
$query = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='$kode_transaksi'");
$kod_trans = mysqli_fetch_array($query);
$data = array(
            'kode_transaksi'      =>  $kod_trans['KODE_TRANSAKSI'],);
 echo json_encode($data);
?>