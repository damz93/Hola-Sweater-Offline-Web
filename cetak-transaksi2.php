<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Cetak Nota Transaksi - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=form-transaksi">
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
	session_start();
	include 'koneksi.php';
	error_reporting(0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV KASIR" AND $_SESSION['level']!="OWNER"){
		//echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		echo "<script>alert('Anda tidak memiliki akses.....');window.close();</script>";
	}
	else{
			
			date_default_timezone_set('Asia/Hong_Kong');
			$no = 1;
			session_start();
			$olehhh = $_SESSION['username'];
			$levell = $_SESSION['level'];
			   $total_bangetz = 0;
			$kode_transaksi   = $_GET['kode_transaksi'];
			$waktu_skg = date("d/m/Y");
						$jam = date("H:i:s");
						
			$penjualan_  = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='$kode_transaksi' order by JENIS_BARANG,WARNA ASC");
					
					         while($datax = mysqli_fetch_array($penjualan_)){	
								$costm = $datax['COSTUMER'];
							 }
							 $penjualan  = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='$kode_transaksi' order by JENIS_BARANG,WARNA ASC");
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
							<td><font style="font-size:30pt"> Costumer </font></td><td><font style="font-size:40pt"> :</font></td><td> <font style="font-size:50pt"> <?php echo $costm; ?></font></td>
							
						</tr>
						<tr>
							<td></td><td></td><td><b> <?php echo $kode_transaksi;?></b></td>
						</tr>
					</table>
					<br>
					</td>
				</tr>
				<tr align="left">
					<td colspan='3'><b>Order</b></td>
				</tr>
				<?php
							error_reporting(0);
					error_reporting(E_ERROR | E_WARNING | E_PARSE);
					error_reporting(E_ERROR | E_PARSE);
					$jumbay=0;
					$no=1;
					$total_tambahan= 0;
					$totpcs=0;$total_diskon=0;
					         while($data = mysqli_fetch_array($penjualan)){
						//$jumbayz = $data['BAYAR'];	
							$satuan = $data['HARGA'];	
							$satuan2 = $satuan;
							$jumbay = $data['BAYAR'];	
							$jumbay = str_replace(".","",$jumbay); 
							$jumbaytamp = "Rp" . number_format($jumbay,0,',','.');
							//$tambahan = $data['HARGA_TAMBAHAN'];	
							//$total_tambahanzz = (int)$tambahan * (int)$data['QTY'];
							//$total_tambahan = $total_tambahan + $total_tambahanzz;
							//$total_tambahantamp = "Rp" . number_format($total_tambahanzz,0,',','.');
							$total = $data['TOTAL'];			
							$satuantamp = "Rp" . number_format($satuan,0,',','.');
							$total = "Rp" . number_format($total,0,',','.');
							$total_banget = $data['TOTAL'];						
							$total_blum_disk = $satuan2 * $data['QTY'];
							$total_blum_disktamp = "Rp" . number_format($total_blum_disk,0,',','.');
							$potonggg = $diskonnew;
							$potongan2 = "Rp" . number_format($diskonnew,0,',','.');			
							$diskon = $data['DISKON'];	
							$diskon2 = $data['DISKON2'];	
							$potongan = $data['POTONGAN'];	
							$paym = $data['PAYMENT'];	
							$waktux = $data['WAKTU'];	
							$total_diskonnnya = $data['POTONGAN'];	
							$total_diskon = $total_diskon + $potongan;
							$potongantamp = "Rp" . number_format($potongan,0,',','.');
							$total_setelah_disk = $total_blum_disk - $diskon2;				
							$total_harga_barang = $total_harga_barang + $total_blum_disk;
							$total_setelah_disktamp = "Rp" . number_format($total_setelah_disk,0,',','.');	
					          
					          ?>
				<tr align="left" colspan="3" width="70%">
					<td align='left'><?php echo $data['JENIS_BARANG']; ?><br><?php echo $data['WARNA']; ?>(<?php echo $data['SIZE_']?>)</td>
					<td width="5%" rowspan="2" align='center'><?php echo $data['QTY']."x"; ?></td>
					<td rowspan="2" align='right'><?php echo $total_blum_disktamp; ?></td>
				</tr>
				<tr>
					<!--<td hidden align='left'><?php echo $satuantamp; ?></td>-->					
				</tr>
				<tr hidden>
					<td hidden align='left'>Tambh</td>
					<td hidden align='right'><?php echo $tambahantamp ?></td>
					<td hidden align='right'><?php echo $total_tambahantamp; ?></td>
				</tr>
				<tr hidden>
					<td hidden align='left'>Disc</td>
					<td hidden align='right' colspan="2"><?php echo $potongantamp; ?></td>
				</tr>
				<tr hidden>
					<td align='left'>Total</td>
					<td align='right' colspan="2"><?php echo $total_setelah_disktamp; ?></td>
				</tr>
				<?php
					$waktu_skg2 = date("d/m/Y h:i:s");
					error_reporting(0);
					error_reporting(E_ERROR | E_WARNING | E_PARSE);
					error_reporting(E_ERROR | E_PARSE);
					$totpcs = 0;
					$totdis = 0;
					
					$jumlah_cos=0;
					         $tgl_hari_ini = date("Y/m/d");
					         $jam_hari_ini = date("h:i:s");
					         $total_bangetz = $total_blum_disk + $total_bangetz;
						$totalnyami = $totalnyami + $total_setelah_disk;		
						$tgl = $data['TGL'];
						$waktu = $data['WAKTU'];
						$oleh = $data['OLEH'];
						$keterangan = $data['KETERANGAN'];
						$kode_barang = $data['KODE_BARANG'];
						$jenis_barang = $data['JENIS_BARANG'];
						$sizee = $data['SIZE_'];
						$warna = $data['WARNA'];
						$ongkir = $data['ONGKIR'];
						$diskon = $data['DISKON'];
						$diskon2 = $data['DISKON2'];
						$kodis = $data['KODE_DISKON'];
						$warna = $data['WARNA'];
						$qty_disk = $data['QTY_DISKON'];
						$kuantitas = $data['QTY'];
						//$sumber = $sumberx;
						$harga = $data['HARGA'];
						//	$diskon = $potonggg;
						///		$potongan = $data['POTONGAN'];
						$total = $data['TOTAL'];
						$totpcs = $totpcs + $kuantitas;
						//$totdis = $totdis + $kuantitas;
					$no++;
					}
								
								 
								 
								// $penjualan2 = mysqli_query($koneksi, "select KODE_COSTUM from t_transaksi where KODE_TRANSAKSI='$kode_transaksi'");
								 $penjualan2 = mysqli_query($koneksi,"SELECT `COSTUM`,`KODE_COSTUM`,SUM(HARGA_TAMBAHAN) AS HARGA,COUNT(`KODE_COSTUM`)AS JUMLAH,QTY FROM t_transaksi WHERE KODE_TRANSAKSI='$kode_transaksi' AND HARGA_TAMBAHAN<>0 GROUP BY `KODE_COSTUM`");
								 while($data2= mysqli_fetch_array($penjualan2)){
									$jumlah_tamp = number_format($data2['JUMLAH'],0,',','.');
									$qtyyy_tamp = number_format($data2['QTY'],0,',','.');
									$harga_tamp = "Rp" . number_format($data2['HARGA'],0,',','.');
									$jumlah_cos = $data2['HARGA'];
									
								 
					         ?>
				<tr>
					<td colspan='3'><br></td>
				</tr>
				<tr hidden>
					<td align='left'><?php echo $data2['COSTUM']; ?></td>
					<td align='center' rowspan="2" width="5%"><?php echo $qtyyy_tamp." pcx"; ?></td>
					<td align='right' rowspan="2"><?php echo $harga_tamp; ?></td>
				</tr>
				<tr hidden>
					<td align='left'><?php echo $data2['KODE_COSTUM']; }?></td>
				</tr>
				<tr hidden>
					<td colspan='3' align='right'>Jumlah Barang</td>
					<td align='right'><?php echo $totpcs; ?></td>
				</tr>
				<?php
				//	$totalnyami = $totalnyami + $ongkir;
				
								 
					error_reporting(0);
					error_reporting(E_ERROR | E_WARNING | E_PARSE);
					error_reporting(E_ERROR | E_PARSE);
								 
								 
						         $total_tambahantamp = "Rp" . number_format($total_tambahan,0,',','.');
								 //$total_diskon = $total_diskon * $qty_disk;
								 $total_diskon = $total_diskonnnya;
						      $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
						$total_harga_barang = $total_harga_barang + $jumlah_cos;
						$total_harga_barangtamp = "Rp" . number_format($total_harga_barang,0,',','.');
						
						$totalnyami = $total_harga_barang -$total_diskon;
						         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
						         $totalnyamitamp = "Rp" . number_format($totalnyami,0,',','.');
								 $total_kembali = $jumbay - $totalnyami;
						         $total_kembalitamp = "Rp" . number_format($total_kembali,0,',','.');
						        // $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');
						       //  $total_bayar = "Rp" . number_format($jumbay,0,',','.');
						         $ongkirr = "Rp" . number_format($ongkir,0,',','.');
					?>
					
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
							<td align='left'><?php echo $paym; ?></td>
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
			<?php
	}
			?>
		</font>
		<script>
			window.print();
		</script>
	</body>
</html>