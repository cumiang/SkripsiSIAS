<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Data Tidak Dapat Ditampilkan";
} else {
    $sql = "SELECT a.id_disposisi,c.no_surat_keluar_fk ,a.tgl_disposisi,
                   b.nama_user,a.isi_disposisi,a.catatan_disposisi
                   FROM t_disposisi_surat_masuk a
                   INNER JOIN t_user b
                   ON a.id_pendisposisi=b.id_user
                   INNER JOIN t_surat_masuk c
                   ON a.id_surat_masuk_fk=c.id_surat_masuk
                   WHERE id_disposisi='$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $data = mysql_fetch_row($kueri);
        echo $data[0]."|".$data[1]."|".$data[2]."|".$data[3]."|".$data[4]."|".$data[5];
    } else {
        echo "tidak ditemukan data";
    }
}
?>
