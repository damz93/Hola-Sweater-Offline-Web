<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Data Diskon - H O L A S W E A T E R</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>	  
      <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
        }
        </style>
        <script>
            $(document).ready(function () {
            $('#selectedColumn').DataTable({
                "aaSorting": [],
                columnDefs: [{
                orderable: false,
                targets: 3
                }]
            });
                $('.dataTables_length').addClass('bs-select');
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
   </head>
   <body>
   <div class="bg">
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA DISKON</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <br>
	  
	  
	<table id="tabel2"  align="center" width="100%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left"><a href="utama" style="color:#FFFFFe"> <button type="button" class="btn btn-info">KE MENU UTAMA</button></a></td>
				<td rowspan="2" align="right"><a href="upload-voucher" style="color:#FFFFFe"> <button type="button" class="btn btn-primary">UPLOAD VOUCHER</button> </a></td>
			</tr>
			<tr>
				
				<td align="left"><br><a href="input-diskon" style="color:#FFFFFe"> <button type="button" class="btn btn-info">INPUT DATA DISKON </button></a></td>
			</tr>
	</table>
	  
      <br>		
      <table id="selectedColumn" class="table table-hover table-bordered table-sm" cellspacing="0" width="100%">
         <thead align="center">
            <tr align='center' class="table-info">
               <th>NO.</th>			   
               <th>Tgl Input</th>
               <th>Kode Diskon</th>
               <th>Note</th>
               <th>Potongan</th>
               <th>Minimal Pembelian</th>
               <th>Keterangan</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <?php 
            include 'koneksi.php';
            $no=1;
            $data = mysqli_query($koneksi,"select * from t_diskon order by ID DESC");
            while($d = mysqli_fetch_array($data)){
				$tgl = $d['WAKTU'];
				$tgl = substr($tgl,0,10);
				$kodisk = $d['KODE_DISKON'];
				$minimal = $d['MINIMAL'];
				$minimalx = number_format($minimal,0,",",".");
				$mulai = $d['TGL_MULAI'];
				$mulai = date("d-m-Y", strtotime($mulai));    
				$selesai = $d['TGL_SELESAI'];
				$selesai = date("d-m-Y", strtotime($selesai));
				$notes = $d['LAIN'];
				$keterr = $d['KETERANGAN'];
				$status = $d['STATUS'];
				$persen = $d['PERSEN'];
				$nominal = number_format($d['NOMINAL'],0,",",".");
            	?>
		<tr align="center">
            <td><?php echo $no++; ?></td>
            <td><?php echo $tgl; ?></td>
            <td><?php echo $kodisk; ?></td>     
            <td><?php echo $kodisk; ?></td>     
            <td align="right"><?php echo "Rp".$nominal; ?></td>
            <td align="right"><?php echo $minimalx; ?></td>
            <td align="left"><?php echo $keterr; ?></td>  
            <td>			
               <a href='edit-diskon.php?kode_diskon=<?php echo $d['KODE_DISKON']; ?>' title="Edit Diskon">
               <img src="img/edit.png" class="img-responsive" height="100%"></a>	| 
               <a href='hapus-diskon.php?kode_diskon=<?php echo $d['KODE_DISKON']; ?>' title="Delete Diskon" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
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
                     "lengthMenu": "Menampilkan _MENU_ Data Diskon",
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