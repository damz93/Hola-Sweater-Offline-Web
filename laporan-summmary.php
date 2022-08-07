<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
   <head>
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <title>Laporan Summary - H O L A S W E A T E R</title>
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
         <style type="text/css" media="print">
            @media print {
            tr.vendorListHeading {
            background-color: #1a4567 !important;
            -webkit-print-color-adjust: exact; 
            }
            }
            @media print {
            .vendorListHeading th {
            color: white !important;
            }
            }
         </style>
   </head>
   </head>
   <body>
      <?php
         error_reporting(0);
         session_start();
         if ($_SESSION['status'] != "login") {
             echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
         } else if ($_SESSION['level'] != "OWNER" AND $_SESSION['level'] != "KASIR" AND $_SESSION['level'] != "SPV KASIR") {
             echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         } else {
             
         }
         ?>
      <u>
         <h1 class="center">SUMMARY PEMASUKAN</h1>
      </u>
      <h3 class="center">H O L A S W E A T E R</h3>
      <?php
         include 'koneksi.php';
         date_default_timezone_set('Asia/Hong_Kong');
         $waktu_skg = date("d-m-Y");
         session_start();
         $olehhh = $_SESSION['username'];
         $jam    = date("H:i:s");
         function formatTanggal($date)
         {
             // ubah string menjadi format tanggal
             return date('d-m-Y', strtotime($date));
         }
         if (isset($_POST['tampil_tanggal3'])) {
             $tglnya    = $_POST['cek_tgl3'];
             $tgl_nya   = date_create($tglnya);
             $tgl_awalz = date_format($tgl_nya, "Y-m-d");
             
             $tglakhir   = $_POST['cek_tgl3d'];
             $tgl_akhir  = date_create($tglakhir);
             $tgl_akhirz = date_format($tgl_akhir, "Y-m-d");            
             if ((strcmp($tglnya, $tglakhir) == 0) OR empty($tglakhir)) {                 
                 $nama        = "Tanggal: " . formatTanggal($tglnya);
                 $data_barang = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where TGL='" . $tgl_awalz . "' GROUP BY TGL ORDER BY TGL ASC");                 
                 //$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL='" . $tglnya . "' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
             } else {
                 $nama         = "Tanggal: " . formatTanggal($tglnya) . " s.d " . formatTanggal($tglakhir);
                 $data_barang  = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where TGL BETWEEN '" . $tgl_awalz . "' AND '" . $tgl_akhirz . "' GROUP BY TGL ORDER BY TGL ASC");
                 //$data_barang2 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL BETWEEN '" . $tgl_awalz . "' AND '" . $tgl_akhirz . "' AND HARGA_TAMBAHAN>0 GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
				}                                   
			} else if (isset($_POST['tampil_bulan3'])) {
             
				 $bulawal  = $_POST['cek_bulan3'];
				 $bulanaw  = substr($bulawal, 0, 2);
				 $tahunaw  = substr($bulawal, 3, 7);
				 $tgl_awal = $tahunaw . "-" . $bulanaw . "-01";
				 
				 $bulakhir  = $_POST['cek_bulan3d'];
				 $bulanak   = substr($bulakhir, 0, 2);
				 $tahunak   = substr($bulakhir, 3, 7);
				 $tgl_akhir = $tahunak . "-" . $bulanak . "-31";
				 
				 if ((strcmp($bulawal, $bulakhir) == 0) OR empty($bulakhir)) {
					 //    $nama = "Laporan Summary Bulanan - " . $bulawal;
					 //    $data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='".$bulanaw."' AND YEAR(TGL)='".$tahunaw."' ORDER BY KODE_TRANSAKSI ASC");
					 $data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE MONTH(TGL)='" . $bulanaw . "' AND YEAR(TGL)='" . $tahunaw . "' ORDER BY KODE_PENGELUARAN ASC");
					 $data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE MONTH(TGL)='" . $bulanaw . "' AND ONGKIR>0 AND YEAR(TGL)='" . $tahunaw . "' GROUP BY KODE_TRANSAKSI ORDER BY KODE_TRANSAKSI ASC");
					 $nama         = "Bulan : " . $bulawal;
					 $data_barang  = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where MONTH(TGL)='" . $bulanaw . "' AND YEAR(TGL)='" . $tahunaw . "' GROUP BY TGL ORDER BY TGL ASC");
					                                     
             } else {
                 //$nama = "Laporan Summary(" . $bulawal." s.d. ". $bulakhir.")";
                 //$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_TRANSAKSI ASC");
                 $data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '" . $tgl_awal . "' AND '" . $tgl_akhir . "' ORDER BY KODE_PENGELUARAN ASC");
                 $data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '" . $tgl_awal . "' AND '" . $tgl_akhir . "' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
                 
                 //    $nama = formatTanggal($tgl_awal) ." - ". formatTanggal($tgl_akhir);
                 $nama        = "Bulan : " . $bulawal . " s.d " . $bulakhir;
                 $data_barang = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where TGL between '" . $tgl_awal . "' AND '" . $tgl_akhir . "' GROUP BY TGL ORDER BY TGL ASC");
                 
                 
                 
                 
                 
                 
             }
             
             
         } else if (isset($_POST['tampil_tahun3'])) {
             $tahunnya      = $_POST['cek_tahun3'];
             $tahunawal_nya = $tahunnya . "-01-01";
             
             $tahunnya2      = $_POST['cek_tahun3d'];
             $tahunakhir_nya = $tahunnya2 . "-12-31";
             
             if ((strcmp($tahunnya, $tahunnya2) == 0) OR empty($tahunnya2)) {
                 $nama         = "Tahun : " . $tahunnya;
                 //$data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='".$tahunnya."' ORDER BY KODE_TRANSAKSI ASC");    
                 $data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE YEAR(TGL)='" . $tahunnya . "' ORDER BY KODE_PENGELUARAN ASC");
                 $data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE YEAR(TGL)='" . $tahunnya . "' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
                 
                 
                 //    $nama = formatTanggal($tahunnya) ." - ". formatTanggal($tahunnya2);
                 $data_barang = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where YEAR(TGL)='" . $tahunnya . "' GROUP BY TGL ORDER BY TGL ASC");
                 
                 
             } else {
                 //$nama = "Laporan Summary(" . $tahunnya." s.d. ". $tahunnya2.")";
                 $nama         = "Tahun : " . $tahunnya . " s.d " . $tahunnya2;
                 //    $data_barang = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '".$tahunnya."' AND '".$tahunakhir_nya."' ORDER BY KODE_TRANSAKSI ASC");
                 $data_barang2 = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE TGL between '" . $tahunnya . "' AND '" . $tahunakhir_nya . "' ORDER BY KODE_PENGELUARAN ASC");
                 $data_barang3 = mysqli_query($koneksi, "SELECT * from t_transaksi WHERE TGL between '" . $tahunnya . "' AND '" . $tahunakhir_nya . "' AND ONGKIR>0 GROUP BY KODE_TRANSAKSI ORDER BY TGL ASC");
                 
                 //$nama = formatTanggal($tglnya) ." - ". formatTanggal($tglakhir);
                 $data_barang = mysqli_query($koneksi, "SELECT TGL FROM t_transaksi where TGL between '" . $tahunnya . "' AND '" . $tahunakhir_nya . "'  GROUP BY TGL ORDER BY TGL ASC");
                 
             }
         }
         $j1       = mysqli_num_rows($data_barang);
    //     $j2       = mysqli_num_rows($data_barang2);
     //    $j3       = mysqli_num_rows($data_barang3);
         $jumtrans = $j1 + $j2 + $j3;
         $jumtrans = "Jumlah Transaksi: " . $jumtrans;
         ?>
      <br>
      <br>
      <br>
      <table border="0" style="width: 100%">
         <tr>
            <td align='left'>
               <h6 class="left"><?php
                  echo $nama;
                  ?></h6>
            </td>
            <td align='right'>
               <h6 class="right"><?php
                  echo "[" . $waktu_skg . " - " . $jam . "] - " . $olehhh;
                  ?></h6>
            </td>
         </tr>
      </table>    
      <table border="2" style="width: 100%">
         <tr align='center'>
            <th width="3%" rowspan='2'>No</th>
            <th rowspan='2'>Tanggal</th>
            <th rowspan='2'>PCS</th>
            <th rowspan='2'>Costum</th>
            <th colspan='4'>Pemasukan</th>
            <th rowspan='2'>Pengeluaran</th>
            <th rowspan='2'>Setoran Cash</th>
         </tr>
         <tr align='center'>
            <th>Cash</th>
            <th>Transfer</th>
            <th>EDC</th>
            <th>Subtotal</th>
         </tr>
         <?php
            $no         = 1;
            $total_jual = 0;
            $tot_pcs    = 0;
            $tot_cos    = 0;
            $tot_cash   = 0;
            $tot_tx     = 0;
            $tot_edc    = 0;
            $tot_subt   = 0;
            $tot_pengel = 0;
            $tot_setor  = 0;
			$sub_total = 0;
			$tot_set_cash = 0;
			$tot_pengeluaran = 0;
			while ($data = mysqli_fetch_array($data_barang)) {				
				$tglx = $data['TGL'];					
				//$tglx = formatTanggal($tglx);  
				$sum_pcsx = 0;
				$sum_cosx = 0;		
				$potongan_edc = 0;
				$potongan_tf = 0;
				$potongan_cash = 0;
				$kotor_edc = 0;
				$kotor_tf = 0;
				$kotor_cash = 0;			
				$bersih_edc = 0;
				$bersih_tf = 0;
				$bersih_cash = 0;
				$sub_tot = 0;
				$set_cash = 0;
				$pengeluaran = 0;
			
					//$sum_pcs = mysqli_query($koneksi, "SELECT SUM(QTY)as QTYX from t_transaksi WHERE TGL='".$tglx."' AND JENIS_BARANG<> 'COSTUM' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND JENIS_BARANG<>'Totebag'");
					$sum_pcs = mysqli_query($koneksi, "select SUM(QTY) AS QTYX from t_transaksi where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'TB' AND JENIS_BARANG<>'Custom Sablon' AND JENIS_BARANG<>'TB2' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND JENIS_BARANG<>'CST Basic Hoodie' AND JENIS_BARANG<>'CST Crewneck' AND JENIS_BARANG<>'CST Zipper' AND JENIS_BARANG<>'CST Hoodie Crop' AND JENIS_BARANG<>'CST Crewneck Crop' AND JENIS_BARANG<>'CST + Sisi' AND JENIS_BARANG<>'Shooping Bag' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND KENA='YA' AND TGL='".$tglx."'");
					
						while($sum_pcx2 = mysqli_fetch_array($sum_pcs)){	
							$sum_pcsx = $sum_pcsx + $sum_pcx2['QTYX'];
						}
						$pcstamp = number_format($sum_pcsx, 0, ',', '.');
						$tot_pcs     = $tot_pcs + $sum_pcsx;
						$tot_pcstamp = number_format($tot_pcs, 0, ',', '.');
						
					//$sum_cos = mysqli_query($koneksi, "SELECT SUM(QTY)as QTYY from t_transaksi WHERE TGL='".$tglx."' AND JENIS_BARANG='Costum' OR JENIS_BARANG='Costum Sablon DTF'");
					$sum_cos = mysqli_query($koneksi, "select SUM(QTY) AS QTYY,JENIS_BARANG from t_transaksi where  (KENA='TIDAK' or JENIS_BARANG='Costum') AND JENIS_BARANG<>'Shooping Bag' AND TGL='".$tglx."'");
					
						while($sum_cos2 = mysqli_fetch_array($sum_cos)){	
							$sum_cosx = $sum_cosx + $sum_cos2['QTYY'];
						}
						$costumtamp = number_format($sum_cosx, 0, ',', '.');
						$tot_cos     = $tot_cos + $sum_cosx;
						$tot_costamp = number_format($tot_cos, 0, ',', '.');
						
					$kot_edc = mysqli_query($koneksi, "select SUM(TOTAL2) AS EDC from t_transaksi where PAYMENT='EDC' AND TGL='".$tglx."'");	
					while($kot_edcx = mysqli_fetch_array($kot_edc)){	
							$kotor_edc = $kotor_edc + $kot_edcx['EDC'];
						}	
						
					$kot_tf = mysqli_query($koneksi, "select SUM(TOTAL2) AS TRANSFER from t_transaksi where PAYMENT='TRANSFER' AND TGL='".$tglx."'");	
					while($kot_tfx = mysqli_fetch_array($kot_tf)){	
							$kotor_tf = $kotor_tf + $kot_tfx['TRANSFER'];
						}
						
					$kot_cash = mysqli_query($koneksi, "select SUM(TOTAL2) AS CASH from t_transaksi where PAYMENT='CASH' AND TGL='".$tglx."'");	
					while($kot_cashx = mysqli_fetch_array($kot_cash)){	
							$kotor_cash = $kotor_cash + $kot_cashx['CASH'];
						}	
											
					$pot_edc = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='".$tglx."' and PAYMENT='EDC' GROUP BY KODE_TRANSAKSI");	
					while($pot_edcx = mysqli_fetch_array($pot_edc)){	
							$potongan_edc = $potongan_edc + $pot_edcx['POTONGAN'];
						}
											
					$pot_tf = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='".$tglx."' and PAYMENT='TRANSFER' GROUP BY KODE_TRANSAKSI");	
					while($pot_tfx = mysqli_fetch_array($pot_tf)){	
							$potongan_tf = $potongan_tf + $pot_tfx['POTONGAN'];
						}
											
					$pot_cash = mysqli_query($koneksi, "select POTONGAN,KODE_TRANSAKSI from t_transaksi where TGL='".$tglx."' and PAYMENT='CASH' GROUP BY KODE_TRANSAKSI");	
					while($pot_cashx = mysqli_fetch_array($pot_cash)){	
							$potongan_cash = $potongan_cash + $pot_cashx['POTONGAN'];
						}
						
					$bersih_edc = $kotor_edc - $potongan_edc;
					$bersih_edctamp = "Rp" . number_format($bersih_edc, 0, ',', '.');
					$tot_edc        = $tot_edc + $bersih_edc;
					$tot_edctamp    = "Rp" . number_format($tot_edc, 0, ',', '.');
					
					$bersih_tf = $kotor_tf - $potongan_tf;
					$bersih_tftamp = "Rp" . number_format($bersih_tf, 0, ',', '.');
					$tot_tx           = $tot_tx + $bersih_tf;
					$tot_txtamp       = "Rp" . number_format($tot_tx, 0, ',', '.');
					
					$bersih_cash = $kotor_cash - $potongan_cash;
					$bersih_cashtamp = "Rp" . number_format($bersih_cash, 0, ',', '.');
					$tot_cash        = $tot_cash + $bersih_cash;
					$tot_cashtamp    = "Rp" . number_format($tot_cash, 0, ',', '.');
					
					$sub_tot = $bersih_tf + $bersih_edc +$bersih_cash;
					$sub_tottamp    = "Rp" . number_format($sub_tot, 0, ',', '.');
					$sub_total        = $sub_total + $sub_tot;
					$tot_subttamp    = "Rp" . number_format($sub_total, 0, ',', '.');
					
					$pengel = mysqli_query($koneksi, "select NOMINAL from t_pengeluaran where TGL='".$tglx."'");	
					while($pengelx = mysqli_fetch_array($pengel)){	
							$pengeluaran = $pengeluaran + $pengelx['NOMINAL'];
						}					
					$pengeluaran_tamp    = "Rp" . number_format($pengeluaran, 0, ',', '.');
					$tot_pengeluaran = $tot_pengeluaran +$pengeluaran;
					$tot_pengeluaran_tamp    = "Rp" . number_format($tot_pengeluaran, 0, ',', '.');
					
					$set_cash = $bersih_cash - $pengeluaran;
					$set_cash_tamp    = "Rp" . number_format($set_cash, 0, ',', '.');
					
					$tot_set_cash = $tot_set_cash + $set_cash;
					$tot_set_cash_tamp    = "Rp" . number_format($tot_set_cash, 0, ',', '.');
			
				
				
			?>	
			<tr>
            <td align='center'><?php
               echo $no++;
               ?></td>
            <td align='center'><?php
               echo formatTanggal($tglx);
               ?></td>
            <td align='right'><?php
               echo $pcstamp;
               ?></td>
            <td align='right'><?php
               echo $costumtamp;
               ?></td>
            <td align='right'><?php
               echo $bersih_cashtamp;
               ?></td>
            <td align='right'><?php
               echo $bersih_tftamp;
               ?></td>
            <td align='right'><?php
               echo $bersih_edctamp;
               ?></td>
            <td align='right'><?php
               echo $sub_tottamp;
               ?></td>
            <td align='right'><?php
               echo $pengeluaran_tamp;
               ?></td>
            <td align='right'> <?php
               echo $set_cash_tamp;
               
               ?></td>
         </tr>
		  <?php
			}
			   
            ?>
         
         <tr>
            <td colspan="2" align="right">
              
			   
			   Total
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_pcstamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_costamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_cashtamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_txtamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_edctamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_subttamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
                  echo $tot_pengeluaran_tamp;
                  ?></b>
            </td>
            <td align='right'>
               <b><?php
			echo $tot_set_cash_tamp;
                  ?></b>
            </td>
         </tr>
      </table>
      <br>
      <br>
      <br>
      <table border="0" style="width: 100%">
         <tr align="center">
            <td>Kasir Utama</td>
            <td>SPV Kasir</td>
            <td>Admin     </td>
         </tr>
         <tr>
            <td><br><br><br></td>
         </tr>
         <tr align="center">
            <td>
               ttd
            </td>
            <td>ttd</td>
            <td>ttd</td>
         </tr>
      </table>
      <script>
         window.print();
            
      </script>
   </body>
</html>