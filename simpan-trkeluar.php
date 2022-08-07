<?php
	include 'koneksi.php';
	session_start();
	date_default_timezone_set('Asia/Hong_Kong');
	$kode_penjualan = $_POST['kode_transaksi_'];	
	$olehyy        = $_SESSION['username'];	


	$sql = mysqli_query($koneksi, "select * from t_transaksi_temp WHERE OLEH='" . $olehyy . "'");	
	while ($data = mysqli_fetch_array($sql)) {$kode_penjualan2 = $kode_penjualan;
			$tgl             = $data['TGL'];
			$waktu           = $data['WAKTU'];			
			$oleh         = $data['OLEH'];
			$keterangan   = $data['KETERANGAN'];
			$kode_barang  = $data['KODE_BARANG'];
			$jenis_barang = $data['JENIS_BARANG'];
			$sizee        = $data['SIZE_'];
			$warna        = $data['WARNA'];
			$kuantitas    = $data['QTY'];
			
			$query = "INSERT INTO t_stok_keluar(KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$kuantitas','$tgl','$waktu','$oleh','$keterangan')";
			if (mysqli_query($koneksi, $query)) {
				
			}
			$stok = mysqli_query($koneksi, "SELECT QTY FROM t_stok WHERE KODE_BARANG='" . $kode_barang . "'");
			while ($data2 = mysqli_fetch_array($stok)) {
				$stok2 = $data2['QTY'];
			}
			$sisa_stok = (int) $stok2 - (int) $kuantitas;
			$queryupd  = "UPDATE t_stok SET QTY=" . $sisa_stok . " WHERE KODE_BARANG='" . $kode_barang . "'";
			if (mysqli_query($koneksi, $queryupd)) {
				
			}						
	}	
	$sql2 = "DELETE FROM t_stok_keluar_temp where OLEH='" . $olehyy . "'";
	if (mysqli_query($koneksi, $sql2)) {
		echo "<script>alert('data tersimpan');window.location.href='input-stok-keluar';</script>";
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>