<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Stok Barang - H O L A S W E A T E R</title>
			<meta http-equiv="refresh" content="5; url=form-laporan">
			<link rel="shortcut icon" href="img/tokonline.png">
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG" AND $_SESSION['level']!="BENDAHARA"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
		<u>
			<h1 class="center">LAPORAN STOK</h1>
		</u>
		<h3 class="center">H O L A S W E A T E R</h3>
		<?php 
			include 'koneksi.php';
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$jam=date("H:i:s");
			if (isset($_POST['barang_terbanyak'])){
			$nama = "QTY Barang - Lebih dari 10";			
			$data_barang = mysqli_query($koneksi,"SELECT * FROM t_stok WHERE QTY>=10 ORDER BY QTY DESC");
			}
			else if (isset($_POST['barang_juml'])){
			$nama = "QTY Barang - Lebih dari 1";			
			$data_barang = mysqli_query($koneksi,"SELECT * FROM t_stok WHERE QTY>=0 ORDER BY QTY DESC");
			}
			else if (isset($_POST['barang_tersedikit'])){
			$nama = "QTY Barang - Kurang dari 1";
			$data_barang = mysqli_query($koneksi,"SELECT * FROM t_stok WHERE QTY<=1 ORDER BY QTY DESC");
			} 
			$jumbar = mysqli_num_rows($data_barang);
			$jumbar = $jumbar." Barang yang berbeda";
		?>     
		<h5 class="right"><b><?php echo $nama; ?></b></h5>
		<h5 class="right"><b><?php echo $jumbar; ?></b></h5>
		<h6 class="right"><i><?php echo $waktu_skg."-".$jam; ?></i></h6>
		<table border="1" style="width: 100%" align='left'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>Tanggal Update</th>
				<th width="15%">Kode Barang</th>
				<th>Jenis Barang</th>
				<th>Harga</th>
				<th width="8%">QTY</th>
			</tr>
			<?php 
				$no = 1;			
				$jumqty = 0;
				function formatTanggal($date){
				// ubah string menjadi format tanggal
				return date('d-m-Y', strtotime($date));
				}
				  while($data = mysqli_fetch_array($data_barang)){					
				$harga = $data['HARGA'];
				$qty = $data['QTY'];
				$kodbar = $data['KODE_BARANG'];
				$jenbar = $data['JENIS_BARANG'];
				$tglupd = substr($data['WAKTU'],0,10);
				//$tglupd = formatTanggal($tglupd);				
				$harga_biasa = "Rp" . number_format($harga,0,',','.');        
				$qty_tamp = number_format($qty,0,',','.');        
				$jumqty = $jumqty + $qty;				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='center'><?php echo $tglupd; ?></td>
				<td align='center'><?php echo $kodbar; ?></td>
				<td align='center'><?php echo $jenbar; ?></td>
				<td align='right'> <?php echo $harga_biasa; ?></td>
				<td align='right'> <?php echo $qty_tamp; } ?></td>
			</tr>
			<?php
				$jumqty = number_format($jumqty,0,',','.');      				
				?>
			<tr>
				<td colspan="5" align="right"><b>Jumlah QTY</b></td>
				<td align='right'> <?php echo $jumqty;  ?></td>
			</tr>
		</table>
		<script>
			window.print();
		</script>
	</body>
</html>