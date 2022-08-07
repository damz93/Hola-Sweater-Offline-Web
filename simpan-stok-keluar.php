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
	$kode_barang = $_POST['kode_barang'];
	//$tambahan = $_POST['tambahan'];
	$kode_transaksi = $_POST['kode_transaksi'];
	$qtynya = 1;
	
   	
	$cekdulu= "select * from t_stok_keluar_temp where OLEH='$oleh' AND KODE_BARANG='$kode_barang'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {    
		$qty = mysqli_query($koneksi,"SELECT * FROM t_stok_keluar_temp where OLEH='$oleh' AND KODE_BARANG='$kode_barang'");
	        	while($data2 = mysqli_fetch_array($qty)){
	        		$stok2 = $data2['QTY'];					
	        	}
	        	$total_stok = (int)$stok2 + 1;
				$total_harga = (int)$total * (int)$total_stok;
	        	$queryupd="UPDATE t_stok_keluar_temp SET QTY=".$total_stok." WHERE KODE_BARANG='$kode_barang' and OLEH='$oleh'";
	        	if (mysqli_query($koneksi, $queryupd)) {	        		
	        	}
	}
	else {	
		$selectbarang = mysqli_query($koneksi,"select * from t_stok where KODE_BARANG='$kode_barang' AND NOTES='GUDANG'");
		while($d = mysqli_fetch_array($selectbarang)){
			$jenis_barang = $d['JENIS_BARANG'];
			$size = $d['SIZE_'];
			$warna = $d['WARNA'];
		}
		
		if (strlen($warna)!=0){	
		$query = "INSERT into t_stok_keluar_temp(KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,QTY,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('$kode_transaksi','$kode_barang','$jenis_barang','$qtynya','$size','$warna','$keterangan','$waktu_skg2','$tgl','$oleh')";
			if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('data tersimpan');window.location.href='form-stok-keluar.php';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
		}
	}
	
	//mysqli_query($koneksi, $insert);
   	mysqli_close($koneksi);   
?>