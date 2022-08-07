<?php               
   //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   error_reporting(0);
   session_start();
   include 'koneksi.php';
   $barang=mysqli_query($koneksi, "SELECT * FROM t_transaksi_temp");
   $jsArray = "var NAMA = new Array();\n"; 
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Input Transaksi - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>		
      <script type="text/javascript">
         function isi_otomatis(){			   
         var kode_barang = $("#kode_barang").val();
         $.ajax({
         url: 'list-ceknama.php',
         method: 'GET',
         data     : 'kode_barang='+kode_barang,
         }).success(function (data) {
         	 var json = data,
         	 obj = JSON.parse(json);
         	 $('#jenis_barang').val(obj.jenis_barang);
         	 $('#warna').val(obj.warna);
         	$('#size').val(obj.size);
         	$('#harga_satuan').val(obj.harga);
         	$('#qty').val("1");
         	var harga = $('#harga_satuan').val();
         	var potongan = $('#potonganxx').val();
         	var tambahan = $('#tambahan').val();
         	var kuannn = $('#qty').val();
         	var jenis = $('#jenis_barang').val();
         	var kuant = (obj.qty);		
         	var warna = $('#warna').val();
         	var size = $('#size').val();
         	var hargcost = $('#tambahan').val();
         	var semua = jenis+'-'+warna+'('+size+')';
         	$('#semua').val(semua); 
         	
         	//var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);			
         	var totaltanpa = (Number(harga) * Number(kuannn));			
         	var tot_tambahan = Number(kuannn) * Number(hargcost);
         	document.getElementById("tambahan").value = tot_tambahan;
         	var hasil = Number(totaltanpa);
         	document.getElementById('kuantitasxx').innerHTML = kuant;				
         	
         	$('#total').val(hasil); 
         	//var anuh = $('#total').val();
         	var anuh = $('#warna').val();
         	//alert(anuh);
         	
         if (anuh.length == 0){
         //	alert('Kode Barang yang discan belum diinput');
         	document.getElementById("kode_barang").focus();
         }
         else{
         	document.getElementById("qty").focus();	
         }
         }).autocomplete({
         source: "list-namabarang.php",
         });
         }
      </script>
	   <script type="text/javascript">
         function isi_harga(){			
			//alert('TESSS');
			var warnax = $("#warna").val();
			 var jenis_barangx = $("#jenis_barang").val();
			 var sizex = $("#size_").val();				
			 var qtyx = $("#qty1").val();			
			//alert(qtyx);
			 var total;
			 var hargasatuan;
			 var cek_harga;
			 if (jenis_barangx == 0){
				 //alert('hah kosong');
				 $('#total_biaya1').val('0');
				$('#harga_satuan').val('0');
			 }
			 else if (sizex == 0){
				 //alert('hah kosong');
				 $('#total_biaya1').val('0');
				$('#harga_satuan').val('0');
			 }
			 else if (warnax == 0){
				 //alert('hah kosong');
				 $('#total_biaya1').val('0');
				$('#harga_satuan').val('0');
			 }
			 else{
			$.ajax({
				 url: 'list-harga-barang.php',
				 method: 'GET',
				// data     : 'warna='+warnax,'jenis_barang='+jenis_barangx,'size_='+sizex,
				data: { warna : warnax,jenis_barang : jenis_barangx,size_ : sizex,type:"get"},
				 }).success(function (data) {
					  var json = data,
					 obj = JSON.parse(json);
					 $('#harga_satuan').val(obj.harga_satuan);	
					 cek_harga = obj.harga_satuan;
					hargasatuan = obj.harga_satuan;
							//alert('hohoh');
					total = (Number(hargasatuan) * Number(qtyx));
					if (cek_harga.val == 0){							
						//	$('#total_biaya1').val('0');
						//	$('#harga_satuan').val('0');
						//	alert('hohoh');
					}
					else{
						
						$('#total_biaya1').val(total);						
					}
					 
				 
				}).autocomplete({
					source: "list-harga-barang.php",
			 });
			 }
		 }
		</script>
	   <script type="text/javascript">
         function isi_costum(){			
			//alert('TESSS');
			var bahanx = $("#bahan").val();
			 var jenis_sweaterx = $("#jenis_sweater").val();	
			 var qty2x = $("#qty2").val();						
			 var total;
			 var hargasatuan;
			 
			 if (jenis_sweaterx == 0){
				 //alert('hah kosong');
				 $('#total_biaya1').val('0');
				$('#harga_satuan').val('0');
			 }
			 else if (bahanx == 0){
				 //alert('hah kosong');
				 $('#harga_costumm').val('0');
				$('#total_biaya2').val('0');
			 }
			else{
				$.ajax({
					 url: 'list-harga-costum.php',
					 method: 'GET',
					data: { bahanx : bahanx,jenis_sweaterx : jenis_sweaterx,type:"get"},
					 }).success(function (data) {
						  var json = data,
						 obj = JSON.parse(json);
						 $('#harga_costumm').val(obj.harga_satuan);	
						 hargasatuan = obj.harga_satuan;
						 total = (Number(hargasatuan) * Number(qty2x));
						 $('#total_biaya2').val(total);
					 
					}).autocomplete({
						source: "list-harga-barang.php",
				 });
			 }
		 }
		</script>
      <script type="text/javascript">
         function isi_promox(){			   
         var kode_promo = $("#kodiskxx").val();
         $.ajax({
         url: 'list-promo.php',
         method: 'GET',
         data     : 'kode_promo='+kode_promo,
         }).success(function (data) {
          var json = data,
          obj = JSON.parse(json);
          $('#potonganxx').val(obj.nominal);
         var diskon = $('#potonganxx').val(); 			
         if (diskon == ""){	
         	$('#potonganxx').val("0");	
         	alert('Kode Promo tidak Valid');		
         	document.getElementById("kodiskxx").focus();							
         }
         else{		
         	 
         }
         	var harga = $('#harga_satuan').val();
         	var tambahan = $('#tambahan').val();
         	var potongan = $('#potonganxx').val();
         	var kuannn = $('#qty').val(); 				
         	var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);
         	var hasil = Number(totaltanpa);
         	$('#total').val(hasil); 
         }).autocomplete({
         //source: "list-namabarang.php",
         });
         }
      </script> 
      <script type="text/javascript">
         function cek_costum(){			   
         var kode_costum = $("#kode_costum").val();
         $.ajax({
         url: 'list-costum.php',
         method: 'GET',
         data     : 'kode_costum='+kode_costum,
         }).success(function (data) {
          var json = data,
          obj = JSON.parse(json);
          //$('#kode_costum').val(obj.kode_costum);
          $('#jenis_costum').val(obj.jenis_costum);
         $('#tambahan').val(obj.harga);
         $('#harga_costumm').val(obj.harga);
         var harga = $('#harga_satuan').val();
         var tambahan = $('#tambahan').val();
         var potongan = $('#potonganxx').val();
         var kuannn = $('#qty').val(); 	
         //	var diskon = $('#diskon').val(); 
         //var potongan = $('#potongan').val(); 
         			
         		var hargcost = document.getElementById('harga_costumm').value;		
         		var tot_tambahan = Number(kuannn) * Number(hargcost);
         		document.getElementById("tambahan").value = tot_tambahan;
         
         
         var totaltanpa = (Number(harga) * Number(kuannn)) + (Number(tambahan)*Number(kuannn)) - Number(potongan);
         //	potongan = Number(potongan)*Number(kuannn);
         //var hasil = Number(totaltanpa) - (Number(totaltanpa)*(Number(diskon)/100)) - Number(potongan);
         var hasil = Number(totaltanpa);
         $('#total').val(hasil); 
         }).autocomplete({
         source: "list-namabarang.php",
         });
         }
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
         	$('#input_barang').on('click',function(){
         	$('#divxx').load('tampil-transaksi.php').fadeIn("slow");
         	var jenis_barangx = $('#jenis_barang').val();
         	var warnax = $('#warna').val();
         	var size_x = $('#size_').val();
         	var qty1 = $('#qty1').val();
			var qty1x = qty1.replace(".","");	
			var harga_satuan = $('#harga_satuan').val();
			var harga_satuanx = harga_satuan.replace(".","");	
			var total_biaya1 = $('#total_biaya1').val();
			var total_biaya1x = total_biaya1.replace(".","");	
			
				
				if(jenis_barangx==0){
					alert("Pilih Jenis Barang terlebih dahulu");
					document.getElementById("jenis_barang").focus();
					return false; 
				}
				else if(warnax==0){
					alert("Pilih Warna terlebih dahulu");
					document.getElementById("warna").focus();
					return false; 
				}
				else if(size_x==0){
					alert("Pilih Ukuran terlebih dahulu");
					document.getElementById("size_").focus();
					return false; 
				}
				else if (total_biaya1x==0){				 
				  alert("Tidak dapat menyimpan... Barang tersebut belum diinput");
				  return false; 
				  
			  }
			  else{
         		$.ajax({
         		  method: "POST",
         		  url: "simpan-transaksi1.php",
         		  data: { jenis_barangx : jenis_barangx,warnax : warnax,size_x : size_x, qty1x : qty1x,harga_satuanx : harga_satuanx,total_biaya1x : total_biaya1x,type:"insert"},					  
         		  success	: function(data){
         						document.getElementById("myForm").reset();									
         					},
         					error: function(response){
         						console.log(response.responseText);
         					}
         		});	
				alert('Data tersimpan di list');            		         	
				location.reload(true);	
				
			  }
			  
			   });
			
         });
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
         	$('#input_tambahan').on('click',function(){
         	$('#divxx').load('tampil-transaksi.php').fadeIn("slow");
         	var jenis_sweater = $('#jenis_sweater').val();
         	var bahan = $('#bahan').val();
         	var qty2 = $('#qty2').val();
			var qty2x = qty2.replace(".","");	
			var harga_costumm = $('#harga_costumm').val();
			var harga_costummx = harga_costumm.replace(".","");	
			var total_biaya2 = $('#total_biaya2').val();
			var total_biaya2x = total_biaya2.replace(".","");	
         		$.ajax({
         		  method: "POST",
         		  url: "simpan-transaksi2.php",
         		  data: { jenis_sweater : jenis_sweater,bahan : bahan,qty2x : qty2x,harga_costumm : harga_costumm,total_biaya2 : total_biaya2,type:"insert"},					  
         		  success	: function(data){
         						document.getElementById("myForm").reset();									
         					},
         					error: function(response){
         						console.log(response.responseText);
         					}
         		});	
         	alert('Data tersimpan di list');            		         	
         	location.reload(true);	
           });
         });
      </script>
     <script type="text/javascript">
	 /*
		totebag
qty_totbag
packing
biaya_pack
ongkir
biaya_ongkir
biaya_totbeg
total_biaya3
	 */
         $(document).ready(function(){
         	$('#input_totbeg').on('click',function(){
         	$('#divxx').load('tampil-transaksi.php').fadeIn("slow");
         	var totebagx = $('#totebag').val();
         	var qty_totbagx = $('#qty_totbag').val();
			qty_totbagx = qty_totbagx.replace(".","");	
			qty_totbagx = qty_totbagx.replace(".","");	
         	var packingx = $('#packing').val();
         	var biaya_packx = $('#biaya_pack').val();
			biaya_packx = biaya_packx.replace(".","");	
			biaya_packx = biaya_packx.replace(".","");	
         	var ongkirx = $('#ongkir').val();
         	var biaya_ongkirx = $('#biaya_ongkir').val();
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
         	var biaya_totbegx = $('#biaya_totbeg').val();
         	var biaya_totbeg1x = $('#biaya_totbeg1').val();
         	var total_biaya3x = $('#total_biaya3').val();				
         		$.ajax({
         		  method: "POST",
         		  url: "simpan-transaksi3.php",
         		  data: { biaya_totbeg1x:biaya_totbeg1x,qty_totbagx : qty_totbagx,biaya_totbegx : biaya_totbegx,biaya_packx : biaya_packx,biaya_ongkirx : biaya_ongkirx,type:"insert"},					  
         		  success	: function(data){
         						document.getElementById("myForm").reset();									
         					},
         					error: function(response){
         						console.log(response.responseText);
         					}
         		});	
         	alert('Data tersimpan di list');            		         	
         	location.reload(true);	
           });
         });
      </script>
	  
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
	  
	  
      <style type="text/css">
			#kiri{
				width:30%;				
				height: 450px;
				float:left;
			}
			#kanan{
				width:70%;
				height: 450px;
				float:right;
			}
		</style>
		<style>
			div.sc_kiri {  
				width: 350px;
				height: 450px;
				overflow-x: hidden;
				overflow-y: scroll;		
			}
			div.sc_kanan {  
				width: 920px;
				height: 450px;
				overflow-x: hidden;
				overflow-y: scroll;	
			}
		</style>
	  <script type="text/javascript">
		function cek_totbeg() {
			var biaya_packx = $('#biaya_pack').val();
			biaya_packx = biaya_packx.replace(".","");	
			biaya_packx = biaya_packx.replace(".","");	
			var biaya_ongkirx = $('#biaya_ongkir').val();		
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
			if (document.getElementById('totebag').checked) {
				//alert("checked");
				$('#qty_totbag').prop('readonly', false);
				$("#qty_totbag").focus();
				document.getElementById("qty_totbag").value = "1";
				var jenis = $('#totebag').val();
				//alert(jenis);
				 $.ajax({
				 url: 'list-totbeg.php',
				 method: 'GET',
				 data     : 'jenisx='+jenis,
				 }).success(function (data) {
					 //alert('tot');
					 var json = data,
					 obj = JSON.parse(json);
					 $('#biaya_totbeg1').val(obj.harga_satuan);			
					var qty_tbg = $('#qty_totbag').val();	
					//alert(qty_tbg);
					var biaya_totbegx = $('#biaya_totbeg1').val();					
					biaya_totbegx = Number(biaya_totbegx) * Number(qty_tbg);
					var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);			
					
					document.getElementById("biaya_totbeg").value = biaya_totbegx;						
					document.getElementById("total_biaya3").value = total_tambahan_lain;						
					
					$('#total').val(hasil); 
					//var anuh = $('#total').val();
					var anuh = $('#warna').val();
					//alert(anuh);
									 
				 }).autocomplete({
				 source: "list-totbeg.php",
				 });
				
				
				
			} else {
			//	alert("notcek");
				$('#qty_totbag').prop('readonly', true);
				document.getElementById("qty_totbag").value = "0";
				$('#biaya_totbeg').val("0");
				var biaya_totbegx = $('#biaya_totbeg').val();
				var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);								
				document.getElementById("total_biaya3").value = total_tambahan_lain;						
			}
		}
		function cek_packing() {
			var biaya_ongkirx = $('#biaya_ongkir').val();			
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
			biaya_ongkirx = biaya_ongkirx.replace(".","");	
			var biaya_totbegx = $('#biaya_totbeg').val();			
			biaya_totbegx = biaya_totbegx.replace(".","");	
			biaya_totbegx = biaya_totbegx.replace(".","");
			if (document.getElementById('packing').checked) {
				$('#biaya_pack').prop('readonly', false);
				$("#biaya_pack").focus();
				document.getElementById("biaya_pack").value = "1";
				
				var biaya_packx = $('#biaya_pack').val();
				var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);			
				document.getElementById("total_biaya3").value = total_tambahan_lain;			
				
			} else {
				$('#biaya_pack').prop('readonly', true);
				document.getElementById("biaya_pack").value = "0";
				var biaya_packx = $('#biaya_pack').val();
				var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);								
				document.getElementById("total_biaya3").value = total_tambahan_lain;	
			}
		}
		//packing biaya_pack - ongkir  -biaya_ongkir
		function cek_ongkir() {			
			var biaya_totbegx = $('#biaya_totbeg').val();					
			biaya_totbegx = biaya_totbegx.replace(".","");	
			biaya_totbegx = biaya_totbegx.replace(".","");
			var biaya_packx = $('#biaya_pack').val();				
			biaya_packx = biaya_packx.replace(".","");	
			biaya_packx = biaya_packx.replace(".","");
			if (document.getElementById('ongkir').checked) {				
				$('#biaya_ongkir').prop('readonly', false);
				$("#biaya_ongkir").focus();
				document.getElementById("biaya_ongkir").value = "1";
				
				var biaya_ongkirx = $('#biaya_ongkir').val();
				var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);			
				document.getElementById("total_biaya3").value = total_tambahan_lain;	
				
			} else {
				$('#biaya_ongkir').prop('readonly', true);
				document.getElementById("biaya_ongkir").value = "0";
				var biaya_ongkirx = $('#biaya_ongkir').val();
				var total_tambahan_lain = Number(biaya_packx) + Number(biaya_ongkirx) + Number(biaya_totbegx);								
				document.getElementById("total_biaya3").value = total_tambahan_lain;	
			}
		}
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
         else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="KASIR" AND $_SESSION['level']!="SPV KASIR"){
         	echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
         }
         ?>
      <p align='center' style="background-color:#71b8e4;color:#FFFFFe;font-size:30pt"><b>DATA TRANSAKSI</b></p>
      <p align='center' style="background-color:#1d7bb6;color:#FFFFee;font-size:20pt"><b>- S W E A T E R I N . M E -</b></p>
      <br>
      <a style="background-color:#71b8e4;color:#FFFFFe" href="form-transaksi.php"> Kembali ke Data Transaksi </a><br>
      <div id="kiri">
         <form method="post" id="myForm">
            <div class="table-responsive">
               <div class="form-group">
                     <div class="sc_kiri">
                        <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#sweater">Belanja Sweater</button>--><br>
                        <table border="0" class="table" cellpadding="2" cellspacing="2" align="center">
                           <tr>
                              <td>
                                 <a class="btn btn-info btn-lg btn-block panel-collapse collapse in" data-toggle="collapse" href="#sweater" role="button" aria-expanded="false" aria-controls="collapseExample">Belanja Sweater</a>									 
                                 <div id="sweater" class="panel-collapse collapse in">
                                    <table border="0" class="table" cellpadding="2" cellspacing="2" align="left">
                                       <tr>
                                          <td colspan=2>
                                             <input autofocus onkeyup="isi_otomatis()" placeholder="Scan Kode Barang"  type="text" id="kode_barang" class="form-control form-control-lg">
                                          </td>
                                       </tr>
                                       <tr hidden>
                                          <td colspan=2>
                                             <input placeholder="Jenis Barang" readonly="readonly" id="semua" class="form-control form-control-sm">
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Jenis Barang</th>
                                          <td>
                                             <select name="jenis_barang" id="jenis_barang" onchange="isi_harga();" class="form-control form-control-sm">
											 <option value="0">Pilih Jenis</option>
                                             <?php
                                                include "koneksi.php";
                                                $data = mysqli_query($koneksi,"select DISTINCT(JENIS_BARANG) FROM t_stok WHERE JENIS_BARANG<>'Totebag' and JENIS_BARANG<>'Custom Sablon DTF Only' ORDER BY JENIS_BARANG ASC");
                                                while($d = mysqli_fetch_array($data)){
                                                	$jen = $d['JENIS_BARANG'];
                                                	echo '<option value="'.$jen.'">'.$jen.'</option>';
                                                }							
                                                ?>
                                             </select>
                                          </td>
										</tr>
                                       <tr>
                                          <th>Warna</th>
                                          <td>
                                             <select name="warna" id="warna" onchange="isi_harga();" class="form-control form-control-sm">
												<option value="0">Pilih Warna</option>
                                             <?php
                                                include "koneksi.php";
												
                                                $data = mysqli_query($koneksi,"select DISTINCT(WARNA) FROM t_stok ORDER BY WARNA ASC");
                                                while($d = mysqli_fetch_array($data)){
                                                	$wrn = $d['WARNA'];
                                                	echo '<option value="'.$wrn.'">'.$wrn.'</option>';
                                                }							
                                                ?>
                                             </select>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Size</th>
                                          <td>
                                             <select name="size_" id="size_" onchange="isi_harga();" class="form-control form-control-sm">
											 <option value="0">Pilih Ukuran</option>
                                             <?php
                                                include "koneksi.php";
                                                $data = mysqli_query($koneksi,"select DISTINCT(SIZE_) FROM t_stok ORDER BY HARGA ASC");
                                                while($d = mysqli_fetch_array($data)){
                                                	$siz = $d['SIZE_'];
                                                	echo '<option value="'.$siz.'">'.$siz.'</option>';
                                                }							
                                               /* $harga = mysqli_query($koneksi,"select HARGA FROM t_stok WHERE JENIS_BARANG='$jen' AND WARNA='$wrn' AND SIZE_='$siz' ORDER BY SIZE_ ASC");
                                                while($d = mysqli_fetch_array($harga)){
                                                	$hargaa = $d[HARGA];
                                                }*/
                                                
                                                ?>
                                             </select>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th><label>Qty</label></th>
                                          <td><input value="1" type="text" id="qty1" class="form-control form-control-sm mata-uang" onkeyup="total_harga1();">
                                             <label hidden id="kuantitasxx" name="kuantitasxx" title="Jumlah STOK"></label>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>
                                             <label>Harga Satuan</label>
                                          </th>
                                          <td>
                                             <input value="0" type="text" class="form-control form-control-sm" id="harga_satuan" readonly="readonly">
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>
                                             <label>Total Biaya</label>
                                          </th>
                                          <td>
                                             <input value="0" type="text" class="form-control form-control-sm" id="total_biaya1" readonly="readonly">
                                          </td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td>
                                             <button  onclick="autofocuss()" value="simpan" name="input_barang" id="input_barang" class="btn btn-info btn-lg btn-block">Add to List</button>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <a class="btn btn-info btn-lg btn-block panel-collapse collapse in" data-toggle="collapse" href="#tambahan_" role="button" aria-expanded="false" aria-controls="collapseExample">Tambahan Costum</a>
								  <div id="tambahan_" class="panel-collapse collapse in">
                                    <table border="0" class="table" cellpadding="2" cellspacing="2" align="center">
                                       <tr hidden>
                                          <th><label>Costum</label></th>
                                          <td><input placeholder="Masukkan Kode Costum" type="text" id="kode_costum" name="kode_costum" class="form-control" onkeyup="cek_costum();"></td>
                                       </tr>
                                       <tr hidden>
                                          <td colspan=2>											
                                             <input value="Jenis Costum" type="text" id="jenis_costum" name="jenis_costum" class="form-control form-control-sm" readonly="readonly">
                                          </td>
                                       </tr>
                                       <tr>
                                          <th><label>Bahan</label></th>                                         
										  <td>
										  
                                             <select name="bahan" id="bahan" onchange="isi_costum();" class="form-control form-control-sm">
											 <option value="0">Pilih Bahan</option>
                                             <?php
                                                include "koneksi.php";
                                                $data = mysqli_query($koneksi,"select DISTINCT(BAHAN) FROM t_costum ORDER BY BAHAN ASC");
                                                while($d = mysqli_fetch_array($data)){
                                                	$bhn = $d['BAHAN'];
                                                	echo '<option value="'.$bhn.'">'.$bhn.'</option>';
                                                }							
                                                ?>
                                             </select>
                                          </td>
                                       </tr>
									   
                                       <tr>
                                          <th><label>Jenis Sweater</label></th>
										  <td>
                                             <select name="jenis_sweater" id="jenis_sweater" onchange="isi_costum();" class="form-control form-control-sm">
											 <option value="0">Pilih Jenis</option>
                                             <?php
                                                include "koneksi.php";
                                                $data = mysqli_query($koneksi,"select DISTINCT(JENIS_SWEATER) FROM t_costum ORDER BY JENIS_SWEATER ASC");
                                                while($d = mysqli_fetch_array($data)){
                                                	$jns = $d['JENIS_SWEATER'];
                                                	echo '<option value="'.$jns.'">'.$jns.'</option>';
                                                }							
                                                ?>
                                             </select>
                                          </td>
										  
                                       </tr>
									   <tr>
                                          <th><label>Qty</label></th>
                                          <td><input value="1" type="text" id="qty2" class="form-control form-control-sm mata-uang" onkeyup="total_harga2();">
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Harga Satuan</th>
                                          <td><input value="0" id="harga_costumm" name="harga_costumm" title="Harga Costum per Item" class="form-control form-control-sm" readonly="readonly">
                                          </td>
                                       </tr>
                                       <tr hidden>
                                          <th><label>Diskon</label></th>
                                          <td><input type="text" placeholder="Masukkan Kode Promo" onchange="isi_promox()" id="kodiskxx_" name="kodiskxx_" class="form-control"></td>
                                       </tr>
                                       <tr hidden>
                                          <th>Potongan</th>
                                          <td><input value="0" type="text" id="potonganxx_" class="form-control form-control-sm" readonly="readonly"></td>
                                       </tr>
                                       <tr>
                                          <th><label>Total Biaya</label></th>
                                          <td><input value="0" type="text" readonly="readonly" id="total_biaya2" class="form-control form-control-sm"></td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td>
                                             <button  onclick="autofocuss()" value="simpan" name="input_tambahan" id="input_tambahan" class="btn btn-info btn-lg btn-block">Add to List</button>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <a class="btn btn-info btn-lg btn-block panel-collapse collapse in" data-toggle="collapse" href="#totbegg" role="button" aria-expanded="false" aria-controls="collapseExample">Biaya Lain</a>
                                 <div id="totbegg" class="panel-collapse collapse in">
                                    <table border="0" class="table" cellpadding="2" cellspacing="2" align="center">
                                       <div class="form-check">
                                          <tr>
                                             <th colspan="2"><input onclick="cek_totbeg()" type="checkbox" id="totebag" name="totebag" value="Totebag"> Totebag</td>
                                          </tr>
                                          <tr>
                                             <th align="right">Qty
                                             </td>
                                             <td>
                                                <input readonly="readonly" onkeyup="total_harga3();" value="0" type="text" id="qty_totbag" class="form-control form-control-sm mata-uang">
                                             </td>
                                          </tr>
                                          <tr>
                                             <th colspan="2"><input type="checkbox" onclick="cek_packing()" id="packing" name="packing" value="Packing"> Packing</td>
                                          </tr>
										   <tr>
                                             <th align="right">Biaya
                                             </td>
                                             <td>
                                                <input readonly="readonly" value="0" type="text" id="biaya_pack" class="form-control form-control-sm mata-uang" onkeyup="total_harga3();">
                                             </td>
                                          </tr>
                                          <tr>
                                             <th colspan="2"><input type="checkbox" onclick="cek_ongkir()" id="ongkir" name="ongkir" value="Ongkir"> Ongkir</td>
                                          </tr>										  
										   <tr>
                                             <th align="right">Biaya
                                             </td>
                                             <td>
                                                <input readonly="readonly" value="0" type="text" id="biaya_ongkir" class="form-control form-control-sm mata-uang" onkeyup="total_harga3();">
                                             </td>
                                          </tr>
										  <tr hidden>
                                             <th align="left">Perpcs Totbeg
                                             </td>
                                             <td>
                                                <input value="0" type="text" id="biaya_totbeg1" readonly="readonly" class="form-control form-control-sm">
                                             </td>
                                          </tr>
										  <tr hidden>
                                             <th align="left">Biaya Totbeg
                                             </td>
                                             <td>
                                                <input value="0" type="text" id="biaya_totbeg" readonly="readonly" class="form-control form-control-sm">
                                             </td>
                                          </tr>
										  <tr>
                                             <th align="left">Total
                                             </td>
                                             <td>
                                                <input value="0" type="text" id="total_biaya3" readonly="readonly" class="form-control form-control-sm">
                                             </td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td>
                                                <button  onclick="autofocuss()" value="simpan" name="input_totbeg" id="input_totbeg" class="btn btn-info btn-lg btn-block">Add to List</button>
                                             </td>
                                          </tr>
                                       </div>
                                    </table>
                                 </div>
                                 <br>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <br>
                     <br>
                     <table hidden>
                        <tr align='center' width="50%">
                           <td width="50%">
                              <button onclick="autofocuss()" type="reset" class="btn btn-danger btn-lg btn-block">Batal</button>					   
                           </td>
                        </tr>
                     </table>
                  </div>
               
            </div>
         </form>
      </div>
      <script>
         function autofocuss() {
         	document.getElementById("kode_barang").focus();
         }
          
      </script>
      <script type="text/javascript">
         function total_diskon(){		  
         	var harga_biasa = document.getElementById('harga_biasa').value;
         	var harga_biasa = harga_biasa.replace(".","");			
         	var kuantitas = document.getElementById('kuantitas').value;
         	var tambahan = document.getElementById('tambahan').value;
         	var diskon = document.getElementById('diskon').value;				
         	var potongan = document.getElementById('potongan').value;				
         	var total_tanpadisk = parseInt(harga_biasa)*parseInt(kuantitas);
         	var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
         	potongan = Number(potongan)*Number(kuantitas);
         	//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
         	var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
         	//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
         //				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
         	document.getElementById("totalx").value = hasil;
         //	alert('Anda menekan tombol TAB');							
          }			   
          function totalnya(){		  
		   $('.mata-uang').mask('0.000.000.000', {reverse: true});
         	var harga_biasa = document.getElementById('harga_satuan').value;
         //	var harga_biasa = harga_biasa.replace(".","");			
         	var kuantitas = document.getElementById('qty').value;
         	var kuantitas = kuantitas.replace(".","");	
         	//var diskon = document.getElementById('diskon').value;				
         	var potongan = document.getElementById('potonganxx').value;				
         	var tambahan = document.getElementById('tambahan').value;				
         	//var potongan = document.getElementById('potongan').value;				
         	//var total_tanpadisk = parseInt(harga_biasa) * parseInt(kuantitas);					
         	
         	
         	var hargcost = document.getElementById('harga_costumm').value;		
         	var tot_tambahan = Number(kuantitas) * Number(hargcost);
         	document.getElementById("tambahan").value = tot_tambahan;
         	
         	var total_tanpadisk = (Number(harga) * Number(kuantitas)) + (Number(tambahan)*Number(kuantitas)) - Number(potongan);
         	//var hargcost = document.getElementById('harga_costumm').value;
         //	var diskon2 = parseInt(diskon) * parseInt(total_tanpadisk);
         //		potongan = Number(potongan)*Number(kuantitas);
         	//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100)) - parseInt(potongan);
         	var hasil = total_tanpadisk;
         	//var hasil = total_tanpadisk - (total_tanpadisk*(parseInt(diskon)/100));
         //				var hasil = total_tanpadisk - parseInt(potongan) - parseInt(diskon2);
         	document.getElementById("total").value = hasil;
         	alert('MANTAP');							
          }		
		  
		  
		   function total_harga1(){		  
         	var harga_biasa = document.getElementById('harga_satuan').value;         
			var qty1 = document.getElementById('qty1').value;
			if (qty1 == "")
			{
				document.getElementById("qty1").value="1";		
				qty1=1;
			}
			if (qty1 == "0")
			{
				document.getElementById("qty1").value="1";				
				qty1=1;
			}
			var total1 = Number(qty1) * Number(harga_biasa);
			document.getElementById("total_biaya1").value = total1;
		   }
          function total_harga2(){		  
         	var harga_costumm = document.getElementById('harga_costumm').value;         
			var qty2 = document.getElementById('qty2').value;
			if (qty2 == "")
			{
				document.getElementById("qty2").value="1";		
				qty2=1;
			}
			if (qty2 == "0")
			{
				document.getElementById("qty2").value="1";				
				qty2=1;
			}
			var total1 = Number(qty2) * Number(harga_costumm);
			document.getElementById("total_biaya2").value = total1;
		   }
          function total_harga3(){		  
			$('.mata-uang').mask('0.000.000.000', {reverse: true});
			var qty_totbag = document.getElementById('qty_totbag').value;
			qty_totbag = qty_totbag.replace(".","");	
			qty_totbag = qty_totbag.replace(".","");	
         	var biaya_totbeg = document.getElementById('biaya_totbeg1').value;     
			biaya_totbeg = biaya_totbeg.replace(".","");	
			biaya_totbeg = biaya_totbeg.replace(".","");	
			var biaya_pack =document.getElementById('biaya_pack').value;			
			biaya_pack = biaya_pack.replace(".","");	
			biaya_pack = biaya_pack.replace(".","");				
			var biaya_ongk = document.getElementById('biaya_ongkir').value;			
			biaya_ongk = biaya_ongk.replace(".","");	
			biaya_ongk = biaya_ongk.replace(".","");	
			if (document.getElementById('totebag').checked) {
				
				if (qty_totbag == "")
				{
					document.getElementById("qty_totbag").value="1";		
					qty_totbag=1;
				}
				else if (qty_totbag == "0")
				{
					document.getElementById("qty_totbag").value="1";				
					qty_totbag=1;
				}
			}
			if (document.getElementById('packing').checked) {
				if (biaya_pack == "")
				{
					document.getElementById("biaya_pack").value="1";		
					biaya_pack=1;
				}
				else if (biaya_pack == "0")
				{
					document.getElementById("biaya_pack").value="1";				
					biaya_pack=1;
				}
			}
			if (document.getElementById('ongkir').checked) {
				if (biaya_ongk == "")
				{
					document.getElementById("biaya_ongkir").value="1";		
					biaya_ongk=1;
				}
				else if (biaya_ongk == "0")
				{
					document.getElementById("biaya_ongkir").value="1";				
					biaya_ongk=1;
				}
			}
			var total1 = Number(biaya_totbeg) * Number(qty_totbag);
			var total2 = Number(total1) + Number(biaya_pack) +Number(biaya_ongk);
			document.getElementById("biaya_totbeg").value = total1;
			document.getElementById("total_biaya3").value = total2;
		   }
          
      </script>
      <div id="kanan">
         <div><?php include"tampil-transaksi.php"; ?>
         </div>
      </div>
      <script src="js/jquery-1.11.2.min.js"></script>
      <script src="js/jquery.mask.min.js"></script>
      <script src="js/terbilang.js"></script>
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
         function selectnya(){
          document.getElementById("opsi_kostum").focus();
         }			   
      </script>		
      <script type="text/javascript">
         function select(){			   
         document.getElementById("jenisx").focus();							
         }
      </script>
	  
   </body>
</html>