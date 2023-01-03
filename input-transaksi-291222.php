<?php               
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	session_start();
	include 'koneksi.php';
	$tgl = date("Y/m/d");
	$barang=mysqli_query($koneksi, "SELECT * FROM t_transaksi_temp WHERE TGL='$tgl'");
	$jsArray = "var NAMA = new Array();\n"; 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Transaksi - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>	
		<style>
			body, html {
			height: 100%;
			margin: 0;
			}
			.bg {
			/* The image used */
			background-image: url("img/bg_.png");
			/* Full height */
			height: 768px;
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
		<style type="text/css">
			#kiri{
			width:65%;							
			background-color: #244062;
			height: 100%;
			padding: 20px;
			float:left;
			}
			#kanan{
			width:35%;
			height: 100%;
			background-color: #366092;
			padding: 2px;
			float:right;
			}
			div.sc_kanan {  
			width:100%;
			height: 100%;
			overflow-x: hidden;
			overflow-y: hidden;	
			}
			div.sc_kiri {  
			width:100%;
			height: 100%;
			overflow-x: hidden;
			overflow-y: scroll;			
			}
		</style>
		
		
		
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#go_cek').on('click',function(){
					//isi_otomatis();
						
						
						
						
			  });
			});
		</script>
		<script type="text/javascript">		
		
			$(document).ready(function(){
				$('#input_list').on('click',function(){
				//alert('kosong');
				var kode_barang = $('#kode_barang2').val();
				var qty = $('#qty').val();
				
				var stokk = $('#kuantitasxxcek').text();	
				nilai_stok = parseInt(stokk);
				if (kode_barang==""){
					alert('Scan Kode Barang/Isi manual terlebih dahulu');
					$('#kode_barang2').focus();
					return false;
				}
				else if (nilai_stok<1) {
					alert('Gagal menambahkan, stok kosong di system...');
					//$('#kode_barang2').val('');
					$('#kode_barang2').focus();
					return false;
				}
				else if (nilai_stok<qty) {
					alert('Gagal menambahkan, stok tidak cukup di system...');
					//$('#kode_barang2').val('');
					$('#kode_barang2').focus();
					return false;
				}
				else{
					alert('Data tersimpan di list');        
					location.reload(true);				
					$.ajax({
					  method: "POST",
					  url: "simpan-transaksi-fix.php",
					  data: { kode_barang : kode_barang, qty : qty,type:"insert"},
					  success	: function(data){
								//	$('#divxx').load('tampil_jual.php').fadeIn("slow");
									document.getElementById("myForm").reset();									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
				}
			  });
			});
		</script>
		<script type="text/javascript">		
		
			$(document).ready(function(){
				$('#simpan_draft').on('click',function(){
					if (confirm("Apakah yakin ingin simpan ke draft terlebih dahulu?")) {			
						window.open("simpan-draft","_self");
					}
					else{
						return false;
					}
			  });
			});
		</script>
	</head>
	<body>
		<?php 
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
				//header("location:index.php?pesan=belum_login");
			}
			else{
				date_default_timezone_set('Asia/Hong_Kong');
				$jam_sekarang = date('H:i:s');
				function formatTanggal($date){
				return date('d-M-Y', strtotime($date));
				}	
				$tgl_saja = date("Y/m/d");
				$tgl = formatTanggal($tgl_saja);  						
				   $hari = date('l', strtotime($tgl_saja));
				$tgl = date('d F Y');
				   $semua = $hari.", ".$tgl;
			}
			?>		
		<div id="kiri">
		
		
		<script type="text/javascript">
         function auto_kode(){			   
         var kode_barang = $("#kode_barang2").val();		
			//alert(kode_promo);
			 var cek_diskon;	
			//alert(kode_promo);
			$.ajax({
			url: 'listnama.php',
			method: 'GET',
			data     : 'kode_barang='+kode_barang,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			// cek_diskon = obj.nominal;
			$('#jenis_barang').val(obj.jenis_barang);
			$('#jenis_barang2').text(obj.jenis_barang);
			$('#warna').val(obj.warna);
			$('#warna2').text(obj.warna);
			var cek_warna = (obj.warna);
			$('#size').val(obj.size);
			$('#size2').text(obj.size);
			$('#harga_satuan').val(obj.harga);
			var harganya = (obj.harga);
			
			//$('#harga_satuan2').text(harganya);
			harganya = parseInt(harganya);
			var total_x= harganya.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");		
			
			$('#harga_satuan2').text("Rp"+total_x);					
			//
			$('#kuantitasxx').text("Jumlah Stok: "+obj.qty);
			$('#kuantitasxxcek').text(+obj.qty);
			$('#qty').val("1");			
			 var stoknya = (obj.qty); 
			 var stoknya_ = parseInt(stoknya);
			 if (stoknya <= 0){
				// alert('stok kurang');
				 document.getElementById("kode_barang2").focus();
			 }
			 else if(warna.length==0){
				 alert('kode barang tidak ditemukan');
			 }
			 else{		
				document.getElementById("qty").focus();
			 }
			 
			 }).autocomplete({
			 source: "listnama.php",
			});
         
         }	 
      </script>
	  <div class="sc_kiri">
		
		
					<div class="table-responsive">
						<div class="form-group">
							<div class="container">
								<div class="form-group">
								
								<form method="post" id="myForm" autocomplete="off">
									<table border="0" class="table table-borderless" cellpadding="2" cellspacing="2" align="left">
										<tr>
											<th width="50%" colspan="2">
												<label style="color:#FFFFFF;font-size:30px;">Input Barang</h2>
											</th>
											<td colspan="2">
												<input autofocus onkeyup="auto_kode()" placeholder="Scan Barang / Input Manual" type="text" id="kode_barang2" class="form-control form-control-lg">
											</td>
											<td hidden>
												<button name="go_cek" style="background-color:#00b050" id="go_cek" class="btn btn-primary btn-lg">Go</button>
											</td>    
										</tr>
										<tr>
											<td width="20%" style="color:#FFFFFF">Nama Barang: </th>
											<th><input hidden placeholder="Nama Barang" readonly="readonly" id="jenis_barang" class="form-control form-control-sm">
											<label style="font-size:20px;color:white;" id="jenis_barang2"><b>...</b></label>
											</th>
											<td valign="top" style="color:#FFFFFF" align="right" rowspan="2">QTY :</th>
											<th rowspan="2"><input value="1" type="text" onchange="totalnya();" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
												<label style="color:white;font-size:20px"id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK">Jumlah Stok: </label>
												<label hidden style="color:white;font-size:20px"id="kuantitasxxcek" name="kuantitasxx" title="Jumlah STOK"></label>
											</th>
										</tr>
										<tr>
											<td style="color:#FFFFFF">Detail :</th>
											<th><input hidden placeholder="Warna" readonly="readonly" id="warna" class="form-control form-control-sm"><label style="font-size:20px;color:white;" id="warna2"><b>...</b></label>
											</th>
										</tr>
										<tr>
											<td style="color:#FFFFFF">Size:</th>
											<th><input hidden placeholder="Size" readonly="readonly" id="size" class="form-control form-control-sm"><label style="font-size:20px;color:white;" id="size2"><b>...</b></label></th>
											<td rowspan="2">
												<button onclick="autofocuss()" type="reset" style="background-color:#538dd5" class="btn btn-info btn-lg btn-block">Cancel</button>
												</th>
											<td rowspan="2">
												<button value="simpan" name="input_list" style="background-color:#00b050" id="input_list" class="btn btn-primary btn-lg btn-block">Tambahkan</button>		
											</td>
										</tr>
										<tr>
											<td style="color:#FFFFFF">Harga:</th>
											<th><input hidden value="0" type="text" class="form-control form-control-sm" id="harga_satuan" readonly="readonly"><label style="font-size:26px;color:white;" id="harga_satuan2">Rp0</label></th>
										</tr>
									</table>
								</form>
								</div>
								<div class="form-group">
								<form method="post" id="myForm3" autocomplete="off">
									<table style="background-color:#b8cce4" border="0" class="table table-hover" cellpadding="2" cellspacing="2" align="center">
										<thead align="center">
											<tr align='center' valign="middle" style="color:#000011;background-color:#95b3d7">
												<td hidden width="1%" align="center">
													<p style="font-size:14pt"><b>No</b></p>
													</th>
												<td width="15%" align="center">
													<p style="font-size:14pt"><b>Item</b></p>
												</td>
												<td align="center">
													<p style="font-size:14pt"><b>Detail</b></p>
												</td>
												<td width="8%" align="center">
													<p style="font-size:14pt"><b>Size</b></p>
												</td>
												<td width="8%" align="center">
													<p style="font-size:14pt"><b>Qty</b></p>
												</td>
												<th hidden>Biaya Costum</th>
												<th hidden>Kode Diskon</th>
												<th hidden>Diskon</th>
												<th hidden>Total Diskon</th>
												<td width="15%" align="center">
													<p style="font-size:14pt"><b>Harga</b></p>
												</td>
												<td width="3%" align="center">
													<p style="font-size:14pt"><b></b></p>
												</td>
											</tr>
										</thead>
										<?php 
											session_start();
											$oleh = $_SESSION['username'];
											$no=1;
											$harga3=0;
											$harga4=0;							
											$totpcs=0;
											$tot_beli_swe=0;
											$aray = 0;
											$total_harga_barang = 0;
											$total_biaya_costum = 0;
											$total_diskon = 0;
											$total_keselurahan =0;
											$diskonxx2=0;
											$totdiskon2 = 0;							
											$diskon2nya2=0;
											$data = mysqli_query($koneksi,"select * from t_transaksi_temp where OLEH='".$oleh."' order by ID DESC");
											while($d = mysqli_fetch_array($data)){
											//$qty=number_format($d['QTY'],0,",",".");
												$qty=$d['QTY'];                                     
												$qtyno=$d['QTY'];                                     
											$kod_bar = $d['KODE_BARANG'];
											$kodisk2 = $d['KODE_DISKON'];
											$diskonnya = $d['DISKON'];
											$kena = $d['KENA'];
											$jenbar = $d['JENIS_BARANG'];
											//if ($jenbar!="Ongkir" AND $jenbar!="Packing" AND $jenbar!="Totebag" AND $jenbar!="TOTEBAG" AND $jenbar!="TB" AND $jenbar!="TB2" AND $jenbar!="Costum"AND $jenbar!="Shooping Bag"){
											if ($kena != 'TIDAK'){
												$tot_beli_swe = $tot_beli_swe + $qty;
											}
											/*
											if ($tot_beli_swe >= 3){
											//if ($tot_beli_swe >= 1){
												$setdiskon="10K";
												$potongannyaaa="10000";									
												$total_diskonyaaa=$potongannyaaa*$tot_beli_swe;					
											}
											else{*/
												$setdiskon="";
												$potongannyaaa="0";
												$total_diskonyaaa="0";		
											//}
									
											
											$banyaknyaaaa=$tot_beli_swe;
											
											$sizex = $d['SIZE_'];
											$warnaaa = $d['WARNA'];
											$diskonxx = $d['POTONGAN'];
											$totdiskon = $d['DISKON2'];
											$total2 = $d['TOTAL2'];
											$total_harga_barang = $total_harga_barang + $d['TOTAL'];
											$total_biaya_costum = $total_biaya_costum + $d['HARGA_TAMBAHAN'];
											$total_diskon = $total_diskon + $d['POTONGAN'];
											$satuan=number_format($d['HARGA'],0,",",".");
											$diskonnyatamp=number_format($d['POTONGAN'],0,",",".");
											$totdiskontamp=number_format($d['DISKON2'],0,",",".");
											$tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
											
											$total=number_format($d['TOTAL'],0,",",".");
											$total2tamp=number_format($d['TOTAL2'],0,",",".");
											$harga3=$harga3+$d['TOTAL'];
											$harga4=$harga4+$d['TOTAL2'];
											$totpcs = $totpcs+$qtyno;
											$tamb_cost = $total2 - ($qty * $d['HARGA']) + $d['DISKON'];
											$tambahan = $d['HARGA_TAMBAHAN'];
											
											$tamb_costtamp=number_format($tamb_cost,0,",",".");
											$tambahantamp=number_format($tambahan,0,",",".");
											?>
										<tr align="center">
											<td hidden><?php echo $no++; ?></td>
											<td align="left"><?php echo $jenbar; ?></td>
											<td hidden><?php echo "Rp".$satuan; ?></td>
											<td align="center"><?php echo $warnaaa; ?></td>
											<td><?php echo $sizex; ?></td>
											<td><?php echo $qty; ?></td>
											<td align="right"><?php echo "Rp".$total2tamp;  ?></td>
											<td>
												<!--<a href='update-transaksi-detail.php?kode_barang=<?php echo $kod_bar."&qty=".$qty; ?>' id="edit_<?php echo $kod_bar;?>" title="Edit Item" onclick="return confirm('Are you sure you want to update qty?')"><img src="img/edit.png" height="50%" ></a>
													<a href='hapus-transaksi-detail.php?kode_barang=<?php echo $kod_bar; ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="50%" ></a>-->
												<a class="" onclick="delete_dataa('<?php echo $kod_bar; ?>','<?php echo $tambahan; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
											</td>
										</tr>
										<?php 
											$aray++;
											$diskonnya2 = $diskonnya2 + $diskonnya;
											$totdiskon2 = $totdiskon2 + $totdiskon;
											$total_bersihnya = $harga3 - $totdiskon2;
											$diskonxx2 = $diskonxx + $diskonxx2;
											}
											$harga5=number_format($harga3,0,",",".");	
											$totdiskon2tamp=number_format($totdiskon2,0,",",".");	
											$diskonxx2tamp=number_format($diskonxx2,0,",",".");	
											$total_bersihnyatamp=number_format($total_bersihnya,0,",",".");	
											$total_harga_barang = $total_harga_barang + $d['TOTAL'];
											$total_harga_barangtamp=number_format($total_harga_barang,0,",",".");	
											$total_biaya_costum = $total_biaya_costum + $d['HARGA_TAMBAHAN'];
																$total_biaya_costumtamp=number_format($total_biaya_costum,0,",",".");	
																$total_diskon = $total_diskon + $d['POTONGAN'];
																$total_diskontamp=number_format($total_diskon,0,",",".");	
																/*
																if ($tot_beli_swe >= 3){
																//if ($tot_beli_swe >= 1){
																	$total_bersih = $total_harga_barang - $total_diskonyaaa + $total_biaya_costum;
																}
																else{*/
																	$total_bersih = $total_harga_barang + $total_biaya_costum;
																//}
																$total_bersihtamp=number_format($total_bersih,0,",",".");	
																
																
											$totpcs_tamp=number_format($totpcs,0,",",".");							   
											$tot_beli_swe_tamp=number_format($tot_beli_swe,0,",",".");		
											
											?>
										<tr>
											<td colspan="3">
											</td>
											<td>
												<p style="color:black;"align="center"><b><?php echo "Subtotal "; ?></b></p>
											</td>
											<td>
												<p style="color:black;"align="right"><b><?php echo "Rp".$total_harga_barangtamp; ?></b></p>
											</td>
											<td>
											</td>
										</tr>
									</table>
									</form>
								</div>
								<div class="form-group">
									<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
										<tr>		
											<td>
											</td>
											<td align="right">
											
												<a href="#"><img src="img/show.png" title="Lihat Draft" width="30" height="30" data-toggle="modal" data-target="#show-draft"></a>
												&nbsp
												&nbsp
												<button width="100%" title="Simpan ke Draft" value="simpan" name="simpan_draft" style="background-color:#00b050" id="simpan_draft" class="btn btn-primary btn-sm">Simpan ke Draft</button>
											</td>
										</tr>
										<tr>
											<td align="left">
												<p style="color:white;font-size:10pt">
													<?php	echo $_SESSION['level']	.":"; ?>
												</p>
												<p style="color:white;font-size:16pt">
													<?php echo $_SESSION['nama_lengkap']; ?>
												</p>
												<p style="color:white;font-size:pt">
													<?php	echo $semua; 
														?>
												</p>
											</td>										
											<?php											
												//$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS PCS from t_transaksi where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'TB' AND JENIS_BARANG<>'TB2' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon DTF Only'AND JENIS_BARANG<>'CST Basic Hoodie' AND JENIS_BARANG<>'CST Crewneck' AND JENIS_BARANG<>'CST Zipper' AND JENIS_BARANG<>'CST Hoodie Crop' AND JENIS_BARANG<>'CST Crewneck Crop' AND JENIS_BARANG<>'CST + Sisi' AND JENIS_BARANG<>'Shooping Bag' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND TGL='".$tgl_saja."'");
												$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS PCS from t_transaksi where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'TB' AND JENIS_BARANG<>'TB2' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND JENIS_BARANG<>'CST Basic Hoodie' AND JENIS_BARANG<>'CST Crewneck' AND JENIS_BARANG<>'CST Zipper' AND JENIS_BARANG<>'CST Hoodie Crop' AND JENIS_BARANG<>'CST Crewneck Crop' AND JENIS_BARANG<>'CST + Sisi' AND JENIS_BARANG<>'Shooping Bag' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND KENA='YA' AND TGL='".$tgl_saja."'");
												while($data = mysqli_fetch_array($penjualan)){
																$pcs_trjual = $data['PCS'];							
																$pcs_trjual = number_format($pcs_trjual,0,',','.');	
															}
												//$costum  = mysqli_query($koneksi, "select SUM(QTY) AS COSTUM,JENIS_BARANG from t_transaksi where  (KENA='TIDAK' or JENIS_BARANG='Costum') AND JENIS_BARANG<>'Shooping Bag' AND TGL='".$tgl_saja."'");
												$costum  = mysqli_query($koneksi, "select SUM(QTY) AS COSTUM,JENIS_BARANG from t_transaksi where  (KENA='TIDAK' or JENIS_BARANG='Costum') AND JENIS_BARANG<>'Shooping Bag' AND TGL='".$tgl_saja."'");
												while($data2= mysqli_fetch_array($costum)){
																$tot_cos = $data2['COSTUM'];							
																$tot_cost = number_format($tot_cos,0,',','.');	
															}
												?>
											<td align="right">
												<p style="color:white;font-size:10pt">
													&nbsp
												</p>												
												<label style="color:white;font-size:20pt" title="PSC Terjual">
													<?php echo $pcs_trjual; ?></label>
												
												<label style="color:white;font-size:20pt" title="Jumlah PSC Terjual Hari ini">/</label>
												<label style="color:white;font-size:20pt" title="Jumlah Costum Hari ini">
													<?php echo $tot_cost; ?></label>												
												<p style="color:white;font-size:pt">
													<?php	echo $jam_sekarang; 
														?>
												</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function autofocuss() {
				document.getElementById("kode_barang2").focus();
			}
			 
		</script>
		<script>
			function autofocuss2() {
				document.getElementById("costumerx").focus();
			}
			 
		</script>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script>
			function inputTerbilang() {
			  //membuat inputan otomatis jadi mata uang
			  //$('.mata-uang').mask('0.000.000.000', {reverse: true});
			  $('.mata-uang').mask('0000', {reverse: true});
				var qtyx = document.getElementById("qty").value;			
				if (qtyx==""){
					document.getElementById("qty").value = "1";
				}
			} 
		</script>			
		<script type="text/javascript">
			function selectnya(){
			 document.getElementById("opsi_kostum").focus();
			}			   
		</script>		
		<script type="text/javascript">
			function select(){			   
			document.getElementById("jenisx").focus();							
			}
		</script>
		<script type="text/javascript">
			function delete_dataa(d,e){
				var kode_barang=d;		
				var tambahan=e;		
				if (confirm("Are you sure you want to delete this Item?")) {			
					$.ajax({
					  type: "get",
					  url: "hapus-transaksi-detail.php",
					  data: {kode_barang:kode_barang, tambahan:tambahan},
					  success: function(value){
						//$("#data_table").html(value);
						 location.reload(true);
						//document.getElementById("form_tampil").reset();		
					  }
					});
				}
				else{
					return false;
				}
			}
		</script>
		
		<script type="text/javascript">
			function buka_draft(kod_draf){
				var kode_draft=kod_draf;	
				if (confirm("Buka Draft?")) {			
					$.ajax({
					  type: "post",
					  url: "buka-draft.php",
					  data: {kode_draft:kode_draft},
					  success: function(value){
						// location.reload(true);
					  }
					});
				}
				else{
					return false;
				}
			}
		</script>
		
		<script type="text/javascript">
			function total_diskonn(){	
			//total_kembali();
				//alert('OK');
			 $('.mata-uang').mask('0.000.000.000', {reverse: true});
			 
			var total_barang = document.getElementById('total_harga_barang').innerHTML;			 
			var potonganxxx = document.getElementById('potonganxx').value;
			var banyaknya_diskonx = document.getElementById('banyaknya_diskon').value;			
			banyaknya_diskonx = banyaknya_diskonx.replace(".","");
			
			 if (banyaknya_diskonx ==""){
				document.getElementById("banyaknya_diskon").value = "0";
				banyaknya_diskonx = 0;
			}
			var total_diskon = parseInt(potonganxxx) * parseInt(banyaknya_diskonx);
			 			 			 
			 var total_bayar = parseInt(total_barang)-parseInt(total_diskon);
			 
			 
			 
			 
			document.getElementById("tot_diskon").value = total_diskon;
			document.getElementById("total_bayarnya").value = total_bayar;
			
			
			
			var total__bayarx = total_bayar.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");		
			document.getElementById("total_bayarnyax").innerHTML = "Rp"+total__bayarx;				 			
			
		//	document.getElementById("totalhargaces2fix").innerHTML = total;
			//var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		//	document.getElementById("totalhargaces2").innerHTML = "Total Pembayaran= Rp"+hemm;		
			 
			 
			}
			 function totalx(){		  
			 $('.mata-uang').mask('0.000.000.000', {reverse: true});
			
			  //mengambil data uang yang akan dirubah jadi terbilang
			   //var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   //document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
			   
			var total_barang = document.getElementById('totalhargaces').innerHTML;
			var ongkirr = document.getElementById('ongkir').value;
			var diskon = document.getElementById('nomdiskon3').innerHTML;
			var ongkirr = ongkirr.replace(".","");
			if (ongkirr ==""){
				document.getElementById("ongkir").value = "0";
				ongkirr = 0;
			}		 
			var total = parseInt(total_barang)-parseInt(total_diskon);
			//var hemm = total.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
			//x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			document.getElementById("totalhargaces2fix").innerHTML = total;
			var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			document.getElementById("totalhargaces2").innerHTML = "Total Pembayaran= Rp"+hemm;		 				
			//  document.getElementById("totalhargaces").innerHTML = ";		 	                 
			}		         
		</script>
		<script type="text/javascript">
			function isi_promoxxx(){		
			var kode_promo = $("#kodiskxx").val();		
			//alert(kode_promo);
			 var cek_diskon;	
			//alert(kode_promo);
			$.ajax({
			url: 'list-promo.php',
			method: 'GET',
			data     : 'kode_promo='+kode_promo,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			// cek_diskon = obj.nominal;
			 $('#potonganxx').val(obj.nominal);
			 $('#tot_diskon').val(obj.nominal);
			 
			 
         	cek_diskon = $('#potonganxx').val();
			 
			total_diskonn();
			total_kembali();
			 
			//var diskon = $('#potonganxx').val();					
			if (kode_promo == ""){
				alert('JALAN');
				$('#potonganxx').val("0");	
			}
			else if (cek_diskon.length == 0){	
				$('#potonganxx').val("0");	
				alert('Kode Promo tidak Valid');		
				document.getElementById("kodiskxx").focus();							
			}
			else{		
			
				$('#potonganxx').val(cek_diskon);	
				$('#banyaknya_diskon').prop('readonly', false);
			//	$('#banyaknya_diskon').val('1');
				 document.getElementById("banyaknya_diskon").focus();		
				 var potongan = $('#potonganxx').val();
				 var pcs = document.getElementById('totpcs').innerHTML;
				// var total_potongan = parseInt(potongan)*parseInt(pcs);
				 var total_potongan = parseInt(potongan);
				//$('#total_diskon').val(potongan); 
				// document.getElementById("total_diskontamp").innerHTML = "Total Diskon= Rp"+total_diskon;
				 
				//var total_barang = document.getElementById('total_bersih').innerHTML;
				 //var total = parseInt(total_barang)-parseInt(diskon);
				 //document.getElementById("totalhargaces2fix").innerHTML = total;
				 //var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				 //document.getElementById("totalhargaces2").innerHTML = "Total Pembayaran= Rp"+hemm;
			}
			
				document.getElementById("total_diskon").value = potongan;
				var total_diskonxx = total_potongan.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");		
				document.getElementById("total_diskontampx").innerHTML = "Total Diskon= Rp"+total_diskonxx;				 
				
				
				
				var total_barang = document.getElementById('total_harga_barang').innerHTML;
				var biaya_cos = document.getElementById('total_biaya_costum').innerHTML;
				var total = parseInt(total_barang)+parseInt(biaya_cos)-parseInt(total_potongan);
				document.getElementById("total_bersih").innerHTML = total;
				var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				document.getElementById("total_bersihtamp").innerHTML = "Total Pembayaran= Rp"+hemm		 			
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script> 
		<script type="text/javascript">
			function refresh_all(){		
				location.reload(true);	
				 //$("#voucherx").focus();
			}
		</script>
		<script type="text/javascript">
			function cek_centang(){		
				 var checkBox = document.getElementById("centang");
				  if (checkBox.checked == true){					
						$('#kodiskxx').val("");
						$('#potonganxx').val("0");				 
						$("#costumerx").focus();						 
						total_diskonn();
						//total_kembali();
				  } else {
					//location.reload(true);				 
						total_diskonn();
						//total_kembali();
				  }
			}
		</script>
		<script type="text/javascript">
			function isi_voucher(){		
				var kode_voucher = $("#voucherx").val();		
				var tot_diskon = $("#tot_diskon").val();		
				var nama_voucher;
				if (kode_voucher==''){
					alert('kode voucher belum diinput');
					//return false;
				}
				else{
					$.ajax({
						url: 'list-voucher.php',
						method: 'GET',
						data     : 'kode_voucher='+kode_voucher,
						success	: function(data){
							var json = data,
							obj = JSON.parse(json);
							$('#voucherx2').val(obj.nama_voucher2);			  
							nama_voucher=(obj.nama_voucher2);
							//alert(nama_voucher);
							if (nama_voucher!=null){
								alert('kode voucher valid');
								document.getElementById("prosess").disabled = true;
								$('#kodiskxx').val("");
								$('#potonganxx').val("0");				 
								$("#costumerx").focus();						 
								total_diskonn();
								total_kembali();
							}
							else{
								alert('kode voucher tidak valid');
								$("#voucherx").focus();
								$("#voucherx").val('');
								document.getElementById("prosess").disabled = true;
							}
						 },																
						error: function(XMLHttpRequest, textStatus, errorThrown) { 
							alert("Status: " + textStatus); alert("Error: " + errorThrown); 
						}       
					});
								
				}		
				return false;
			}
			
		</script> 
		
		<script type="text/javascript">
			function total_kembali(){		  
				 $('.mata-uang').mask('0.000.000.000', {reverse: true});
				
				  //mengambil data uang yang akan dirubah jadi terbilang
				   //var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
				
				   //menampilkan hasil dari terbilang
				   //document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
				 //alert('jalanji'); 
				
				var total_bersih = document.getElementById('total_bayarnya').value;
				total_bersih = total_bersih.replace(".","");
				total_bersih = total_bersih.replace(".","");
				total_bersih = total_bersih.replace(".","");
				var total_bayarx = document.getElementById('jumlah_pembayaran').value;				
				//var total_bayar = $('#jumlah_pembayaran').val(); 				
				var total_bayar = total_bayarx.replace(".","");
				total_bayar = total_bayar.replace(".","");
				total_bayar = total_bayar.replace(".","");
				total_bayar = total_bayar.replace(".","");
				if (total_bayar == ""){
					document.getElementById('jumlah_pembayaran').value="0";
					total_bayar=0;
					//alert('0');
				}
				
					var kembali = parseInt(total_bayar) - parseInt(total_bersih);
					var hemm = kembali.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
					document.getElementById("kembalian").innerHTML = "Rp"+hemm;				
				
			}		         
		</script>
		<script type="text/javascript">
			function cek_isinya_voucher() {							
				var cek_voucher = document.getElementById("voucherx").value; 
				if (cek_voucher==''){
					document.getElementById("prosess").disabled = true;
					
				}
				else if (cek_voucher==' '){
					document.getElementById("prosess").disabled = true;
				}
				else if (cek_voucher=='  '){
					document.getElementById("prosess").disabled = true;
				}
				else if (cek_voucher=='   '){
					document.getElementById("prosess").disabled = true;
				}
				else{
					document.getElementById("prosess").disabled = false;
				}
				return false;
			}
		</script>
		<script type="text/javascript">
			function cek_dulukanan() {			
				var tes="";
				var totharga = document.getElementById("total_bayarnya").value;
				totharga = totharga.replace(".",""); 
				totharga = totharga.replace(".",""); 
				var totbay = document.getElementById("jumlah_pembayaran").value; 
				totbay = totbay.replace(".","");  
				totbay = totbay.replace(".","");  
				var costumerx = document.getElementById("costumerx").value; 
				var tot_diskonnya = document.getElementById("tot_diskon").value; 
				var metode = document.getElementById("payment").value; 
				var cek_voucher = document.getElementById("voucherx").value; 
				var isi_teks = "Yakin untuk proses dengan metode bayar "+metode+"?";		
				
				if (cek_voucher!=''){
					if(tot_diskonnya>0){
						isi_voucher();
						return false;
					}
					else{
						if(totharga==0){
							alert("Belum ada barang yang diinput pada transaksi ini.");
							document.getElementById("kode_barang2").focus();
							document.getElementById("kode_barang2").value="";
							return false; 
						}
						else if(costumerx==''){
							alert("Mohon isi nama costumer");
							document.getElementById("costumerx").focus();
							return false;
						}
						else if(totbay==0){
							alert('Masukkan jumlah pembayaran');	
							document.getElementById("jumlah_pembayaran").focus();
							return false;
						}
						else if(parseInt(totbay)<parseInt(totharga)){
							alert("Jumlah pembayaran kurang");
							document.getElementById("jumlah_pembayaran").focus();
							return false;
						}  			  
						else{
							return confirm(isi_teks);				
						}
					}
				}
				else{
					if(totharga==0){
						alert("Belum ada barang yang diinput pada transaksi ini.");
						document.getElementById("kode_barang2").focus();
						document.getElementById("kode_barang2").value="";
						return false; 
					}
					else if(costumerx==''){
						alert("Mohon isi nama costumer");
						document.getElementById("costumerx").focus();
						return false;
					}
					else if(totbay==0){
						alert('Masukkan jumlah pembayaran');	
						document.getElementById("jumlah_pembayaran").focus();
						return false;
					}
					else if(parseInt(totbay)<parseInt(totharga)){
						alert("Jumlah pembayaran kurang");
						document.getElementById("jumlah_pembayaran").focus();
						return false;
					}  			  
					else{
						return confirm(isi_teks);				
					}
				}
			}
			
		</script> 
		
		<div id="kanan">
			<div class="sc_kanan">
			<br>
				<div class="form-group">
				<form method="post" onsubmit="return cek_dulukanan()" name="myForm2" action="cetak-transaksi.php" autocomplete="off">
					<table border="0" width="95%" cellpadding="2" cellspacing="2" align="center">
						<tr hidden>
							<td colspan="3">								
								<h6 style="color:white;">Promo/ Diskon</h6>
							</td>
						</tr>
						<tr hidden>
							<td>
								<input type="text" placeholder="Masukkan Kode Promo" onkeyup="isi_promoxxx();" id="kodiskxx" value="<?php echo $setdiskon; ?>" name="kodiskxx" class="form-control form-control-sm">
							</td>
							<td>
								<input type="text" value="<?php echo $potongannyaaa ?>" name="potonganxx" id="potonganxx" class="form-control form-control-sm" readonly="readonly">
							</td>
							<td  align="left">
								<input type="text" id="banyaknya_diskon" value="<?php echo $banyaknyaaaa; ?>" maxlength="8" onkeyup="total_diskonn();" oninput="total_diskonn();" name="banyaknya_diskon" class="form-control form-control-sm mata-uang" readonly="readonly">
							</td>
							<td align="left">
								
							</td>
						</tr>
						<tr hidden>
							<td>
							
							<br>
							</td>
						</tr>
						<tr hidden>
							<td colspan="2">
								<input type="text" placeholder="Masukkan Voucher" id="voucherx" onkeyup="cek_isinya_voucher()" name="voucherx" class="form-control form-control-sm">
								<input hidden type="text" placeholder="ISINYA" id="voucherx2" name="voucherx2" class="form-control form-control-sm">
							</td>
							<td width="10%">
								<button style="background-color:#00b050" class="btn btn-primary btn-sm btn-block" title="Validasi Voucher" onclick="isi_voucher2()" name="prosess" disabled id="prosess" >&#10003;</button>	
							</td>
							<td width="10%">								
								<button style="background-color:#00b050" class="btn btn-primary btn-sm btn-block" title="Batalkan Voucher" onclick="refresh_all()" name="prosessref" id="prosessref" type="reset">&#x21bb;</button>													
							</td>
						</tr>
						<tr hidden>
								<td><label name="total_harga_barang" id="total_harga_barang"><?php echo $total_harga_barang; ?></label></td>								
								<td width="80%" colspan="6">
									<p align="right"><b><?php echo "Total Harga Item= Rp".$total_harga_barangtamp; ?></b></p>
								</td>
						</tr>
						<tr hidden>
							<td hidden colspan="4" align="left">
								<input onclick="cek_centang()" type="checkbox" id="centang2" name="centang2" value="centang">
								<label style="color:#FFFFFF" for="centang">Centang Untuk Mematikan Diskon</label>
							</td>	
							<td colspan="4" align="left">
								<input onclick="cek_centang()" type="checkbox" id="centang" name="centang" value="centang">
								<label style="color:#FFFFFF" for="centang">Centang Untuk Mematikan Diskon</label>
							</td>							
						</tr>	
						<tr hidden>
							<td style="color:white;" align="right">
								Total Potongan :
							</td>
							<td colspan="3" align="center">
								<input type="text"  value="<?php echo $total_diskonyaaa ?>" id="tot_diskon" maxlength="8" name="tot_diskon" class="form-control form-control-sm" readonly>
							</td>
								
						</tr>	
						<tr>
							<td colspan="4" align="center">
							<br>
								<h5 style="color:white">Total Pembayaran</h5>
								   <input hidden type="text" value="<?php echo $total_bersihtamp; ?>" id="total_bayarnya" maxlength="8" name="total_bayarnya" class="form-control form-control-sm mata-uang" readonly="readonly">
								<h1 style="color:white"><label name="total_bayarnyax" id="total_bayarnyax"><?php echo "Rp".$total_bersihtamp; ?></label></h1>
							</td>
								<td hidden><label name="total_bersih" id="total_bersih"><?php echo $total_bersih; ?></label></td>							
									<td hidden><h6 align="right"><label name="total_bersihtamp" id="total_bersihtamp"><?php echo "Total Pembayaran= Rp".$total_bersihtamp; ?></label></h6></td>
							</td>
							<td hidden><label name="total_bersih" id="total_bersih"><?php echo $total_bersih; ?></label></td>							
									<td hidden><h6 align="right"><label name="total_bersihtamp" id="total_bersihtamp"><?php echo "Total Pembayaran= Rp".$total_bersihtamp; ?></label></h6></td>
								
						</tr>
						<tr>
							<td colspan="4" align="center">
								<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
									<tr>
										<td style="color:white;" align="right">
											<br>
											Customer
										</td>
										<td align="left"><br>
											<input type="text" placeholder="Customer" id="costumerx" name="costumerx" class="form-control form-control-sm ">
										</td>
									</tr>
									<tr>
										<td style="color:white;" align="right">
											Metode Bayar
										</td>
										<td align="left">
											<select name="payment" id="payment" class="form-control form-control-sm">
												 <option value="CASH" <?php if($_POST['payment'] == 'CASH') {echo 'selected=selected'; } ?> selected>Cash</option>
												 <option value="EDC" <?php if($_POST['payment'] == 'EDC') {echo 'selected=selected'; } ?> >EDC</option>
												 <option value="TRANSFER" <?php if($_POST['payment'] == 'TRANSFER') {echo 'selected=selected'; } ?> >Transfer</option>
											</select>		
										</td>
									</tr>
									<tr>
										<td style="color:white;" align="right">
											Diterima
										</td>
										<td align="left">
											<input type="text" value="0" id="jumlah_pembayaran" maxlength="8" onkeyup="total_kembali();" name="jumlah_pembayaran" class="form-control form-control-sm mata-uang">
										</td>
									</tr>
									<tr>
										<td style="color:white;" align="right">
											Kembali
										</td>
										<td valign="center" align="right">
											<h3 style="color:white;"><label name="kembalian" id="kembalian">Rp0</label></h3>
										</td>
									</tr>
									<tr>
										<td style="color:white;" align="right">
											<button onclick="autofocuss2()" type="reset" style="background-color:#538dd5" class="btn btn-info btn-sm btn-block">Cancel</button>
										</td>
										<td valign="center" align="right">
											<button value="simpan" type="submit" style="background-color:#00b050" class="btn btn-primary btn-sm btn-block">Cetak Nota</button>
										</td>
									</tr>
								</table>
							
							</td>
						</tr>
						<tr>
							<td colspan="4" align="center">
							<br>
											<br>
											<br>
								<a href="form-transaksi" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#538dd5;" class="btn btn-lg btn-secondary">Riwayat Transaksi</button></a>								
								<a href="cetak-laporan-penjualan" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#538dd5;" class="btn btn-lg btn-secondary">Cetak Laporan Penjualan</button></a>								
								<a href="utama" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#538dd5;" class="btn btn-lg btn-secondary">Menu Utama </button></a>
								
							</td>
						</tr>
						
					</table>
					</form>
				</div>
				
				
				<div id="show-draft" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3>List Draft</h3>
							</div>
							<table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
								<tr align='center' class="table-info">
									<th align='center'>NO.</th>
									<th align='center'>KODE DRAFT</th>
									<th align='center'>DETAIL</th>
								</tr>
								<?php
									include "koneksi.php";
									$no=1;
									session_start();   
									$olehnya = $_SESSION['username'];
									$tgl = date("Y/m/d");
									$data = mysqli_query($koneksi,"select KODE_DRAFT from t_draft where OLEH='$olehnya' AND TGL='$tgl' GROUP by KODE_DRAFT ORDER BY ID DESC");
										while($d = mysqli_fetch_array($data)){
											$kode_draft = $d['KODE_DRAFT'];
										
									?>
									
								<tr align="center">
									<td><?php echo $no++; ?></td>
									<td align="center" width="30%">									
										<a href='buka-draft.php?kode_draft=<?php echo $kode_draft; ?>' title="Buka Draft" onclick="return confirm('Buka Draft <?php echo $kod_draf; ?> ???')"><button type="button" class="btn btn-info">
										<b><?php echo $kode_draft; ?></button></b></a>
									</td>											
									<td align="left">
								
										<?php
											$data2 = mysqli_query($koneksi,"select * from t_draft where KODE_DRAFT='$kode_draft' ORDER BY QTY DESC");
											
											while($d2 = mysqli_fetch_array($data2)){
												$kode_barang = $d2['KODE_BARANG'];
												$jenis_barang = $d2['JENIS_BARANG'];
												$warna = $d2['WARNA'];
												$qty = $d2['QTY'];
												$semua =$jenis_barang." - ".$warna." (".$qty.")";
												
												
												echo "*".$semua."<br>";
											}
										?>
									</td>
								</tr>
											<?php } ?>
								
							</table>	
							<div class="modal-footer">					
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>							
						</div>
						
					</div>		
				</div>
				
				
				
			</div>
		</div>
	</body>
</html>