<?php
   include 'koneksi.php';
   $kode_pengeluaran= $_GET['kode_pengeluaran'];
   $barang  = mysqli_query($koneksi, "select * from t_pengeluaran where KODE_PENGELUARAN='$kode_pengeluaran'");
   $row        = mysqli_fetch_array($barang);
   $kategori = $row['KATEGORI'];
   $tglnya = $row['TGL'];
   $keterangan = $row['NOTES'];
   $harga1=number_format($row['NOMINAL'],0,",",".");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit Pengeluaran - S W E A T E R I N . M E</title>
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
         else if($_SESSION['level']!="OWNER"){
         //echo "<script>alert('...');window.location.href='edit-pengeluarann.php';</script>";                    
         echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
             ?>
      <div class="bg">
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT PENGELUARAN</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
         <a style="background-color:#71b8e4;color:#FFFFFe" href="form-pengeluaran"> [ Kembali ke Data Pengeluaran ]</a><br>
         <br>
         <br>
         <form method="post" action="update-pengeluaran.php" onsubmit="return confirm('Yakin ingin update?');">
            <div class="table-responsive">
               <div class="form-group">
                  <div class="container">
                     <br>
                     <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">
                           <tr>
                              <th>Kode Pengeluaran</th>
                              <td colspan="2"><input readonly value="<?php echo $row['KODE_PENGELUARAN'];?>" name="KODE_PENGELUARAN" class="form-control form-control-sm" ></td>
                           </tr>
                           <tr>
                              <th>Kategori</th>
                              <td colspan="2">
                                 <select name="KATEGORIX" id="KATAGORIX" onchange="select()" autofocus class="form-control form-control-sm" >   
                                 <?php
                                    include "koneksi.php";			
                                    $kategor = $row['KATEGORI'];											 
                                    $data = mysqli_query($koneksi,"select * from t_kategori_pengeluaran order by KATEGORI ASC");
                                    while($d = mysqli_fetch_array($data)){
                                    	$kat = $d['KATEGORI'];
                                    	echo '<option value="'.$kat.'"';
                                    	if (strcmp($kategor, $kat) == 0){
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
                           </tr>
                           <tr>
                              <th>Tanggal Transaksi</th>
                              <td colspan="3"><input placeholder="Tanggal Transaksi(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" value="<?php echo $tglnya;?>" type="text" name="tgl_transaksi" id="tgl_transaksi">  </td>
                           </tr>
                           <tr>
                              <th>Keterangan</th>
                              <td colspan="2"><input maxlength="30" type="text" value="<?php echo $keterangan;?>" name="KETERANGAN" class="form-control form-control-sm" ></td>
                           </tr>
                           <tr>
                              <th>Nominal</th>
                              <td width="1%">Rp</td>
                              <td><input type="text" id="nominal" onkeydown="myFunction();" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="NOMINAL"  value="<?php echo $harga1;?>" ></td>
                              </td>
                           </tr>
                           <tr align='center'>
                              <br>
                              <td colspan="3"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Update</button></td>
                           </tr>
                        </div>
                     </table>
                  </div>
               </div>
            </div>
         </form>
         <script src="js/jquery.mask.min.js"></script>
         <script src="js/terbilang.js"></script>
         <script type="text/javascript">
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
            function select(){			   
            document.getElementById("tgl_transaksi").focus();							
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
      </div>
   </body>
</html>