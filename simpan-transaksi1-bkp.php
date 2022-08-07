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
	
	$qty = $_POST['qty'];
	//$harga_satuan = $_POST['harga_satuan'];
	//$tambahan = $_POST['tambahan'];
	//$qty = 1;
	//$total = $_POST['total'];
   	
	$cekdulu= "select * from t_transaksi_temp where OLEH='$oleh' AND KODE_BARANG='$kode_barang'";
	$prosescek= mysqli_query($koneksi, $cekdulu);
	if (mysqli_num_rows($prosescek)>0) {    
		$qtyz = mysqli_query($koneksi,"SELECT * FROM t_transaksi_temp where OLEH='$oleh' AND KODE_BARANG='$kode_barang'");
	        	while($data2 = mysqli_fetch_array($qtyz)){
	        		$stok2 = $data2['QTY'];					
					$harga = $data2['HARGA'];
					$diskon = $data2['DISKON'];
					$diskon2 = $data2['DISKON2'];
	        	}
	        	$total_stok = (int)$stok2 + 1;
				$total_harga = (int)$harga * (int)$total_stok;
				$total_harga2 = ((int)$qty * (int)$satuan) - ((int)$diskon*(int)$qty) ;
	        	$queryupd="UPDATE t_transaksi_temp SET TOTAL=".$total_harga.", QTY=".$total_stok.", TOTAL2=".$total_harga2." WHERE KODE_BARANG='$kode_barang' and OLEH='$oleh'";
	        	if (mysqli_query($koneksi, $queryupd)) {	        		
	        	}
	}
	else {			
		$selectbarang = mysqli_query($koneksi,"select * from t_stok where KODE_BARANG='$kode_barang'");
		while($d = mysqli_fetch_array($selectbarang)){
			$kode_barang = $d['KODE_BARANG'];
			$jenis_barang = $d['JENIS_BARANG'];
			$size = $d['SIZE_'];
			$warna = $d['WARNA'];
			$harga_satuan = $d['HARGA'];				
			//$kode_diskon = '0';
			//$diskon = 0;
		}		
		$selectcostum = mysqli_query($koneksi,"select * from t_costum where KODE_COSTUM='$kode_costum'");
		while($e = mysqli_fetch_array($selectcostum)){
			$kode_costum = $e['KODE_COSTUM'];
			$ket_costum = $e['KET_COSTUM'];
			$harga_cost = $e['HARGA'];
		}
		$selectdiskon = mysqli_query($koneksi,"select * from t_diskon where KODE_DISKON='$kode_promo'");
		while($f = mysqli_fetch_array($selectdiskon)){
			$kodis = $f['KODE_DISKON'];
			$potongan = $f['NOMINAL'];
		}
		
		$total_harga = (int)$harga_satuan * (int)$qty;
		$totcost = (int)$harga_cost * (int)$qty;
		$total_harga2 = ((int)$harga_satuan * (int)$qty) + ((int)$harga_cost * (int)$qty) - (int)$potongan ;
		
		if (strlen($warna)!=0){			
			$query = "INSERT into t_transaksi_temp(KODE_COSTUM,POTONGAN,COSTUM,KODE_BARANG,KODE_DISKON,JENIS_BARANG,HARGA,HARGA_TAMBAHAN,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('$kode_costum','$potongan','$ket_costum','$kode_barang','$kode_promo','$jenis_barang','$harga_satuan','$totcost','$qty','$total_harga','$total_harga2','$size','$warna','$keterangan','$waktu_skg2','$tgl','$oleh')";
				if (mysqli_query($koneksi, $query)) {
					//echo "<script>alert('data tersimpan');window.location.href='form-user.php';</script>";		
				} else {
					echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
				}
		}
	//}
	
	//mysqli_query($koneksi, $insert);
   	mysqli_close($koneksi);   
?>