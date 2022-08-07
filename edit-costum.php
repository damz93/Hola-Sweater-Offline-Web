<?php
   include 'koneksi.php';
   $kode_costum = $_GET['kode_costum'];
   $costum  = mysqli_query($koneksi, "select * from t_costum where KODE_COSTUM='$kode_costum'");
   $row        = mysqli_fetch_array($costum);
   $kode_costum = $row['KODE_COSTUM'];
   $status = $row['STATUS'];
   $kett = $row['KET_COSTUM'];
   $bahan = $row['BAHAN'];
   $jeniss = $row['JENIS_SWEATER'];
   $harga=number_format($row['HARGA'],0,",",".");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Edit Costum - S W E A T E R I N . M E</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="shortcut icon" href="img/tokonline.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="js/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" href="css/datepicker.css">
      <!--  <link rel="stylesheet" href="css/freelancer.min.css">    -->
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
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="SPV KASIR")) {
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT COSTUM</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-costum"> [ Kembali ke Data Costum ]</a><br>
      <br>
      <form method="post" action="update-costum.php" onsubmit="return confirm('Yakin ingin simpan?');">
         <div class="table-responsive">
            <div class="form-group">
               <div class="container">
                  <br>
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <tr>
                           <th>Kode Costum</th>
                           <td colspan="3"><input value="<?php echo $kode_costum;?>" readonly maxlength="60" type="text" class="form-control form-control-sm" id="KODE_COSTUM" name="KODE_COSTUM" value="" placeholder="KODE COSTUM"> </td>
                        </tr>
						
						<tr>
                              <th>Jenis Sweater</th>
                              <td colspan="3">
                                 <select name="JENIS_SWEATER" id="JENIS_SWEATER" class="form-control form-control-sm" autofocus>
                                 <?php
                                    include "koneksi.php";			
                                    $jns = $jeniss;											 
                                    $data = mysqli_query($koneksi,"select DISTINCT(JENIS_BARANG) FROM t_stok WHERE JENIS_BARANG<>'Totebag' ORDER BY JENIS_BARANG ASC");
                                    while($d = mysqli_fetch_array($data)){
                                    	$jen = $d['JENIS_BARANG'];
                                    	echo '<option value="'.$jen.'"';
                                    	if (strcmp($jns, $jen) == 0){
                                    		echo 'selected="selected"';
                                    	}
                                    	else{
                                    		echo '';
                                    	}
                                    	echo '>';
                                    	echo $jen;
                                    	echo '</option>';
                                    }							
                                    ?>
                                 </select>
                              </td>
                           </tr>
						
						
						<tr>
                              <th>Bahan</th>
                              <td colspan="3">
                                 <select  class="form-control form-control-sm" name="BAHANX" id="BAHANX">   
                                 <?php
                                    include "koneksi.php";			
                                    $bhn = $bahan;											 
                                    $data = mysqli_query($koneksi,"select * from t_bahan order by BAHAN ASC");
                                    while($d = mysqli_fetch_array($data)){
                                    	$bah = $d['BAHAN'];
                                    	echo '<option value="'.$bah.'"';
                                    	if (strcmp($bhn, $bah) == 0){
                                    		echo 'selected="selected"';
                                    	}
                                    	else{
                                    		echo '';
                                    	}
                                    	echo '>';
                                    	echo $bah;
                                    	echo '</option>';
                                    }							
                                    ?>
                                 </select>
                              </td>
                           </tr>
                        <tr>
                           <th>Keterangan</th>
                           <td colspan="3"> <input value="<?php echo $kett;?>" id="keterangan" autofocus placeholder="KETERANGAN" class="form-control form-control-sm" maxlength="80" type="text" name="KETERANGAN">  </td>
                        </tr>
                        <tr>
                           <th>Harga</th>
                           <td width="1%">Rp</td>
                           <td align="left" width="60%" colspan="2"><input value="<?php echo $harga;?>" type="text" id="harga" placeholder="0" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="HARGA" >
                        </tr>
                        <tr>
                           <th>Status</th>
                           <td colspan="3">
                              <select name="STATUSX" id="STATUSX" class="form-control form-control-sm">
                                 <option value="AKTIF" <?php if($status=="AKTIF") echo 'selected="selected"'; ?> >Aktif</option>
                                 <option value="NON AKTIF" <?php if($status=="NON AKTIF") echo 'selected="selected"'; ?>>Non AKtif</option>
                              </select>
                           </td>
                        </tr>                        
                        <tr align='center'>
                           <br>
                           <td colspan=4><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Update</button></td>
                        </tr>
                     </div>
               </table>				   
               </div>
            </div>
			</div>
      </form>
      <!-- <script src="js/jquery-1.11.2.min.js"></script>-->
      <script src="js/jquery.mask.min.js"></script>
      <script src="js/terbilang.js"></script>
      <script>
         function autofocuss() {
         	document.getElementById("KODE_DISKON").focus();
         }
          
      </script>
      <script>
         function inputTerbilang() {
           //membuat inputan otomatis jadi mata uang
           $('.mata-uang').mask('0.000.000.000', {reverse: true});
         
           //mengambil data uang yang akan dirubah jadi terbilang
            var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
         
            //menampilkan hasil dari terbilang
            document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
         } 
      </script>			
      </div>
      <script type="text/javascript">
         $(function(){
             $(".TGL_AWAL").datepicker({
                 format: 'yyyy/mm/dd',
                 autoclose: true,
         minViewMode: 3,
                 todayHighlight: true,
             });
         });
      </script>
      <script type="text/javascript">
         $(function(){
             $(".TGL_AKHIR").datepicker({
                 format: 'yyyy/mm/dd',
                 autoclose: true,
         minViewMode: 3,
                 todayHighlight: true,
             });
         });
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
   </body>
</html>