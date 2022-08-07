<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Data Order Costum - H O L A S W E A T E R</title>
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
				   	echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index?pesan=belum_login';</script>";
				   	//header("location:index.php?pesan=belum_login");
				   }
				    ?>
			<h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA ORDER COSTUM</h1>
			<h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
			<br>
			<a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
			<a style="background-color:#71b8e4;color:#FFFFFe" href="input-order"> INPUT DATA ORDER </a><br>
			<br>		
			<table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
				<thead align="center">
					<tr align='center' class="table-info">
						<th>NO.</th>
						<th>WAKTU</th>
						<th>KODE KOSTUM</th>
						<th>KETERANGAN</th>
						<th>HARGA</th>
						<th>OLEH</th>
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
					$data = mysqli_query($koneksi, "select COUNT('QTY') AS JUMLAHH,KODE_ORDER,TGL,STATUS from t_costum WHERE STATUS='DESIGNER' GROUP BY KODE_ORDER ORDER BY ID DESC");					
					while($d = mysqli_fetch_array($data)){
					$tgl = formatTanggal($d['TGL']);  
					$hari = date('l', strtotime($d['TGL']));
					$semua = $hari.", ".$tgl;
					$harga = $d['HARGA'];	
					$hargatamp = "Rp".number_format($harga, 0, ",", ".");	
					$kocos = $d['KODE_COSTUM'];				
					$ketcos = $d['KET_COSTUM'];				
					$oleh = $d['OLEH'];				

						?>
				<tr align="center">
					<td><?php echo $no++; ?></td>
					<td><?php echo $semua; ?></td>
					<td><?php echo $kocos; ?></td>
					<td><?php echo $ketcos; ?></td>
					<td><?php echo $hargatamp; ?></td>
					<td><?php echo $oleh; ?></td>
					<td>
						<a href='update-order?kode_order=<?php echo $koder; ?>' title="Update Progress" onclick="return confirm('Are you sure you want to update STATUS?')"><img src="img/edit.png" height="100%" ></a>
						|<a target="_BLANK" href='form-order-detail?kode_order=<?php echo $koder; ?>' title="Detail Order" onclick="return confirm('Want Show?')"><img src="img/show.png" height="100%" ></a>
						|<a href='hapus-order?kode_order=<?php echo $koder; ?>' title="Delete Order" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a> 
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