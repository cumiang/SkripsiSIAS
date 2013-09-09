<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Data Tidak Dapat Ditampilkan";
} else {
    $sql = "SELECT * FROM t_kop_surat WHERE id_kop='$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $data = mysql_fetch_row($kueri);
        echo $data[0].",".$data[1].",".$data[2].",".$data[3].",".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9];
    } else {
        echo "tidak ditemukan data";
    }
}
?>
