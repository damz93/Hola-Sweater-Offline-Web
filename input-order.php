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
		<title>Input Order Costum - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript">
			function qtynya(){
					$("#inputa").click();
				 }
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#inputa').on('click',function(){
				$('#divxx').load('tampil-order.php').fadeIn("slow");
				var jenisx = $('#jenisx').val();
				var kode_transaksi = $('#kode_transaksi').val();
				var opsi_kostum = $('#opsi_kostum').val();
				var notes = $('#notes').val();
				var qty = $('#qty').val();
				
				if (opsi_kostum == ""){
					alert('Opsi Costum kosong');
					return false;
				}
				else if (notes == ""){
					alert('Notes kosong');
					document.getElementById("notes").focus();
					return false;
				}			
				else if (qty == ""){
					alert('Qty kosong');
					document.getElementById("qty").focus();
					return false;
				}
				else{					
					$.ajax({
					   method: "POST",
					  url: "simpan-order.php",
					  data: { kode_transaksi:kode_transaksi, jenisx : jenisx, opsi_kostum : opsi_kostum, notes : notes, qty : qty,type:"insert"},
					  success	: function(data){
									//$('#divxx').load('tampil-order.php').fadeIn("slow");
									document.getElementById("myFormaa").reset();		
									location.reload(true);									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
					alert('Data tersimpan di list');            		
				}	
				
				
				
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
			width:30%;				
			height:100px;
			padding: 5px;
			float:left;
			}
			#kanan
			{
			width:70%;
			height:100px;
			padding: 10px;
			float:right;
			}
		</style>
		<script type="text/javascript">
			//		document.getElementById('sumber').value = "<?php echo $_POST['sumber'];?>";
				//	document.getElementById('kategorix').value = "<?php echo $_POST['kategorix'];?>";
				
				
		</script>
		<script>
			function sebelum() {         				
			  var opsi_kostum = $('#opsi_kostum').val();
			  var notes = $('#notes').val()
			  var qty = $('#qty').val()
			  if(opsi_kostum==""){
				  alert('Opsi Kostum Kosong');	
				  document.getElementById("opsi_kostum").focus();
				  return false;
			  }
			else if(notes==""){
				  alert('Notes Kostum Kosong');	
				  document.getElementById("notes").focus();
				  return false;
			  }
			else if(qty==""){
				  alert('Qty Kostum Kosong');	
				  document.getElementById("qty").focus();
				  return false;
			  }
				else{
			return confirm('Yakin ingin simpan?');         	 
				}
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
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV ADMIN" AND $_SESSION['level']!="ADMIN"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			else{
				$kode_transk = $_POST['kode_order'];
			}
	?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA ORDER COSTUM</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N -</h3>
		<br>
		<a style="background-color:#71b8e4;color:#FFFFFe" href="form-order.php"> Kembali ke Data Order </a><br>			
		<div id="kiri">
			<br>	 
			<form method="post" id="myFormaa" onsubmit="return sebelum()">
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
												<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="12" name="kode_transaksi2" class="form-control form-control-sm">
											</td>
										<tr>
										</tr>
										<th>Jenis Kostum</th>
										<th>
											<select autofocus name="jenisx" id="jenisx" onchange="selectnya()" class="form-control form-control-sm">
												<option value="BORDIR">Bordir</option>
												<option value="SABLON" selected>Sablon</option>
											</select>
											<!--	<script type="text/javascript">
												document.getElementById('jenisx').value = "<?php if ($_POST['jenisx']==''){ echo 'BORDIR';} else {echo $_POST['jenisx'];}?>";
												</script>-->
										</th>
										<tr>
											<th>Opsi Kostum</th>
											<td><input placeholder="Opsi Kostum"  type="text" id="opsi_kostum" class="form-control form-control-sm"></td>
										</tr>
										<tr>
											<th>Notes</th>
											<td><textarea placeholder="Notes" id="notes" class="form-control form-control-sm"></textarea></td>
										</tr>
										<tr>
											<th><label>Qty</label></th>
											<td><input onchange="qtynya();" value="1" type="text" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();"></td>
										</tr>
										<tr align='center'>
											<th align='right' colspan="2"><br>
												<button  onclick="autofocuss()" value="simpan" name="inputa" id="inputa" class="btn btn-info btn-lg btn-block">Input</button>		
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
					document.getElementById("jenisx").focus();
				}
				 
			</script>
		</div>
		<div id="kanan">
			<div><?php include"tampil-order.php"; ?>
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