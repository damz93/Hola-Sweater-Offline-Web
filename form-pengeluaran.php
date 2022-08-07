<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data Pengeluaran - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
			<style>
			tr {
			  opacity: 0.9;
			  color: #b8b6b6;
			}

			tr:hover {
			  opacity: 1.0;
			  color: #000000;
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
	<body>
		<script type="text/javascript">
			function cek_btntx(){			   
				var kode_keperluan = $("#kode_keperluan").val();
				
				if (kode_keperluan==''){
					alert('Keperluan Kosong');
					document.getElementById("kode_keperluan").focus();					
					return false;
				}
				else{								
					//alert(kode_keperluan);
					document.getElementById("kode_keperluan").value = kode_keperluan;
					return false;
				}
			}
			function cek_btntgl(){			   
				var tgl = $("#tgl_transaksi").val();
				if (tgl==''){
					alert('Tgl Kosong');
					document.getElementById("tgl_transaksi").focus();
					return false;
				}
				else{
					document.getElementById("tgl_transaksi").value = tgl;
					return false;
					
				}
			}
		</script>
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
		<div id="kiri">
			<div class="sc_kiri">
				<table width="100%" border="0">
					<br>
					<tr>
						<br>
						<h2 style="color:white;"><b>
							Data Pengeluaran
							<br>
						</b></h2>
					</tr>
					<tr>
						<td colspan="2" valign="top">
							<br>
							<br>
							<br>
							<br>
							<a href="input-pengeluaran" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#366092;" class="btn btn-lg btn-secondary">Input Pengeluaran</button></a>
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
					 $('#tgl_transaksi').datepicker({
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
				<br>	
				<form autocomplete="off" action="#" method="get" autocomplete="off">
					<table width="100%" border="0">
						<tr>
							<td>
								<br>
								<input placeholder="Pilih Tanggal" class="form-control form-control-sm datepicker" maxlength="30" type="text" id="tgl_transaksi" name="tgl_transaksi"> 
							</td>
							<td>
								<br>
								<button name="sm_tgl" style="background-color:#00b050;" onclick="cek_btntgl()" value="ok" class="btn btn-primary btn-block">Tampilkan</button>	 
							</td>
							<td width="20%">
							</td>
							<td>
								<br>
								<input placeholder="Keperluan"  class="form-control form-control-sm" maxlength="30" type="text" id="kode_keperluan" name="kode_keperluan"> 
							</td>
							<td>
								<br>
								<button type="submit" name="sm_keperluan" onclick="cek_btntx()" value="ok" style="background-color:#00b050;" class="btn btn-primary btn-block">Cari</button>     
							</td>
						</tr>
					</table>
				</form>
				<table id="tabel1" class="table table-hover" border="0" cellpadding="0" cellspacing="1">

					<thead align="center">
						<tr align='center' valign="middle" style="color:#FFFFFF;background-color:#244062">
							<th>TGL</th>
							<th>KEPERLUAN</th>
							<th>QTY</th>
							<th>DETAIL</th>
							<th>JUMLAH</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<?php 
						include 'koneksi.php';
						$no=1;
						function formatTanggal($date){
						// ubah string menjadi format tanggal
						return date('d/m/Y', strtotime($date));
						}
						
						
						if (isset($_GET['sm_keperluan'])) {			
							if(($_GET['kode_keperluan'])!=''){
								echo "<h5 style='color:white;'>Hasil Pencarian : ".$_GET['kode_keperluan']."</h5>";
								$kode = $_GET['kode_keperluan'];
								
								$data_tampil2 = mysqli_query($koneksi, "select * from t_pengeluaran where KATEGORI='".$kode."' ORDER BY ID DESC");
							}
						}
						
						else if (isset($_GET['sm_tgl'])) {
							if(($_GET['tgl_transaksi'])!=''){
								echo "<h5 style='color:white;'>Hasil Pencarian : ".$_GET['tgl_transaksi']."</h5>";
								$tgl = $_GET['tgl_transaksi'];
								$data_tampil2 = mysqli_query($koneksi, "select * from t_pengeluaran where TGL='".$tgl."' order by ID DESC");
							}
						}
						
					//	$data = mysqli_query($koneksi,"select * from t_pengeluaran order by ID DESC");
						while($d = mysqli_fetch_array($data_tampil2)){
						//$tglAA = $d['TGL'];
						$tglx = formatTanggal($d['TGL']);  
						$tgl = $d['WAKTU'];				
						$tgl = substr($tgl,0,10);
						$kate = $d['KATEGORI'];
						$kodpen = $d['KODE_PENGELUARAN'];
						$notes = $d['NOTES'];
						$keterr = $d['KETERANGAN'];
						$qty = $d['QTY'];
						$nominal = number_format($d['NOMINAL'],0,",",".");
						$qty_tamp = number_format($qty,0,",",".");
							?>
					<tr align="center">
						<td align="center"><?php echo $tglx; ?></td>
						<td align="left"><?php echo $kate; ?></td>
						<td><?php echo $qty_tamp; ?></td>
						<td align="left"><?php echo $notes; ?></td>
						<td align="right"><?php echo "Rp".$nominal; ?></td>
						<td style="color:white">
							<a hidden href='edit-pengeluaran.php?kode_pengeluaran=<?php echo $d['KODE_PENGELUARAN']; ?>' title="Edit Pengeluaran">
							<img src="img/edit.png" class="img-responsive" height="100%"></a>	
							<a hidden href='hapus-pengeluaran?kode_pengeluaran=<?php echo $d['KODE_PENGELUARAN']; ?>' title="Delete Pengeluaran" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
							<a href="#"><img src="img/delete.png" title="Hapus Pengeluaran" width="30" height="30" data-toggle="modal" data-target="#hapuss<?php echo $kodpen; ?>"></a>
						</td>
					</tr>
					
					
				<div  id="hapuss<?php echo $kodpen; ?>" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
						<!--<form id="form-hapus-pengeluaran" name="form-hapus-pengeluaran" role="form" autocomplete="off">-->
						 <form autocomplete="off" method="post" action="hapus-pengeluaran-new.php" onsubmit="return confirm('Yakin ingin hapus?');">
							<div class="modal-header">
								<h3>Verifikasi Hapus Pengeluaran</h3><b>*<?php echo $kodpen;?>*</b>
								
							</div>
							<div class="modal-body">
									<div class="form-group">
										<label>Kode Akses</label>
										<input placeholder="masukkan kode akses" type="text" name="kode_akses" id="kode_akses" autofocus class="form-control form-control-sm">
										<input hidden value="<?php echo $kodpen;?>" readonly="readonly" type="text" id="kode_pengeluaran" name="kode_pengeluaran">
										
									</div>
							</div>
							<div class="modal-footer">		
								<button  value="add" name="prosess" id="prosess" class="btn btn-primary" type="submit">Proses Hapus</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>			
						</form>				
						</div>
						
					</div>		
				</div>
					
					
					<?php 
						}
						?>
				</table>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#prosess').on('click',function(){
							var kode_akses = $('#kode_akses').val();
							var kode_pengeluaran = $('#kode_pengeluaran').val();
							//alert(kode_pengeluaran);
							if (kode_akses==""){
								alert("Mohon masukkan kode akses");
								document.getElementById("kode_akses").focus();
								return false;										
							}							
							else{
								/*window.open("hapus-pengeluaran-new.php","_self");
								
								$.ajax({
									  method: "POST",
									  url: "hapus-pengeluaran-new.php",
									 data: { kode_akses : kode_akses,kode_pengeluaran : kode_pengeluaran,type:"insert"},	
									  success	: function(data){			
												},
												error: function(response){
													console.log(response.responseText);
												}
									});	
									//alert('berhasil hapus terhapus');          
									window.open("form-pengeluaran","_self");
									//location.reload(true);	*/
							}	
						});
					});
				</script>
				
				
				
			</div>
	  
		</div>
		
	
	</body>
</html>