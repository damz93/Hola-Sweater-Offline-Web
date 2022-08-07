<?php
   include 'koneksi.php';
   $id         = $_GET['id'];
   $user  = mysqli_query($koneksi, "select * from t_user where ID='$id'");
   $row        = mysqli_fetch_array($user);
   $level = $row['LEVEL'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit User - H O L A S W E A T E R</title>
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
				if($_SESSION['status']!="login"){
					echo "<script>alert('Anda belum login.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="SPV KASIR" AND $_SESSION['level']!="SPV KASIR"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
				}
		?>
         <h1 align='center' style="background-color:#71b8e4;color:#FFFFFe">EDIT USER</h1>
      <h3 align='center' style="background-color:#1d7bb6;color:#FFFFee">- S W E A T E R I N . M E -</h3>
         <div class='container'>
            <a style="background-color:#71b8e4;color:#FFFFFe" href="form-user.php"> [ Kembali ke Data User ]</a><br>
            <br>
            <form method="post" action="update-user.php" onsubmit="return confirm('Yakin ingin update?');">
               <div class="table-responsive">
                  <div class="form-group">
                     <div class="container">
                        <br>
                        <table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
                           <div class="form-group">
                              <tr>
                                 <th>Username</th>
                                 <th>&nbsp &nbsp <input readonly value="<?php echo $row['USERNAME'];?>" name="USERNAME" class="form-control form-control-sm"></th>
                              </tr>
                              <tr>
                                 <th>Nama Lengkap</th>
                                 <th>&nbsp &nbsp  <input autofocus maxlength="30" type="text" value="<?php echo $row['NAMA'];?>" name="NAMA_LENGKAP" class="form-control form-control-sm"></th>
                              </tr>
                              <tr>
                                 <th>Password</th>
                                 <th>&nbsp &nbsp <input type='password' maxlength="30" type="text" value="<?php echo $row['PASSWORD'];?>" name="PASSWORD" class="form-control form-control-sm"></th>
                              </tr>
                              <tr>
                                 <th>Level</th>
                                 <th>
                                    &nbsp &nbsp
                                    <select name="LEVELX" id="LEVELX" autofocus onchange="autofocus2()" autofocus class="form-control form-control-sm">
                                       <option value="KASIR" <?php if($level=="ADMIN") echo 'selected="selected"'; ?> >Kasir</option>
                                       <option value="SPV KASIR" <?php if($level=="SPV KASIR") echo 'selected="selected"'; ?> >SPV Kasir</option>
                                    </select>	
									
                                 </th>
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
         </div>
      </div>
   </body>
</html>