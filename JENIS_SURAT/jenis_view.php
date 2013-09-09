<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Data Tidak Dapat Ditampilkan";
} else {
    $sql = "SELECT * FROM t_jenis_surat WHERE id_jenis='$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $data = mysql_fetch_row($kueri);
        echo $data[0].",".$data[1].",".$data[2].",".$data[3];
    } else {
        echo "tidak ditemukan data";
    }
}
?>
