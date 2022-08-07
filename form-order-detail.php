<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	   <?php
         include 'koneksi.php';
         $no             = 1;
         $kode_order = $_GET['kode_order'];
         ?>
      <title>Data Detail Order - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js
         "></script>
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
                   	echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
                   	//header("location:index.php?pesan=belum_login");
                   }
         ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA DETAIL ORDER </h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
      <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama.php"> KE MENU UTAMA </a></br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-order.php"> KEMBALI KE FORM ORDER </a><br><br>
	  <b style="background-color:#71b8e4;color:#FFFFFe">NOMOR RESI : <?php echo $kode_order; ?></b>
      <br>		
      <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' class="table-info">
               <th>NO.</th>			   
               <th>WAKTU</th>           		   
               <th>JENIS KOSTUM</th>               
               <th>OPSI KOSTUM</th>
			   <th>QTY</th>  			   
			   <th>NOTES</th>	
            </tr>
         </thead>
		 <?php
			function formatTanggal($date){
			// ubah string menjadi format tanggal
				return date('d-M-Y', strtotime($date));
			}
         $juml_keseluruhan = 0;
         $kuantitas = 0;
         $order = mysqli_query($koneksi, "select * from t_order where KODE_ORDER='$kode_order' ORDER BY QTY ASC");
         while ($d = mysqli_fetch_array($order)) {
			$kodr = $d['KODE_ORDER'];
			$tgl = formatTanggal($d['TGL']);
			$hari = date('l', strtotime($d['TGL']));
			$semua = $hari.", ".$tgl;			
			$jencos = $d['JENIS_COSTUM'];
			$opscos = $d['OPSI_COSTUM'];
			$qty = $d['QTY'];
			$kuantitas = $kuantitas + $qty;
			$status = $d['STATUS'];
			$notes = $d['NOTES'];
            $harga3 = number_format($d['POTONGAN'], 0, ",", ".");
            $tgl = formatTanggal($d['TGL']);  
			$juml_keseluruhan = $juml_keseluruhan+$d['JUMLAH'];
			$hari = date('l', strtotime($d['TGL']));
			$semua = $hari.", ".$tgl;
         ?>
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $semua; ?></td>
            <td><?php echo $jencos; ?></td>
            <td><?php echo $opscos; ?></td>         
            <td><?php echo $qty; ?></td>        
            <td><?php echo $notes; ?></td>        
         </tr>
         <?php 
            }
			$noo = $no - 1;
            ?>
		<tr>
			<td align="right" colspan=5><b>Jumlah Costum berbeda</b>
				</td>
         <td align="left">
            <?php echo $noo;?>
         </td>
		 </tr>
		<tr>
			<td align="right" colspan=5><b>Jumlah QTY</b>
				</td>
			<td>
            <?php echo $kuantitas;?>
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
                     "lengthMenu": "Menampilkan _MENU_ Data Detail Order",
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