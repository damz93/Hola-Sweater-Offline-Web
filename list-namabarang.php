<?php       
	error_reporting(E_ERROR);
	include "koneksi.php";
	$q = mysqli_query($koneksi,'SELECT * FROM `t_stok`');
	//get search term
	$searchTerm = $_GET['term'];
	//get matched data from skills table
	$query =mysqli_query($koneksi,"SELECT * FROM t_stok WHERE KODE_BARANG LIKE '%".$searchTerm."%' ORDER BY KODE_BARANG ASC");
	while ($row = $query->fetch_assoc()) {
	   $data[] = $row['KODE_BARANG'];
	}
	//return json data
	echo json_encode($data);
?>