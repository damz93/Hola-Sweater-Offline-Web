<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Data Transaksi Khusus - H O L A S W E A T E R</title>
        <link rel="shortcut icon" href="img/tokonline.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">      
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
			background-color: #101f40;
			height: 100%;
			padding: 20px;
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
			overflow-x: hidden;
			overflow-y: scroll;	
			}
			div.sc_kiri {  
			width:100%;
			height: 100%;
			overflow-x: hidden;
			overflow-y: hidden;			
			}
		</style>
    </head>
    <body>
	<div class="bg">
	<script type="text/javascript">
			function cek_btntx(){			   
				var kode_trx = $("#kode_trx").val();
				
				if (kode_trx==''){
					alert('Kode Transaksi Kosong');
					document.getElementById("kode_trx").focus();					
					return false;
				}
				else{								
					//alert(kode_trx);
					document.getElementById("kode_trx").value = kode_trx;
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
		  
			<table width="100%" border="0">
            <br>
				<tr>
				<br>
					<h2 style="color:white;">
						<b>Cari Transaksi</b>
                        <br>
					</h2>
				</tr>
				<form action="" method="get" autocomplete="off">
				<tr>
                    <td>
                        <input placeholder="Kode TRX" autofocus class="form-control form-control-sm" maxlength="30" type="text" id="kode_trx" name="kode_trx">  
					</td>
					<td>
                        <button type="submit" name="sm_tx" onclick="cek_btntx()" value="ok" style="background-color:#101f40;" class="btn btn-info btn-block">Cari</button>    
						
                    </td>                    
                </tr>
                <tr>
                    <td>
                    <br>
                        <input placeholder="Pilih Tanggal" class="form-control form-control-sm datepicker" maxlength="30" type="text" id="tgl_transaksi" name="tgl_transaksi"> 
					</td>                    
					<td>
                    <br>
                        <button name="sm_tgl" style="background-color:#101f40;" onclick="cek_btntgl()" value="ok" class="btn btn-info btn-block">Tampilkan</button>						
                    </td> 
				</tr>				
                <tr>				
                    <td colspan="2">                    
					<br>
						<a href="form-transaksi-khusus" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#e6c700;" class="btn btn-block btn-warning">Reset</button></a>
                    </td> 
				</tr>				
				</form>
                <tr>
					<td colspan="2" valign="top">
						<br>
						<br>
						<br>
						<br>
						<a href="input-transaksi-khusus" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#366092;" class="btn btn-lg btn-secondary">Input Transaksi Khusus</button></a>
						<br><br>
						<a href="utama" style="color:#FFFFFe"><button type="button" style="width:100%;background-color:#366092;" class="btn btn-lg btn-secondary">Menu Utama </button>
					</td>
                </tr>
				
			</table>
		  </div>
		  <div id="kanan">	
			  <div class="sc_kanan">	
				<br>
				<h2 style="color:white;" align="right">
					<b>Riwayat Transaksi Khusus</b>
				</h2>
				<h2 style="color:white;" align="right">
					
				</h2>
			
				<table id="tabel1" width="100%" class="table table-hover" align="center" border="1" cellpadding="0" cellspacing="1">
					<thead>
						<tr style="color:#FFFFFF;background-color:#101f40">
							<th>No.</th>
							<th>Tanggal</th>
							<th>Nama</th>
							<th>Pcs</th>
							<th>Pembayaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<?php 
						include 'koneksi.php';
						$no=1;
						function formatTanggal($date){
						// ubah string menjadi format tanggal
						return date('d/m/Y', strtotime($date));
						}	
						$random_kata = 'Kode Transaksi Kosong...';
						$tgl_kosong = 'Isi Tanggal...';
						
						$halaman = 5; /* page halaman*/
						$page    =isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						$mulai    =($page>1) ? ($page * $halaman) - $halaman : 0;
						
						if (isset($_GET['sm_tx'])) {
								//echo "<script>alert('tx tertekan');</script>";							
							if(($_GET['kode_trx'])!=''){
								echo "<h5 style='color:white;'>Hasil Pencarian : ".$_GET['kode_trx']."</h5>";
								$kode = $_GET['kode_trx'];
								//$data_tampil = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,OLEH,POTONGAN from t_transaksi where KODE_TRANSAKSI like '%".$kode."%' GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
								
								$data_tampil2 = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,OLEH,POTONGAN from t_transaksi_khusus where KODE_TRANSAKSI='".$kode."' GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
							}
							else{
								//echo "<script>alert('Kode ');</script>";		
							}
						}
						else if (isset($_GET['sm_tgl'])) {
							//	echo "<script>alert('tgl tertekan');</script>";											
							if(($_GET['tgl_transaksi'])!=''){
								echo "<h5 style='color:white;'>Hasil Pencarian : ".$_GET['tgl_transaksi']."</h5>";
								$tgl = $_GET['tgl_transaksi'];
								//$data_tampil = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,OLEH,POTONGAN from t_transaksi where TGL='".$tgl."' GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
								$data_tampil2 = mysqli_query($koneksi, "select ID,COSTUMER,PAYMENT,SUM(`TOTAL`)AS TOTALNYA, SUM(`QTY`) AS JUMLAHH,KODE_TRANSAKSI,TGL,WAKTU,OLEH,POTONGAN from t_transaksi_khusus where TGL='".$tgl."' GROUP BY KODE_TRANSAKSI ORDER BY ID DESC");
							}
							
						}
					
				
						
					
						while($d = mysqli_fetch_array($data_tampil2)){
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
						<td><?php echo $no; ?></td>		
						<td><?php echo $tgl; ?></td>
						<td align="left"><?php echo $costumer; ?></td>	
						<td><?php echo $qty; ?></td>	
						<td align="right"><?php echo $totalnya; ?></td>
                        <td hidden>
							<select name="paymentxx" id="paymentxx" onchange="upd_pay('<?php echo $koder;?>',this.value);" class="form-control form-control-sm" >
                            <option value="CASH" <?php if($paym=="CASH") echo 'selected="selected"'; ?> >Cash</option>
							<option value="EDC" <?php if($paym=="EDC") echo 'selected="selected"'; ?> >EDC</option>
							<option value="TRANSFER" <?php if($paym=="TRANSFER") echo 'selected="selected"'; ?> >Transfer</option>
							</select>	
						</td>	
						<td hidden style="color:white"><?php echo $oleh; ?></td>
						<td><a target="_BLANK" href='form-transaksi-khusus-detail?kode_transaksi=<?php
						   echo $koder;
						   ?>' title="Detail Transaksi" onclick="return confirm('Want Show?')"><img src="img/show.png" height="100%" ></a>|
						   <a target="_BLANK" href='cetak-transaksi-khusus2.php?kode_transaksi=<?php echo $koder; ?>' title="Cetak Nota Transaksi" onclick="return confirm('Are you sure you want to reprint?')"><img src="img/print.png" height="100%" ></a>|
						   <a hidden href='hapus-transaksi.php?kode_transaksi=<?php
							  echo $koder;
							  ?>' title="Delete Transaksi" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>
							<a href="#"><img src="img/delete.png" title="Hapus Transaksi" width="30" height="30" data-toggle="modal" data-target="#hapuss<?php echo $koder; ?>"></a>  
							  
						</td>
					</tr>
				
				<div  id="hapuss<?php echo $koder; ?>" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
						<!--<form id="form-hapus-pengeluaran" name="form-hapus-pengeluaran" role="form" autocomplete="off">-->
						 <form autocomplete="off" method="post" action="hapus-transaksi-new-khusus.php" onsubmit="return confirm('Yakin ingin hapus?');">
							<div class="modal-header">
								<h3>Verifikasi Hapus Transaksi</h3><b>*<?php echo $koder;?>*</b>
								
							</div>
							<div class="modal-body">
									<div class="form-group">
										<label>Kode Akses</label>
										<input placeholder="masukkan kode akses" type="text" name="kode_akses" id="kode_akses" autofocus class="form-control form-control-sm">
										<input hidden value="<?php echo $koder;?>" readonly="readonly" type="text" id="kode_transaksi" name="kode_transaksi">
										
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
					$no++;
						}
						?>
				</table>
				 <div hidden style="font-weight:bold;">
					Paging
					<?php
						for ($i=1; $i<=$pages ; $i++){
					?>
						<a href="?halaman=<?php echo $i; ?>" style="text-decoration:none">   <u><?php echo $i; ?></u></a>
					<?php
						}
					?>
				</div>
				<nav hidden>
					<ul class="pagination justify-content-center">
						<li class="page-item">
							<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
						</li>
						<?php 
						for($x=1;$x<=$total_halaman;$x++){
							?> 
							<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
							<?php
						}
						?>				
						<li class="page-item">
							<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
						</li>
					</ul>
				</nav>
				
				</div>
        </div>
			
            <script type="text/javascript">
                $(document).ready(function() {
                    //$("#tabel1").tablesorter();
                    $("#tabel2").DataTable({
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
		
		<script>
			function upd_pay(kod_tr, paym) {
		//	   var link = document.getElementById("edit_"+kod_bar);
			  // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
			  //alert('tes');
			var linkkk = "update-payment.php?kode_transaksi="+kod_tr+"&paym="+paym;
			window.location.href = linkkk;
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
		</div>
    </body>
</html>