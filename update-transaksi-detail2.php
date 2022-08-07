<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$kod_bar   = $_GET['kode_barang'];
$kodsk = $_GET['kodprom'];
$qty = $_GET['qty'];

$diskonx = mysqli_query($koneksi,"SELECT NOMINAL FROM t_diskon WHERE KODE_DISKON='".$kodsk."'");
	        	while($dd = mysqli_fetch_array($diskonx)){
	        		$diskon = $dd['NOMINAL'];					
	        	}
				
$harga = mysqli_query($koneksi,"SELECT HARGA FROM t_transaksi_temp WHERE KODE_BARANG='".$kod_bar."'");
	        	while($data2 = mysqli_fetch_array($harga)){
	        		$satuan = $data2['HARGA'];					
	        	}
$total = (int)$qty * (int)$satuan;
$tot_disk = (int)$diskon * (int)$qty;
$total2 = ((int)$qty * (int)$satuan) - ((int)$diskon*(int)$qty) ;
$query="UPDATE t_transaksi_temp SET DISKON='$diskon', DISKON2='$tot_disk', KODE_DISKON='$kodsk', QTY='$qty', TOTAL='$total', TOTAL2='$total2' where KODE_BARANG='$kod_bar'";
if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('data terupdate');window.location.href='input-transaksi.php';</script>";		
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>