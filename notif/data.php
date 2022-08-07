<?php

    // melakukan koneksi 
    $connect = mysqli_connect("localhost","esanasto_damz","damzKU1993#$","esanasto_tokonline");
    
    //menghitung jumlah pesan dari tabel pesan
    $query= mysqli_query($connect, "Select Count(ID_PESAN) as jumlah From t_pesan");
    
    //menampilkan data
    $hasil = mysqli_fetch_array($query);
    
    //membuat data json
    echo json_encode(array('jumlah' => $hasil['jumlah']));
    
?>