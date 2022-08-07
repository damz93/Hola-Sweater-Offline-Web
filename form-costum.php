<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data Costum - H O L A S W E A T E R</title>
		<link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/freelancer.min.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
			<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA COSTUM</h1>
			<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
			<br>
			<a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="input-costum"> INPUT DATA COSTUM </a><br>
			<br>		
			<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
				<thead align="center">
					<tr align='center' class="table-info">
						<th>NO.</th>
						<th>WAKTU</th>
						<th>KODE KOSTUM</th>
						<th>JENIS SWEATER</th>
						<th>BAHAN</th>
						<th>KETERANGAN</th>
						<th>HARGA</th>
						<th>OLEH</th>
						<th>STATUS</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<?php 
					include 'koneksi.php';
					session_start();
					$no=1;
					function formatTanggal($date){
					// ubah string menjadi format tanggal
					return date('d-M-Y', strtotime($date));
					
					}	
					$data = mysqli_query($koneksi, "select * from t_costum ORDER BY KODE_COSTUM ASC");					
					while($d = mysqli_fetch_array($data)){
					$tgl = formatTanggal($d['TGL']);  
					$hari = date('l', strtotime($d['TGL']));
					$semua = $hari.", ".$tgl;
					$harga = $d['HARGA'];	
					$hargatamp = "Rp".number_format($harga, 0, ",", ".");	
					$kocos = $d['KODE_COSTUM'];				
					$bahan = $d['BAHAN'];				
					$jens_swe = $d['JENIS_SWEATER'];				
					$ketcos = $d['KET_COSTUM'];				
					$stt = $d['STATUS'];				
					$oleh = $d['OLEH'];				

						?>
				<tr align="center">
					<td><?php echo $no++; ?></td>
					<td><?php echo $semua; ?></td>
					<td><?php echo $kocos; ?></td>
					<td align="left"><?php echo $jens_swe; ?></td>
					<td align="left"><?php echo $bahan; ?></td>
					<td align="left"><?php echo $ketcos; ?></td>
					<td align="right"><?php echo $hargatamp; ?></td>
					<td><?php echo $oleh; ?></td>
					<td><?php echo $stt; ?></td>
					<td>			
					   <a href='edit-costum?kode_costum=<?php echo $kocos; ?>' title="Edit Costum">
					   <img src="img/edit.png" class="img-responsive" height="100%"></a>	| 
					   <a href='hapus-costum?kode_costum=<?php echo $kocos; ?>' title="Delete Costum" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
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
				            "lengthMenu": "Menampilkan _MENU_ Data Order Costum",
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