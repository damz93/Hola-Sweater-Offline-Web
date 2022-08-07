<?php 
	error_reporting(0);
	session_start();
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	$oleh = $_SESSION['username'];
	$kod_res = $_POST['kode_transaksi_'];	
	$status = $_POST['status'];	    
	$sql = mysqli_query($koneksi,"select * from t_order_temp WHERE OLEH='".$oleh."'");
		while($data = mysqli_fetch_array($sql)){
			$satuan = $data['HARGA_SATUAN'];	
			$keter = $data['KETERANGAN'];
			$tgl = $data['TGL'];
			$waktu = $data['WAKTU'];
			$jencos = $data['JENIS_COSTUM'];
			$qty = $data['QTY'];
			$opscos = $data['OPSI_COSTUM'];
			$nots = $data['NOTES'];
			$query="INSERT INTO t_order(KODE_ORDER,KETERANGAN,OLEH,TGL,WAKTU,QTY,JENIS_COSTUM,OPSI_COSTUM,NOTES,STATUS)VALUES('$kod_res','$keter','$oleh','$tgl','$waktu','$qty','$jencos','$opscos','$nots','$status')";
	        if (mysqli_query($koneksi, $query)) {				
				echo "<script>alert('data tersimpan');window.location.href='form-order.php';</script>";
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	        			        
	        	/* mengambil data barang
	        	$stok = mysqli_query($koneksi,"SELECT STOK FROM tbl_barang WHERE KODE_BARANG='".$kode_barang."'");
	        	while($data2 = mysqli_fetch_array($stok)){
	        		$stok2 = $data2['STOK'];					
	        	}
	        	$sisa_stok = (int)$stok2 - (int)$kuantitas;
	        	$queryupd="UPDATE tbl_barang SET STOK=".$sisa_stok." WHERE KODE_BARANG='".$kode_barang."'";
	        	if (mysqli_query($koneksi, $queryupd)) {
	        		
	        	}*/
	        //}
	        $sql2 = "DELETE FROM t_order_temp where OLEH='".$oleh."'";            
	        if (mysqli_query($koneksi, $sql2)) {
	        //	echo "Record deleted successfully";
			}
	    }
?>