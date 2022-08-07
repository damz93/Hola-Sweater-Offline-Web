<?php
   //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   error_reporting(0);
     include 'koneksi.php';
     ?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">      
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
			$(document).ready(function(){
				$('#input').on('change',function(){
				var kode_barang = $('#kode_barang').val();
				var kode_transaksi = $('#kode_transaksi').val();
				var jenis_barang = $('#jenis_barang').val();
				var tambahan = $('#tambahan').val();
				var qty = $('#qty').val();
				var qty = qty.replace(".","");	
				var size = $('#size').val();
				var warna = $('#warna').val();
				var stokk = $('#kuantitasxx').text();
				if (kode_barang!=""){
					$.ajax({
					  method: "POST",
					  url: "simpan-stok-keluar.php",
					  data: { kode_transaksi : kode_transaksi, kode_barang : kode_barang, jenis_barang : jenis_barang, qty : qty, size : size, warna : warna,type:"insert"},
					  success	: function(data){
								//	$('#divxx').load('tampil_jual.php').fadeIn("slow");
									document.getElementById("myForm").reset();									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
					//alert('Data tersimpan di list');            		
				}				
				else if (Number(stokk)==0){
					//alert('Kode Barang belum diinput');
					//$('#kode_barang').val("");
				}	
				/*	
				else if (Number(qty)>Number(stokk)){
					//$('#kode_barang').val("");	
					//alert('Kode Barang belum diinput');
					$('#qty').val("1");						
					//document.getElementById("qty").focus();
					return false;
				}		*/				
			  });
			});
		</script>
		<script type="text/javascript">
			function cek_kodetransaksi(){			   
			var kode_transaksi = $("#kode_transaksi").val();
			$.ajax({
			url: 'list-kode-tkeluar.php',
			method: 'GET',
			data     : 'kode_transaksi='+kode_transaksi,
			}).success(function (data) {
			 var json = data,
			 obj = JSON.parse(json);
			 $('#kode_transaksi2').val(obj.kode_transaksi);
			 
			var kod1 = $('#kode_transaksi').val(); 
			var kod2 = $('#kode_transaksi2').val(); 
			if (kod1 == kod2){
				alert('Kode transaksi sudah ada....');					
				document.getElementById("kode_transaksi").focus();	
				document.getElementById("kode_transaksi2").value = "Kode transaksi sudah ada...."; 
				document.getElementById("kode_transaksi").value = "...."; 
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
           //var totharga = document.forms["myff2"]["totalhargaces"].value;
           var totharga = document.getElementById("totalhargaces2fix").textContent; 
           var totbay = document.getElementById("jumlah_pembayaran").value; 
           //var totharga = document.forms["myff2"]["totalhargaces"].value;
           //var totbay = document.forms["myff2"]["jumlah_pembayaran"].value;
           //var totbay = document.forms["myff2"]["jumlah_pembayaran"].value;  
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
           var kode_transaksi = document.getElementById("kode_transaksi").value; 
           if(kode_transaksi==""){
         	  alert('Masukkan Kode Transaksi');	
         	  document.getElementById("kode_transaksi").focus();
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
         width: 980px;
         height: 500px;
         overflow-x: hidden;
         overflow-y: scroll;	
         }
         div.ex4 {
         background-color: lightblue;
         width: 110px;
         height: 110px;
         overflow: visible;
         }
      </style>
      <script>
         /* $(document).ready(function($) {
           $('#qty').on('change', function(){
         	var parent = $(this).parent('.col').parent('.row');
         	var qty = $(parent).find('.id').find('input').val();
         	var total = $(parent).find('.name').find('input').val();
         	var kode_barang = $(parent).find('.city').find('input').val();
         	var attribChanged = $(this).attr('name');
         	data = {id: id, name: name, city: city, attribChanged: attribChanged};
         	$.post('getter.php', data, function(data){
         	  $(parent).html(data);
         	});
           });
         }); */
      </script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.btnaaa-danger').click(function() {
					var kode_barang = $(this).attr("id");
					if (confirm("Are you sure you want to delete this Item?")) {
						$.ajax({
							type: "POST",
							url: "hapus-stok-keluar-detail.php",
							data: ({
								kode_barang: kode_barang
							}),
							cache: false,
							success: function(html) {
								$(".delete_mem" + id).fadeOut('slow');
							}
						});
					} else {
						return false;
					}
				});
			});
		</script>
		<script type="text/javascript">
		  function delete_data(d){
			var kode_barang=d;		
			if (confirm("Are you sure you want to delete this Item?")) {			
				$.ajax({
				  type: "get",
				  url: "hapus-stok-keluar-detail.php",
				  data: {kode_barang:kode_barang},
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
			var kode_barang=d;		
			var qty = e;			
				$.ajax({
				  type: "get",
				  url: "update-stok-keluar-detail.php",
				  data: {kode_barang:kode_barang, qty:qty},
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
      <form method="post" onsubmit="return sebelum()" id="form_tampil" name="myff2" action="simpan-trkeluar.php">
         <div class="ex3">
         <div class="table-responsive">
         <div class="form-group">
            <div class="container">
               <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                  <thead align="center">
                     <tr align='center' class="table-info">
                        <th width="1%">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th width="10%">Qty</th>
                        <th width="3%">Aksi</th>
                     </tr>
                  </thead>
                  <?php 
                     session_start();
                     $oleh = $_SESSION['username'];
                     $no=1;
					 $kod_trs = $_POST['kode_transaksi'];
                     $harga3=0;
                     $totpcs=0;
					 $diskonnya = 0;
                     $aray = 0;
                     //$data = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."' order by WAKTU DESC");
                     $data = mysqli_query($koneksi,"select * from t_stok_keluar_temp where OLEH='".$oleh."' AND KODE_TRANSAKSI='".$kod_trs."' order by ID DESC");
                     while($d = mysqli_fetch_array($data)){
                     //$qty=number_format($d['QTY'],0,",",".");
                         $qty=$d['QTY'];                                     
                         $qtyno=$d['QTY'];                                     
                     $kod_bar = $d['KODE_BARANG'];
                     $jenbar = $d['JENIS_BARANG'];
					 $kode_transaksi = $d['KODE_TRANSAKSI'];
                     $warna = $d['WARNA'];
                     $size = $d['SIZE_'];
					 $barang = $jenbar."-".$warna."(".$size.")";
                     $satuan=number_format($d['HARGA'],0,",",".");
                     $tambah=number_format($d['HARGA_TAMBAHAN'],0,",",".");
                     $total=number_format($d['TOTAL'],0,",",".");
                     $harga3=$harga3+$d['TOTAL'];
                     $totpcs = $totpcs+$qtyno;
                     ?>
                  <tr align="center" class="delete_mem<?php echo $kod_bar; ?>">
                     <td><?php echo $no++; ?></td>
                     <td><?php echo $kod_bar; ?></td>
                     <td><?php echo $barang; ?></td>
                     <!--<td><input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="editurl('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5"></td>-->
                     <td><input style="text-align:center;" name="qty_<?php echo $kod_bar;?>" id="qty" onchange="update_data('<?php echo $kod_bar;?>', this.value);" value="<?php echo $qty; ?>" type="text" onclick="totalx()" class="form-control form-control-sm mata-uang" onkeyup="inputTerbilang();" maxlength="5"></td>
                     <td>
                        <!--<a href='update-transaksi-detail.php?kode_barang=<?php echo $kod_bar."&qty=".$qty; ?>' id="edit_<?php echo $kod_bar;?>" title="Edit Item" onclick="return confirm('Are you sure you want to update qty?')"><img src="img/edit.png" height="50%" ></a>-->
                       <!-- <a href='hapus-stok-keluar-detail.php?kode_barang=<?php echo $kod_bar; ?>' title="Delete Item" onclick="return confirm('Are you sure you want to delete?')"><img src="img/delete.png" height="50%" ></a>-->
                        <a class="btn btn-danger" onclick="delete_data('<?php echo $kod_bar; ?>')" title="Delete Item"><img src="img/delete.png" height="50%" ></a>
                     </td>
                  </tr>
                  <?php 
                     $aray++;
                                         }
                                         $harga5=number_format($harga3,0,",",".");	
                     $totpcs_tamp=number_format($totpcs,0,",",".");			
									$noooo = $no-1;
                                         ?>
                  <tr>
                     <td colspan="5" hidden>
                        <p align='right'>
                           <?php echo $totpcs_tamp."(qty)"; ?>
                        </p>
                     </td>
                  </tr>
               </table>
               <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                  <div class="form-group">
                     <tr>
                        <td colspan="4" align="right"></td>
                        <td><label hidden name="totalhargaces" id="totalhargaces"><?php echo $harga3; ?></label></td>
                        <td width="2%"></td>
                        <td>
                           <h6 align='right'><?php echo "Jumlah Barang yang berbeda = ".$noooo; ?></h6>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4" align="right"></td>
                        <td><label hidden name="totalhargaces" id="totalhargaces"><?php echo $harga3; ?></label></td>
                        <td width="2%"></td>
                        <td>
                           <h6 align='right'><?php echo "Total QTY= ".$totpcs_tamp; ?></h6>
                        </td>
                     </tr>
					 <tr hidden>
                        <td colspan="4" align="right"></td>
                        <td><label hidden name="totalhargaces" id="totalhargaces"><?php echo $harga3; ?></label></td>
                        <td width="2%"></td>
                        <td>
                           <h6 align='right'><?php echo "Total Harga Barang= Rp".$harga5; ?></h6>
                        </td>
                     </tr>
                     
                     <tr hidden>
                        <td colspan="6"	 align="right">
                           <h6>Kode Transaksi</h6>
                        </td>
                        <td align="left"><input type="text" placeholder="Input/Scan Kode Transaksi" value="<?php echo $kode_transaksi; ?>" id="kode_transaksi_" maxlength="8" name="kode_transaksi_" class="form-control form-control-sm">
						<input hidden type="text" placeholder="kode..." readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm">
                        </td>
                     </tr>
                     
                     <tr>
                        <td colspan="7">
                           <button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button>												
                        </td>
                     </tr>
               </table>
               </div>
            </div>
         </div>
      </form>
      <script type="text/javascript">
         function totalx(){		  
          $('.mata-uang').mask('0.000.000.000', {reverse: true});
         
           //mengambil data uang yang akan dirubah jadi terbilang
            //var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
         
            //menampilkan hasil dari terbilang
            //document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
            
         var total_barang = document.getElementById('totalhargaces').innerHTML;
         var ongkirr = document.getElementById('ongkir').value;
         var diskon = document.getElementById('nomdiskon').value;
         var ongkirr = ongkirr.replace(".","");
         if (ongkirr ==""){
         	document.getElementById("ongkir").value = "0";
         	ongkirr = 0;
         }		 
         var total = parseInt(total_barang)+parseInt(ongkirr)-parseInt(diskon);
         //var hemm = total.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
         //x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         document.getElementById("totalhargaces2fix").innerHTML = total;
         var hemm = total.toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         document.getElementById("totalhargaces2").innerHTML = "Total Harga= Rp"+hemm;		 	
         //  document.getElementById("totalhargaces").innerHTML = ";		 	                 
         }		         
      </script>
      <script>
         function editurl(kod_bar, qty) {
            var link = document.getElementById("edit_"+kod_bar);
           // link.setAttribute("href","update-transaksi-detail.php?kode_barang="+kod_bar+"&qty="+qty);	  
         var linkkk = "update-stok-keluar-detail.php?kode_barang="+kod_bar+"&qty="+qty;
         window.location.href = linkkk;
         }
      </script>
   </body>
</html>