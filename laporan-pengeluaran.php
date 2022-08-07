<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Pengeluaran - H O L A S W E A T E R</title>
			<meta http-equiv="refresh" content="5; url=utama">
			<link rel="shortcut icon" href="img/tokonline.png">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="css/freelancer.min.css">
			<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="BENDAHARA")) {
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
		<u>
			<h1 class="center">LAPORAN PENGELUARAN</h1>
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
			if (isset($_POST['dateranged']))
			{			
				$tglnya = $_POST['daterange'];
				$tgl_awal = substr($tglnya,0,10);
				$tgl_awal = date_create($tgl_awal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tgl_akhir = substr($tglnya,12,11);
				$tgl_akhir = date_create($tgl_akhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
				
				
				$nama = "Laporan Pengeluaran(" . formatTanggal(substr($tglnya,0,10)) ." s.d. ". formatTanggal(substr($tglnya,12,11)).")";
				$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY TGL ASC");
			}
			else if (isset($_POST['tampil_tanggal2']))
			{			
				$tglnya = $_POST['cek_tanggal2'];
				$tgl_nya = date_create($tglnya);
				$tgl_awalz = date_format($tgl_nya,"Y/m/d");
				
				$tglakhir = $_POST['cek_tanggal2d'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglnya,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Pengeluaran Harian - " . formatTanggal($tglnya);
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL='".$tglnya."' ORDER BY TGL ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran(" . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir).")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY TGL ASC");
				}
			}
			else if (isset($_POST['tampil_bulan2']))
			{		
				$bulawal = $_POST['cek_bulan2'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['cek_bulan2d'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Pengeluaran Bulanan - " . $bulawal;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw." ORDER BY TGL ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran Bulanan(" . $bulawal." s.d. ". $bulakhir.")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
				}
			}
			else if (isset($_POST['tampil_tahun2']))
			{	
				$tahunnya = $_POST['cek_tahun2'];
				$tahunawal_nya = $tahunnya."-01-01";
				
				$tahunnya2 = $_POST['cek_tahun2d'];
				$tahunakhir_nya = $tahunnya2."-12-31";
				
				if((strcmp($tahunnya,$tahunnya2)==0) OR empty($tahunnya2)){
					$nama = "Laporan Pengeluaran Tahunan - " . $tahunnya;
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE YEAR(TGL)=".$tahunnya." ORDER BY TGL ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran Tahunan(" . $tahunnya." s.d. ". $tahunnya2.")";
					$data_barang = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' ORDER BY TGL ASC");	
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
				<th>Tanggal - Jam</th>
				<th>Kode Pengeluaran</th>
				<th>Kategori</th>
				<th>Keterangan</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$no = 1;		
				$total_keluar=0;
				  while($data = mysqli_fetch_array($data_barang)){					
				$waktuu = $data['WAKTU'];
				$kodpenn = $data['KODE_PENGELUARAN'];
				$katee = $data['KATEGORI'];
				$ketee = $data['NOTES'];
				$nomii = $data['NOMINAL'];
				$total_keluar=$total_keluar+$nomii;   								
				$nomii = "Rp" . number_format($nomii,0,',','.');      				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $waktuu; ?></td>
				<td align='center'><?php echo $kodpenn; ?></td>
				<td align='left'><?php echo $katee; ?></td>
				<td align='left'><?php echo $ketee; ?></td>
				<td align='right'><?php echo $nomii; }?></td>
			</tr>
			<tr>
				<?php
					$total_keluar = "Rp" . number_format($total_keluar,0,',','.');      
					?>
				<td colspan="5" align="right"><b>Total</td>
				<td align='right'> <?php echo $total_keluar; ?></td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>