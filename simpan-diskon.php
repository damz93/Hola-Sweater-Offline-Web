<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg2 = date("d/m/Y h:i:s A");
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$kode_diskon = $_POST['KODE_DISKON'];
	$notes = $_POST['NOTES'];
	$nominal = $_POST['NOMINAL'];
	$minimal = $_POST['MINIMAL'];
	$nominal = str_replace(".","",$nominal);
	$minimal = str_replace(".","",$minimal);
	// query SQL untuk insert data
	//$query="INSERT INTO t_diskon(KODE_DISKON,KETERANGAN,TGL_MULAI,TGL_SELESAI,TGL,WAKTU,OLEH,LAIN,NOMINAL,PERSEN,STATUS)VALUES('$kode_diskon','$keterangan','$tgawal','$tgakhir','$tgl','$waktu_skg2','$oleh','$notes','$nominal','$persen','$status')";
	$query="INSERT INTO t_diskon(MINIMAL,KODE_DISKON,KETERANGAN,TGL,WAKTU,OLEH,NOMINAL,LAIN)VALUES('$minimal','$kode_diskon','$keterangan','$tgl','$waktu_skg2','$oleh','$nominal','$notes')";
	
	//mysqli_query($koneksi,$query);
	$cekdulu= "select * from t_diskon where KODE_DISKON='$kode_diskon'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		//echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
		echo "<script>alert('Kode Diskon sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='form-diskon.php';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>