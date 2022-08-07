<?php
	error_reporting(0);
	session_start();   
	$olehnya = $_SESSION['username'];
	include 'koneksi.php';
	
	$kode_draft = $_GET['kode_draft'];
	
	
	if($_SESSION['status']!="login"){
				echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
				//header("location:index.php?pesan=belum_login");
	}
	else{
	
		$sql = mysqli_query($koneksi,"select * from t_draft WHERE OLEH='".$olehnya."' AND KODE_DRAFT='".$kode_draft."' order by ID DESC");
	
			while($d = mysqli_fetch_array($sql)){
				
				$kode_barang = $d['KODE_BARANG'];
				$jenis_barang = $d['JENIS_BARANG'];
				$size = $d['SIZE_'];
				$warna = $d['WARNA'];
				$harga_satuan = $d['HARGA'];				
				$keterangan = $d['KETERANGAN'];				
				$waktu_skg2 = $d['WAKTU'];					
				$tgl = $d['TGL'];					
				$harga_satuan = $d['HARGA'];				
				$kena = $d['KENA'];				
				$qty = $d['QTY'];				
				$total_harga = (int)$harga_satuan * (int)$qty;
				$total_harga2 = (int)$harga_satuan * (int)$qty;
				
				
				
				mysqli_query($koneksi,"INSERT INTO t_transaksi_temp(KENA,KODE_BARANG,JENIS_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH)VALUES('$kena','$kode_barang','$jenis_barang','$harga_satuan','$qty','$total_harga','$total_harga2','$size','$warna','$keterangan','$waktu_skg2','$tgl','$olehnya')");
			}
			
			 $sql2 = "DELETE FROM t_draft where OLEH='".$olehnya."' AND KODE_DRAFT='".$kode_draft."'";
			if (mysqli_query($koneksi, $sql2)) {
				echo "<script>alert('Draft Terbuka');window.location.href='input-transaksi';</script>";
			}
			else {
				echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
			}			
	}
?>