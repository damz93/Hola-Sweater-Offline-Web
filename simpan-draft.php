<?php
	error_reporting(0);
	session_start();   
	$olehnya = $_SESSION['username'];
	include 'koneksi.php';
   //include 'csrf.php';
    date_default_timezone_set('Asia/Hong_Kong');
    $waktu_skg2 = date("d/m/Y h:i:s A");
   	$tgl = date("Y/m/d");
   	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	//$data_dr = mysqli_query($koneksi,"SELECT ID,KODE_DRAFT FROM t_draft ORDER BY ID DESC LIMIT 1");
	
	if($_SESSION['status']!="login"){
				echo "<script>alert('Anda Harus Login untuk mengakses halaman ini');window.location.href='index.php?pesan=belum_login';</script>";
				//header("location:index.php?pesan=belum_login");
	}
	else{
		$data_dr = mysqli_query($koneksi,"SELECT MAX(`ID`) AS MAX FROM t_draft");
		
			while($d = mysqli_fetch_array($data_dr)){	
						//$jumdraft        = substr($d['KODE_DRAFT'],5);								
				$jumdraft        = $d['MAX'];								
			}			     
			if ($jumdraft == 0) {
				$kode_draft = "DRF-00001";
			}
			else{
				$jumdraft++;
				if (strlen($jumdraft)== 1){
					$kode_draft = "DRF-0000".$jumdraft;
				}
				else if (strlen($jumdraft)== 2){
					$kode_draft = "DRF-000".$jumdraft;
				}
				else if (strlen($jumdraft)== 3){
					$kode_draft = "DRF-00".$jumdraft;
				}
				else if (strlen($jumdraft)== 4){
					$kode_draft = "DRF-0".$jumdraft;
				}
				else{
					$kode_draft = "DRF-".$jumdraft;
				}
			}
			
			$sql = mysqli_query($koneksi,"select * from t_transaksi_temp WHERE OLEH='".$olehnya."' order by JENIS_BARANG,WARNA ASC");
			$cek = mysqli_num_rows($sql);
			
			if ($cek>0){
				while($d = mysqli_fetch_array($sql)){
					
					$kode_barang = $d['KODE_BARANG'];
					$jenis_barang = $d['JENIS_BARANG'];
					$size = $d['SIZE_'];
					$warna = $d['WARNA'];
					$harga_satuan = $d['HARGA'];				
					$kena = $d['KENA'];				
					$qty = $d['QTY'];				
					$total_harga = (int)$harga_satuan * (int)$qty;
					$total_harga2 = (int)$harga_satuan * (int)$qty;
					
					
					
					mysqli_query($koneksi,"INSERT INTO t_draft(KODE_DRAFT,KENA,KODE_BARANG,JENIS_BARANG,HARGA,QTY,TOTAL,TOTAL2,SIZE_,WARNA,KETERANGAN,WAKTU,TGL,OLEH)VALUES('$kode_draft','$kena','$kode_barang','$jenis_barang','$harga_satuan','$qty','$total_harga','$total_harga2','$size','$warna','$keterangan','$waktu_skg2','$tgl','$olehnya')");								
					//mysqli_query($koneksi,"DELETE FROM t_transaksi_temp where OLEH='".$olehnya."'");
				}
				
				
				 $sql2 = "DELETE FROM t_transaksi_temp where OLEH='".$olehnya."'";
				if (mysqli_query($koneksi, $sql2)) {
					echo "<script>alert('data tersimpan di draft');window.location.href='input-transaksi';</script>";
				}
				else {
					echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
				}	
			}
			else{
				echo "<script>alert('tidak ada data yang tersimpan di keranjang...');window.location.href='input-transaksi';</script>";
			}
	}
?>