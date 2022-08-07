<?php
include 'koneksi.php';
$kode_order = $_GET['kode_order'];
$query = mysqli_query($koneksi, "select * from t_order where KODE_ORDER='$kode_order'");
$kod_trans = mysqli_fetch_array($query);
$data = array(
            'kode_order'      =>  $kod_trans['KODE_ORDER'],);
 echo json_encode($data);
?>