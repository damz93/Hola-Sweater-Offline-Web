<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Transaksi - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=input-transaksi">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>			
			<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
			error_reporting(0);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
			$jumbay = $_POST['jumlah_pembayaran'];	
			$tot_dis = $_POST['tot_diskon'];	
			session_start();
			$olehhh = $_SESSION['username'];
			$levell = $_SESSION['level'];
			$jumbay = str_replace(".","",$jumbay); 
			$jumbaytamp = "Rp" . number_format($jumbay,0,',','.');
			$totpcs=0;
		//	$ongkir = $_POST['ongkir'];		
			//			$sumberx = $_POST['sumberx'];			
			//$diskonnew = $_POST['nomdiskon'];
			//$kode_penjualan = $_POST['kode_transaksii'];	
			$payment = $_POST['payment'];	
			$costumerx = $_POST['costumerx'];	
			
		//	$ongkir= str_replace(".","",$ongkir); 
			//		$jumbay = str_replace(".","",$jumbay); 
			//$jumbayZZ = str_replace(".","",$jumbay); 
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam = date("H:i:s");
			$data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI FROM t_transaksi ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_tr)){	
					$jumtranskX        = substr($d['KODE_TRANSAKSI'],5);			
					
				 }
			      
			      if ($jumtranskX == 0) {
			      	$kode_penjualan = "TRX-0000000001";
			      }
			      else{
			      	$jumtranskX++;
					if (strlen($jumtranskX)== 1){
			      		$kode_penjualan = "TRX-000000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 2){
			      		$kode_penjualan = "TRX-00000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 3){
			      		$kode_penjualan = "TRX-0000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 4){
			      		$kode_penjualan = "TRX-000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 5){
			      		$kode_penjualan = "TRX-00000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 6){
			      		$kode_penjualan = "TRX-0000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 7){
			      		$kode_penjualan = "TRX-000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 8){
			      		$kode_penjualan = "TRX-00".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 9){
			      		$kode_penjualan = "TRX-0".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 10){
			      		$kode_penjualan = "TRX-".$jumtranskX;
			      	}
			      }
			
			?>
		<font size="10" face="Arial" >
			<table border="0" style="width:95%" align='left'>
				<tr align='center'>
					<td colspan='3'>
						<img src="img\hdr_2.png" width='80%'>
					</td>
				</tr>
				
				<tr>
					<td colspan='3'><br>
					</td>
				</tr>
				<tr>
					<td colspan='3'>
					<table>
						<tr>
							<td><font style="font-size:30pt"> Costumer </font></td><td><font style="font-size:40pt"> :</font></td><td> <font style="font-size:50pt"> <?php echo $costumerx; ?></font></td>
							
						</tr>
						<tr>
							<td></td><td></td><td><b> <?php echo $kode_penjualan;?></b></td>
						</tr>
					</table>
					<br>
					</td>
				</tr>
				<tr align="left">
					<td colspan='3'><b>Order</b></td>
				</tr>
			<?php 
				$no = 1;
				
			error_reporting(0);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
				session_start();
				$olehyy = $_SESSION['username'];
				
				$total_bangetz = 0;
				$totalnyami = 0;
				$total_diskon = 0;
				date_default_timezone_set('Asia/Hong_Kong');
				$total_harga_barang = 0;
				$total_tambahan = 0;
				$potongan=0;
				$jumlah_cos=0;
				$totpcs =0;
				$total_diskon = 0;
				$sql = mysqli_query($koneksi,"select * from t_transaksi_temp WHERE OLEH='".$olehyy."' order by JENIS_BARANG,WARNA ASC ");
				while($data = mysqli_fetch_array($sql)){
					$satuan = $data['HARGA'];						
					$satuan2 = $satuan;
					$total = $data['TOTAL'];			
					$satuan = "Rp" . number_format($satuan,0,',','.');
					$total = "Rp" . number_format($total,0,',','.');
					$total_banget = $data['TOTAL'];						
					$total_blum_disk = $satuan2 * $data['QTY'];
					$total_harga_barang = $total_harga_barang + $total_blum_disk;
					$total_blum_disktamp = "Rp" . number_format($total_blum_disk,0,',','.');
					//$potonggg = $diskonnew;
								
//					$potongan2 = "Rp" . number_format($diskonnew,0,',','.');			
					$diskon = $data['DISKON'];	
					$tambahan = $data['HARGA_TAMBAHAN'];	
					$total_tambahanzz = (int)$tambahan * (int)$data['QTY'];
					$total_tambahan = $total_tambahan + $total_tambahanzz;
					$total_tambahantamp = "Rp" . number_format($total_tambahanzz,0,',','.');
					$tambahantamp = "Rp" . number_format($tambahan,0,',','.');
					$diskon2 = $data['DISKON2'];	
					//$potongan = $data['POTONGAN'];	
					//$potongan = $_POST['tot_dis'];
					//$potongan = $potongan
					$total_diskon = $total_diskon + $potongan;
					$potongantamp = "Rp" . number_format($potongan,0,',','.');
					$total_diskonx = $total_diskon+$diskon2;
					$total_setelah_disk = $total_blum_disk - $potongan + $total_tambahan;				
					$total_setelah_disktamp = "Rp" . number_format($total_setelah_disk,0,',','.');	
					$waktux = $data['WAKTU'];
				?>
			<tr align="left" colspan="3" width="70%">
					<td align='left'><?php echo $data['JENIS_BARANG']; ?><br><?php echo $data['WARNA']; ?>(<?php echo $data['SIZE_']?>)</td>
					<td width="5%" rowspan="2" align='center'><?php echo $data['QTY']."x"; ?></td>
					<td rowspan="2" align='right'><?php echo $total_blum_disktamp; ?></td>
			</tr>
			
			<tr>
					<!--<td hidden align='left'><?php echo $satuantamp; ?></td>-->					
				</tr>
			
			<?php 	
				date_default_timezone_set('Asia/Hong_Kong');						
				
				error_reporting(0);
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
				$total_bangetz = $total_blum_disk + $total_bangetz;
				$totalnyami = $totalnyami + $total_setelah_disk;
				$kode_penjualan2 = $kode_penjualan;					
				$tgl = $data['TGL'];
				$waktu = $data['WAKTU'];
				//$paym = $data['PAYMENT'];
				$oleh = $data['OLEH'];
				$keterangan = $data['KETERANGAN'];
				$kode_barang = $data['KODE_BARANG'];
				$jenis_barang = $data['JENIS_BARANG'];
				$sizee = $data['SIZE_'];
				$warna = $data['WARNA'];
				$diskon = $data['DISKON'];
				$diskon2 = $data['DISKON2'];
				//$kodis = $data['KODE_DISKON'];
				$kodis = $_POST['kodiskxx'];;
				$warna = $data['WARNA'];
				$kod_costumm = $data['KODE_COSTUM'];
				$costumm = $data['COSTUM'];
				$kena = $data['KENA'];
				$kuantitas = $data['QTY'];
				$qty_disk = $_POST['banyaknya_diskon'];
				//$potonggannn = $data['POTONGAN'];
				$potongan = $_POST['tot_diskon'];
				$potonggannn = $_POST['tot_diskon'];
				$voucher = $_POST['voucherx'];
				//$harga_tamb = $data['HARGA_TAMBAHAN'];
				//$sumber = $sumberx;
				$harga = $data['HARGA'];
				//	$diskon = $potonggg;
				///		$potongan = $data['POTONGAN'];
				$total = $data['TOTAL'];
				//$total2nya = $total -$potonggannn + $harga_tamb;
				$total2nya = $total;
				$totpcs = $totpcs + $kuantitas;
				$no++;
				         	// query SQL untuk insert data			
				//$query="INSERT INTO t_transaksi(KODE_COSTUM,COSTUM,HARGA_TAMBAHAN,POTONGAN,BAYAR,KODE_DISKON,DISKON,DISKON2,TOTAL2,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,HARGA,QTY,TOTAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kod_costumm','$costumm','$harga_tamb','$potonggannn','$jumbay','$kodis','$diskon','$diskon2','$total_setelah_disk','$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$harga','$kuantitas','$total','$tgl','$waktu','$oleh','$keterangan')";
				$query="INSERT INTO t_transaksi(KENA,QTY_DISKON,PAYMENT,COSTUMER,KODE_COSTUM,COSTUM,POTONGAN,BAYAR,KODE_DISKON,DISKON,DISKON2,TOTAL2,KODE_TRANSAKSI,KODE_BARANG,JENIS_BARANG,SIZE_,WARNA,HARGA,QTY,TOTAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kena','$qty_disk','$payment','$costumerx','$kod_costumm','$costumm','$potonggannn','$jumbay','$kodis','$diskon','$diskon2','$total2nya','$kode_penjualan2','$kode_barang','$jenis_barang','$sizee','$warna','$harga','$kuantitas','$total','$tgl','$waktu','$oleh','$keterangan')";
				if (mysqli_query($koneksi, $query)) {
				
				}
				// mengambil data barang
				$stok2 =0;
            	$stok = mysqli_query($koneksi,"SELECT QTY FROM t_stok WHERE KODE_BARANG='".$kode_barang."'");
            	while($data2 = mysqli_fetch_array($stok)){
            		$stok2 = $data2['QTY'];					
            	}
            	$sisa_stok = (int)$stok2 - (int)$kuantitas;
            	$queryupd="UPDATE t_stok SET QTY=".$sisa_stok." WHERE KODE_BARANG='".$kode_barang."'";
            	if (mysqli_query($koneksi, $queryupd)) {
            		
            	}
				$terpakai='TERPAKAI PADA TRANSAKSI: '.$kode_penjualan2;
            	$qr_voucher="UPDATE t_voucher SET STATUS='TIDAK AKTIF',KETERANGAN='$terpakai' WHERE KODE_VOUCHER='".$voucher."'";
            	if (mysqli_query($koneksi, $qr_voucher)) {
            		
            	}
				
				$sql2 = "DELETE FROM t_transaksi_temp where OLEH='".$oleh."'";            
				    if (mysqli_query($koneksi, $sql2)) {				       
				}
			}
			
			
			
							// $penjualan2 = mysqli_query($koneksi, "select KODE_COSTUM from t_transaksi where KODE_TRANSAKSI='$kode_transaksi'");
								 $penjualan2 = mysqli_query($koneksi,"SELECT `COSTUM`,`KODE_COSTUM`,SUM(HARGA_TAMBAHAN) AS HARGA,COUNT(`KODE_COSTUM`)AS JUMLAH,QTY FROM t_transaksi WHERE KODE_TRANSAKSI='$kode_penjualan2' AND HARGA_TAMBAHAN<>0 GROUP BY `KODE_COSTUM`");
								 while($data2= mysqli_fetch_array($penjualan2)){
									$jumlah_tamp = number_format($data2['JUMLAH'],0,',','.');
									$qtyyy_tamp = number_format($data2['QTY'],0,',','.');
									$harga_tamp = "Rp" . number_format($data2['HARGA'],0,',','.');
									$jumlah_cos = $data2['HARGA'];
									?>
									
									<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr>
					<td align='left'><?php echo $data2['COSTUM']; ?></td>
					<td align='center' rowspan="2"><?php echo $qtyyy_tamp." pcx"; ?></td>
					<td align='right' rowspan="2"><?php echo $harga_tamp; ?></td>
				</tr>
				<tr>
					<td align='left'><?php echo $data2['KODE_COSTUM']; }?></td>
				</tr>
				<tr align="center">		
			<?php
			
						         $total_tambahantamp = "Rp" . number_format($total_tambahan,0,',','.');
								 //$total_diskon = $potonggannn * $totpcs;
								 $total_diskon = $potonggannn;
						      $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
						      $totpcstamp = "Rp" . number_format($totpcs,0,',','.');
						$total_harga_barang = $total_harga_barang + $jumlah_cos;
						$total_harga_barangtamp = "Rp" . number_format($total_harga_barang,0,',','.');
						
						$totalnyami = $total_harga_barang -$total_diskon;
						         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
						         $totalnyamitamp = "Rp" . number_format($totalnyami,0,',','.');
								 $total_kembali = $jumbay - $totalnyami;
						         $total_kembalitamp = "Rp" . number_format($total_kembali,0,',','.');
						         //$ongkirr = "Rp" . number_format($ongkir,0,',','.');
					?>
			<tr hidden>
					<td colspan='3' align='right'>Jumlah Barang</td>
					<td align='right'><?php echo $totpcstamp; ?></td>
				</tr>
				<tr align="center">
					<td colspan='3'><hr size="20px"></td>
				</tr>
				
				<tr>
					<td colspan="3">
					<table width="95%" align="right">
						<tr>
							<td width="12%"></td>
							<td align='left'>Total</td>
							<td align='left'><?php echo $total_harga_barangtamp; ?></td>
						</tr>
						<tr>
							
							<td width="12%"></td>
							<td align='left'>Diskon</td>
							<td align='left'><?php echo $total_diskontamp;; ?></td>
						</tr>
						<tr>
							<td width="12%"></td>
							<td align='left'><b><font style="font-size:38pt"> Sisa Pembayaran</font></b></td>
							<td align='left'><b><font style="font-size:50pt"> <?php echo $totalnyamitamp; ?></font></b></td>
						</tr>
						<tr align="center">
							<td colspan='3'><hr size="20px"></td>
						</tr>
						<tr>
							<td width="12%"></td>
							<td align='left'>Payment</td>
							<td align='left'><?php echo $payment; ?></td>
						</tr>
						<tr>
							<td width="12%"></td>
							<td align='left'>Diterima</td>
							<td align='left'><?php echo $jumbaytamp; ?></td>
						</tr>
						<tr>
							<td width="12%"></td>
							<td align='left'>Kembali</td>
							<td align='left'><?php echo $total_kembalitamp; ?></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
				<td><br></td>
				</tr>
				<tr align='center'>
					<td colspan="3" align="center" style="font-size: 40px;">
					<font style="font-size:40pt"> <b>
					<?php 					
						$waktu1 = substr($waktux,0,10);
						$waktu2 = substr($waktux,10,10);
						echo $waktu1.' - '.$waktu2; ?></b></font>
					</td>
				</tr>
				<tr align='center'>
					<td colspan="3" align="center" style="font-size: 35px;">
						<b><?php echo $levell.' - '.$olehhh; ?></b>
					</td>
				</tr>
				<tr align='center'>
					<th colspan='3'>
						<img src="img\ftr.png" width='100%'>
					</th>
				</tr>
		</table>
		</font>
		<script>
			window.print();
		</script>
	</body>
</html>