<!DOCTYPE html>
<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Data Akses - H O L A S W E A T E R</title>
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
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>

	<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">UPLOAD AKSES</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
      <br>      
	  <a style="background-color:#71b8e4;color:#FFFFFe" href="form-user"><button type="button" class="btn btn-info">[ Kembali ke Data User ]</button> </a><br>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">			
	<tr>
		<td align="center">
		
			<a style="background-color:#217346;color:#FFFFFe" target="_BLANK" href='template/format_upload_akses.xlsx'><button type="button" class="btn btn-primary">DOWNLOAD FORMAT EXCEL</button> </a>
			
		</td>
	</tr>	
	
	<tr>
		<td align="center">
		
		</br>	
		</br>	
			<form class="" method="post" enctype="multipart/form-data" action="upload-aksi-akses" align='center'>
				<label for="exampleInputFile">Pilih File: </label>
				<input name="berkas_akses" type="file" required="required" id="exampleInputFile"><br>
				<input name="upload" type="submit" value="Upload" class="btn btn-info btn-sm"></form>
		</td>
	</tr>
	</table>
	<br>
			<h5 align='left' style="background-color:#1d7bb6;color:#FFFFFe">Hasil Import...</h5>
			<table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
				<tr align='center' class="table-info">
					<th width="5" height="40">No</th>
					<th width="8">Kode Voucher</th>
					<th width="20">Nama Akses</th>
					<th width="10">Status</th>
					<th width="20">Keterangan</th>
					<th width="20">Waktu Upload</th>
				</tr>
				<?php
					include "koneksi.php";
					$no=1;
					$data = mysqli_query($koneksi, "select * from t_akses order by STATUS,ID ASC");
					
					//menampilkan data
					while ($d = mysqli_fetch_array($data)) {
					?>
				<tr>
					<td align="center" height="36"><?php echo $no++;?></td>
					<td align="center"><?php echo $d['KODE_AKSES'];?></td>
					<td align="center"><?php echo $d['NAMA_AKSES'];?></td>
					<td align="center"><?php echo $d['STATUS']; ?></td>
					<td align="left"><?php echo $d['KETERANGAN']; ?></td>
					<td align="center"><?php echo $d['WAKTU'];?></td>
				</tr>
				<?php
					}
					?>    
				<tr hidden>
					<td colspan="5" height="36"> 
						<?php
							//jika data tidak ditemukan
							if(mysql_num_rows($data)==0){
								echo "<font color=red>Data tidak ditemukan!</font>";
							}
							?>
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
							 "lengthMenu": "Menampilkan _MENU_ Data Akses",
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

		</td>
	</tr>
</table>




</div>
</body>
</html>