<?php

    // melakukan koneksi 
    $connect = mysqli_connect("localhost","esanasto_damz","damzKU1993#$","esanasto_tokonline");

    //mengambil data 5 pesan terbaru 
    $sql = mysqli_query($connect, "SELECT * FROM t_pesan ORDER BY ID_PESAN DESC limit 5");
    $result = array();
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(array("result" => $data));
?>