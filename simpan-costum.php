<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg2 = date("d/m/Y h:i:s A");
	$tgl = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$kode_costum = $_POST['KODE_COSTUM'];
	$notes = $_POST['KETERANGAN'];
	$harga = $_POST['HARGA'];
	$bahanx = $_POST['BAHANX'];
	$jenis_sweaterx= $_POST['JENIS_SWEATER'];
	$status = $_POST['STATUSX'];
	$harga = str_replace(".","",$harga);
	// query SQL untuk insert data
	$query="INSERT INTO t_costum(BAHAN,JENIS_SWEATER,KODE_COSTUM,KET_COSTUM,HARGA,STATUS,WAKTU,OLEH,TGL,KETERANGAN)VALUES('$bahanx','$jenis_sweaterx','$kode_costum','$notes','$harga','$status','$waktu_skg2','$oleh','$tgl','$keterangan')";
	//mysqli_query($koneksi,$query);
	$cekdulu= "select * from t_costum where KODE_COSTUM='$kode_costum'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {
		//echo "<script>alert('Kode Barang sudah ada.');history.go(-1) </script>";
		echo "<script>alert('Kode Costum sudah ada.');history.go(-1) </script>";
	}
	else {
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('data tersimpan');window.location.href='form-costum.php';</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	}
?>