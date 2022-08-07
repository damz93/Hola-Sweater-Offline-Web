<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	  include 'koneksi.php';
	  ?>
<html>
	<head>
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
			function isi_promo(){			   
			var kode_promo = $("#kodisk").val();
			$.ajax({
			url: 'list-promo.php',
			method: 'GET',
			data     : 'kode_promo='+kode_promo,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#nomdiskon').val(obj.nominal);
			 $('#harga_satuan').val(obj.nominal);
			var diskon = $('#nomdiskon').val(); 
			var ongkirr = $('#ongkir').val(); 
			if (kode_promo == ""){
				//alert('HAH KOSONG');	
				$('#nomdiskon').val("0");	
				document.getElementById("kodisk").focus();	
			}
			else if (diskon == ""){	
				$('#nomdiskon').val("0");	
				alert('Kode Promo tidak Valid');		
				document.getElementById("kodisk").focus();				
				
			}
			else{
				document.getElementById("jumlah_pembayaran").focus();				
				 var ongkirr = ongkirr.replace(".","");
				 if (ongkirr ==""){
					document.getElementById("ongkir").value = "0";
					ongkirr = 0;
				 }		 
				 var total_barang = document.getElementById('total_bersih').innerHTML;
				 var total = parseInt(total_barang)-parseInt(diskon);
				 document.getElementById("totalhargaces2fix").innerHTML = total;
				 var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				 document.getElementById("totalhargaces2").innerHTML = "Total Pembayaran= Rp"+hemm;		 					
			}
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script> 
		<script type="text/javascript">
			function isi_promo2(a, b, aak){			   
			//var kode_promo = $("#kodisk2").val();
			//var kode_promo = c;	
				var kode_barang=a;		
				var qty = b;		
				var kode_promo = aak;					
			$.ajax({
				url: 'list-promo.php',
				method: 'GET',
				data     : 'kode_promo='+kode_promo,
				}).success(function (data) {
					 var json = data,
					 obj = JSON.parse(json);
					 $('#nomdiskon2').val(obj.nominal);
					var diskon = $('#nomdiskon2').val(); 
					if (kode_promo == ""){					
						$('#nomdiskon').val("0");	
						document.getElementById("kodisk2").focus();	
					}
					else if (diskon == ""){	
						$('#nomdiskon2').val("0");	
						$('#kodisk2').val("0");	
						alert('Kode Diskon tidak valid');		
						document.getElementById("kodisk2").focus();									
					}
					else{
						//alert('YUK,... GASKEUN...');
						update_data(kode_barang, qty, kode_promo);
					}
					}).autocomplete({
					//source: "list-namabarang.php",
				});
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
         	cek_diskon = $('#potonganxx').val();
			 
			 
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
			
				document.getElementById("total_diskon").innerHTML = potongan;
				var total_diskonxx = total_potongan.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");		
				document.getElementById("total_diskontampx").innerHTML = "Total Diskon= Rp"+total_diskonxx;				 
				
				
				var total_barang = document.getElementById('total_harga_barang').innerHTML;
				var biaya_cos = document.getElementById('total_biaya_costum').innerHTML;
				var total = parseInt(total_barang)+parseInt(biaya_cos)-parseInt(total_potongan);
				document.getElementById("total_bersih").innerHTML = total;
				var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				document.getElementById("total_bersihtamp").innerHTML = "Total Pembayaran= Rp"+hemm		 			
				total_diskonn();
			}).autocomplete({
			//source: "list-namabarang.php",
			});
			}
		</script> 
		<script type="text/javascript">
			function update_data(c, d, e){
			var kode_barang=c;		
			var qty = d;		
			var kodprom = e;					
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail2.php",
			  data: {kode_barang:kode_barang, qty:qty, kodprom:kodprom},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function edit_qty(c, d){
			var kode_barang=c;		
			var qty = d;					
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail.php",
			  data: {kode_barang:kode_barang, qty:qty},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function edit_qtyy(c, d, e){
			var kode_barang=c;		
			var qty = d;			
			var tambahan =e;
			$.ajax({
			  type: "get",
			  url: "update-transaksi-detail.php",
			  data: {kode_barang:kode_barang, qty:qty, tambahan:tambahan},
			  success: function(value){
				//$("#data_table").html(value);
				 location.reload(true);
				//document.getElementById("form_tampil").reset();		
			  }
			});
			}
		</script>
		<script type="text/javascript">
			function cek_kodetransaksi(){			   
			var kode_transaksi = $("#kode_transaksi").val();
			$.ajax({
			url: 'list-kode-transaksi.php',
			method: 'GET',
			data     : 'kode_transaksi='+kode_transaksi,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#kode_transaksi2').val(obj.kode_transaksi);
			 
			var kod1 = $('#kode_transaksi').val(); 
			var kod2 = $('#kode_transaksi2').val(); 
			if (kod1 == kod2){
				alert('Kode transaksi sudah ada....');					
				document.getElementById("kode_transaksi").focus();	
				document.getElementById("kode_transaksi2").value = "Kode transaksi sudah ada...."; 
			}
			}).autocomplete({
			//source: "list-namabarang.php",
			});
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
		<script>
			function sebelum() {         	
			  var kode_transaksi = document.getElementById("kode_transaksi").value; 
			  if(kode_transaksi==""){
				  alert('Masukkan Kode Transaksi');	
				  document.getElementById("kode_transaksi").focus();
				  return false;
			  }
				else{
			return confirm('Yakin ingin simpan?');         	 
				}
			}
			
		</script>
		<script type="text/javascript">
			function delete_data(d){
			var kode_barang=d;		
			if (confirm("Are you sure you want to delete this Item?")) {			
			$.ajax({
			  type: "get",
			  url: "hapus-transaksi-detail.php",
			  data: {kode_barang:kode_barang},
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
		
		<script>
		function confirmDelete(delUrl) {
		  if (confirm("Yakin ingin hapus semua???")) {
		   document.location = delUrl;
		  }
		}
		</script>
	</head>
	<body>
	
      <?php 
         error_reporting(0);
             session_start();	
         if($_SESSION['status']!="login"){
         	echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
         }
         else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
         	echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
         ?>
	<?php
		include 'koneksi.php';
			error_reporting(0);
		//$data_tr = mysqli_query($koneksi,"select CAST(max(KODE_TRANSAKSI)AS INT) as JUMLAH,ID from t_transaksi");
		$data_tr = mysqli_query($koneksi,"SELECT ID,KODE_TRANSAKSI FROM t_transaksi ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_tr)){	
					$jumtranskX        = substr($d['KODE_TRANSAKSI'],5);			
					
				 }
			      
			      if ($jumtranskX == 0) {
			      	$kode_penjualan = "TRX-0000000001";
			      }
			      else{
			      	$jumtranskX++;
					if (strlen($jumtranskX)== 1){
			      		$kode_penjualan = "TRX-000000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 2){
			      		$kode_penjualan = "TRX-00000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 3){
			      		$kode_penjualan = "TRX-0000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 4){
			      		$kode_penjualan = "TRX-000000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 5){
			      		$kode_penjualan = "TRX-00000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 6){
			      		$kode_penjualan = "TRX-0000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 7){
			      		$kode_penjualan = "TRX-000".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 8){
			      		$kode_penjualan = "TRX-00".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 9){
			      		$kode_penjualan = "TRX-0".$jumtranskX;
			      	}
			      	else if (strlen($jumtranskX)== 10){
			      		$kode_penjualan = "TRX-".$jumtranskX;
			      	}
			      }
	?>
		<!--<form method="post" action="cetak-transaksi.php" autocomplete="off" onsubmit="return confirm('Yakin ingin simpan?');">	-->
		<div class="sc_kanan">
		<form method="post" onsubmit="return cek_dulu()" name="myForm" action="cetak-transaksi.php">
			<div class="table-responsive">
			<div class="form-group">
		<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<tr>
							<th colspan="4">
							<p align='left' style="color:#31859b;font-size:20pt;"><b>Keranjang Belanja</b></p>
							</td>
						</tr>						
							<tr>
								<td align="left">
									Costumer
								</td>
								<td>								
									<input type="text" placeholder="Costumer" id="costumerx" name="costumerx" class="form-control form-control-sm "></td>
								<td align="right">
									Kode Transaksi
								</td>
								<td>								
									<input type="text" readonly="readonly"value="<?php echo $kode_penjualan; ?>" id="kode_transaksii" name="kode_transaksii" class="form-control form-control-sm "></td>
										
							</tr>
					</table>
		
		
				
				
					
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<thead align="center">
							<tr align='center' class="table-info">
								<td width="1%" align="center"><p style="font-size:14pt"><b>No</b></p></th>
								<td width="15%" align="center"><p style="font-size:14pt"><b>Item</b></p></td>
								<td align="center"><p style="font-size:14pt"><b>Detail</b></p></td>
								<td width="8%" align="center"><p style="font-size:14pt"><b>Size</b></p></td>
								<td width="8%" align="center"><p style="font-size:14pt"><b>Qty</b></p></td>
								<th hidden>Biaya Costum</th>
								<th hidden>Kode Diskon</th>
								<th hidden>Diskon</th>
								<th hidden>Total Diskon</th>
								<td width="15%" align="center"><p style="font-size:14pt"><b>Harga</b></p></td>
								<td width="3%" align="center"><p style="font-size:14pt"><b>-</b></p></td>
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
							<td><?php echo $no++; ?></td>
							<td align="left"><?php echo $jenbar; ?></td>							
							<td hidden><?php echo "Rp".$satuan; ?></td>
							<td><?php echo $warnaaa; ?></td>
							
							<td><?php echo $sizex; ?></td>					
							<td><?php echo $qty; ?></td>					
							<td hidden><input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="edit_qtyy('<?php echo $kod_bar;?>', this.value,'<?php echo $tambahan;?>');" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="4"></td>
							<td hidden><?php echo "Rp".$tambahantamp; ?></td>
							<td hidden><input type="text" placeholder="Scan Kode Promo" id="kodisk2" class="form-control form-control-sm" maxlength="30" onchange="isi_promo2('<?php echo $kod_bar; ?>','<?php echo $qty; ?>', this.value);" value="<?php echo $kodisk2; ?>" name="kodisk_<?php echo $kod_bar;?>" >
								<input hidden readonly="readonly" class="form-control form-control-sm" type="text" name="nomdiskon2" id="nomdiskon2" value="<?php echo $diskonnya; ?>">
							</td>
							<td hidden><?php echo "Rp".$diskonnyatamp;  ?></td>
							<td hidden><?php echo "Rp".$totdiskontamp;  ?></td>
							<td><?php echo "Rp".$total2tamp;  ?></td>
							<td>
								<!--<a href='update-transaksi-detail.php?kode_barang=<?php echo $kod_bar."&qty=".$qty; ?>' id="edit_<?php echo $kod_bar;?>" title="Edit Item" onclick="return confirm('Are you sure you want to update qty?')"><img src="img/edit.png" height="50%" ></a>
									<a href='hapus-transaksi-detail.php?kode_barang=<?php echo $kod_bar; ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="50%" ></a>-->
								<a class="btn btn-danger" onclick="delete_dataa('<?php echo $kod_bar; ?>','<?php echo $tambahan; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
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
							                    
						<tr hidden>
							<td colspan="10">
								<p align='right'>
									<?php echo $totpcs_tamp."(qty)"; ?>
								</p>
								<td hidden><label name="totpcs" id="totpcs"><?php echo $totpcs; ?></label></td>
							</td>
						</tr>
						<tr hidden>
							<td colspan="10">
								<p align='right'>
									<?php echo $tot_beli_swe_tamp."(total swter)"; ?>
								</p>
								<td hidden><label name="totpcs" id="totpcs"><?php echo $totpcs; ?></label></td>
							</td>
						</tr>
						
							<tr>
								<td hidden><label name="total_harga_barang" id="total_harga_barang"><?php echo $total_harga_barang; ?></label></td>								
								<td colspan="6">
									<p align="right"><b><?php echo "Total Harga Item= Rp".$total_harga_barangtamp; ?></b></p>
								</td>
							</tr> 
					</table>
					</div>
					<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
						<div class="form-group">
							<tr hidden>
								<td colspan="4" align="right"></td>
								<td><label hidden name="total_biaya_costum" id="total_biaya_costum"><?php echo $total_biaya_costum; ?></label></td>
								<td width="2%"></td>
								<td>
									<h6 align='right'><?php echo "Total Biaya Tambahan= Rp".$total_biaya_costumtamp; ?></h6>
								</td>
							</tr>
							<tr>
								<td align="left">
									<h6>Diskon</h6>
								</td>
								<td align="left">
									<h6>Potongan</h6>
								</td>
								<td align="left">
									<h6>Banyaknya</h6>
								</td>
								<td align="left">
									<h6>Total Diskon</h6>
								</td>
							</tr>
							<tr>
								<td><input type="text" placeholder="Masukkan Kode Promo" onkeyup="isi_promoxxx();" id="kodiskxx" value="<?php echo $setdiskon; ?>" name="kodiskxx" class="form-control"></td>
								<td><input type="text" value="<?php echo $potongannyaaa ?>" name="potonganxx" id="potonganxx" class="form-control form-control-sm" readonly="readonly"></td>
								<td align="left"><input type="text" id="banyaknya_diskon" value="<?php echo $banyaknyaaaa; ?>" maxlength="8" onkeyup="total_diskonn();" oninput="total_diskonn();" name="banyaknya_diskon" class="form-control form-control-sm mata-uang" readonly="readonly"></td>
								<td align="left"><input type="text"  value="<?php echo $total_diskonyaaa ?>" id="tot_diskon" maxlength="8" name="tot_diskon" class="form-control form-control-sm" readonly="readonly"></td>
							</tr>
									
							<tr hidden>
								<td colspan="6" align="right">
									<h6>Kode Promo</h6>
								</td>
								<td align="left">
									<input type="text" placeholder="Scan Kode Promo" id="kodisk" class="form-control form-control-sm" maxlength="30" onkeyup="isi_promo()" name="kodisk">Nominal
									<input readonly="readonly" class="form-control form-control-sm" type="text" name="nomdiskon" id="nomdiskon" value="<?php echo $diskonnya; ?>">
								</td>
							</tr>
							<tr hidden>
								<td colspan="2" align="right"></td>
								<td>
									<label hidden name="total_diskon" id="total_diskon">0</label>
								</td>
								<td width="2%"></td>
								<td>									
									<h6 align="right"><label name="total_diskontampx" id="total_diskontampx">Total Diskon= Rp0</label></h6>
								</td>
							</tr>
							<tr hidden>
								<td colspan="7" align="right">
									<h5 align="right"><label name="totalhargaces2" id="totalhargaces2"><?php echo "Totalcc Pembayaran= Rp".$total_bersihnyatamp; ?></label></h5>
									<label name="totalhargaces2fix"id="totalhargaces2fix"></label>				
								</td>
							<tr hidden>
								<td colspan="6"	 align="right">
									<h6>Kode Transaksi</h6>
								</td>
								<td align="left"><input type="text" placeholder="Input/Scan Kode Transaksi" value="0" onkeyup="cek_kodetransaksi();" id="kode_transaksi" maxlength="8" name="kode_transaksi" class="form-control form-control-sm">
									<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm">
								</td>
							</tr>
							
							<tr>
								<td align="left">
									
								</td>
								<td></td>
								<td colspan="2" align="left"><br>Total Pembayaran
								   <input type="text" value="<?php echo $total_bersihtamp; ?>" id="total_bayarnya" maxlength="8" name="total_bayarnya" class="form-control form-control-sm mata-uang" readonly="readonly"></td>
								<td hidden><label name="total_bersih" id="total_bersih"><?php echo $total_bersih; ?></label></td>							
									<td hidden><h6 align="right"><label name="total_bersihtamp" id="total_bersihtamp"><?php echo "Total Pembayaran= Rp".$total_bersihtamp; ?></label></h6></td>
							</tr>
							<tr>
								   <td>		
										Payment Method
										<select name="payment" id="payment" class="form-control form-control-sm">
										 <option value="CASH" <?php if($_POST['payment'] == 'CASH') {echo 'selected=selected'; } ?> selected>Cash</option>
										 <option value="EDC" <?php if($_POST['payment'] == 'EDC') {echo 'selected=selected'; } ?> >EDC</option>
										 <option value="TRANSFER" <?php if($_POST['payment'] == 'TRANSFER') {echo 'selected=selected'; } ?> >Transfer</option>
									  </select>								   
								   </td>
								   <td></td>
								<td colspan="2" align="left">Uang Diterima
									<input type="text" value="0" id="jumlah_pembayaran" maxlength="8" onkeyup="total_kembali();" name="jumlah_pembayaran" class="form-control form-control-lg mata-uang">
									</td>
							</tr>
							<tr>
								<td colspan="2"	 align="right">									
								</td>
								<td colspan="2" align="left">
									Kembali<h4 align="left"><label name="kembalian" id="kembalian">Rp0</label></h4></td>
								</td>
							</tr>
							<tr><td>
									<a style="color:white" class="btn btn-danger btn-lg btn-block" href="javascript:confirmDelete('hapus-semua-detail.php')" title="Delete Item">Clear</a>
								</td>
								<td>
									<button width="100%" type="reset" value="Reset" class="btn btn-warning btn-lg btn-block">Refresh Field</button>	
								</td>
								<td colspan="2">
									<button width="100%" type="submit" value="simpan" class="btn btn-success btn-lg btn-block">Check Out</button>
								</td>
							</tr>			
						</div>
					</table>
				</div>
			</div>
		
		</form>
		</div>
		<script type="text/javascript">
			function total_diskonn(){	
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
			function editurl(kod_bar, qty) {
			   var link = document.getElementById("edit_"+kod_bar);
			  // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
			var linkkk = "update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty;
			window.location.href = linkkk;
			}
		</script>
	</body>
</html>