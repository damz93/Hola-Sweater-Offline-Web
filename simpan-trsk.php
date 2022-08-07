<?php
	error_reporting(0);
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	//$jumbay = $_POST['jumlah_pembayaran'];    
	$totpcs         = 0;
	$ongkir         = $_POST['ongkir'];
	//            $sumberx = $_POST['sumberx'];            
	$diskonnew      = $_POST['nomdiskon'];
	$kode_penjualan = $_POST['kode_transaksi'];
	$ongkir         = str_replace(".", "", $ongkir);
	$waktu_skg      = date("d/m/Y");

	$olehyy        = $_SESSION['username'];
	$total_bangetz = 0;
	$totalnyami    = 0;
	$total_diskon  = 0;
	$jam            = date("H:i:s");

	$data_pengeluaran = mysqli_query($koneksi, "select max(ID) as ID from t_transaksi");
	while ($d = mysqli_fetch_array($data_pengeluaran)) {
		$jumtranskX = $d['ID'];
	}

	if ($jumtranskX == 0) {
		$kode_penjualan = "TRX-0000001";
	} else {
		$jumtranskX++;
		if (strlen($jumtranskX) == 1) {
			$kode_penjualan = "TRX-000000" . $jumtranskX;
		} else if (strlen($jumtranskX) == 2) {
			$kode_penjualan = "TRX-00000" . $jumtranskX;
		} else if (strlen($jumtranskX) == 3) {
			$kode_penjualan = "TRX-0000" . $jumtranskX;
		} else if (strlen($jumtranskX) == 4) {
			$kode_penjualan = "TRX-000" . $jumtranskX;
		} else if (strlen($jumtranskX) == 5) {
			$kode_penjualan = "TRX-00" . $jumtranskX;
		} else if (strlen($jumtranskX) == 6) {
			$kode_penjualan = "TRX-0" . $jumtranskX;
		} else if (strlen($jumtranskX) == 7) {
			$kode_penjualan = "TRX-" . $jumtranskX;
		} else if (strlen($jumtranskX) == 8) {
			$kode_penjualan = "TRX-" . $jumtranskX;
		}
	}

	$sql = mysqli_query($koneksi, "select * from t_transaksi_temp WHERE OLEH='" . $olehyy . "'");
	while ($data = mysqli_fetch_array($sql)) {
		$satuan                 = $data['HARGA'];
		$satuan2                = $satuan;
		$total                  = $data['TOTAL'];
		$satuan                 = "Rp" . number_format($satuan, 0, ',', '.');
		$total                  = "Rp" . number_format($total, 0, ',', '.');
		$total_banget           = $data['TOTAL'];
		$total_blum_disk        = $satuan2 * $data['QTY'];
		$total_blum_disktamp    = "Rp" . number_format($total_blum_disk, 0, ',', '.');
		$potonggg               = $diskonnew;
		$potongan2              = "Rp" . number_format($diskonnew, 0, ',', '.');
		$diskon                 = $data['DISKON'];
		$diskon2                = $data['DISKON2'];
		$total_diskon           = $total_diskon + $diskon2;
		$total_setelah_disk     = $total_blum_disk - $diskon2;
		
		$kode_penjualan2 = $kode_penjualan;
		$tgl             = $data['TGL'];
		$waktu           = $data['WAKTU'];
		$oleh            = $data['OLEH'];
		$keterangan      = $data['KETERANGAN'];
		$kode_barang     = $data['KODE_BARANG'];
		$jenis_barang    = $data['JENIS_BARANG'];
		$sizee           = $data['SIZE_'];
		$warna           = $data['WARNA'];
		$diskon          = $data['DISKON'];
		$diskon2         = $data['DISKON2'];
		$kodis           = $data['KODE_DISKON'];
		$warna           = $data['WARNA'];
		$kuantitas       = $data['QTY'];
		$harga           = $data['HARGA'];
		$total           = $data['TOTAL'];
		$totpcs          = $totpcs + $kuantitas;
		$query           = "INSERT INTO t_transaksi(KODE_DISKON,DISKON,DISKON2,TOTAL2,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,HARGA,QTY,ONGKIR,TOTAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kodis','$diskon','$diskon2','$total_setelah_disk','$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$harga','$kuantitas','$ongkir','$total','$tgl','$waktu','$oleh','$keterangan')";
		if (mysqli_query($koneksi, $query)) {
					
		}
		
	}
	$sql2 = "DELETE FROM t_transaksi_temp where OLEH='" . $olehyy . "'";
	if (mysqli_query($koneksi, $sql2)) {
		echo "<script>alert('data tersimpan');window.location.href='input-transaksi';</script>";
	}
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
?>