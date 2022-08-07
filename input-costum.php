<?php
   include 'koneksi.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Tambah Costum - S W E A T E R I N . M E</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="shortcut icon" href="img/tokonline.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="js/bootstrap-datepicker.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
      <script type="text/javascript">
         $(document).ready(function(){
         	$('#input').on('click',function(){
         	var bahan = $('#bahan').val();
         	if (bahan!=""){
         		$.ajax({
         		  method: "POST",
         		  url: "simpan-bahan.php",
         		  data: { bahan : bahan,type:"insert"},
         		  success	: function(data){
         						//document.getElementById("myForm").reset();									
         						location.reload(true);		
         						alert('Data tersimpan');            	
         					},
         					error: function(response){
         						console.log(response.responseText);
         					}
         		});							
         	}				
         	else{
         		alert('Bahan Kosong...');
         		document.getElementById("bahan").focus();
         	}	
           });
         });
      </script>
   </head>
   <body>
      <div class="bg">
      <?php 
         error_reporting(0);
             session_start();	
         if($_SESSION['status']!="login"){
         	echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
         }
         else if (($_SESSION['level']!="OWNER") AND ($_SESSION['level']!="SPV KASIR")){
         	echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
         ?>
	  <p align='center' style="background-color:#71b8e4;color:#FFFFFe;font-size:30pt"><b>TAMBAH COSTUM</b></p>
      <p align='center' style="background-color:#1d7bb6;color:#FFFFee;font-size:20pt"><b>- S W E A T E R I N . M E -</b></p>
      <div class='container'>
         <a style="background-color:#71b8e4;color:#FFFFFe" href="form-costum"> [ Kembali ke Data Costum ]</a><br>        
         <br>
         <form method="post" action="simpan-costum.php" onsubmit="return confirm('Yakin ingin simpan?');">
            <div class="table-responsive">
               <div class="form-group">
                     <br>
                     <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">
                           <tr>
                              <th>Kode Costum</th>
                              <td colspan="3"><input autofocus maxlength="60" type="text" class="form-control form-control-sm" id="KODE_COSTUM" name="KODE_COSTUM" placeholder="KODE COSTUM"> </td>
                           </tr>
                           <tr>
                              <th>Jenis Sweater</th>
                              <td colspan="3"> 
                                 <select name="JENIS_SWEATER" id="JENIS_SWEATER" class="form-control form-control-sm">
                                 <?php
                                    include "koneksi.php";
                                    $data = mysqli_query($koneksi,"select DISTINCT(JENIS_BARANG) FROM t_stok WHERE JENIS_BARANG<>'Totebag' ORDER BY JENIS_BARANG ASC");
                                    while($d = mysqli_fetch_array($data)){
                                    	$jen = $d['JENIS_BARANG'];
                                    	echo '<option value="'.$jen.'">'.$jen.'</option>';
                                    }							
                                    ?>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <th>Bahan</th>
                               <td colspan="2"> 
                                 <select  class="form-control form-control-sm" name="BAHANX" id="BAHANX" autofocus>                        
                                 <?php
                                    include "koneksi.php";
                                    $data = mysqli_query($koneksi,"select BAHAN from t_bahan order by BAHAN ASC");
                                    while($d = mysqli_fetch_array($data)){
                                    	$kat = $d['BAHAN'];
                                    	echo '<option value="'.$kat.'">'.$kat.'</option>';
                                    }							
                                    ?>
                                 </select>						
                              </td>
                              <td width="10%" align="left"> <a href="#"><img src="img/plus.png" width="40" height="40" data-toggle="modal" data-target="#contact-modal2"></a></td>
                           </tr>
                           <tr>
                              <th>Keterangan</th>
                              <td colspan="3"> <input id="keterangan"  placeholder="KETERANGAN" class="form-control form-control-sm" maxlength="80" type="text" name="KETERANGAN">  </td>
                           </tr>
                           <tr>
                              <th>Harga</th>
                              <td width="1%">Rp</td>
                              <td align="left" width="60%" colspan="2"><input type="text" id="harga" placeholder="0" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" name="HARGA" >
                           </tr>
                           <tr>
                              <th>Status</th>
                              <td colspan="3">
                                 <select name="STATUSX" id="STATUSX" class="form-control form-control-sm">
                                    <option value="AKTIF" selected>Aktif</option>
                                    <option value="NON AKTIF">Non AKtif</option>
                                 </select>
                              </td>
                           </tr>
                           <tr align='center'>
                              <br>
                              <td colspan="2"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Simpan</button></td>
                              <td colspan="2">
                                 <button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>
                              </td>
                           </tr>
                        </div>
                     </table>
               </div>
            </div>
         </form>
         <!-- <script src="js/jquery-1.11.2.min.js"></script>-->
         <script src="js/jquery.mask.min.js"></script>
         <script src="js/terbilang.js"></script>
         <script>
            function autofocuss() {
            	document.getElementById("KODE_COSTUM").focus();
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
      <div id="contact-modal2" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h3>Tambah Bahan</h3>
               </div>
               <table id="tabel1" class="table table-striped" border="1" cellpadding="0" cellspacing="1">
                  <tr align='center' class="table-info">
                     <td align='center'>NO.</th>
                     <td align='center'>BAHAN</th>
                     <td align='center'>AKSI</th>
                  </tr>
                  <?php
                     include "koneksi.php";
                     $no=1;
                     $data = mysqli_query($koneksi,"select ID,BAHAN from t_bahan order by BAHAN ASC");
                     	while($d = mysqli_fetch_array($data)){
                     $id = $d['ID'];
                     	
                     ?>
                  <tr align="center">
                     <td><?php echo $no++; ?></td>
                     <td align="left"><?php echo $d['BAHAN']; ?></td>
                     <td align="center"> <a href='hapus-bahan?id=<?php echo $id; ?>' title="Delete Bahan" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a><?php } ?></td>
                  </tr>
               </table>
               <form id="contactForm" name="contact" role="form">
                  <div class="modal-body">
                     <div class="form-group">
                        <label for="name">Bahan</label>
                        <input type="text" name="bahan" id="bahan" placeholder="Masukkan nama bahan" onchange="cek_kat();" class="form-control">                        
                        <input hidden readonly="readonly" type="text" value="0" id="kategoriy2" name="kategoriy2">
                     </div>
                  </div>
                  <div class="modal-footer">					
                     <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                     <button  value="simpan" name="input" id="input" class="btn btn-success">Tambah</button>	
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>