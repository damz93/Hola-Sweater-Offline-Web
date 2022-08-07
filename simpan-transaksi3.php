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
	$qty_totbagx = $_POST['qty_totbagx'];
	$biaya_totbegx = $_POST['biaya_totbegx'];
	$biaya_totbeg1x = $_POST['biaya_totbeg1x'];
	$biaya_packx = $_POST['biaya_packx'];
	$biaya_ongkirx = $_POST['biaya_ongkirx'];	
	$qty = $_POST['qty'];	
	$selectbrg = mysqli_query($koneksi,"select KODE_BARANG from t_stok where JENIS_BARANG='Totebag'");
		while($d = mysqli_fetch_array($selectbrg)){
			$kode_barang = $d['KODE_BARANG'];
		}					
	if 	($biaya_totbegx!=0){
		$query = "INSERT into t_transaksi_temp(JENIS_BARANG,KODE_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('Totebag','$kode_barang','$biaya_totbeg1x','$qty_totbagx','$biaya_totbegx','$biaya_totbegx','-','Totebag','$keterangan','$waktu_skg2','$tgl','$oleh')";
		if (mysqli_query($koneksi, $query)) {
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
			mysqli_close($koneksi);   
	}					
	if 	($biaya_packx!=0){
		$query = "INSERT into t_transaksi_temp(JENIS_BARANG,KODE_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('Packing','Packing','$biaya_packx','1','$biaya_packx','$biaya_packx','-','Packing','$keterangan','$waktu_skg2','$tgl','$oleh')";
		if (mysqli_query($koneksi, $query)) {
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
			mysqli_close($koneksi);   
	}				
	if 	($biaya_ongkirx!=0){
		$query = "INSERT into t_transaksi_temp(JENIS_BARANG,KODE_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH) VALUES('Ongkir','Ongkir','$biaya_ongkirx','1','$biaya_ongkirx','$biaya_ongkirx','-','Ongkir','$keterangan','$waktu_skg2','$tgl','$oleh')";
		if (mysqli_query($koneksi, $query)) {
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
			mysqli_close($koneksi);   
	}		
?>