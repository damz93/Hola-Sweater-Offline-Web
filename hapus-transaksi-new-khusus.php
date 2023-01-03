<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$kode_transaksi   = $_POST['kode_transaksi'];
	$kode_akses = $_POST['kode_akses'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
	}
	else {
		$sql = mysqli_query($koneksi,"select * from t_akses WHERE KODE_AKSES='$kode_akses' AND STATUS='AKTIF'");
			$cek = mysqli_num_rows($sql);
			if ($cek>0){				
				$terpakai='TERPAKAI PADA TRANSAKSI: '.$kode_transaksi;
				$query="DELETE from t_transaksi_khusus where KODE_TRANSAKSI='$kode_transaksi'";
				mysqli_query($koneksi,"UPDATE `t_akses` SET `STATUS`='TIDAK AKTIF',KETERANGAN='$terpakai' WHERE KODE_AKSES='$kode_akses'");
				
				if (mysqli_query($koneksi, $query)) {
					echo "<script>alert('data terhapus');window.location.href='form-transaksi';</script>";
				} 
				else {
					echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
				}
			}
			else{
			//	echo "<script>alert('gagal menghapus, kode akses yang anda masukkan tidak valid...');window.location.href='form-transaksi';</script>";
				echo "<script>alert('gagal menghapus, kode akses yang anda masukkan tidak valid...');window.location.href='javascript:history.go(-1)';</script>";
			}
	}
?>