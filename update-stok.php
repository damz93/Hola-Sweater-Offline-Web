<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	error_reporting(0);	
	// menyimpan data kedalam variabel
	$waktu_skg2 = date("d/m/Y h:i:s A");		
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$kode_barang = $_POST['KODE_BARANG'];
	$jenis_barang = $_POST['JENIS_BARANG'];
	$sizee = $_POST['SIZE'];
	$warna = $_POST['WARNA'];
	$qty = $_POST['QTY'];
	$qty = str_replace(".","",$qty);
	$qty2 = $_POST['QTY2'];
	$ktrg = $_POST['KETERANGAN'];
	$qty2 = str_replace(".","",$qty2);
	$qtyhasil = $qty+$qty2;
	$harga = $_POST['HARGA'];
	$harga = str_replace(".","",$harga);
// query SQL untuk insert data

	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV GUDANG")) {
		echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="UPDATE t_stok SET NOTES='$ktrg', JENIS_BARANG='$jenis_barang',TGL='$tgl',WAKTU='$waktu_skg2',KETERANGAN='$keterangan',OLEH='$oleh',HARGA='$harga',QTY='$qtyhasil',WARNA='$warna',SIZE_='$sizee' where KODE_BARANG='$kode_barang'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data terupdate');window.location.href='form-stok.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>