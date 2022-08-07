<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data Detail Transaksi - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>		
		<style>
			body, html {
			height: 100%;
			margin: 0;
			}
			.bg {
			/* The image used */
			background-image: url("img/bg_.png");
			/* Full height */
			height: 100%; 
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
	</head>
	<body>
		<div class="bg">
			<?php 
				error_reporting(0);
				    session_start();
				    if($_SESSION['status']!="login"){
				    	echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='esana-admin/index.php?pesan=belum_login';</script>";				    	
				    }
			?>
			<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA DETAIL TRANSAKSI </h1>
			<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
			<br>
			<a style="background-color:#1d7bb6;color:#FFFFFe" href="utama.php"> KE MENU UTAMA </a></br>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="form-transaksi.php"> KEMBALI KE FORM TRANSAKSI </a><br><br>
			<?php
				$kode_transaksi = $_GET['kode_transaksi'];
			?>
			<table id="tabel1" class="" border="0" cellpadding="0" cellspacing="1">
			<tr>
			<td>
				<b style="background-color:#71b8e4;color:#FFFFFe">KODE TRANSAKSI : <?php echo $kode_transaksi; ?></b>
			</td>
			<td align='right'><b>Payment :</b> </td>
			<td>
				<select name="paymentxx" id="paymentxx" onchange="upd_pay('<?php echo $kode_transaksi;?>',this.value);" class="form-control form-control-sm" >   
							
										 <?php
											include "koneksi.php";													 
											$paymx = mysqli_query($koneksi,"select DISTINCT PAYMENT from t_transaksi WHERE PAYMENT<>'' order by PAYMENT ASC");
											$paymx2 = mysqli_query($koneksi,"select PAYMENT from t_transaksi WHERE KODE_TRANSAKSI='$kode_transaksi'");
											while($ddd = mysqli_fetch_array($paymx2)){
												$paym = $ddd['PAYMENT'];
											}
											while($ee = mysqli_fetch_array($paymx)){
												$kat = $ee['PAYMENT'];
												echo '<option value="'.$kat.'"';
												if (strcmp($paym, $kat) == 0){
													echo 'selected="selected"';
												}
												else{
													echo '';
												}
												echo '>';
												echo $kat;
												echo '</option>';
											}							
											?>
				</select>		
			</td>
			</tr>
			</table>					 
			<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
				<thead align="center">
					<tr align="center" class="table-info">
						<th>NO.</th>
						<th>WAKTU</th>
						<th>KODE BARANG</th>
						<th>JENIS BARANG</th>
						<th>SIZE</th>
						<th>WARNA</th>				
						<th>HARGA SATUAN</th>
						<th>QTY</th>
						<th>TOTAL</th>
						<th hidden>BIAYA COSTUM</th>
						<th hidden>KODE DISKON</th>
						<th hidden>NOMINAL DISKON</th>
						<th hidden>TOTAL DISKON</th>
						<th hidden>TOTAL</th>
					</tr>
				</thead>
				<?php
						error_reporting(0);
						error_reporting(E_ERROR | E_WARNING | E_PARSE);
						error_reporting(E_ERROR | E_PARSE);
						include 'koneksi.php';
						$kode_transaksi = $_GET['kode_transaksi'];
						function formatTanggal($date){
							return date('d-M-Y', strtotime($date));
						}
						$juml_keseluruhan = 0;
						$kuantitas = 0;						 
						$no = 1;
						$totharg = 0;
						$totharg2 = 0;
						$diskonn = 0;
						$totalbangetbiayacost = 0;
						//$ongkirr = 0;
						$order = mysqli_query($koneksi, "select * from t_transaksi where KODE_TRANSAKSI='".$kode_transaksi."' ORDER BY JENIS_BARANG,WARNA ASC");
						while ($d = mysqli_fetch_array($order)) {
							$kodr = $d['KODE_TRANSAKSI'];
							$tgl = formatTanggal($d['TGL']);
							$hari = date('l', strtotime($d['TGL']));
							$semua = $hari.", ".$tgl;			
							$kod_bar = $d['KODE_BARANG'];
							$kod_diskon = $d['KODE_DISKON'];
							$diskon = $d['POTONGAN'];		
							$diskontamp = "Rp".number_format($diskon, 0, ",", ".");	
							$diskon2 = $d['POTONGAN'];					
							$diskon33 = $d['POTONGAN'];					
							$diskon2tamp = number_format($diskon2, 0, ",", ".");	
							$jenbar = $d['JENIS_BARANG'];
							$size = $d['SIZE_'];
							$warna = $d['WARNA'];							
							$harga = $d['HARGA'];			
							$harga2 = number_format($harga, 0, ",", ".");			
							$qty = $d['QTY'];
							$biayacost = $d['COSTUM'];		
							//$totbiayacost = $biayacost * $qty;			
							//$totbiayacosttamp = "Rp".number_format($totbiayacost, 0, ",", ".");
							//$ttlbgtbiayacost = $ttlbgtbiayacost + $totbiayacost;
							$ttlbgtbiayacosttamp = "Rp".number_format($ttlbgtbiayacost, 0, ",", ".");
							//$diskon2 = $diskon2 * $qty;
							
						//	$diskonn = $diskonn + $diskon33;
							$diskon2tamp = "Rp".number_format($diskon33, 0, ",", ".");
							$qty2 = number_format($qty, 0, ",", ".");
							$kuantitas = $kuantitas + $qty;
							$juml = $d['TOTAL'];
							$totalfix = $d['TOTAL2'];
							$totharg = $totharg + $juml;
							$totharg2 = $totharg2 + $totalfix;
						//	$diskonn = $diskonn + $diskon2;
							$diskonn = $diskon33;
							$juml2 = number_format($juml, 0, ",", ".");										
							$totalfixtamp = "Rp".number_format($totalfix, 0, ",", ".");								
					 ?>
					<tr align="center">					
						<td><?php echo $no++; ?></td>
						<td><?php echo $semua; ?></td>
						<td><?php echo $kod_bar; ?></td>
						<td><?php echo $jenbar; ?></td>
						<td><?php echo $size; ?></td>
						<td><?php echo $warna; ?></td>
					
						
						<td align="right"><?php echo "Rp".$harga2; ?></td>
						<td align="right"><?php echo $qty2; ?></td>
						<td align="right"><?php echo "Rp".$juml2; ?></td>
						<td hidden align="right"><?php echo $totbiayacosttamp; ?></td>
						<td hidden><?php echo $kod_diskon; }?></td>
						<td hidden align="right"><?php echo $diskontamp; ?></td>
						<td hidden align="right"><?php echo $diskon2tamp; ?></td>
						<td hidden align="right"><?php echo $totalfixtamp; ?></td>
					</tr>
					<?php 						
						$noo = $no - 1;
						$totharg2 = $totharg - $diskonn + $ttlbgtbiayacost ;			
						$totharg = number_format($totharg, 0, ",", ".");				
						$totharg2tamp = number_format($totharg2, 0, ",", ".");	
						$kuantitas = number_format($kuantitas, 0, ",", ".");	
						$diskonntamp = number_format($diskonn, 0, ",", ".");	
						?>
					<tr>
						<td align="right" colspan="8"><b>Jumlah Barang yang berbeda</b>
						</td>
						<td align="right">
							<?php echo $noo;?>
						</td>
					</tr>
					<tr>
						<td align="right" colspan="8"><b>Jumlah Qty</b>
						</td>
						<td align="right">
							<?php echo $kuantitas;?>
						</td>
					</tr>
					<tr>
						<td align="right" colspan="8"><b>Total Harga Barang</b>
						</td>
						<td align="right">
							<?php echo "Rp".$totharg;?>
						</td>
					</tr>
					<tr hidden>
						<td align="right" colspan="8"><b>Ongkos Kirim</b>
						</td>
						<td align="right">
							<?php //echo "Rp".$ongkirr;?>
						</td>
					</tr>
					<tr hidden>
						<td align="right" colspan="8"><b>Total Costum</b>
						</td>
						<td align="right">
							<?php echo $ttlbgtbiayacosttamp;?>
						</td>
					</tr>
					<tr>
						<td align="right" colspan="8"><b>Total Diskon</b>
						</td>
						<td align="right">
							<?php echo "Rp".$diskonntamp;?>
						</td>
					</tr>
					<tr>
						<td align="right" colspan="8"><b>Total Harga</b>
						</td>
						<td align="right">
							<?php echo "Rp".$totharg2tamp;?>
						</td>
					</tr>
			</table>
			<script type="text/javascript">
				$(document).ready(function() {
				    //$("#tabel1").tablesorter();
				    $("#tabel1").DataTable({
				        "paging": true,
				        "ordering": true,
				        "info": true,
				        // });
				        //$("#tabel1").DataTable({
				        "language": {
				            "decimal": "",
				            "emptyTable": "Tidak ada data yang tersedia di tabel",
				            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
				            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
				            "infoFiltered": "(difilter dari _MAX_ total Inputan)",
				            "infoPostFix": "",
				            "thousands": ".",
				            "lengthMenu": "Menampilkan _MENU_ Data Detail Order",
				            "loadingRecords": "memuat...",
				            "processing": "Sedang di proses...",
				            "search": "Pencarian:",
				            "zeroRecords": "Arsip tidak ditemukan",
				            "paginate": {
				                "first": "Pertama",
				                "last": "Terakhir",
				                "next": "Selanjutnya",
				                "previous": "Kembali"
				            },
				            "aria": {
				                "sortAscending": ": aktifkan urutan kolom ascending",
				                "sortDescending": ": aktifkan urutan kolom descending"
				            }
				        }
				    });
				});
			</script>
		</div>
	</body>
	<script>
			function upd_pay(kod_tr, paym) {
		//	   var link = document.getElementById("edit_"+kod_bar);
			  // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
			  //alert('tes');
			var linkkk = "update-payment2.php?kode_transaksi="+kod_tr+"&paym="+paym;
			window.location.href = linkkk;
			}
	</script>
</html>