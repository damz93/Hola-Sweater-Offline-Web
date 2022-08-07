<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Stok Keluar - T O K O N L I N E</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=pra-form-stok-keluar.php">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>			
			<script data-ad-client="ca-pub-5256228815542923" async src"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<style type="text/css">
				.left    { text-align: left;}
				.right   { text-align: right;}
				.center  { text-align: center;}
				.justify { text-align: justify;}
			</style>
			<!--<style type="text/css" media="print">
				@page {
				size: 72.1px, 210px;   /* auto is the initial value */    
				}
				</style>-->
			<style type="text/css" media="print">
				@media screen {
				p.bodyText {font-family:verdana, arial, sans-serif;}
				}
				@media print {
				p.bodyText {font-family:georgia, times, serif;}
				}
				@media screen, print {
				p.bodyText {font-size:9pt}
				size: auto;
				}
			</style>
	</head>
	</head>
	<body>
		<?php 
			include 'koneksi.php';
			//$jumbay = $_POST['jumlah_pembayaran'];	
			$totpcs=0;
			$ongkir = $_POST['ongkir'];		
//			$sumberx = $_POST['sumberx'];			
			$diskonnew = $_POST['nomdiskon'];
			$kode_penjualan = $_POST['kode_transaksi_'];	
			$ongkir= str_replace(".","",$ongkir); 
	//		$jumbay = str_replace(".","",$jumbay); 
			//$jumbayZZ = str_replace(".","",$jumbay); 
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			?>
		<table border="0" style="width:28%" align='left'>
			<tr align="left">
				<td colspan="3">
					<p style="font-size: 10px;">
						<?php echo $waktu_skg."-".$jam; ?>
					</p>
				</td>
			</tr>
			<tr align='center'>
				<th colspan="3">T O K O N L I N E</th>
			</tr>
			<tr align='center'>
				<th colspan="3">Jl </th>
			</tr>
			<tr>
				<td align="center" colspan="3">
					<p style="font-size: 12px;">							
						IG:@ - WA:+
					</p>
				</td>
			</tr>
			<tr align="center">
				<td colspan="3">----------------------------------------</td>
			</tr>
			<tr align='left'>
				<th colspan="3">
					<i><u><?php echo $kode_penjualan ?><br></u></i>
				</th>
			</tr>
			<?php 
				$noo = 0;
				session_start();
				$olehyy = $_SESSION['username'];
				$total_bangetz = 0;
				date_default_timezone_set('Asia/Hong_Kong');
				
				$sql = mysqli_query($koneksi,"select * from t_stok_keluar_temp WHERE OLEH='".$olehyy."'");
				while($data = mysqli_fetch_array($sql)){
					//$satuan = $data['HARGA'];	
					//s$satuan2 = $satuan;
		//			$potongan = $data['POTONGAN'];	
				//	$potongan2 = $potongan;
					$noo = $noo + 1;
					$total = $data['TOTAL'];			
					$satuan = "Rp" . number_format($satuan,0,',','.');
				//	$potongan = "Rp" . number_format($potongan,0,',','.');
					$total = "Rp" . number_format($total,0,',','.');
			//		$diskon = $data['DISKON'];
					$total_banget = $data['TOTAL'];	
					$total_blum_disk = $satuan2 * $data['QTY'];
				//	$diskon = $total_blum_disk * $diskon /100; 
					$total_blum_disk2 = "Rp" . number_format($total_blum_disk,0,',','.');
			//		$potongan2 = $potongan2 * $data['QTY'];
				//	$potongan2 = $potongan2 + $diskon;
					//$potongan2 = "Rp" . number_format($potongan2,0,',','.');		
					$potonggg = $diskonnew;
					$potongan2 = "Rp" . number_format($diskonnew,0,',','.');				
				?>
			<tr align="left" colspan="3">
				<td><?php echo $data['KODE_BARANG']."-".$data['JENIS_BARANG']."-".$data['WARNA']."-".$data['SIZE_']; ?></td>
			</tr>
			<tr>
				<td align='right' colspan=3><?php echo $data['QTY']; ?>(psc)</td>
				</tr>
			<tr hidden>
				<td align='left'>Disc</td>
				<td align='right'><?php echo $data['DISKON']."% + ".$potongan; ?></td>
				<td align='right'><?php echo $potongan2; ?></td>
			</tr>
			<?php 	
				date_default_timezone_set('Asia/Hong_Kong');
				
				$total_bangetz = $total_banget+ $total_bangetz - $potonggg;
				$total_kembali = $jumbay - $total_bangetz;
				$kode_penjualan2 = $kode_penjualan;					
				$tgl = $data['TGL'];
				$waktu = $data['WAKTU'];
				
				$oleh = $data['OLEH'];
				$keterangan = $data['KETERANGAN'];
				$kode_barang = $data['KODE_BARANG'];
				$jenis_barang = $data['JENIS_BARANG'];
				$sizee = $data['SIZE_'];
				$warna = $data['WARNA'];
				$kuantitas = $data['QTY'];
				//$sumber = $sumberx;
		///		$potongan = $data['POTONGAN'];
				$total = $data['TOTAL'];
				$totpcs = $totpcs + $kuantitas;
				         	// query SQL untuk insert data			
				         	$query="INSERT INTO t_stok_keluar(KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$kuantitas','$tgl','$waktu','$oleh','$keterangan')";
				         	if (mysqli_query($koneksi, $query)) {
				         		
				         	}
				         	// mengambil data barang
				         	$stok = mysqli_query($koneksi,"SELECT QTY FROM t_stok WHERE KODE_BARANG='".$kode_barang."'");
				         	while($data2 = mysqli_fetch_array($stok)){
				         		$stok2 = $data2['QTY'];					
				         	}
				         	$sisa_stok = (int)$stok2 - (int)$kuantitas;
				         	$queryupd="UPDATE t_stok SET QTY=".$sisa_stok." WHERE KODE_BARANG='".$kode_barang."'";
				         	if (mysqli_query($koneksi, $queryupd)) {
				         		
				         	}
				         //}
				         $sql2 = "DELETE FROM t_stok_keluar_temp where OLEH='".$oleh."'";            
				         if (mysqli_query($koneksi, $sql2)) {
				         //	echo "Record deleted successfully";
				}
				         }
				         $total_bangetz2 = $total_bangetz + $ongkir;
						
				//		$total_kembali = $jumbay - $total_bangetz2;
						$total_bangetz2 = "Rp" . number_format($total_bangetz2,0,',','.');
				         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
				         $total_kembali = "Rp" . number_format($total_kembali,0,',','.');
				         $noo = number_format($noo,0,',','.');
				         $totpcs = number_format($totpcs,0,',','.');
				       //  $total_bayar = "Rp" . number_format($jumbay,0,',','.');
				         $ongkirr = "Rp" . number_format($ongkir,0,',','.');
				         ?>
			<tr align="center">
				<td colspan='3'>----------------------------------------</td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Jumlah Barang yang berbeda</td>
				<td align='right'><?php echo $noo; ?></td>
			</tr>
			<tr>
				<td colspan='2' align='left' colspan="2">Total QTY</td>
				<td align='right'><?php echo $totpcs; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Total Barang</td>
				<td align='right'><?php echo $total_bangetz; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Ongkos Kirim</td>
				<td align='right'><?php echo $ongkirr; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Diskon</td>
				<td align='right'><?php echo $potongan2;; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Total</td>
				<td align='right'><?php echo $total_bangetz2; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Bayar</td>
				<td align='right'><?php //echo $total_bayar; ?></td>
			</tr>
			<tr hidden>
				<td colspan='2' align='left' colspan="2">Kembali</td>
				<td align='right'><?php //echo $total_kembali; ?></td>
			</tr>
			<tr align="center">
				<td colspan="3"><br>- Terima Kasih -</td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>