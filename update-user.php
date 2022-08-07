<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
// menyimpan data kedalam variabel

$waktu_skg = date("d/m/Y h:i:s A");
$waktu_skg2 = date("Y/m/d");
$oleh = $_SESSION['username'];
$level = $_POST['LEVELX'];
$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
$username = $_POST['USERNAME'];
$nama_lengkap = $_POST['NAMA_LENGKAP'];
$password = $_POST['PASSWORD'];
// query SQL untuk insert data
$query="UPDATE t_user SET KETERANGAN='$keter',WAKTU='$waktu_skg',NAMA='$nama_lengkap',OLEH='$oleh',PASSWORD='$password' where USERNAME='$username'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='form-user.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>