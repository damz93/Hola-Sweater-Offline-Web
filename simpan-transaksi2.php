<?php
   error_reporting(0);
   session_start();
   include 'koneksi.php';
   //include 'csrf.php';
    date_default_timezone_set('Asia/Hong_Kong');   
	$waktu_skg2 = date("d/m/Y h:i:s A");
   	$tgl = date("Y/m/d");
   	$oleh = $_SESSION['username'];
   	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;	
	$jenis_barang = $_POST['jenis_sweater'];
	$jenis_barangx = 'Costum';
	//$jenis_barangx = $jenis_barang.'(Costum)';
	$warnax = $_POST['bahan'];
	$size_x = '-';
	$qty1x = $_POST['qty2x'];
	$harga_satuanx = $_POST['harga_costumm'];
	$total_biaya1x = $_POST['total_biaya2'];
	$qty = $_POST['qty'];	
		$selectkode = mysqli_query($koneksi,"select KODE_COSTUM from t_costum where BAHAN='$warnax' AND JENIS_SWEATER='$jenis_barang'");
		while($d = mysqli_fetch_array($selectkode)){
			$kode_barang = $d['KODE_COSTUM'];
		}	
			$query = "INSERT into t_transaksi_temp(JENIS_BARANG,KODE_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('$jenis_barangx','$kode_barang','$harga_satuanx','$qty1x','$total_biaya1x','$total_biaya1x','$size_x','$warnax','$keterangan','$waktu_skg2','$tgl','$oleh')";
				if (mysqli_query($koneksi, $query)) {
				} else {
					echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
				}
   	mysqli_close($koneksi);   
?>