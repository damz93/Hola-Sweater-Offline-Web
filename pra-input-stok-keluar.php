<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Input Nomor Resi - S W E A T E R I N . M E</title>
      <link rel="shortcut icon" href="img/tokonline.png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/freelancer.min.css">
     <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
			function cek_kodeorder(){			   				
				var kode_transaksi = $("#kode_transaksi").val();
				if (kode_transaksi == ""){
				}
				else{
					$.ajax({
						url: 'list-kode-tkeluar.php',
						type: 'get',
						data     : 'kode_transaksi='+kode_transaksi,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);
							 $('#kode_transaksi2').val(obj.kode_transaksi);
							var kod1 = $('#kode_transaksi').val(); 
							var kod2 = $('#kode_transaksi2').val(); 
							if (kod1 == kod2){
								alert('Kode Transaksi sudah ada....');					
								document.getElementById("kode_transaksi").focus();	
								document.getElementById("kode_transaksi").value = ""; 
								document.getElementById("kode_transaksi2").value = "Kode transaksi sudah ada...."; 
							}
						}
					});
				}
			}					
		</script>	
	  <style>
		.box {
			 border-collapse: collapse;
			  width: 100%;
			  height: 100%;
		}
      </style>
      <script type="text/javascript">
         function cek_resi(){			   
			 var kode_transaksi = document.getElementById("kode_transaksi").value; 
			 var n = kode_transaksi.length;
			if (kode_transaksi==""){
				 alert('Scan Nomor Resi');	
				  document.getElementById("kode_transaksi").focus();
				  return false;
			}
			else if (n != 12){
				alert('Pastikan memasukkan nomor resi yang benar');	
				document.getElementById("kode_transaksi").focus();
				document.getElementById("kode_transaksi").value = ""; 
				 return false;
			}			
			else{
				return confirm('Lanjut ke input stok keluar?');         	 
         	}			
         }
      </script>
   </head>
   <body>
   <a style="background-color:#71b8e4;color:#FFFFFe" href="form-stok-keluar"> Kembali ke Data Stok Keluar </a><br>
      <div class="bg">
	   <form method="post" onsubmit="return cek_resi()" id="form_tampil" name="myff2" action="input-stok-keluar.php">
         <div class="table-responsive">
            <div class="form-group">
               <div class="container">
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <table border="0" class="box" cellpadding="2" cellspacing="2" align=center>
                     <div class="form-group">
                        <tr>
                           <td align="center">
                              <input align="middle" autofocus placeholder="Scan Nomor Resi" onkeyup="cek_kodeorder();" type="text" name="kode_transaksi" id="kode_transaksi" class="form-control form-control-lg">
                           </td>
                           <td hidden align="center">
                              <input type="text" readonly="readonly" id="kode_transaksi2" maxlength="8" name="kode_transaksi2" class="form-control form-control-sm" value="0">
                           </td>
						</tr>		
						<tr hidden>
							<td colspan="2"><button width="100%" type="submit" value="simpan" class="btn btn-info btn-lg btn-block">Proses</button></td>
						</tr>						
                     </div>
                  </table>
               </div>
            </div>
         </div>
      </form>
   </body>
</html>