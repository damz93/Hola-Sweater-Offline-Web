<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Laporan Transaksi - S W E A T E R I N . M E</title>
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
     <h3 class="center">S W E A T E R I N . M E</h3>
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
				$data_barang = mysqli_query($koneksi, "SELECT SUM(QTY) AS 'JUMLAH QTY',KODE_TRANSAKSI,SUM(TOTAL2) AS TOTAL_BARANG,POTONGAN from t_transaksi WHERE TGL='".$tglnya."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='".$tglnya."' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
			}
			else{
				$nama = "Laporan Pemasukan(" . formatTanggal($tglnya) ." s.d. ". formatTanggal($tglakhir).")";
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY KODE_TRANSAKSI ASC");
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
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' ORDER BY KODE_TRANSAKSI ASC");
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND HARGA_TAMBAHAN>0 AND YEAR(TGL)='".$tahunaw."' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");	
			}
			else{
				$nama = "Laporan Pemasukan Bulanan(" . $bulawal." s.d. ". $bulakhir.")";
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_TRANSAKSI ASC");
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
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' ORDER BY KODE_TRANSAKSI ASC");	
				$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");	
			}
			else{
				$nama = "Laporan Transaksi Tahunan(" . $tahunnya." s.d. ". $tahunnya2.")";
				
				$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunawal_nya."' AND '".$tahunakhir_nya."' ORDER BY KODE_TRANSAKSI ASC");	
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
            <th>Kuantitas</th>
            <th>Total Harga</th>
            <th hidden>Costum</th>
            <th hidden>Diskon</th>
            <th hidden>Total Bersih</th>
         </tr>
         <?php 
            $no = 1;		
			$total_kuant=0;
			$total_mask=0;
			$total_kotor=0;
			$total_bersih=0;
			$total_diskon=0;
              while($data = mysqli_fetch_array($data_barang)){					
            $kodbar = $data['KODE_BARANG'];
            $kodtrans = $data['KODE_TRANSAKSI'];
            $tgltrans = $data['TGL'];
            $nambar = $data['JENIS_BARANG'];
            $costumm = $data['HARGA_TAMBAHAN'];
            $kuant = $data['QTY'];
			$costumtot = $costumm * $kuant;
			//$ongkir = $data2['ONGKIR']; 
            $pendp = $data['TOTAL'];	
			$total_kotor=$total_kotor+$pendp;
            $pendp2 = $data['TOTAL2'];	
			$total_bersih=$total_bersih+$pendp2;
			$total_mask=$total_mask+$pendp;
			$total_mask1=$total_mask;
            $hargs = $data['HARGA'];	
            $diskon = $data['POTONGAN'];	
            $total_diskon = $total_diskon+$diskon;	
			$total_kuant = $total_kuant + $kuant;
			$total_tambahan = $total_tambahan + $costumtot;
            $hargs = "Rp" . number_format($hargs,0,',','.');      				
            $diskontamp = "Rp" . number_format($diskon,0,',','.');      				
            $costumtottamp = "Rp" . number_format($costumtot,0,',','.');      				
            $pendptamp = "Rp" . number_format($pendp,0,',','.');      				
            $pendp2tamp = "Rp" . number_format($pendp2,0,',','.');      			

			
					
          //  $ongkir = "Rp" . number_format($ongkir,0,',','.');      				
            ?>
         <tr>
            <td align='center'><?php echo $no++; ?></td>
            <td align='center'><?php echo formatTanggal($tgltrans); ?></td>
            <td align='center'><?php echo $kodtrans; ?></td>
            <td align='center'><?php echo $kodbar; ?></td>
            <td><?php echo $nambar; ?></td>
            <td align='right'> <?php echo $hargs; ?></td>
			<td align='right'> <?php echo $kuant; ?></td>
            <td align='right'> <?php echo $pendptamp; ?></td>
            <td hidden align='right'> <?php echo $costumtottamp; ?></td>
            <td hidden align='right'> <?php echo $diskontamp; ?></td>
            <td hidden align='right'> <?php echo $pendp2tamp; ?></td>
         </tr>
		 <tr>
		 <?php
			  }
			     
						
            $total_kuanttamp = number_format($total_kuant,0,',','.');  
            $total_kotortamp = "Rp" . number_format($total_kotor,0,',','.');  
            $total_bersihtamp = "Rp" . number_format($total_bersih,0,',','.');  
            $total_diskontamp = "Rp" . number_format($total_diskon,0,',','.');  
            $total_tambahantamp = "Rp" . number_format($total_tambahan,0,',','.');  
		 ?>
			<td colspan="3" align="right"><b>Total </td>
			<td align='right'> <?php echo $total_kuanttamp; ?></td>
			<td align='right'> <?php echo $total_kotortamp; ?></td>
			<td align='right'> <?php echo $total_tambahantamp; ?></td>
			<td align='right'> <?php echo $total_diskontamp; ?></td>
			<td align='right'> <?php echo $total_bersihtamp; ?></td>
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
					<td align='right'> <?php echo $totsel; ?></td>
				 </tr>
      </table>
      <script>
         window.print();
      </script>
   </body>
</html>