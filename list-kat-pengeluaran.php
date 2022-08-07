<?php
include 'koneksi.php';
$kat = $_GET['kategori'];
$query = mysqli_query($koneksi, "select * from t_kategori_pengeluaran where KATEGORI='$kat'");
$katt = mysqli_fetch_array($query);
$data = array(
            'kategori'      =>  $katt['KATEGORI'],);
 echo json_encode($data);
?>