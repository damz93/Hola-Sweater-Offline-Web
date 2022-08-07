<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		 <title>Cetak Stok Keluar - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=form-stok-keluar.php">
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
         date_default_timezone_set('Asia/Hong_Kong');
		  $no = 1;
			session_start();
            $total_bangetz = 0;
         $kode_transaksi   = $_GET['kode_transaksi'];
		 $waktu_skg = date("d/m/Y");
         			$jam = date("H:i:s");
         			
         $penjualan  = mysqli_query($koneksi, "select * from t_stok_keluar where KODE_TRANSAKSI='$kode_transaksi'");
         			
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
				<th colspan="3">S W E A T E R I N</th>
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
               <i><u><?php echo $kode_transaksi; ?><br></u></i>
            </th>
         </tr>
         <?php
				$no = 1;
				$noo = 0;
		 $jumbay=0;
		 $totpcs=0;
            while($data = mysqli_fetch_array($penjualan)){
				//$jumbayz = $data['BAYAR'];	
				$ongkir = $data['ONGKIR'];	
				//$jumbay = $jumbayz;				
				$satuan = $data['HARGA'];	
				$satuan2 = $satuan;
				$noo = $noo + 1;
            	$potongan = $data['DISKON'];	
            	$diskonnew = $data['DISKON'];	
				$potongan2 = $potongan;
            	$total = $data['TOTAL'];			
            	$satuan = "Rp" . number_format($satuan,0,',','.');
            	$potongan = "Rp" . number_format($potongan,0,',','.');
            	$total = "Rp" . number_format($total,0,',','.');
				$diskon = $data['DISKON'];
            	$total_banget = $data['TOTAL'];	
				$total_blum_disk = $satuan2 * $data['QTY'];
				$diskon = $total_blum_disk * $diskon /100; 
				$total_blum_disk2 = "Rp" . number_format($total_blum_disk,0,',','.');
				$potongan2 = $potongan2 * $data['QTY'];
				$potongan2 = $potongan2 + $diskon;
				$potongan2 = "Rp" . number_format($potongan2,0,',','.');	
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
			$waktu_skg2 = date("d/m/Y h:i:s");
            $tgl_hari_ini = date("Y/m/d");
            $jam_hari_ini = date("h:i:s");
            $total_bangetz = $total_banget + $total_bangetz;
            $total_kembali = $jumbay - $total_bangetz;
			$kode_penjualan2 = $kode_transaksi;
			$tgl_hari_ini2 = $tgl_hari_ini;
			$jam_hari_ini2 = $jam_hari_ini;
            $kode_barang = $data['KODE_BARANG'];
            $jenis_barang = $data['JENIS_BARANG'];
            $kuantitas = $data['QTY'];
            $harga_satuan = $data['HARGA'];
            $diskon = $data['DISKON'];
            $potongan = $data['POTONGAN'];
            $total = $data['TOTAL'];
			$totpcs = $totpcs + $kuantitas;
			$no++;
			}
            $total_bangetz2 = $total_bangetz + $ongkir - $diskon;
				//		$total_kembali = $jumbay - $total_bangetz2;
						$total_bangetz2 = "Rp" . number_format($total_bangetz2,0,',','.');
				         $total_bangetz = "Rp" . number_format($total_bangetz,0,',','.');
				         $total_kembali = "Rp" . number_format($total_kembali,0,',','.');						 
				         $noo = number_format($noo,0,',','.');
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