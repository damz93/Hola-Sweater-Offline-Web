<?php
error_reporting(0);
session_start();
if ($_SESSION['status'] != "login") {
    echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";
}
else if ($_SESSION['level'] == "OWNER" OR $_SESSION['level'] == "ADMIN" OR $_SESSION['level'] == "SPV ADMIN") {
    if (isset($_POST["view"])) {
        include("koneksi.php");
        if ($_POST["view"] != '') {
            $update_query = "UPDATE t_order SET SUDAH_LIHAT='SUDAH' WHERE SUDAH_LIHAT='BELUM'";
            mysqli_query($koneksi, $update_query);
        }
        $query  = "SELECT * FROM t_order WHERE STATUS='DONE' GROUP BY KODE_ORDER ORDER BY TGL DESC LIMIT 8";
        $result = mysqli_query($koneksi, $query);
        $output = '';
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $pathny = 'form-order-detail?kode_order=' . $row['KODE_ORDER'];
                $output .= '
                           <li>    
                            <a href="' . $pathny . '" target="_BLANK">
                             <strong>' . $row["KODE_ORDER"] . '</strong><br />
                             <small><em>' . $row["STATUS"] . '</em></small><br />
                             (<small><em>' . $row["WAKTU"] . '</em></small>)
                            </a>
                           </li>
                           <li class="divider"></li>
                           ';
            }
        } else {
            $output .= '<li><a href="#" class="text-bold text-italic">Tidak ada Notifikasi...</a></li>';
        }
        
        $query_1  = "SELECT * FROM t_order WHERE STATUS='DONE' AND SUDAH_LIHAT='BELUM' GROUP BY KODE_ORDER";
        $result_1 = mysqli_query($koneksi, $query_1);
        $count    = mysqli_num_rows($result_1);
        $data     = array(
            'notification' => $output,
            'unseen_notification' => $count
        );
        echo json_encode($data);
    }
} 
else {
}
?>