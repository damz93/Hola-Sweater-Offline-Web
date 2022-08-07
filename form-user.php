<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data User - S W E A T E R I N . M E</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
			"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<link rel="shortcut icon" href="img/esana.jpg">
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
			<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA USER</h1>
			<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
			<br>
			<table id="tabel2" align="center" width="100%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left"><a href="utama" style="color:#FFFFFe"> <button type="button" class="btn btn-info">KE MENU UTAMA</button></a></td>
				<td rowspan="2" align="right"><a href="upload-akses" style="color:#FFFFFe"> <button type="button" class="btn btn-primary">UPLOAD AKSES</button> </a></td>
			</tr>
			<tr>
				
				<td align="left"><br><a href="input-user" style="color:#FFFFFe"> <button type="button" class="btn btn-info">INPUT USER </button></a></td>
			</tr>
	</table>
			<br>			
			<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
				<thead align="center">
					<tr align='center' class="table-info">
						<th>NO.</th>
						<th>USERNAME</th>
						<th>NAMA</th>
						<th>LEVEL</th>
						<th>KETERANGAN</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<?php 
					include 'koneksi.php';
					$no=1;
					$data = mysqli_query($koneksi,"select * from t_user WHERE AKTIF='YA' AND LEVEL<>'OWNER' order by ID asc");
					while($d = mysqli_fetch_array($data)){
						?>
				<tr align="center">
					<td><?php echo $no++; ?></td>
					<td align="left"><?php echo $d['USERNAME']; ?></td>
					<td align="left"><?php echo $d['NAMA']; ?></td>
					<td align="center"><?php echo $d['LEVEL']; ?></td>
					<td align="left"><?php echo $d['KETERANGAN']; ?></td>
					<td>			
						<a href='edit-user?id=<?php echo $d['ID']; ?>' title="Edit User">
						<img src="img/edit.png" class="img-responsive" height="100%"></a>	| 
						<a href='hapus-user?id=<?php echo $d['ID']; ?>' title="Hapus User" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
					</td>
				</tr>
				<?php 
					}
					?>
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
				            "lengthMenu": "Menampilkan _MENU_ Data User",
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
</html>