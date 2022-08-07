<?php
   error_reporting(0);
   session_start();
   include 'koneksi.php';
   //include 'csrf.php';
    date_default_timezone_set('Asia/Hong_Kong');
	$waktu_skg2 = date("d/m/Y h:i:s A");
   	$tgl = date("Y/m/d");
   	$oleh = $_SESSION['username'];
	$kode_resi = $_POST['kode_transaksi'];
   	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$jenis_kostum = $_POST['jenisx'];
	$opsi_kostum = $_POST['opsi_kostum'];
	$notes = $_POST['notes'];
	$qty = $_POST['qty'];
   	$insert = "INSERT into t_order_temp(KODE_ORDER,TGL,WAKTU,OLEH,KETERANGAN,JENIS_COSTUM,OPSI_COSTUM,NOTES,QTY) VALUES('$kode_resi','$tgl','$waktu_skg2','$oleh','$keterangan','$jenis_kostum','$opsi_kostum','$notes','$qty')";
   	mysqli_query($koneksi, $insert);
   	mysqli_close($koneksi);   
?>