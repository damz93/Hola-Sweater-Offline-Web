<?php
	include 'koneksi.php';
	// membuat data jurusan menjadi dinamis dalam bentuk array
	//$jurusan    = array('TEKNIK INFORMATIKA','TEKNIK ELEKTRO','REKAMEDIS');
	// membuat function untuk set aktif radio button
	/*function active_radio_button($value,$input){
	    // apabilan value dari radio sama dengan yang di input
	    $result =  $value==$input?'checked':'';
	    return $result;
	}*/
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Tambah Pengeluaran - H O L A S W E A T E R</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="img/tokonline.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" href="css/datepicker.css">
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
	
      <?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if (($_SESSION['level']!="OWNER")AND($_SESSION['level']!="BENDAHARA")){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
		<div class="bg">
		<?php 
			error_reporting(0);
			session_start();
			if($_SESSION['status']!="login"){
				echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
				//header("location:index.php?pesan=belum_login");
			}
			?>
		<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">TAMBAH PENGELUARAN</h1>
		<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
		<div class='container'>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="form-pengeluaran.php"> [ Kembali ke Data Pengeluaran ]</a><br>
			<br>
			<?php 
				include 'koneksi.php';
				
				$data_pengeluaran = mysqli_query($koneksi,"select max(ID) as ID from t_pengeluaran");
				 while($d = mysqli_fetch_array($data_pengeluaran)){
					$jumkeluar        = $d['ID'];					
				 }
				if ($jumkeluar == 0) {
					$kode_pengeluaran = "TOKOUT-0000001";
				}
				else{
					$jumkeluar++;			
					if (strlen($jumkeluar)== 1){
						$kode_pengeluaran = "TOKOUT-000000".$jumkeluar;				
					}
					else if (strlen($jumkeluar)== 2){
						$kode_pengeluaran = "TOKOUT-00000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 3){
						$kode_pengeluaran = "TOKOUT-0000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 4){
						$kode_pengeluaran = "TOKOUT-000".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 5){
						$kode_pengeluaran = "TOKOUT-00".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 6){
						$kode_pengeluaran = "TOKOUT-0".$jumkeluar;
					}
					else if (strlen($jumkeluar)== 7){
						$kode_pengeluaran = "TOKOUT-".$jumkeluar;
					}
				}
				?>         
			<form method="post" action="simpan-pengeluaran.php" onsubmit="return confirm('Yakin ingin simpan?');">
				<div class="table-responsive">
					<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
						<tr>
							<th>Kode Pengeluaran</th>
							<th><input  class="form-control form-control-sm" readonly maxlength="30" type="text" name="KODE_PENGELUARAN" value="<?php echo $kode_pengeluaran ?>"></th>
						</tr>
						<tr>
							<th>Kategori</th>
							<th>
								<select  class="form-control form-control-sm" name="KATEGORIX" id="kategorix"  onchange="autofocus2()" autofocus>
									<option value="Ongkir">Ongkir</option>
									<option value="Operasional">Operasional</option>
									<option value="Utang">Utang</option>
									<option value="Lain-lain">Lain-lain</option>
								</select>
							</th>
						</tr>
						<tr>
							<th>Keterangan</th>
							<th><input  class="form-control form-control-sm" id="keterangan"  placeholder="Keterangan" maxlength="30" type="text" name="KETERANGAN"></th>
						</tr>
						<tr>
							<th>Nominal</th>
							<th><label>Rp</label><input type="text" placeholder="0" id="nominal" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="NOMINAL" ></th>
						</tr>
						<tr align='center'>
							<br>
							<th><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></th>
							<td><button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
								</th>
						</tr>
					</table>
				</div>
			</form>
		</div>
		<!--<script src="js/jquery-1.11.2.min.js"></script>-->
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/terbilang.js"></script>
		<script>
			function autofocuss() {
				document.getElementById("kategorix").focus();
			}
			 
		</script>
		<script>
			function autofocus2() {
				document.getElementById("keterangan").focus();
			}
			 
		</script>
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
			$(function(){
			    $(".tgl_transaksi").datepicker({
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
		</script>
	</body>
</html>