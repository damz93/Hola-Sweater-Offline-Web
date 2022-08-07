<?php               
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	session_start();
	include 'koneksi';
	$barang=mysqli_query($koneksi, "SELECT * FROM t_transaksi_temp");
	$jsArray = "var NAMA = new Array();\n"; 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Input Stok Keluar - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>		
		
		<script type="text/javascript">
			function isi_otomatis(){			   
			var kode_barang = $("#kode_barang").val();
			$.ajax({
			url: 'list-ceknama2.php',
			method: 'GET',
			data     : 'kode_barang='+kode_barang,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#jenis_barang').val(obj.jenis_barang);
			 $('#warna').val(obj.warna);
			$('#size').val(obj.size);
			$('#harga_satuan').val(obj.harga);
			$('#qty').val("1");			
			var harga = $('#harga_satuan').val(); 
			var jenis = $('#jenis_barang').val(); 	
			var kuannn = $('#qty').val(); 		
			var kuant = (obj.qty);					
		//	var diskon = $('#diskon').val(); 
			//var potongan = $('#potongan').val(); 
			var totaltanpa = Number(harga) * Number(kuannn);
		//	potongan = Number(potongan)*Number(kuannn);
			//var hasil = Number(totaltanpa) - (Number(totaltanpa)*(Number(diskon)/100)) - Number(potongan);
			var hasil = Number(totaltanpa);
			//document.getElementById('kuantitasxx').innerHTML = 'Stok: '+(kuannn);					
			document.getElementById('kuantitasxx').innerHTML = kuant;		
			$('#total').val(hasil); 
			//var anuh = $('#total').val();
			var anuh = $('#warna').val();
			
					
			//var anuh = document.getElementById('warna').innerHTML;
			//alert(anuh);
			
			//if (anuh == 0){
			if (anuh.length == 0){
			//	alert('Kode Barang yang discan belum diinput');
				document.getElementById("kode_barang").focus();
			}
			else{
				//alert('OK!');
				//document.getElementById("qty").focus();
			//	 $("#input").click();
				// document.getElementById("myForm").submit();
				// var button = document.getElementById('input');
					//button.form.click();				
			}
			
			//document.getElementById("kuantitas").focus();
			}).autocomplete({
			source: "list-namabarang",
			});
			
			
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#input').on('click',function(){
				$('#divxx').load('tampil-stok-keluar').fadeIn("slow");
				var kode_barang = $('#kode_barang').val();
				var kode_transaksi = $('#kode_transaksi').val();
				var jenis_barang = $('#jenis_barang').val();
				var tambahan = $('#tambahan').val();
				var qty = $('#qty').val();
				var qty = qty.replace(".","");	
				var size = $('#size').val();
				var warna = $('#warna').val();
				var stokk = $('#kuantitasxx').text();
				var anuh = $('#warna').val();
				if (kode_barang.length!=0){
					$.ajax({
					  method: "POST",
					  url: "simpan-stok-keluar.php",
					  data: { kode_transaksi : kode_transaksi, kode_barang : kode_barang, jenis_barang : jenis_barang, qty : qty, size : size, warna : warna,type:"insert"},					
					  success	: function(data){
								//	$('#divxx').load('tampil_jual').fadeIn("slow");
									document.getElementById("myForm").reset();
																	
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
					//alert('Data tersimpan di list');            		
				}				
				else{
					alert('Kode Barang belum diinput');
					//$('#kode_barang').val("");
				}	
				location.reload(true);	
			  });
			});
		</script>
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
		<style type="text/css">
			#kiri
			{
			width:35%;				
			height:500px;
			padding: 0px;
			float:left;
			}
			#kanan
			{
			width:65%;
			height:500px;
			padding: 0px;
			float:right;
			}
		</style>
		<style>
			div.ex1 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: scroll;
			}
			div.ex2 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: hidden;
			}
			div.ex3aaa {  
			width: 5%;
			height: 100px;
			overflow: auto;
			}
			div.exxxxx3 {  
			width:500px;
			height: 500px;
			overflow-x: hidden;
			overflow-y: hidden;			
			}
			div.ex4 {
			background-color: lightblue;
			width: 110px;
			height: 110px;
			overflow: visible;
			}
		</style>
		<script type="text/javascript">
			function cek_kodetransaksi(){			   
			var kode_transaksi = $("#kode_transaksi").val();
			$.ajax({
			url: 'list-kode-tkeluar',
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
				document.getElementById("kode_transaksi").value = "...."; 
			}
			}).autocomplete({
			//source: "list-namabarang",
			});
			}
		</script>
		
	</head>
	<body>
		<div class="bg">
		<?php 
		
				error_reporting(0);
				    session_start();	
			if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV GUDANG" AND $_SESSION['level']!="GUDANG"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			else{
				$kode_transk = $_POST['kode_transaksi'];
			}
			?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA STOK KELUAR</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
		<br>
		<a style="background-color:#71b8e4;color:#FFFFFe" href="form-stok-keluar"> Kembali ke Data Stok Keluar </a><br>
		<div id="kiri">			
			<br>	 			
			<form method="post" id="myForm">
			<div class="exxxxx3">
				<div class="table-responsive">
						<div class="form-group">
							<div class="container">
								<div class="form-group">
									<table border="0" class="table" cellpadding="2" cellspacing="2" align="left">
										<tr>
										<td>
										   <h6>Nomor Resi</h6>
										</td>
											<td align="left"><input type="text" id="kode_transaksi" maxlength="12" value="<?php echo $kode_transk; ?>" name="kode_transaksi" class="form-control form-control-sm" readonly=readonly>
											<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm">
											</td><?php												
													if ($kode_transk == ""){
														echo "<script>alert('Scan Kode resi terlebih dahulu');window.location.href='pra-input-stok-keluar';</script>";	
													}
											?>
										<tr>
											<td colspan="2">
												<input autofocus onkeyup="isi_otomatis()" placeholder="Scan Kode Barang"  type="text" id="kode_barang" class="form-control form-control-lg">
											</td>
										</tr>
										<tr hidden>
											<th>Jenis Barang</th>
											<td>
												<input placeholder="Jenis Barang" readonly="readonly" id="jenis_barang" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>
											<th>Warna</th>
											<td>
												<input placeholder="Warna" readonly="readonly" id="warna" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>
											<th>Size</th>
											<td>
												<input placeholder="Size" readonly="readonly" id="size" class="form-control form-control-sm">
											</td>
										</tr>
										<tr hidden>
											<th>
												<label>Harga Satuan</label>
											</th>
											<td>
												<input value="0" type="text" class="form-control form-control-sm" id="harga_satuan" readonly="readonly">
											</td>
										</tr>
										<tr hidden>
											<label hidden>Biaya Tambahan</label></th>
											<input hidden value="0" type="text" id="tambahan" onchange="totalnya();" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang(); ">
										</tr>
										<tr hidden>
											<th><label>Qty</label></th>
											<td><input value="1" type="text" onchange="totalnya();" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();">
											<label hidden id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK"></label></td>
										</tr>
										<tr hidden>
											<th><label>Total</label></th>
											<td><input value="0" type="text" readonly="readonly" id="total" class="form-control form-control-sm"></td>
										</tr>
										<tr align='center' hidden>
											<th align='right' colspan="2">
												<button  onclick="autofocuss()" value="simpan" name="input" id="input" class="btn btn-info btn-lg btn-block">Input</button>		
												<button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>					   
											</th>
										</tr>
							</table>
							
								</div>
							</div>
						</div>
					</div>
					</div>
			</form>
			<script>
				function autofocuss() {
					document.getElementById("kode_barang").focus();
				}
				 
			</script>
			<script type="text/javascript">
				function total_diskon(){		  
					var harga_biasa = document.getElementById('harga_biasa').value;
					var harga_biasa = harga_biasa.replace(".","");			
					var kuantitas = document.getElementById('kuantitas').value;
					var tambahan = document.getElementById('tambahan').value;
					var diskon = document.getElementById('diskon').value;				
					var potongan = document.getElementById('potongan').value;				
					var total_tanpadisk = parseInt(harga_biasa)*parseInt(kuantitas);
					var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
					potongan = Number(potongan)*Number(kuantitas);
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
					var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
				//				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
					document.getElementById("totalx").value = hasil;
				//	alert('Anda menekan tombol TAB');							
				 }			   
				 function totalnya(){		  
					var harga_biasa = document.getElementById('harga_satuan').value;
				//	var harga_biasa = harga_biasa.replace(".","");			
					var kuantitas = document.getElementById('qty').value;
					var kuantitas = kuantitas.replace(".","");	
					//var diskon = document.getElementById('diskon').value;				
					var tambahan = document.getElementById('tambahan').value;				
					//var potongan = document.getElementById('potongan').value;				
					//var total_tanpadisk = parseInt(harga_biasa) * parseInt(kuantitas);
					var total_tanpadisk = Number(harga_biasa) * Number(kuantitas) + Number(tambahan);
				//	var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
			//		potongan = Number(potongan)*Number(kuantitas);
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
					var hasil = total_tanpadisk;
					//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
				//				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
					document.getElementById("total").value = hasil;
				//	alert('Anda menekan tombol TAB');							
				 }		
				 
			</script>
		</div>
		<div id="kanan">
			<div><?php include"tampil-stok-keluar.php"; ?>
			</div>
		</div>
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
	</body>
</html>