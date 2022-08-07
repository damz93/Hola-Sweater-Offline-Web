<?php               
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	session_start();
	include 'koneksi.php';
	$barang=mysqli_query($koneksi, "SELECT * FROM t_stok");
	$jsArray = "var NAMA = new Array();\n"; 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Transaksi - T O K O N L I N E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>		
		<style>
			body, html {
			height: 768px;
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
			height: 720px;
			overflow-x: hidden;
			overflow-y: scroll;			
			}
		</style>
		
		<script type="text/javascript">
         function isi_otomatis(){		
			 var kode_barangz = $("#kode_barang2").val();
				$.ajax({
				 url: 'listnama',
				 method: 'GET',
				 data     : 'kode_barangz='+kode_barangz,
				 }).success(function (data) {
				  //var json = data,
				  //obj = JSON.parse(json);
				  //document..val(obj.kode_barang);
				  document.getElementById("warna").val('-');
				 
				 }).autocomplete({
				 //source: "list-namabarang",
				 });
         }
      </script>
		
		
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#go_cek').on('click',function(){
					//isi_otomatis();
						
						
						
						
			  });
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#input').on('click',function(){
				$('#divxx').load('tampil-transaksi.php').fadeIn("slow");
				var kode_barang = $('#kode_barang').val();
				var jenis_barang = $('#jenis_barang').val();
				var harga_satuan = $('#harga_satuan').val();
				var tambahan = $('#tambahan').val();
				var qty = $('#qty').val();
				var total = $('#total').val();
				var size = $('#size').val();
				var warna = $('#warna').val();		
				
				var stokk = $('#kuantitasxx').text();	
				if (kode_barang=="") {
					alert('Scan Kode Barang/Isi manual terlebih dahulug');
				}
				else if (Number(qty)>Number(stokk)){
					alert('Stok tidak cukup, perhatikan inputan kuantitas');
					document.getElementById("qty").focus();
					return false;
				}
				else if (Number(stokk)==0){
				alert('Stok barang kosong');
				}
				
				else{
					alert('Data tersimpan di list');            		
					$.ajax({
					  method: "POST",
					  url: "simpan-transaksi.php",
					  data: { kode_barang : kode_barang, jenis_barang : jenis_barang, harga_satuan : harga_satuan, tambahan : tambahan, qty : qty, total : total, size : size, warna : warna,type:"insert"},
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
					<div class="table-responsive">
						<div class="form-group">
							<div class="container">
								<div class="form-group">
								
								<form method="post" id="myForm">
									<table border="0" class="table table-border" cellpadding="2" cellspacing="2" align="left">
										<tr>
											<th colspan="2">
												<h2 style="color:#FFFFFF">Input Barang</h2>
											</th>
											<td>
												<input autofocus onkeyup="isi_otomatis()" placeholder="Scan Barang" type="text" id="kode_barang2" class="form-control form-control-sm">
											</td>
											<td>
												<button name="go_cek" style="background-color:#00b050" id="go_cek" class="btn btn-primary btn-sm">Go</button>
											</td>    
										</tr>
										<tr>
											<td style="color:#FFFFFF">Nama Barang : </th>
											<th><input placeholder="Nama Barang" readonly="readonly" id="jenis_barang" class="form-control form-control-sm"></th>
											<td valign="top" style="color:#FFFFFF" align="right" rowspan="2">QTY :</th>
											<th rowspan="2"><input value="1" type="text" onchange="totalnya();" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
												<label id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK"></label>
											</th>
										</tr>
										<tr>
											<td style="color:#FFFFFF">Detail :</th>
											<th><input placeholder="Warna" id="warna" class="form-control form-control-sm"></th>
										</tr>
										<tr hidden>
											<td style="color:#FFFFFF">Size:</th>
											<th><input placeholder="Size" readonly="readonly" id="size" class="form-control form-control-sm"></th>
											<td rowspan="2">
												<button onclick="autofocuss()" type="reset" style="background-color:#538dd5" class="btn btn-info btn-lg btn-block">Cancel</button>
												</th>
											<td rowspan="2">
												<button value="simpan" name="input" style="background-color:#00b050" id="input" class="btn btn-primary btn-lg btn-block">Tambahkan</button>		
											</td>
										</tr>
										<tr hidden>
											<td style="color:#FFFFFF">Harga:</th>
											<th><input value="0" type="text" class="form-control form-control-sm" id="harga_satuan" readonly="readonly"></th>
										</tr>
									</table>
								</form>
								</div>
								<div class="form-group">
									<table style="background-color:#b8cce4" border="0" class="table table-hover" cellpadding="2" cellspacing="2" align=center>
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
											$jenbar = $d['JENIS_BARANG'];
											if ($jenbar!="Ongkir" AND $jenbar!="Packing" AND $jenbar!="Totebag" AND $jenbar!="Costum"){
												$tot_beli_swe = $tot_beli_swe + $qty;
											}
												if ($tot_beli_swe >= 3){
													$setdiskon="10K";
													$potongannyaaa="10000";									
													$total_diskonyaaa=$potongannyaaa*$tot_beli_swe;					
												}
												else{
													$setdiskon="";
													$potongannyaaa="0";
													$total_diskonyaaa="0";		
												}							
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
											<td><?php echo $warnaaa; ?></td>
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
																if ($tot_beli_swe >= 3){
																	$total_bersih = $total_harga_barang - $total_diskonyaaa + $total_biaya_costum;
																}
																else{
																	$total_bersih = $total_harga_barang + $total_biaya_costum;
																}
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
								</div>
								<br>
								<br>
								<div class="form-group">
									<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
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
												$penjualan  = mysqli_query($koneksi, "select SUM(QTY) AS PCS from t_transaksi where JENIS_BARANG<>'Costum' AND JENIS_BARANG<>'Totebag' AND JENIS_BARANG<>'Packing' AND JENIS_BARANG<>'Ongkir' AND JENIS_BARANG<>'Custom Sablon DTF Only' AND TGL='$tgl_saja'");
												while($data = mysqli_fetch_array($penjualan)){
																$pcs_trjual = $data['PCS'];							
																$pcs_trjual = number_format($pcs_trjual,0,',','.');	
															}
												$costum  = mysqli_query($koneksi, "select SUM(QTY) AS COSTUM,JENIS_BARANG from t_transaksi where JENIS_BARANG='Costum' AND TGL='$tgl_saja'");
												while($data2= mysqli_fetch_array($costum)){
																$tot_cos = $data2['COSTUM'];							
																$tot_cost = number_format($tot_cos,0,',','.');	
															}
												?>
											<td align="right">
												<p style="color:white;font-size:10pt">
													&nbsp
												</p>
												<p style="color:white;font-size:20pt">
													<?php echo $pcs_trjual."/".$tot_cost; ?>
												</p>
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
		<script>
			function autofocuss() {
				document.getElementById("jenisx").focus();
			}
			 
		</script>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script>
			function inputTerbilang() {
			  //membuat inputan otomatis jadi mata uang
			  $('.mata-uang').mask('0.000.000.000', {reverse: true});
			
			  //mengambil data uang yang akan dirubah jadi terbilang
			   var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
			
			   //menampilkan hasil dari terbilang
			   document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
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
			function total_diskonn(){	
			total_kembali();
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
		<script>
			function cek_dulu() {			
			  var totharga = document.getElementById("total_bayarnya").value;
			  totharga = totharga.replace(".",""); 
			  totharga = totharga.replace(".",""); 
			  var totbay = document.getElementById("jumlah_pembayaran").value; 
			  totbay = totbay.replace(".","");  
			  totbay = totbay.replace(".","");  
			  var costumerx = document.getElementById("costumerx").value; 
			  var metode = document.getElementById("payment").value; 
			  var isi_teks = "Yakin untuk proses dengan metode bayar "+metode+"?";		
			  if(totharga==0){
				 alert("Belum ada barang yang diinput pada transaksi ini. Silahkan pilih jenis barang, warna dan size terlebih dahulu...");
				 document.getElementById("jenis_barang").focus();
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
				//  return false;
			  }
				
			}
			
		</script> 
		
		<div id="kanan">
			<div class="sc_kanan">
			<br>
				<div class="form-group">
				<form method="post" onsubmit="return cek_dulu()" name="myForm2" action="cetak-transaksi.php">
					<table border="0" width="95%" cellpadding="2" cellspacing="2" align="center">
						<tr>
							<td colspan="3">								
								<h6 style="color:white;">Promo/ Diskon</h6>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" placeholder="Masukkan Kode Promo" onkeyup="isi_promoxxx();" id="kodiskxx" value="<?php echo $setdiskon; ?>" name="kodiskxx" class="form-control form-control-sm">
							</td>
							<td hidden>
								<input type="text" value="<?php echo $potongannyaaa ?>" name="potonganxx" id="potonganxx" class="form-control form-control-sm" readonly="readonly">
							</td>
							<td  align="left">
								<input type="text" id="banyaknya_diskon" value="<?php echo $banyaknyaaaa; ?>" maxlength="8" onkeyup="total_diskonn();" oninput="total_diskonn();" name="banyaknya_diskon" class="form-control form-control-sm mata-uang" readonly="readonly">
							</td>
							<td align="left">
								<input type="text"  value="<?php echo $total_diskonyaaa ?>" id="tot_diskon" maxlength="8" name="tot_diskon" class="form-control form-control-sm" readonly="readonly">
							</td>
						</tr>
						<tr hidden>
								<td hidden><label name="total_harga_barang" id="total_harga_barang"><?php echo $total_harga_barang; ?></label></td>								
								<td colspan="6">
									<p align="right"><b><?php echo "Total Harga Item= Rp".$total_harga_barangtamp; ?></b></p>
								</td>
						</tr>
						<tr>
						
							<td colspan="3" align="center">
							<br>
							<br>
								<h5 style="color:white">	Total Pembayaran</h5>
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
							<td colspan="3" align="center">
								<table border="0" width="100%" cellpadding="2" cellspacing="2" align="center">
									<tr>
										<td style="color:white;" align="right">
											<br>
											Costumer
										</td>
										<td align="left"><br>
											<input type="text" placeholder="Costumer" id="costumerx" name="costumerx" class="form-control form-control-sm ">
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
							<td colspan="3" align="center">
							<br>
											<br>
											<br>
								<button type="button" style="width:100%;background-color:#538dd5;" class="btn btn-lg btn-secondary"><a href="form-transaksi" style="color:#FFFFFe">Riwayat Transaksi</a></button>								
								<button type="button" style="width:100%;background-color:#538dd5;" class="btn btn-lg btn-secondary"><a href="utama" style="color:#FFFFFe">Menu Utama </a></button>
								
							</td>
						</tr>
						
					</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>