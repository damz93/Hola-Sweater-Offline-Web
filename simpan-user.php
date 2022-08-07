<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
// menyimpan data kedalam variabel

$waktu_skg2 = date("d/m/Y h:i:s A");
$waktu_skg = date("Y/m/d");
$oleh = $_SESSION['username'];
$ketern = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
$username = $_POST['USERNAME'];
$nama_lengkap = $_POST['NAMA_LENGKAP'];
$password = $_POST['PASSWORD'];
$level = $_POST['LEVELX'];
// query SQL untuk insert data
$query="INSERT INTO t_user(AKTIF,USERNAME,NAMA,PASSWORD,TGL,KETERANGAN,WAKTU,OLEH,LEVEL)VALUES('YA','$username','$nama_lengkap','$password','$waktu_skg','$ketern','$waktu_skg2','$oleh','$level')";
//mysqli_query($koneksi,$query);
$cekdulu= "select * from t_user where USERNAME='$username'";
$prosescek= mysqli_query($koneksi, $cekdulu);
if (mysqli_num_rows($prosescek)>0) {    
	echo "<script>alert('Username sudah ada.');history.go(-1) </script>";
}
else {
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data tersimpan');window.location.href='form-user.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
}
?>