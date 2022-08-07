<!DOCTYPE html>
<html>
   <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Laporan - H O L A S W E A T E R</title>
	<link rel="shortcut icon" href="img/tokonline.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/freelancer.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>



     
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>      
      <style>
			body, html {
				height: 100%;
				margin: 0;
				background-image: url("img/bg_.png");
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
	<style>
	.responsive {
	  width: 100%;
	  max-width: 400px;
	  height: auto;
	}
	</style>
   </head>
   <body>
      <div class="bg">
         <?php
            error_reporting(0);
            session_start();
            if ($_SESSION['status'] != "login") {
             echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
             //header("location:index.php?pesan=belum_login");
            }
            ?>        <br>
         <h3><a style="background-color:#1d7bb6;color:#FFFFFe" href="utama.php"> __KE MENU UTAMA </a></h3>
         <br><br>			
         <div class="main">
            <div class="main-content">
               <br>
               <table style="width:100%;height:100%">
                  <tr style="height:50%">
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#demo" class="collapsible" src="img/report.png" style="display: block; margin: auto;"/> </a>
                        <figcaption class="figure-caption" align='center'>
                           <b>
                              <h4>Laporan Stok</h4>
                           </b>
                        </figcaption>
                        <div id="demo" class="collapse">
                           <form autocomplete="off" method="post" action="laporan-stok.php">
                              <button onclick="" type="submit" class="btn btn-outline-info btn-lg" name="barang_juml">Jumlah Stok</button><br>
                              <button onclick="" type="submit" class="btn btn-outline-info btn-lg" name="barang_terbanyak">Barang Paling Banyak</button><br>
                              <button onclick="" type="submit" class="btn btn-outline-info btn-lg" name="barang_tersedikit">Barang Habis & Sedikit</button>
                           </form>
                        </div>
                     </td>
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#demo2" class="collapsible" src="img/report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>
                           <b>
                              <h4>Laporan Transaksi</h4>
                           </b>
                        </figcaption>
                           <form autocomplete="off" method="post" action="laporan-transaksi.php">                              
                              <div id="demo2" class="collapse">							  
							  <br>
                              <h4><a data-toggle="collapse" data-target="#demo21" class="collapsible-btn btn-outline-info btn-lg">Transaksi Harian</a></h4>
                              <div id="demo21" class="collapse">
                                 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tanggal Awal"  id="exampled9" name="cek_tanggald22">	
                                  <input type="text" class="form-control form-control-sm datepicker" placeholder="Tanggal Akhir"  id="exampled9d" name="cek_tanggald22d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tanggald22">Tampilkan</button>
							  </div>
                              <br>
							  <h4><a data-toggle="collapse" data-target="#demo22" class="collapsible-btn btn-outline-info btn-lg">Transaksi Bulanan</a></h4>
                              <div id="demo22" class="collapse">
                                <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal"  id="exampled10" name="cek_buland22">
                                  <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir"  id="exampled10d" name="cek_buland22d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_buland22">Tampilkan</button>
                              </div>
                              <br>
							   <h4><a data-toggle="collapse" data-target="#demo23" class="collapsible-btn btn-outline-info btn-lg">Transaksi Tahunan</a></h4>
                              <div id="demo23" class="collapse">
                                  <input type="text" class="form-control form-control-sm datepicker" placeholder="Tahun Awal"  id="exampled11" name="cek_tahund22">
                                 <input type="text" class="form-control form-control-sm datepicker" placeholder="Tahun Akhir"  id="exampled11d" name="cek_tahund22d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tahund22">Tampilkan</button>
                              </div>                                                                                             
                                 <br><br><button onclick="" type="submit" class="btn btn-info" name="tampil_semua22">Tampilkan Semua</button>
                              </div>
                           </form> 
                     </td>                   
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#demo4" class="collapsible" src="img/report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>
                           <b>
                              <h4>Laporan Pengeluaran</h4>
                           </b>
                        </figcaption>
                        <form autocomplete="off" method="post" action="laporan-pengeluaran.php">
                           <div id="demo4" class="collapse">                             
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo41" class="collapsible-btn btn-outline-info btn-lg">Pengeluaran Harian</a></h4>
                              <div id="demo41" class="collapse">
                                 <input type="text" placeholder="Tanggal Awal" class="form-control form-control-sm datepicker" id="example6dd" name="cek_tanggal2">
                                 <input type="text" placeholder="Tanggal Akhir"  id="example6"  class="form-control form-control-sm datepicker" name="cek_tanggal2d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tanggal2">Tampilkan</button>
                              </div>
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo42" class="collapsible-btn btn-outline-info btn-lg">Pengeluaran Bulanan</a></h4>
                              <div id="demo42" class="collapse">
                                 <input type="text" placeholder="Bulan Awal"  id="example5"  class="form-control form-control-sm datepicker" name="cek_bulan2">
                                 <input type="text" placeholder="Bulan Akhir"  id="example5d"  class="form-control form-control-sm datepicker" name="cek_bulan2d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_bulan2">Tampilkan</button>
                              </div>
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo43" class="collapsible-btn btn-outline-info btn-lg">Pengeluaran Tahunan</a></h4>
                              <div id="demo43" class="collapse">
                                 <input type="text" placeholder="Tahun Awal" class="form-control form-control-sm datepicker" id="example4" name="cek_tahun2">
                                 <input type="text" placeholder="Tahun Akhir" class="form-control form-control-sm datepicker" id="example4d" name="cek_tahun2d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tahun2">Tampilkan</button>
                              </div>
                           </div>
                        </form>
                     </td>
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#demo5" class="collapsible" src="img/report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>
                           <b>
                              <h4>Laporan Summary</h4>
                           </b>
                        </figcaption>
                        <form autocomplete="off" method="post" action="laporan-summmary.php">
                           <div id="demo5" class="collapse">
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo50" class="collapsible-btn btn-outline-info btn-lg">Summary Harian/Mingguan</a></h4>
                              <div id="demo50" class="collapse">
                                 <input type="text" placeholder="Tanggal Awal" class="form-control form-control-sm datepicker" id="example9" name="cek_tgl3">
                                 <input type="text" placeholder="Tanggal Akhir" class="form-control form-control-sm datepicker" id="example9d" name="cek_tgl3d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tanggal3">Tampilkan</button>
                              </div>
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo51" class="collapsible-btn btn-outline-info btn-lg">Summary Bulanan</a></h4>
                              <div id="demo51" class="collapse">
                                 <input type="text" placeholder="Bulan Awal" class="form-control form-control-sm datepicker" id="example8" name="cek_bulan3">
                                 <input type="text" placeholder="Bulan Akhir" class="form-control form-control-sm datepicker" id="example8d" name="cek_bulan3d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_bulan3">Tampilkan</button>
                              </div>
                              <br>
                              <h4><a data-toggle="collapse" data-target="#demo52" class="collapsible-btn btn-outline-info btn-lg">Summary Tahunan</a></h4>
                              <div id="demo52" class="collapse">
                                 <input type="text" placeholder="Tahun Awal" class="form-control form-control-sm datepicker" id="example7" name="cek_tahun3">
                                 <input type="text" placeholder="Tahun Akhir" class="form-control form-control-sm datepicker" id="example7d" name="cek_tahun3d">
                                 <button onclick="" type="submit" class="btn btn-info" name="tampil_tahun3">Tampilkan</button>
                              </div>
                           </div>
                        </form>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example3').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example3d').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example2d').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example1').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example1d').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <!--
         <script>
             $(function() {
               $('input[name="daterange"]').daterangepicker({
                 opens: 'left'
               }, function(start, end, label) {
                 console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
               });
             });
         </script>
         -->
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
         $('#example9').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
       <script type='text/javascript'>
         $(document).ready(function () {
         $('#example9d').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example8').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example8d').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
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
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example7').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>        
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example7d').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example11').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#example11d').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example9').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example9d').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example10').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#example10d').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#exampled11').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         // When the document is ready
         $(document).ready(function () {
             
             $('#exampled11d').datepicker({
                 minViewMode: 'years',
                 autoclose: true,
                  format: 'yyyy'
             });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#exampled9').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#exampled9d').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#exampled10').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#exampled10d').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>        
	  
      
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_awal1').datepicker({
         autoclose: true,
		 format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
         });  
         
         });
      </script>
   </body>
</html>