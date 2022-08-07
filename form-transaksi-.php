<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Data Transaksi - H O L A S W E A T E R</title>
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
            <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">DATA TRANSAKSI</h1>
            <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- H O L A S W E A T E R -</h3>
            <br>
            <a style="background-color:#1d7bb6;color:#FFFFFe" href="utama"> KE MENU UTAMA </a></br>
            <a style="background-color:#1d7bb6;color:#FFFFFe" href="form-transaksi"> KE FORM TRANSAKSI </a></br>
            <a hidden style="background-color:#71b8e4;color:#FFFFFe" href="cetak-laporan-penjualan"> CETAK LAPORAN PENJUALAN </a><br>
            <a hidden style="background-color:#71b8e4;color:#FFFFFe" href="input-transaksi"> INPUT DATA TRANSAKSI </a><br>
            <br>		
            <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
                <thead align="center">
                    <tr align='center' class="table-info">
                        <th>NO.</th>
                        <th>KODE TRANSAKSI</th>
                        <th>WAKTU</th>
                        <th>COSTUMER</th>
                        <th>PCS</th>
                        <th>TOTAL PEMBAYARAN</th>
                        <th>PAYMENT</th>
                        <th>OLEH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <?php 
                    include 'koneksi.php';
                    $no=1;
                    function formatTanggal($date){
                    // ubah string menjadi format tanggal
                    return date('d-M-Y', strtotime($date));
                    }	
                    //$data = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,OLEH from t_transaksi GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
                    $data = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,POTONGAN,OLEH from t_transaksi GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
                    
                    while($d = mysqli_fetch_array($data)){
                    $tgl = formatTanggal($d['TGL']);  
                    $hari = date('l', strtotime($d['TGL']));
                    $semua = $hari.", ".$tgl;
                    $koder = $d['KODE_TRANSAKSI'];				
                    $costumer = $d['COSTUMER'];				
                    $paym = $d['PAYMENT'];				
                    $total = $d['TOTALNYA'];		
                    $potong = $d['POTONGAN'];		
					$totalnya= $total-$potong;
					$totalnya = "Rp".number_format($totalnya,0,",",".");					
                    $qty = $d['JUMLAHH'];				
                    $oleh = $d['OLEH'];
                    	?>
                <tr align="center">
                    <td><?php echo $no++; ?></td>		
                    <td><?php echo $koder; ?></td>		
                    <td align="left"><?php echo $semua; ?></td>
                    <td align="left"><?php echo $costumer; ?></td>	
                    <td><?php echo $qty; ?></td>	
                    <td align="right"><?php echo $totalnya; ?></td>	
               
                    <td>
					 <select name="paymentxx" id="paymentxx" onchange="upd_pay('<?php echo $koder;?>',this.value);" class="form-control form-control-sm" >   
					
                                 <?php
                                    include "koneksi.php";													 
                                    $paymx = mysqli_query($koneksi,"select DISTINCT PAYMENT from t_transaksi WHERE PAYMENT<>'' order by PAYMENT ASC");
                                    while($ee = mysqli_fetch_array($paymx)){
                                    	$kat = $ee['PAYMENT'];
                                    	echo '<option value="'.$kat.'"';
                                    	if (strcmp($paym, $kat) == 0){
                                    		echo 'selected="selected"';
                                    	}
                                    	else{
                                    		echo '';
                                    	}
                                    	echo '>';
                                    	echo $kat;
                                    	echo '</option>';
                                    }							
                                    ?>
                                 </select>
					</td>	
                    <td><?php echo $oleh; ?></td>
                    <td><a target="_BLANK" href='form-transaksi-detail?kode_transaksi=<?php
					   echo $koder;
					   ?>' title="Detail Transaksi" onclick="return confirm('Want Show?')"><img src="img/show.png" height="100%" ></a>|
					   <a target="_BLANK" href='cetak-transaksi2.php?kode_transaksi=<?php echo $koder; ?>' title="Cetak Nota Transaksi" onclick="return confirm('Are you sure you want to reprint?')"><img src="img/print.png" height="100%" ></a>|<a href='hapus-transaksi.php?kode_transaksi=<?php
						  echo $koder;
						  ?>' title="Delete Transaksi" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
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
                            "lengthMenu": "Menampilkan _MENU_ Data Transaksi",
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
		
		<script>
			function upd_pay(kod_tr, paym) {
		//	   var link = document.getElementById("edit_"+kod_bar);
			  // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
			  //alert('tes');
			var linkkk = "update-payment.php?kode_transaksi="+kod_tr+"&paym="+paym;
			window.location.href = linkkk;
			}
		</script>
    </body>
</html>