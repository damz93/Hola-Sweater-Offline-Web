<?php
   //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   error_reporting(0);
   include 'koneksi.php';
   ?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>    
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
      <script type="text/javascript">
         function cek_kodeorder(){              
         
         var kode_order = $("#kode_order").val();
         $.ajax({
         url: 'list-kode-order.php',
         method: 'GET',
         data     : 'kode_order='+kode_order,
         }).success(function (data) {
          var json = data,
          obj = JSON.parse(json);
          $('#kode_order2').val(obj.kode_order);
         
         var kod1 = $('#kode_order').val(); 
         var kod2 = $('#kode_order2').val(); 
         if (kod1 == kod2){
             alert('Kode Order sudah ada....');                    
             document.getElementById("kode_order").focus();    
             document.getElementById("kode_order2").value = "Kode transaksi sudah ada...."; 
         }
         }).autocomplete({
         //source: "list-namabarang.php",
         });
         }
      </script>
      <script>
         function aa() {
             //<form method="post" action="simpan_barang.php" onsubmit="return confirm('Yakin ingin simpan?');">
             //var str = document.getElementById("demo").innerHTML; 
           //var res = str.replace("Microsoft", "W3Schools");
           //document.getElementById("demo").innerHTML = res;
           //var totharga = document.forms["myForm"]["totalhargaces"].value;
           var totharga = document.getElementById("totalhargaces2fix").textContent; 
           var totbay = document.getElementById("jumlah_pembayaran").value; 
           //var totharga = document.forms["myForm"]["totalhargaces"].value;
           //var totbay = document.forms["myForm"]["jumlah_pembayaran"].value;
           //var totbay = document.forms["myForm"]["jumlah_pembayaran"].value;  
           //alert('total bayar---------: '+ totbay);    
           if(totbay==""){
               alert('Masukkan jumlah pembayaran');    
               document.getElementById("jumlah_pembayaran").focus();
               return false;
           }
             else{
                 var totbay2 = totbay.replace(".","");  
                 var totbay2 = totbay2.replace(".","");  
               if (parseInt(totbay2)<parseInt(totharga)) {        
                 alert("Jumlah pembayaran kurang");
                 document.getElementById("jumlah_pembayaran").focus();
                 return false;
               }
               else{
                   return confirm('Yakin ingin simpan?');
               }//action="cetak_jual.php"
             }
         }
         
      </script> 
      <script>
         function sebelum() {                        
           var resi = document.getElementById("kode_order").value; 
           if(resi==""){
               alert('Masukkan Kode Resi');    
               document.getElementById("kode_order").focus();
               return false;
           }
             else{
                return confirm('Yakin ingin simpan?');              
             }
         }
         
      </script>
      <style>
         div.ex1 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: scroll;
         }
         div.ex2 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: hidden;
         }
         div.ex3 {  
         width: 1024px;
         height: 500px;
         overflow: auto;
         }
         div.ex4 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: visible;
         }
      </style>
      <script type="text/javascript">
         function delete_data(d){
           var notes=d;        
           if (confirm("Are you sure you want to delete this Item?")) {            
               $.ajax({
                 type: "get",
                 url: "hapus-order-detail.php",
                 data: {notes:notes},
                 success: function(value){
                   //$("#data_table").html(value);
                    location.reload(true);
                   //document.getElementById("form_tampil").reset();        
                 }
               });
           }
           else{
               return false;
           }
         }
      </script>
      <script type="text/javascript">
         function update_data(d, e){
             //alert ("jalanjikahh");
           var notes=d;        
           var qty = e;            
               $.ajax({
                 type: "get",
                 url: "update-order-detail.php",
                 data: {notes:notes, qty:qty},
                 success: function(value){
                   //$("#data_table").html(value);
                    location.reload(true);
                   //document.getElementById("form_tampil").reset();        
                 }
               });
         }
      </script>
   </head>
   <body>
      <form method="post" onsubmit="return sebelum()" name="myForm" action="simpan-orderr.php">
         <div class="ex3">
         <div class="table-responsive">
            <div class="form-group">
               <div class="container">
                  <br>
                  <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <thead align="center">
                           <tr align='center' class="table-info">
                              <th width="1%">No</th>
                              <th>Jenis Costum</th>
                              <th>Opsi Costum</th>
                              <th>Notes</th>
                              <th width="10%">Qty</th>
                              <th width="3%">Aksi</th>
                           </tr>
                        </thead>
                        <?php
                           session_start();
                           $oleh   = $_SESSION['username'];
						   $kod_trs = $_POST['kode_order'];
                           $no     = 1;
                           $harga3 = 0;
                           $totpcs = 0;
                           $data   = mysqli_query($koneksi, "select * from t_order_temp where OLEH='" . $oleh . "' AND KODE_ORDER='".$kod_trs."' ORDER BY ID DESC");
                           while ($d = mysqli_fetch_array($data)) {
                               $qty            = number_format($d['QTY'], 0, ",", ".");
                               $jenkos         = $d['JENIS_COSTUM'];
                               $kode_transaksi = $d['KODE_ORDER'];
                               $opskos         = $d['OPSI_COSTUM'];
                               $notes          = $d['NOTES'];
                               $totpcs         = $totpcs + $qty;
                           ?>
                        <tr align="center">
                           <td><?php
                              echo $no++;
                              ?></td>
                           <td><?php
                              echo $jenkos;
                              ?></td>
                           <td><?php
                              echo $opskos;
                              ?></td>
                           <td><?php
                              echo $notes;
                              ?></td>
                           <!-- <td><input style="text-align:center;" name="qty_<?php
                              echo $kod_bar;
                              ?>" id="qty" onchange="editurl('<?php
                              echo $notes;
                              ?>', this.value);" value="<?php
                              echo $qty;
                              ?>" type="text" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5"></td>-->
                           <td><input style="text-align:center;" name="qty_<?php
                              echo $notes;
                              ?>" id="qty" onchange="update_data('<?php
                              echo $notes;
                              ?>', this.value);" value="<?php
                              echo $qty;
                              ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5"></td>
                           <td>
                              <!--<a href='hapus-order-detail.php?notes=<?php
                                 echo $d['NOTES'];
                                 ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="100%" ></a>-->
                              <a class="btn btn-danger" onclick="delete_data('<?php
                                 echo $d['NOTES'];
                                 ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
                           </td>
                        </tr>
                        <?php
                           }
                           $harga5 = number_format($harga3, 0, ",", ".");
                           ?>
                        <tr>
                           <td colspan="6">
                              <p align='right'>
                                 <?php
                                    echo $totpcs . "(qty)";
                                    ?>
                              </p>
                           </td>
                        </tr>
                        <tr hidden>
                           <td colspan="3" align="right">
                              <h6>Scan/ Input Kode Resi Shope</h6>
                           </td>
                           <td align="left"><input type="text" placeholder="Input/Scan Kode Transaksi" value="<?php
                              echo $kode_transaksi;
                              ?>" id="kode_transaksi_" maxlength="8" name="kode_transaksi_" class="form-control form-control-sm"><input hidden readonly="readonly" type="text" value="0" id="kode_order2" class="form-control form-control-sm" maxlength="20" name="kode_order2"></td>
                        </tr>
                        <tr>
                           <td colspan="3" align="right">
                              <h6>Status</h6>
                           </td>
                           <td align="right" colspan="3">
                              <select name="status" id="status" class="form-control form-control-sm" onchange="selectnya2x()">
                                 <option value="DESIGNER" selected>Proses Ke Designer</option>
                                 <option value="GUDANG">Proses Ke Gudang</option>
                              </select>
                           </td>
                        </tr>
                        <tr align='right'>
                           <td colspan="6">
                              <button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>                                                
                           </td>
                        </tr>
                     </div>
                  </table>
               </div>
            </div>
         </div>
      </form>
      <script type="text/javascript">
         function selectnya2x(){
          document.getElementById("ongkir").focus();
         }              
      </script>
      <script>
         function editurl(kod_bar, qty) {
            var link = document.getElementById("edit_"+kod_bar);
           // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);      
         var linkkk = "update-order-detail.php?notes="+kod_bar+"&qty="+qty;
         window.location.href = linkkk;
         }
      </script>
   </body>
   </body>
</html>