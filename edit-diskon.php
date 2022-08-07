<?php
   include 'koneksi.php';
   $kode_diskon = $_GET['kode_diskon'];
   $diskon  = mysqli_query($koneksi, "select * from t_diskon where KODE_DISKON='$kode_diskon'");
   $row        = mysqli_fetch_array($diskon);
   $kode_diskon = $row['KODE_DISKON'];
   $notes = $row['LAIN'];
   $tgl_awal = $row['TGL_MULAI'];
   $tgl_akhir =$row['TGL_SELESAI'];
   $persen = $row['PERSEN'];
   $status =   $row['STATUS'];
   $nominal=number_format($row['NOMINAL'],0,",",".");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Edit Diskon - S W E A T E R I N . M E</title>
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
		else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="OWNER")) {
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT DISKON</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-diskon.php"> [ Kembali ke Data Diskon ]</a><br>
      <br>
      <form method="post" action="update-diskon.php" onsubmit="return confirm('Yakin ingin simpan?');">
         <div class="table-responsive">
            <div class="form-group">
               <div class="container">
                  <br>
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <tr>
                           <th>Kode Diskon</th>
                           <td colspan="3"><input value="<?php echo $kode_diskon;?>" readonly  maxlength="60" type="text" class="form-control form-control-sm" id="KODE_DISKON" name="KODE_DISKON" placeholder="KODE DISKON"> </td>
                        </tr>
                        <tr>
                           <th>Notes</th>
                           <td colspan="3"> <input id="notes" value="<?php echo $notes;?>" autofocus  placeholder="NOTES" class="form-control form-control-sm" maxlength="30" type="text" name="NOTES">  </td>
                        </tr>
                        <tr>
                           <th>Tanggal Awal</th>
                           <td colspan="3"><input value="<?php echo $tgl_awal;?>" placeholder="TANGGAL AWAL(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="TGL_AWAL">  </td>
                        </tr>
                        <tr>
                           <th>Tanggal Akhir</th>
                           <td colspan="3"><input value="<?php echo $tgl_akhir;?>" id="TGL_AKHIR"  placeholder="TANGGAL AKHIR(dd/MM/yyyy)" class="form-control form-control-sm datepicker" maxlength="30" type="text" name="TGL_AKHIR"> </td>
                        </tr>
                        <tr>
                           <th width="30%">Nominal</th>
                           <td width="1%">Rp</td>
                           <td align="left" width="60%" colspan="2"><input value="<?php echo $nominal;?>" type="text" id="nominal" placeholder="0" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="NOMINAL" >
                        </tr>
                        <tr>
                           <th>Persen</th>
                           <td colspan="2"><input value="<?php echo $persen;?>" maxlength="3" size="30" type="text" id="nominal" placeholder="0" class="mata-uang form-control form-control-sm" onkeyup="inputTerbilang();" name="PERSEN" ></td>
                           <td align="left">% </td>
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