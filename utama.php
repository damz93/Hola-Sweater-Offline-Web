<?php
   include "koneksi.php";
   ?>
<!DOCTYPE html>
<html>
   <head>
      <script data-ad-client="ca-pub-5256228815542923" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Menu Utama - H O L A S W E A T E R</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/freelancer.min.css">
      <link rel="shortcut icon" href="img/tokonline.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
    <style>
			body, html {
				height: 100%;
				margin: 0;
				background-image: url("img/bg_.png");
			}
			.bg {
				/* The image used */
				//background-image: url("img/bg_.png");			
				background: #244062;		
				/* Full height */
				height: 80%; 
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
	<style>
			.header {
			padding: 10px;
			text-align: center;
			background: #244062;		
			height: 20%;
			color:#FFFFFe;
			}
		</style>	
		
	<style>
		img {
		  opacity: 0.8;
		}

		img:hover {
		  opacity: 1.0;
		}
	  </style>
   </head>
   <body>   
			<?php 
				error_reporting(0);
				session_start();					
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";                    
				}
				else{
					date_default_timezone_set('Asia/Hong_Kong');
					 function formatTanggal($date){
						 return date('d-M-Y', strtotime($date));
					}	
						$tgl_saja = date("Y/m/d");
						$tgl = formatTanggal($tgl_saja);  						
				        $hari = date('l', strtotime($tgl_saja));
						$tgl = date('d F Y');
				        $semua = $hari.", ".$tgl;
				}
			?>   
			<div class="header">
			 <table style="width:100%;height:100%" border="0" class="" cellpadding="2" cellspacing="2" align="center">
                     <tr style="height:25%">
						<td style="width:50%" valign="middle" align="left">							
						    <table style="width:50%;height:20%" border="0" cellpadding="2" cellspacing="2" align="left">
								<tr>
									<td style="width:10%;" valign="middle" align="left" rowspan="2">
										 <img src="https://i.pinimg.com/originals/e9/89/a9/e989a9eac79019722ce0c3a7d877bee1.png" class="responsive" style="width:80%;display: block; margin: auto;">
									</td>
									<td style="width:40%;" valign="bottom" align="left">
										<h6>&nbsp
											<?php	echo $_SESSION['level']; ?>
										</h6>
									</td>
								</tr>
								<tr>
									<td style="width:40%;" valign="top" align="left">
										<h5><b>&nbsp
											<?php	echo $_SESSION['nama_lengkap']; ?>
										</b></h5>
									</td>
								</tr>
								<tr hidden>
									<td  colspan="2" style="width:15%;" valign="bottom" align="center">
										<div class="progress">
											<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td  colspan="2" style="width:15%;" valign="bottom" align="left">
										<h5>&nbsp
											<?php	echo $semua; 
											?>
										</h5>
									</td>
								</tr>
							</table>
						   
						 </td>
						<td style="width:50%" valign="top" align="right">
                            <table style="width:30%;height:20%" border="0" cellpadding="2" cellspacing="2" align="right">
								<tr>
									<td style="width:15%;" align="center">
										<a href="logout" style="color:#FFFFFe"><button type="button" style="width:100%;" class="btn btn-danger">Logout </button></a>
									</td>
									<td style="width:15%;" align="center">
										<a href="form-user" style="color:#FFFFFe"><button type="button" style="width:100%;" class="btn btn-primary"> User </button></a></td>
								</tr>
								
							</table>
						 </td>
					 </tr>
					 
			</table>				
		</div>
      <div class="bg">
         <div class="main">
            <div class="main-content">
               <div align="center" class="table-responsive"><img align="center" src="img/logo_hola.png" width="300" height="auto"><br><br>
                  <table style="width:100%;height:100%" border="0" class="" cellpadding="2" cellspacing="2" align="center">
                     <tr style="height:25%">
                        <td style="width:10%" valign="center" align="center">
                           <a href="input-transaksi-khusus" title="Data Transaksi Khusus">
                              <img src="img/sales_s.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5 style="color:#FFFFFe"><b>TRANSAKSI KHUSUS</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:10%" valign="center" align="center">
                           <a href="input-transaksi" title="Input Transaksi">
                              <img src="img/sales.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5 style="color:#FFFFFe"><b>TRANSAKSI</b></h5>
                              </figcaption>
                           </a>
                        </td>
						<td style="width:10%" valign="center" align="center">
                           <a href="form-pengeluaran" title="Data Pengeluaran">
                              <img src="img/spending.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5 style="color:#FFFFFe"><b>PENGELUARAN</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:10%" valign="center" align="center">
                           <a href="form-stok" title="Data Stok">
                              <img src="img/product.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                <h5 style="color:#FFFFFe"><b>DATA BARANG</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td hidden style="width:16%" valign="center" align="center">
                           <a href="form-costum" title="Data Order">
                              <img src="img/order.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                 <h5 style="color:#FFFFFe"><b>DATA COSTUM</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:10%" valign="center" align="center">
                           <a href="form-diskon" title="Data Diskon">
                              <img src="img/discount.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                <h5 style="color:#FFFFFe"><b>DISKON</b></h5>
                              </figcaption>
                           </a>
                        </td>
                        <td style="width:10%" valign="center" align="center">
                           <a href="form-laporan" title="Data Report">
                              <img src="img/report.png" class="responsive"style="display: block; margin: auto;">
                              <figcaption class="figure-caption" align='center'>
                                <h5 style="color:#FFFFFe"><b>SUMMARY</b></h5>
                              </figcaption>
                           </a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>     
   </body>
</html>