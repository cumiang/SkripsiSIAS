<?php

include "../koneksi.php";

$id = $_POST["id"];
$kategori = $_POST["kategori"];
//validasi
if (empty($id)) {
    echo "Data Tidak Dapat Ditampilkan";
} else {
    $sql = "SELECT * FROM t_arsip_surat WHERE kategori_arsip='$kategori' AND id_arsip='$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $data = mysql_fetch_row($kueri);
        echo $data[0]."|".$data[1]."|".$data[2]."|".$data[3]."|".$data[4]."|".$data[5];
    } else {
        echo "tidak ditemukan data";
    }
}
?>
