<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Laporan Penjualan Harian - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=form-transaksi.php">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
				"></script>
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
			date_default_timezone_set('Asia/Hong_Kong');
			$no = 1;
			session_start();
			$olehh = $_SESSION['username'];
			$total_bangetz = 0;
			//$kode_transaksi   = $_GET['kode_transaksi'];
			$waktu_skg = date("d-m-Y");
			//$waktu_cek = '2021-09-09';
			$waktu_cek = date("Y-m-d");
			$jam = date("H:i:s");
						
			//$penjualan  = mysqli_query($koneksi, "select SUM(PCS) AS PCS from t_transaksi where TGL='$waktu_cek'");
			$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS PCS from t_transaksi where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'TB' AND JENIS_BARANG<>'TB2' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND JENIS_BARANG<>'CST Basic Hoodie' AND JENIS_BARANG<>'CST Crewneck' AND JENIS_BARANG<>'CST Zipper' AND JENIS_BARANG<>'CST Hoodie Crop' AND JENIS_BARANG<>'CST Crewneck Crop' AND JENIS_BARANG<>'CST + Sisi' AND JENIS_BARANG<>'Shooping Bag' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND KENA='YA' AND TGL='$waktu_cek'");
			while($data = mysqli_fetch_array($penjualan)){
							$pcs_trjual = $data['PCS'];							
							$pcs_trjual = number_format($pcs_trjual,0,',','.');	
						}
			$costum  = mysqli_query($koneksi, "select SUM(QTY) AS COSTUM,JENIS_BARANG from t_transaksi where  (KENA='TIDAK' or JENIS_BARANG='Costum') AND JENIS_BARANG<>'Shooping Bag' AND TGL='$waktu_cek'");			
			while($data2= mysqli_fetch_array($costum)){
							$tot_cos = $data2['COSTUM'];							
							$tot_cost = number_format($tot_cos,0,',','.');	
						}
			$totbeg  = mysqli_query($koneksi, "select SUM(QTY) AS totbeg,JENIS_BARANG from t_transaksi where JENIS_BARANG='Totebag' OR JENIS_BARANG='Shooping Bag' AND TGL='$waktu_cek'");
			while($data21= mysqli_fetch_array($totbeg)){
							$tot_totbeg = $data21['totbeg'];							
							$tot_totbegtamp = number_format($tot_totbeg,0,',','.');	
						}
			$pembayaranedc  = mysqli_query($koneksi, "select SUM(TOTAL2) AS EDC from t_transaksi where PAYMENT='EDC' AND TGL='$waktu_cek'");
			while($data3= mysqli_fetch_array($pembayaranedc)){
							$tot_edc = $data3['EDC'];							
							$tot_edctamp = "Rp".number_format($tot_edc,0,',','.');	
						}
						
			$pot_edc=0;			
			$diskon_edc  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='$waktu_cek' and PAYMENT='EDC' GROUP BY KODE_TRANSAKSI");
			while($dataedc= mysqli_fetch_array($diskon_edc)){
							$potnedc = $dataedc['POTONGAN'];		
							$pot_edc= $pot_edc + $potnedc;						
						}						
			$pot_edctamp = "Rp".number_format($pot_edc,0,',','.');	
			$bersih_edc = $tot_edc - $pot_edc;
			$bersih_edctamp = "Rp".number_format($bersih_edc,0,',','.');	
			
			$pembayarantf  = mysqli_query($koneksi, "select SUM(TOTAL2) AS TRANSFER from t_transaksi where PAYMENT='TRANSFER' AND TGL='$waktu_cek'");
			while($data4= mysqli_fetch_array($pembayarantf)){
							$tot_tf = $data4['TRANSFER'];							
							$tot_tftamp = "Rp".number_format($tot_tf,0,',','.');	
						}
			
			$pot_tf=0;			
			$diskon_tf  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='$waktu_cek' and PAYMENT='TRANSFER' GROUP BY KODE_TRANSAKSI");
			while($datatf= mysqli_fetch_array($diskon_tf)){
							$potntf = $datatf['POTONGAN'];		
							$pot_tf= $pot_tf + $potntf;						
						}						
			$pot_tftamp = "Rp".number_format($pot_tf,0,',','.');				
			$bersih_tf = $tot_tf - $pot_tf;
			$bersih_tftamp = "Rp".number_format($bersih_tf,0,',','.');	
						
						
			$pembayarancash  = mysqli_query($koneksi, "select SUM(TOTAL2) AS CASH from t_transaksi where PAYMENT='CASH' AND TGL='$waktu_cek'");
			while($data5= mysqli_fetch_array($pembayarancash)){
							$tot_cash = $data5['CASH'];							
							$tot_cashtamp = "Rp".number_format($tot_cash,0,',','.');	
						}
			
			$pot_cash=0;			
			$diskon_cash  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='$waktu_cek' and PAYMENT='CASH' GROUP BY KODE_TRANSAKSI");
			while($datacash= mysqli_fetch_array($diskon_cash)){
							$potncash = $datacash['POTONGAN'];		
							$pot_cash = $pot_cash + $potncash;						
						}						
			$pot_cashamp = "Rp".number_format($pot_cash,0,',','.');								
			$bersih_cash = $tot_cash - $pot_cash;
			$bersih_cashtamp = "Rp".number_format($bersih_cash,0,',','.');
						
			$pembayarantotal  = mysqli_query($koneksi, "select SUM(TOTAL2) AS TOTALXXX from t_transaksi where TGL='$waktu_cek'");
			while($data6= mysqli_fetch_array($pembayarantotal)){
							$tot_semu = $data6['TOTALXXX'];							
							$tot_semu_tamp = "Rp".number_format($tot_semu,0,',','.');	
						}
			
			$potn2=0;
			$diskon  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='$waktu_cek' GROUP BY KODE_TRANSAKSI");
			while($data7= mysqli_fetch_array($diskon)){
							$potn = $data7['POTONGAN'];		
							$potn2 = $potn2+$potn;
							
						}
						$potntamp = "Rp".number_format($potn2,0,',','.');	
						$grand_total = $tot_semu-$potn2;
						$grand_totaltamp = "Rp".number_format($grand_total,0,',','.');	
						
			?>
		<font size="10" face="Arial" >
			<table border="0" style="width:100%" align='center'>
				<tr align='center'>
					<th colspan=3 align="right" style="font-size: 40pt;">	
						LAPORAN PEMASUKAN HARIAN
					</th>
				</tr>
				
				<tr align='center'>
					<td colspan='3'>------------------------------------------------------------</td>
				</tr>
				<tr align='center'>
					<td align="left" style="font-size: 30pt;">			
						Tanggal
					</td>
					<td align="center" style="font-size: 30pt;">			
						<?php echo $waktu_skg; ?>
					</td>
					<td align="right" style="font-size: 30pt;">			
						<?php echo $olehh; ?>
					</td>
				</tr>		
			</table>
			<table border="0" style="width:100%" align='center'>
				<tr align="center">
					<td colspan='3'>------------------------------------------------------------</td>
				</tr>				
				<tr>
					<td align='left'>Pcs Terjual</td>
					<td align='right' colspan="2"><?php echo $pcs_trjual; ?></td>
				</tr>
				<tr>
					<td align='left'>Costum Sablon</td>
					<td align='right' colspan="2"><?php echo $tot_cost; ?></td>
				</tr>
				<tr hidden>
					<td align='left'>Total Totebag</td>
					<td align='right' colspan="2"><?php echo $tot_totbeg; ?></td>
				</tr>
				<tr>
					<td align='left' colspan="3"><b>Pembayaran</b></td>
				</tr>				
				<tr>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EDC</td>
					<td align='right' colspan="2"><?php echo $bersih_edctamp; ?></td>
				</tr>		
							
				<tr>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Transfer</td>
					<td align='right' colspan="2"><?php echo $bersih_tftamp; ?></td>
				</tr>
				<tr>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tunai</td>
					<td align='right' colspan="2"><?php echo $bersih_cashtamp; ?></td>
				</tr>	
				
				<tr>
					<td align='right' colspan="3"><b>subtotal&nbsp;&nbsp;&nbsp;</b><?php echo $grand_totaltamp; ?></td>
				</tr>	
				<tr hidden>
					<td align='left'>- Pembayaran Kotor Transfer</td>
					<td align='left' colspan="2"><?php echo $tot_tftamp; ?></td>
				</tr>				
				<tr hidden>
					<td align='left'>Diskon Transfer</td>
					<td align='left' colspan="2"><?php echo $pot_tftamp; ?></td>
				<tr hidden>		
					<td align='left'>- Pembayaran Kotor EDC</td>
					<td align='left' colspan="2"><?php echo $tot_edctamp; ?></td>
				</tr>
				<tr hidden>		
					<td align='left'>Diskon EDC</td>
					<td align='left' colspan="2"><?php echo $pot_edctamp; ?></td>
				</tr>
				
				<tr hidden>		
					<td align='left'>- Pembayaran Kotor Cash</td>
					<td align='left' colspan="2"><?php echo $tot_cashtamp; ?></td>
				</tr>		
				
				<tr hidden>		
					<td align='left'>Diskon Cash</td>
					<td align='left' colspan="2"><?php echo $pot_cashamp; ?></td>
				</tr>		
					
				<tr>
					<td align='left' colspan="3"><b>Pengeluaran</b></td>
				</tr>	
				<tr align="center">				
					<td colspan='3'>------------------------------------------------------------</td>
				</tr>
			<?php
				
				error_reporting(0);
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
				$total_pengel = 0;
				$total_pemasukan = 0;
				$pengeluara  = mysqli_query($koneksi, "select * from t_pengeluaran where TGL='$waktu_cek'");
					while($data80= mysqli_fetch_array($pengeluara)){
							$kateg = $data80['KATEGORI'];
							$nomin = $data80['NOMINAL'];				
							$nomin_tamp = "Rp".number_format($nomin,0,',','.');			
							$total_pengel = $total_pengel + $nomin;											
			?>
				<tr>		
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $kateg; ?></td>
					<td align='right' colspan="2"><?php echo $nomin_tamp; ?></td>
				</tr>	
				<?php 
					}									
					$total_pengel_tamp = "Rp".number_format($total_pengel,0,',','.');
					$total_pemasukan = $bersih_cash-$total_pengel;
					$total_pemasukan_tamp = "Rp".number_format($total_pemasukan,0,',','.');
				?>
				
				<tr>
					<td align='right' colspan="3"><b>subtotal&nbsp;&nbsp;&nbsp;</b><?php echo $total_pengel_tamp; ?></td>
				</tr>	
				
				<tr align="center">				
					<td colspan='3'>------------------------------------------------------------</td>
				</tr>
				<tr align="center">		
					<td colspan="3">Summary Pemasukan Harian</td>
				</tr>	
				<tr align="center">		
					<td colspan="3"><b><?php echo $total_pemasukan_tamp; ?></b></td>
				</tr>	
				
				<tr hidden>
					<td align='left' style="font-size:35pt;"><b>Total Pembayaran</b></td>
					<td align='left'><?php echo $tot_semu_tamp; ?></td>
				</tr>	
				<tr hidden>
					<td align='left' style="font-size:35pt;"><b>Total Potongan</b></td>
					<td align='left'><?php echo $potntamp; ?></td>
				</tr>	
				<tr hidden>
					<td colspan="3"><br><br></td>					
				</tr>	
				<tr hidden>
					<td colspan="3" align="left" style="font-size:30pt;">Catatan: </td>					
				</tr>	
				
			</table>
		</font>
		<script>
			window.print();
		</script>
	</body>
</html>