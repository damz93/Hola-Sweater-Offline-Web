<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data Pengeluaran - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<style>			

			th {  
				color: #b8b6b6;
			}
			td {  
				color: #b8b6b6;
			}
			th:hover {  
				color: #000000;
			}
			td:hover {  
				color: #000000;
			}
	  </style>
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
			#kiri
			{
			width:30%;							
			background-color: #244062;
			height: 100%;
			padding: 10px;
			float:left;
			}
			#kanan
			{
			width:70%;
			height: 100%;
			background-color: #366092;
			padding: 5px;
			float:left;
			}
			div.sc_kanan {  
			width:100%;
			height: 100%;
			padding:10px;
			overflow-x: hidden;
			overflow-y: scroll;	
			}
			div.sc_kiri {  
			width:100%;
			padding:10px;
			height:100%;
			overflow-x: hidden;
			overflow-y: scroll;			
			}
		</style>
	</head>
	<script type="text/javascript">
			$(document).ready(function(){
				$('#input').on('click',function(){
				var kategori = $('#kategoriy').val();
				if (kategori!=""){
					$.ajax({
					  method: "POST",
					  url: "simpan-kategori-pengeluaran.php",
					  data: { kategori : kategori,type:"insert"},
					  success	: function(data){
									//document.getElementById("myForm").reset();									
									location.reload(true);		
									alert('Data tersimpan');            	
								},
								error: function(response){
									console.log(response.responseText);
								}
					});							
				}				
				else{
					alert('Kategori Kosong...');
					document.getElementById("kategoriy").focus();
				}	
			  });
			});
		</script>
		<script type="text/javascript">
			function cek_kat(){        			   		   
				var kategori = $('#kategoriy').val();
				//alert(a);   
				$.ajax({
				url: 'list-kat-pengeluaran.php',
				method: 'GET',
				data: { kategori : kategori},
				success	: function(data){
								//document.getElementById("myForm").reset();									
					var json = data,
					obj = JSON.parse(json);
					$('#kategoriy2').val(obj.kategori);	     
					 var kod1 = $('#kategoriy').val(); 
				 var kod2 = $('#kategoriy2').val(); 
				 if (kod1 == kod2){
					 alert('Kategori sudah ada....');                    
					 document.getElementById("kategoriy").focus();    
					 document.getElementById("kategoriy").value = "Kategori sudah ada...."; 
				 }
				},
				error: function(response){
					console.log(response.responseText);
				}
				});	
			}			 
		</script>
	<body>
		<?php 
			error_reporting(0);
			session_start();			
				include 'koneksi.php';				
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
			}
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
				echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
			else{					
				$data_pengeluaran = mysqli_query($koneksi,"SELECT ID,KODE_PENGELUARAN FROM t_pengeluaran ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_pengeluaran)){		
					$jumkeluar        = substr($d['KODE_PENGELUARAN'],8);	
				 }
				 
				if ($jumkeluar == 0) {
					$kode_pengeluaran = "SPDING-0000001";
				}
				else{
					$jumkeluar++;			
					if (strlen($jumkeluar)== 1){
						$kode_pengeluaran = "SPDING-000000".$jumkeluar;				
					}
					else if (strlen($jumkeluar)== 2){
						$kode_pengeluaran = "SPDING-00000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 3){
						$kode_pengeluaran = "SPDING-0000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 4){
						$kode_pengeluaran = "SPDING-000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 5){
						$kode_pengeluaran = "SPDING-00".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 6){
						$kode_pengeluaran = "SPDING-0".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 7){
						$kode_pengeluaran = "SPDING-".$jumkeluar;
					}
				}
				
			}
			?>
		<div id="kiri">
			<div class="sc_kiri">
			<table width="100%" border="0">
				<br>
				<tr>
					<br>
					<h2 style="color:white;">
						Input Pengeluaran
						<br>
					</h2>
				</tr>
				<tr>
					<td colspan="2" valign="top">
						<br>
						<br>
						<br>
						<br>
						<a href="form-pengeluaran" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#366092;" class="btn btn-lg btn-secondary">Data Pengeluaran</button></a>
						<br><br>
						
						
                        
                        <a href="#" style="color:#FFFFFe"><button data-toggle="collapse" data-target="#demo4" class=" btn btn-lg btn-secondary collapsible"type="button" style="width:100%;background-color:#366092;">Recap Pengeluaran</button>
                        <form autocomplete="off" method="post" action="laporan-pengeluaran">
                           <div id="demo4" class="collapse">                             
                              <br>
                              <h6><a style="color:white;" data-toggle="collapse" data-target="#demo41" class="collapsible-btn btn-outline-primary btn-lg">Harian</a></h6>
                              <div id="demo41" class="collapse">
                                 <input type="text" placeholder="Tanggal Awal"  id="example6dd" class="form-control form-control-sm datepicker" name="cek_tanggal2">
                                 <input type="text" placeholder="Tanggal Akhir"  id="example6" class="form-control form-control-sm datepicker" name="cek_tanggal2d">
                                 <button onclick="" type="submit" class="btn btn-info btn-sm" name="tampil_tanggal2">Tampilkan</button>
                              </div>
							  <br>
                              <h6><a style="color:white;" data-toggle="collapse" data-target="#demo42" class="collapsible-btn btn-outline-primary btn-lg">Bulanan</a></h6>
                              <div id="demo42" class="collapse">
                                 <input type="text" placeholder="Bulan Awal"  id="example5" class="form-control form-control-sm datepicker" name="cek_bulan2">
                                 <input type="text" placeholder="Bulan Akhir"  id="example5d" class="form-control form-control-sm datepicker" name="cek_bulan2d">
                                 <button onclick="" type="submit" class="btn btn-info btn-sm" name="tampil_bulan2">Tampilkan</button>
                              </div>
							  <br>
                              <h6><a style="color:white;" data-toggle="collapse" data-target="#demo43" class="collapsible-btn btn-outline-primary btn-lg">Tahunan</a></h6>
                              <div id="demo43" class="collapse">
                                 <input type="text" placeholder="Tahun Awal" id="example4" class="form-control form-control-sm datepicker" name="cek_tahun2">
                                 <input type="text" placeholder="Tahun Akhir" id="example4d" class="form-control form-control-sm datepicker" name="cek_tahun2d">
                                 <button onclick="" type="submit" class="btn btn-info btn-sm" name="tampil_tahun2">Tampilkan</button>
                              </div>
                           </div>
                        </form>
						
						
						
						
						<br>
						<a href="utama" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#366092;" class="btn btn-lg btn-secondary">Menu Utama </button></a>
					</td>
				</tr>
			</table>
			<script type='text/javascript'>
					 $(document).ready(function () {
					 $('#example5').datepicker({
					 minViewMode: 1,
					 autoclose: true,
					 format: 'mm-yyyy'
					 });  
					 
					 });
				   </script>
				   <script type='text/javascript'>
					 $(document).ready(function () {
					 $('#example5d').datepicker({
					 minViewMode: 1,
					 autoclose: true,
					 format: 'mm-yyyy'
					 });  
					 
					 });
				   </script>
				  
				  
				  
				   <script type='text/javascript'>
					 $(document).ready(function () {
					 $('#tgl_transaksi_cance').datepicker({
					 minViewMode: 3,
					 autoclose: true,
					 format: 'yyyy-mm-dd'
					 });  
					 
					 });
				   </script>
				  
				   <script type='text/javascript'>
					 $(document).ready(function () {
					 $('#example6').datepicker({
					 minViewMode: 3,
					 autoclose: true,
					 format: 'yyyy-mm-dd'
					 });  
					 
					 });
				  </script>
				  <script type='text/javascript'>
					 $(document).ready(function () {
					 $('#example6dd').datepicker({
					 minViewMode: 3,
					 autoclose: true,
					 format: 'yyyy-mm-dd'
					 });  
					 
					 });
				  </script>
				  
				  
				  <script type='text/javascript'>
					 // When the document is ready
					 $(document).ready(function () {
						 
						 $('#example4').datepicker({
							 minViewMode: 'years',
							 autoclose: true,
							  format: 'yyyy'
						 });  
					 
					 }); 
				  </script>    
				  <script type='text/javascript'>
					 // When the document is ready
					 $(document).ready(function () {
						 
						 $('#example4d').datepicker({
							 minViewMode: 'years',
							 autoclose: true,
							  format: 'yyyy'
						 });  
					 
					 }); 
				  </script>
			
			</div>
		</div>
		<div id="kanan">
			<div class="sc_kanan">
				
				<form method="post" action="simpan-pengeluaran" onsubmit="return confirm('Yakin ingin simpan?');">
				<br>
				<br>
				<br>
					<div class="table-responsive">
						<table border="0" class="table table-borderless" style="width:85%" cellpadding="2" cellspacing="2" align="left">
							<tr>
								<th>No. REF</th>
								<td width="5%"></td>
								<td colspan="2"><input  class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PENGELUARAN" value="<?php echo $kode_pengeluaran ?>"></th>
							</tr>
							<tr>
								<th>Tanggal</th>
								<td width="5%"></td>
								<td colspan="2"><input readonly="readonly" placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm" maxlength="30" value="<?php echo date("d/m/Y"); ?>" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
							</tr>
							
							<tr>
								<th>Jenis Keperluan</th>
								<td width="5%"></td>
								<td>
									<select  class="form-control form-control-sm" name="KATEGORIX" id="kategorix"  onchange="autofocus2()" autofocus>                        
									<?php
										include "koneksi.php";
										$data = mysqli_query($koneksi,"select KATEGORI from t_kategori_pengeluaran order by KATEGORI ASC");
										while($d = mysqli_fetch_array($data)){
											$kat = $d['KATEGORI'];
											echo '<option value="'.$kat.'">'.$kat.'</option>';
										}							
										?>
									</select>						
								</td>
								<td width="10%" align="left"> <a href="#"><img src="img/plus.png" width="40" height="40" data-toggle="modal" data-target="#contact-modal"></a></td>
							</tr>
							<tr>
								<th>Detail</th>
								<td width="5%"></td>
								<td colspan="2"><textarea  class="form-control form-control-sm" id="keterangan"  placeholder="Detail" maxlength="30" type="text" name="KETERANGAN"></textarea></td>
							</tr>
							<tr>
								<th>Harga Satuan</th>
								<td width="5%" align="right"><label>Rp</label></td>
								<td colspan="2"><input type="text" placeholder="0" id="hargasatuan" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" value="0" name="HARGA_SATUAN" ></td>
							</tr>
							<tr>
								<th colspan="2">QTY</th>
								<td colspan="2"><input type="text" placeholder="0" value="1" id="qty" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="QTY" ></td>
							</tr>
							<tr>
								<th colspan="2">Nominal</th>
								<td hidden width="5%" align="right"><label>Rp</label></td>
								<td colspan="2"><input hidden type="text" placeholder="0" id="nominal" class="form-control form-control-sm mata-uang" name="NOMINAL" >
								<label style="font-size:30px" id="nominal2"><b>Rp0</b></label>
								</td>
							</tr>
							<tr align='center'>
								<td colspan="2">
									<button onclick="autofocuss()" style="background-color:#16365c" type="reset" class="btn btn-primary btn-lg btn-block">Batal</button>
								</td>
								<td colspan="2">
									<button type="submit" value="simpan" style="background-color:#00b050" class="btn btn-info btn-lg btn-block">Input</button></td>
								</td>
							</tr>
						</table>
					</div>
				</form>
				
				<script src="js/jquery.mask.min.js"></script>
				<script src="js/terbilang.js"></script>
				<script>
					function autofocuss() {
						document.getElementById("kategorix").focus();
					}
					 
				</script>
				<script>
					function autofocus2() {
						document.getElementById("tgl_transaksi").focus();
					}
					 
				</script>
				<script>
					function inputTerbilang() {
					  //membuat inputan otomatis jadi mata uang
					  $('.mata-uang').mask('0.000.000.000', {reverse: true});									
					   
						var satuan = document.getElementById("hargasatuan").value;			
						if (satuan==""){
							document.getElementById("hargasatuan").value = "0";
						}
						else{
							satuanx = satuan.replace(".","");
							satuanx = satuanx.replace(".","");
							satuanx = satuanx.replace(".","");
						}
						var qty = document.getElementById("qty").value;	
						if (qty==""){
							document.getElementById("qty").value = "0";
						}
						else{
							qtyx = qty.replace(".","");
							qtyx = qtyx.replace(".","");
							qtyx = qtyx.replace(".","");
						}		
						
						var total = parseInt(satuanx) * parseInt(qtyx);						
						document.getElementById("nominal").value = total;											
						var total_x = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");		
						document.getElementById("nominal2").innerHTML = "Rp"+total_x;								
					} 
				</script>	
				<script type="text/javascript">
					$(function(){
						$(".tgl_transaksi_cancel").datepicker({
							format: 'yyyy/mm/dd',
							autoclose: true,
					minViewMode: 3,
							todayHighlight: true,
						});
					});
				</script>
				<script type="text/javascript">
					function select(){			   
					document.getElementById("jenisx").focus();							
					}
				</script>
				<script type="text/javascript">
					$(function(){
						$(".datepicker").datepicker({
							format: 'yyyy-mm-dd',
							autoclose: true,
							todayHighlight: true,
						});
					});
					
					function cek_kat(){        			   		   
						var kategori = $('#kategoriy').val();
						//alert(a);   
						$.ajax({
						url: 'list-kat-pengeluaran.php',
						method: 'GET',
						data: { kategori : kategori},
						success	: function(data){
										//document.getElementById("myForm").reset();									
							var json = data,
							obj = JSON.parse(json);
							$('#kategoriy2').val(obj.kategori);	     
							 var kod1 = $('#kategoriy').val(); 
						 var kod2 = $('#kategoriy2').val(); 
						 if (kod1 == kod2){
							 alert('Kategori sudah ada....');                    
							 document.getElementById("kategoriy").focus();    
							 document.getElementById("kategoriy").value = "Kategori sudah ada...."; 
						 }
						},
						error: function(response){
							console.log(response.responseText);
						}
						});	
					}		
					
				</script>
				
				
				<div id="contact-modal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3>Tambah Kategori Pengeluaran</h3>
							</div>
							<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
								<tr align='center' class="table-info">
									<td align='center'>NO.</th>
									<td align='center'>KATEGORI</th>
									<td align='center'>AKSI</th>
								</tr>
								<?php
									include "koneksi.php";
									$no=1;
									$data = mysqli_query($koneksi,"select ID,KATEGORI from t_kategori_pengeluaran order by KATEGORI ASC");
										while($d = mysqli_fetch_array($data)){
									$id = $d['ID'];
										
									?>
								<tr align="center">
									<td><?php echo $no++; ?></td>
									<td align="left"><?php echo $d['KATEGORI']; ?></td>
									<td align="center"> <a href='hapus-kategori-pengeluaran?id=<?php echo $id; ?>' title="Delete Pengeluaran" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a><?php } ?></td>
								</tr>
							</table>
							<form id="contactForm" name="contact" role="form">
								<div class="modal-body">
									<div class="form-group">
										<label for="name">Kategori</label>
										<input type="text" name="kategoriy" id="kategoriy" onchange="cek_kat();" class="form-control">                        
										<input hidden readonly="readonly" type="text" value="0" id="kategoriy2" name="kategoriy2">
									</div>
								</div>
								<div class="modal-footer">					
									<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
									<button  value="simpan" name="input" id="input" class="btn btn-success">Tambah</button>	
								</div>
							</form>
						</div>
					</div>		
				</div>
				
			</div>
		
		</div>
	
	</body>
</html>