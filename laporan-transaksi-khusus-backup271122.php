<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Transaksi Khusus - H O L A S W E A T E R</title>
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta http-equiv="refresh" content="5; url=form-laporan">
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
			<style type="text/css" media="print">
				@page {
				size: a4;   /* auto is the initial value */
				margin: 1;  /* this affects the margin in the printer settings */
				}
			</style>
			<style>
				table .dda{
				border: 1px solid #014995;
				border-collapse: collapse;
				}
			</style>
	</head>
	</head>
	<body>
		<?php 
			error_reporting(0);
			session_start();				
			$oleh = $_SESSION['nama_lengkap'];
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="BENDAHARA"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			?>
		<h2 class="left">Laporan Transaksi Khusus</h2>
		<h4 class="left">Holasweater</h4>
		<?php
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$tglnyaa = date("d F Y");
			$jam = date("H:i:s");
			$cetak = $tglnyaa.' ('.$jam.')';
			
			function formatTanggal($date){
			 // ubah string menjadi format tanggal
			 return date('d-m-Y', strtotime($date));
			}
			if (isset($_POST['tampil_tanggald22']))
			{			
				$tglnya = $_POST['cek_tanggald22'];
				$tgl_nya = date_create($tglnya);
				$tgl_awalz = date_format($tgl_nya,"Y/m/d");
				
				$tglakhir = $_POST['cek_tanggald22d'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
				
				if((strcmp($tglnya,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Periode : " . formatTanggal($tglnya);
					
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi_khusus WHERE TGL='".$tglnya."' GROUP BY KODE_TRANSAKSI ORDER BY ID ASC");
				}
				else{
					$nama = "Periode : " . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir);
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi_khusus WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' GROUP BY KODE_TRANSAKSI ORDER BY ID ASC");
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
				
				if ($bulanak=='02'){
					$tgl_akhir = $tahunak."-".$bulanak."-28";
				}
				else if (($bulanak=='01')||($bulanak=='03')||($bulanak=='05')||($bulanak=='07')||($bulanak=='08')||($bulanak=='10')||($bulanak=='12')){
					$tgl_akhir = $tahunak."-".$bulanak."-31";
				}
				else{
					$tgl_akhir = $tahunak."-".$bulanak."-30";
				}
				
				//$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Periode :  " . $bulawal;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi_khusus WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' GROUP BY KODE_TRANSAKSI ORDER BY ID ASC");
				}
				else{
					$nama = "Periode : " . $bulawal." s.d. ". $bulakhir;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi_khusus WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' GROUP BY KODE_TRANSAKSI ORDER BY ID ASC");
				}	
			}
			
			$jumtrans = mysqli_num_rows($data_barang);
			$jumtrans = "Jumlah Transaksi: " . $jumtrans;
			?>
		<br>
		<br>
		<h6 class="left"><?php echo $nama; ?></h6>
		<table class="table-borderless dda" style="width: 100%" align='center'>
			<tr style="background-color:#014995;color:#ffffff" align='center'>
				<th width="5%">No</th>
				<th>Tanggal Transaksi</th>
				<th>Customer</th>
				<th>PCS</th>
				<th>Sablon</th>
				<th>Payment Mtd</th>
				<th>Total Pembayaran</th>
			</tr>
			<?php 
				$no = 1;		
				$tot_pcsnya=0;
				$tot_sablonnya=0;
				$tot_pemasukannya=0;
				$total_diskon=0;
				$tot_sel_edc=0;
				$tot_sel_tf=0;
				$totalx=0;
				$tot_sel_cash=0;
				$pot_tff=0;
				$pot_edcc=0;
				$pot_cashh=0;
				
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
				$data_transaksi = mysqli_query($koneksi, "select KODE_TRANSAKSI,SUM(QTY) AS PCS from t_transaksi_khusus where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'TB' AND JENIS_BARANG<>'TB2' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND JENIS_BARANG<>'CST Basic Hoodie' AND JENIS_BARANG<>'CST Crewneck' AND JENIS_BARANG<>'CST Zipper' AND JENIS_BARANG<>'CST Hoodie Crop' AND JENIS_BARANG<>'CST Crewneck Crop' AND JENIS_BARANG<>'CST + Sisi' AND JENIS_BARANG<>'Shooping Bag' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND KENA='YA' AND TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi' GROUP BY KODE_TRANSAKSI");
				
				while($dataxx = mysqli_fetch_array($data_transaksi)){
				$pcs_trjual = $dataxx['PCS'];
				if ($dataxx['PCS'] === NULL){
				$pcs_trjual_tamp ='S';
				}
				else{
				$pcs_trjual_tamp = number_format($pcs_trjual,0,',','.');
				}
				}
				
				$tot_pcsnya = $tot_pcsnya + $pcs_trjual;
				$tot_pcsnya_tamp = number_format($tot_pcsnya,0,',','.');	
				
				
				
				
				$data_transaksi2 = mysqli_query($koneksi,"SELECT PAYMENT,COSTUMER,SUM(TOTAL2)as TOTAL FROM t_transaksi_khusus WHERE TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi' GROUP BY KODE_TRANSAKSI");
				while($data2 = mysqli_fetch_array($data_transaksi2)){
				$payment = $data2['PAYMENT'];
				$customer = $data2['COSTUMER'];
				$total = $data2['TOTAL'];
				}
				
				
				$potn2=0;
				$diskon  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi_khusus where TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi' GROUP BY KODE_TRANSAKSI");
				while($data7x= mysqli_fetch_array($diskon)){
				$potn = $data7x['POTONGAN'];		
				$potn2 = $potn2+$potn;								
				}		
				
				$totalx = $total - $potn;
				$total_tamp = "Rp".number_format($totalx,0,',','.');	
				$total_diskon = $total_diskon +$potn2;
				$tot_pemasukannya = $tot_pemasukannya + $totalx;
				$tot_pemasukannya_tamp = number_format($tot_pemasukannya,0,',','.');
				
				/*				$pembayarantotal  = mysqli_query($koneksi, "select PAYMENT,COSTUMER,SUM(TOTAL2) AS TOTALXXX from t_transaksi_khusus where TGL='$tgl_transaksi' and KODE_TRANSAKSI='$kode_transaksi' GROUP BY KODE_TRANSAKSI");
				while($data6x= mysqli_fetch_array($pembayarantotal)){
				$tot_semu = $data6x['TOTALXXX'];							
				$tot_pemasukannya_tamp = "Rp".number_format($tot_semu,0,',','.');	
				}
				*/
				
				$costum  = mysqli_query($koneksi, "select SUM(QTY) AS COSTUM,JENIS_BARANG from t_transaksi_khusus where (KENA='TIDAK' or JENIS_BARANG='Costum') AND JENIS_BARANG<>'Shooping Bag' AND TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi' GROUP BY KODE_TRANSAKSI");
				while($data3= mysqli_fetch_array($costum)){
				$tot_cos = $data3['COSTUM'];
				$tot_cost_tamp = number_format($tot_cos,0,',','.');	
				}				
				$tot_sablonnya = $tot_sablonnya + $tot_cos;		
				$tot_sablonnya_tamp = number_format($tot_sablonnya,0,',','.');			
				
				
				
				
				//EDC			
				/*$pembayaranedc  = mysqli_query($koneksi, "SELECT TGL,COSTUMER,KODE_TRANSAKSI,PAYMENT,SUM(TOTAL2)AS TOTALX,SUM(POTONGAN)AS POTONGAN,SUM(TOTAL2)-SUM(POTONGAN) AS EDC from t_transaksi_khusus WHERE TGL='$tgl_transaksi' GROUP BY KODE_TRANSAKSI");
				while($data4= mysqli_fetch_array($pembayaranedc)){
				$tot_edc = $data4['EDC'];							
				$tot_edctamp = "Rp".number_format($tot_edc,0,',','.');	
				}
				*/
				
				
				$pembayaranedc  = mysqli_query($koneksi, "select SUM(TOTAL2) AS EDC from t_transaksi_khusus where PAYMENT='EDC' AND TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi'");
				while($data4= mysqli_fetch_array($pembayaranedc)){
				$tot_edc = $data4['EDC'];							
				$tot_edctamp = "Rp".number_format($tot_edc,0,',','.');	
				}
				$tot_sel_edc = $tot_sel_edc + $tot_edc;
				
				$pot_edc=0;			
				$diskon_edc  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi_khusus where TGL='$tgl_transaksi' AND PAYMENT='EDC' GROUP BY KODE_TRANSAKSI");
				while($dataedc= mysqli_fetch_array($diskon_edc)){
				$potnedc = $dataedc['POTONGAN'];		
				$pot_edc= $pot_edc + $potnedc;						
				}						
				//$pot_edctamp = "Rp".number_format($pot_edc,0,',','.');	
				$tot_sel_edc2 = $tot_sel_edc - $pot_edc;
				$tot_sel_edc_tamp = "Rp".number_format($tot_sel_edc2,0,',','.');
				
				
				
				
				
				
				
				
				
				
				//TRANSFER		
				
				$pembayarantf  = mysqli_query($koneksi, "select SUM(TOTAL2) AS TRANSFER from t_transaksi_khusus where PAYMENT='TRANSFER' AND TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi'");
				while($data5= mysqli_fetch_array($pembayarantf)){
				$tot_tf = $data5['TRANSFER'];							
				$tot_tftamp = "Rp".number_format($tot_tf,0,',','.');	
				}		
				
				$tot_sel_tf = $tot_sel_tf + $tot_tf;			
				
				$pot_tf=0;			
				$diskon_tf  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi_khusus where TGL='$tgl_transaksi' AND PAYMENT='TRANSFER' GROUP BY KODE_TRANSAKSI");
				while($datatf= mysqli_fetch_array($diskon_tf)){
				$potntf = $datatf['POTONGAN'];		
				$pot_tf= $pot_tf + $potntf;						
				}					
				//$pot_tftamp = "Rp".number_format($pot_tf,0,',','.');				
				$tot_sel_tf2 = $tot_sel_tf - $pot_tf;				
				$tot_sel_tf_tamp = "Rp".number_format($tot_sel_tf2,0,',','.');		
				
				
				
				
				
				
				
				
				//CASH		
				
				$pembayarancash  = mysqli_query($koneksi, "select SUM(TOTAL2) AS CASH from t_transaksi_khusus where PAYMENT='CASH'  AND TGL='$tgl_transaksi' AND KODE_TRANSAKSI='$kode_transaksi'");
				while($data6= mysqli_fetch_array($pembayarancash)){
				$tot_cash = $data6['CASH'];							
				$tot_cashtamp = "Rp".number_format($tot_cash,0,',','.');	
				}		
				$tot_sel_cash = $tot_sel_cash + $tot_cash;		
				
				$pot_cash=0;			
				$diskon_cash  = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi_khusus where TGL='$tgl_transaksi' AND PAYMENT='CASH' GROUP BY KODE_TRANSAKSI");
				while($datacash = mysqli_fetch_array($diskon_cash)){
				$potncash = $datacash['POTONGAN'];		
				$pot_cash = $pot_cash + $potncash;						
				}											
				//$pot_cashamp = "Rp".number_format($pot_cash,0,',','.');				
				$tot_sel_cash2 = $tot_sel_cash - $pot_cash;
				$tot_sel_cash_tamp = "Rp".number_format($tot_sel_cash2,0,',','.');
				
				
				?>
			<tr>
				<td align='center'><?php echo $no++."."; ?></td>
				<td align='center'><?php echo formatTanggal($tgl_transaksi); ?></td>
				<td align='left'><?php echo $customer; ?></td>
				<td align='center'><?php echo $pcs_trjual_tamp; ?></td>
				<td align='center'><?php echo $tot_cost_tamp; ?></td>
				<td align='left'><?php echo $payment; ?></td>
				<td align='right'><?php echo $total_tamp; }?></td>
			</tr>
			<tr style="background-color:#d0d0d0">
				<td colspan="3" rowspan="4" align="center"><b>Jumlah<b></td>
				<td rowspan="4" align='center'><?php echo $tot_pcsnya_tamp; ?></td>
				<td rowspan="4" align='center'><?php echo $tot_sablonnya_tamp; ?></td>
			</tr>
			<tr style="background-color:#d0d0d0">
				<td align='left'>Cash</td>
				<td align='right'><?php echo $tot_sel_cash_tamp; ?></td>
			</tr>
			<tr style="background-color:#d0d0d0">
				<td align='left'>Transfer</td>
				<td align='right'><?php echo $tot_sel_tf_tamp; ?></td>
			</tr>
			<tr style="background-color:#d0d0d0">
				<td align='left'>EDC</td>
				<td align='right'><?php echo $tot_sel_edc_tamp; ?></td>
			</tr>
			<tr style="background-color:#b8b8b8">
				<td colspan='6' align='center'>
					<h4>Total Pemasukan</h4>
				</td>
				<td align='center'>
					<h4><?php echo "Rp".$tot_pemasukannya_tamp; ?></h4>
				</td>
			</tr>
		</table>
		<table class="table-borderless" border="0" style="width: 100%" align='center'>
			<tr align='center'>
				<td><br></td>
			</tr>
			<tr align='center'>
				<td width="65%">
				</td>
				<td align="left">
					Tanggal Cetak
				</td>
				<td align="center">
					:
				</td>
				<td align="left">
					<?php echo $cetak; ?>
				</td>
			</tr>
			<tr align='center'>
				<td width="65%">
				</td>
				<td align="left">
					Oleh
				</td>
				<td align="center">
					:
				</td>
				<td align="left">
					<?php echo $oleh; ?>
				</td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>