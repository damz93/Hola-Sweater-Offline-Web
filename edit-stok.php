<?php
   include 'koneksi.php';
   $kode_barang         = $_GET['kode_barang'];
   $barang  = mysqli_query($koneksi, "select * from t_stok where KODE_BARANG='$kode_barang'");
   $row        = mysqli_fetch_array($barang);
   $harga=number_format($row['HARGA'],0,",",".");
   $keterrr=$row['NOTES'];
   $kena_p=$row['KENA'];
   $penanda=$row['PENANDA'];
   $qty=number_format($row['QTY'],0,",",".");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit Stok - H O L A S W E A T E R</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <link rel="shortcut icon" href="img/logo_ghm2.png">
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
         if ($_SESSION['status']!="login") {
			echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";
		}
		else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV KASIR" AND $_SESSION['level']!="SPV KASIR"){
			echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
		}
		else {
			
		}
      ?>
      <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT STOK</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
      <div class='container'>
         <a style="background-color:#71b8e4;color:#FFFFFe" href="form-stok"> [ Kembali ke Data Stok ]</a><br>
         <br>
         <form method="post" action="update-stok" onsubmit="return confirm('Yakin ingin update?');">
            <div class="table-responsive">
               <div class="form-group">
                  <div class="container">
                     <br>
                     <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                        <div class="form-group">
                           <tr>
                              <th>Penanda Barang</th>
                              <th colspan="2">
                                 <select onchange="autofocuss2()" autofocus class="form-control form-control-sm" name="penanda" id="penanda">                                    
                                    <option value="BIASA" <?php if($penanda=="BIASA") echo 'selected="selected"'; ?> >Biasa</option>
                                    <option value="KHUSUS" <?php if($penanda=="KHUSUS") echo 'selected="selected"'; ?> >Khusus</option>
                                 </select>
                              </th>
                           </tr>
                           <tr>
                              <th>Kode Barang</th>
                              <td colspan="2"><input readonly value="<?php echo $row['KODE_BARANG'];?>" name="KODE_BARANG" class="form-control form-control-sm"></td>
                           </tr>
                           <tr>
                              <th>Jenis Barang</th>
                              <td colspan="2"><input autofocus maxlength="30" class="form-control form-control-sm" type="text" value="<?php echo $row['JENIS_BARANG'];?>" name="JENIS_BARANG"></td>
                           </tr>
                           <tr>
                              <th>Size</th>
                              <td colspan="2"><input class="form-control form-control-sm" maxlength="30" type="text" value="<?php echo $row['SIZE_'];?>" name="SIZE"></td>
                           </tr>
                           <tr>
                              <th>Warna</th>
                              <td colspan="2"><input class="form-control form-control-sm" autofocus maxlength="30" type="text" value="<?php echo $row['WARNA'];?>" name="WARNA"></td>
                           </tr>
                           <tr>
                              <th>Harga Satuan</th>
                              <td width="1%">Rp</td>
                              <td><input class="form-control form-control-sm mata-uang" type="text" id="harga" onkeydown="myFunction();" onkeyup="inputTerbilang();" name="HARGA"  value="<?php echo $harga;?>" ></td>
                           </tr>
                           <tr>
                              <th>Stok Sekarang</th>
                              <td colspan="2">   <input readonly type='text' id="terbilang-input" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5" value="<?php echo $row['QTY'];?>" name="QTY"> </td>
                           </tr>
                           <tr>
                              <th>Qty Penambahan</th>
                              <td colspan="2">   <input type='text' id="terbilang-input" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5" value="1" name="QTY2"> </td>
                           </tr>
						   
						   <tr hidden>
                              <th>Keterangan</th>
                              <td colspan="2">
                                 <select name="KETERANGAN" id="KETERANGAN" class="form-control form-control-sm" >
                                    <option value="ADMIN" <?php if($keterrr=="ADMIN") echo 'selected="selected"'; ?> >Admin</option>
                                    <option value="GUDANG" <?php if($keterrr=="GUDANG") echo 'selected="selected"'; ?> >Gudang</option>
                                 </select>
                              </td>
                           </tr>
						   
                           <tr>
                              <th>Kena Potongan</th>
                              <th colspan="2">
                                 <select onchange="autofocuss2()" autofocus class="form-control form-control-sm" name="kena_p" id="kena_p">
                                    <option value="YA" <?php if($kena_p=="YA") echo 'selected="selected"'; ?> >Ya</option>
                                    <option value="TIDAK" <?php if($kena_p=="TIDAK") echo 'selected="selected"'; ?> >Tidak</option>
                                 </select>
                              </th>
                           </tr>
                           <tr align='center'>
                              <td colspan="3"><button type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Update</button></td>
                           </tr>
                        </div>
                     </table>
                  </div>
               </div>
            </div>
         </form>
         <script src="js/jquery-1.11.2.min.js"></script>
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
      </div>
   </body>
</html>