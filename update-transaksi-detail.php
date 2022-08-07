<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$kod_bar   = $_GET['kode_barang'];
$tambahan   = $_GET['tambahan'];
$qty = $_GET['qty'];
$qty = str_replace(".","",$qty); 

$harga = mysqli_query($koneksi,"SELECT HARGA,POTONGAN,HARGA_TAMBAHAN,KODE_COSTUM FROM t_transaksi_temp WHERE KODE_BARANG='$kod_bar' and HARGA_TAMBAHAN='$tambahan'");
	        	while($data2 = mysqli_fetch_array($harga)){
	        		$satuan = $data2['HARGA'];					
	        		$diskon = $data2['POTONGAN'];					
	        		$kode_cos = $data2['KODE_COSTUM'];					
	        		$tambahan = $data2['HARGA_TAMBAHAN'];					
	        	}
				
				
				$costum = mysqli_query($koneksi,"SELECT HARGA FROM t_costum WHERE KODE_COSTUM='$kode_cos'");
	        	while($datacos = mysqli_fetch_array($costum)){
	        		$harga_cost = $datacos['HARGA'];								
	        	}
$tot_tambahan = (int)$qty * (int)$harga_cost;
$total = (int)$qty * (int)$satuan;
$tot_disk = (int)$diskon;
$total2 = ((int)$qty * (int)$satuan) - (int)$diskon + ((int)$harga_cost*(int)$qty) ;
$query="UPDATE t_transaksi_temp SET HARGA_TAMBAHAN='$tot_tambahan',QTY='$qty',TOTAL='$total',TOTAL2='$total2' where KODE_BARANG='$kod_bar' and HARGA_TAMBAHAN='$tambahan'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='input-transaksi.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>