<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Transaksi - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
         <meta http-equiv="refresh" content="5; url=form-laporan">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="css/freelancer.min.css">
         <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
            "></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
         <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
         <link rel="shortcut icon" href="img/esana.jpg">
         <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
         <style type="text/css">
            .left    { text-align: left;}
            .right   { text-align: right;}
            .center  { text-align: center;}
            .justify { text-align: justify;}
         </style>
         <style type="text/css" media="print">
            @page {
            size: a4;   /* auto is the initial value */
            margin: 1;  /* this affects the margin in the printer settings */
            }
         </style>
   </head>
   </head>
   <body>   
      <?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
      <u>
         <h1 class="center">LAPORAN TRANSAKSI</h1>
      </u>
     <h3 class="center">H O L A S W E A T E R</h3>
     <?php
		include 'koneksi.php';
		date_default_timezone_set('Asia/Hong_Kong');
		$waktu_skg = date("d/m/Y");
		$jam = date("H:i:s");
		function formatTanggal($date){
		 // ubah string menjadi format tanggal
		 return date('d-m-Y', strtotime($date));
		}
		if (isset($_POST['tampil_semua22'])){			
			$nama = "Penjualan Pemasukan - Semua Transaksi";
			$data_barang = mysqli_query($koneksi,"SELECT * from t_transaksi ORDER BY KODE_TRANSAKSI ASC");
			$data_barang2 = mysqli_query($koneksi,"SELECT * from t_transaksi WHERE HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
		 }
		 
		else if (isset($_POST['tampil_tanggald22']))
		{			
			$tglnya = $_POST['cek_tanggald22'];
			$tgl_nya = date_create($tglnya);
			$tgl_awalz = date_format($tgl_nya,"Y/m/d");
			
			$tglakhir = $_POST['cek_tanggald22d'];
			$tgl_akhir = date_create($tglakhir);
			$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
			if((strcmp($tglnya,$tglakhir)==0) OR empty($tglakhir)){
				$nama = "Laporan Pemasukan Harian - " . formatTanggal($tglnya);
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='".$tglnya."' ORDER BY KODE_TRANSAKSI ASC");
				//$data_barang = mysqli_query($koneksi, "SELECT COSTUMER,TGL,SUM(QTY) AS JUMLAH_QTY,KODE_TRANSAKSI,SUM(TOTAL2) AS TOTAL_BARANG,POTONGAN from t_transaksi WHERE TGL='".$tglnya."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE TGL='".$tglnya."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='".$tglnya."' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
			}
			else{
				$nama = "Laporan Pemasukan(" . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir).")";
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY KODE_TRANSAKSI ASC");
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
			}
		}
		else if (isset($_POST['tampil_buland22']))
		{	
			$bulawal = $_POST['cek_buland22'];
			$bulanaw = substr($bulawal,0,2);
			$tahunaw = substr($bulawal,3,7);
			$tgl_awal = $tahunaw."-".$bulanaw."-01";
			
			$bulakhir = $_POST['cek_buland22d'];
			$bulanak = substr($bulakhir,0,2);
			$tahunak = substr($bulakhir,3,7);
			$tgl_akhir = $tahunak."-".$bulanak."-31";
			
			if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
				$nama = "Laporan Pemasukan Bulanan - " . $bulawal;
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' ORDER BY KODE_TRANSAKSI ASC");
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND HARGA_TAMBAHAN>0 AND YEAR(TGL)='".$tahunaw."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");	
			}
			else{
				$nama = "Laporan Pemasukan Bulanan(" . $bulawal." s.d. ". $bulakhir.")";
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_TRANSAKSI ASC");				
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' AND HARGA_TAMBAHAN>0 ORDER BY KODE_TRANSAKSI ASC");
			}	
		}
		else if (isset($_POST['tampil_tahund22']))
		{	
			$tahunnya = $_POST['cek_tahund22'];
			$tahunawal_nya = $tahunnya."-01-01";
			
			
			$tahunnya2 = $_POST['cek_tahund22d'];
			$tahunakhir_nya = $tahunnya2."-12-31";
			
			if((strcmp($tahunnya,$tahunnya2)==0) OR empty($tahunnya2)){				
				$nama = "Laporan Pemasukan Tahunan - " . $tahunnya;
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' ORDER BY KODE_TRANSAKSI ASC");	
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");	
			}
			else{
				$nama = "Laporan Transaksi Tahunan(" . $tahunnya." s.d. ". $tahunnya2.")";
				
				//$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' ORDER BY KODE_TRANSAKSI ASC");	
				$data_barang = mysqli_query($koneksi, "SELECT POTONGAN,KODE_TRANSAKSI,TGL from t_transaksi WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' AND HARGA_TAMBAHAN>0 ORDER BY KODE_TRANSAKSI ASC");	
			}
			
			
		}
		$jumtrans = mysqli_num_rows($data_barang);
		$jumtrans = "Jumlah Transaksi: " . $jumtrans;
	?>

      <h5 class="right"><b><?php echo $nama; ?></b></h5>
      <h6 class="right"><b><?php echo $jumtrans; ?></b></h6>
      <h6 class="right"><i><?php echo "[".$waktu_skg."-".$jam."]"; ?></i></h6>
      <table border="1" style="width: 100%" align='left'>
         <tr align='center'>
            <th width="5%">No</th>
            <th>Tanggal Transaksi</th>
            <th>Kode Penjualan</th>
            <th width="15%">Kode Barang</th>
            <th>Jenis Barang</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Total Harga</th>
         </tr>
         <?php 
            $no = 1;		
			
			$total_bersih_seluruh=0;
			$total_barang_seluruh=0;
			$total_qty_seluruh=0;
			$potongannnn=0;
			$total_diskon_seluruh=0;
              while($data = mysqli_fetch_array($data_barang)){				
				
					$poton = $data['POTONGAN'];
					$potongannnn = $poton + $potongannnn;									
				
				$kode_transaksi = $data['KODE_TRANSAKSI'];
				$tgl_transaksi = $data['TGL'];
				$total_qty=0;
				$total_harga=0;
				$total_harga_nya=0;
				$data_transaksi = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE KODE_TRANSAKSI='".$kode_transaksi."'");
				while($transaksi = mysqli_fetch_array($data_transaksi)){					
					$costumer = $transaksi['COSTUMER'];
					$kode_barang = $transaksi['KODE_BARANG'];
					$jenis_barang = $transaksi['JENIS_BARANG'];
					$qty = $transaksi['QTY'];
					$qtytamp = number_format($qty,0,',','.');     
					$total_qty	= $total_qty + $qty;
					$total_qtytamp = number_format($total_qty,0,',','.');     
					$harga = $transaksi['HARGA'];					
					$hargatamp = "Rp" . number_format($harga,0,',','.');      			
					//$total_harga=$harga*$qty;
					$total_harga=$transaksi['TOTAL'];
					$total_hargatamp = "Rp" . number_format($total_harga,0,',','.');      			
					$total_harga_nya = $total_harga_nya + $total_harga;
					$total_harga_nyatamp = "Rp" . number_format($total_harga_nya,0,',','.');
					$potongan = $transaksi['POTONGAN'];
					$potongantamp = "Rp" . number_format($potongan,0,',','.');     
					$total_bersih = $total_harga_nya - $potongan;
					$total_bersihtamp = "Rp" . number_format($total_bersih,0,',','.');      					
			 				
            ?>
         <tr>
            <td align='center'><?php echo $no++; ?></td>
            <td align='center'><?php echo formatTanggal($tgl_transaksi); ?></td>
            <td align='center'><?php echo $kode_transaksi; ?></td>
            <td align='center'><?php echo $kode_barang; ?></td>
            <td align='center'><?php echo $jenis_barang; ?></td>            
            <td align='right'><?php echo $hargatamp; ?></td>            
            <td align='right'><?php echo $qtytamp; ?></td>            
            <td align='right'><?php echo $total_hargatamp; ?></td>            
         </tr>
		 
		 <?php	
				//$total_bersih_seluruh = $total_bersih_seluruh+$total_bersih;
				
				$total_qty_seluruh = $total_qty_seluruh+$qty;
				$total_diskon_seluruh = $total_diskon_seluruh+$potongan;
				$total_barang_seluruh = $total_barang_seluruh+$total_harga;
				
				}
				
				
				$total_qty_seluruhtamp = number_format($total_qty_seluruh,0,',','.');   
				$total_barang_seluruhtamp = "Rp" . number_format($total_barang_seluruh,0,',','.');    
				$total_diskon_seluruhtamp = "Rp" . number_format($total_diskon_seluruh,0,',','.');  
				 
				?>
		<tr>
			<td align='right' colspan='7'>Total Qty</td>
			<td align='right'><?php echo $total_qtytamp; ?></td>
		</tr>
		<tr>
			<td align='right' colspan='7'>Total Harga</td>
			<td align='right'><?php echo $total_harga_nyatamp; ?></td>
		</tr>
		<tr>
			<td align='right' colspan='7'>Total Diskon</td>
			<td align='right'><?php echo $potongantamp; ?></td>
		</tr>
		<tr>
			<td align='right' colspan='7'>Total Bersih<b>(<?php echo $kode_transaksi; ?>)</b></td>
			<td align='right'><?php echo $total_bersihtamp; ?></td>
		</tr>
				
				
				<?php
			  }			
			  
			  $total_bersih_seluruh = $total_barang_seluruh-$potongannnn;
			  
			  $potongannnntamp = "Rp" . number_format($potongannnn,0,',','.'); 
			 $total_bersih_seluruhtamp = "Rp" . number_format($total_bersih_seluruh,0,',','.');   
		 ?>
		 
		<tr>
			<td colspan="8" align="center"><b>Summary<b></td>
		</tr>
		 <tr>
			<td align='right' colspan='7'>Total Harga Barang Keseluruhan</td>
			<td align='right'><?php echo $total_barang_seluruhtamp; ?></td>
		</tr>
		 <tr>
			<td align='right' colspan='7'>Total QTY Keseluruhan</td>
			<td align='right'><?php echo $total_qty_seluruhtamp; ?></td>
		</tr>
		 <tr>
			<td align='right' colspan='7'>Total Diskon Keseluruhan</td>
			<td align='right'><?php echo $potongannnntamp; ?></td>
		</tr>
		 <tr>
			<td align='right' colspan='7'>Total Bersih Keseluruhan</td>
			<td align='right'><?php echo $total_bersih_seluruhtamp; ?></td>
		</tr>
		 <?php 
            $no = 1;		
			$total_kuant=0;
			$total_mask=0;
			?>
			<tr hidden align='center'>
				<th width="5%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Kode Penjualan</th>
				<th colspan=7>Harga Costum</th></tr>
		<?php
			$totking=0;
              while($data2 = mysqli_fetch_array($data_barang2)){ 
			   $tgltrans = $data2['TGL']; 
			   $kodtrans = $data2['KODE_TRANSAKSI']; 
			   $ongkir = $data2['HARGA_TAMBAHAN']; 
			   $totking = $totking + $ongkir;
			   $totking2 = $totking;
			   $ongkir = "Rp" . number_format($ongkir,0,',','.');      
			  
	   ?>
				<tr hidden>
					<td align='center'><?php echo $no++; ?></td>
					<td align='center'><?php echo formatTanggal($tgltrans); ?></td>
					<td align='center'><?php echo $kodtrans; ?></td>
					<td align='right' colspan=7><?php echo $ongkir; } ?></td>
				</tr>
				 <tr hidden>
					 <?php
						$totking = "Rp" . number_format($totking,0,',','.');     
					 ?>
					<td colspan="7" align="right"><b>Total Pemasukan Costum</td>
					<td align='right'> <?php echo $totking; ?></td>
				 </tr>
				<tr hidden>
					 <?php
						$totsel = $totking2+$total_bersih;
						$totsel = "Rp" . number_format($totsel,0,',','.');      
					 ?>
					<td colspan="7" align="right"><b>Total Keseluruhan</td>
					<td align='right'> <?php echo $total_bersih_seluruhtamp; ?></td>
				 </tr>
      </table>
      <script>
         window.print();
      </script>
   </body>
</html>