<?php

include "../koneksi.php";

$id = $_POST["id"];
$penerima = $_POST["penerima"];

if (isset($id) && isset($penerima)) {
    $sql = "UPDATE t_surat_keluar SET status='Terkirim' WHERE no_surat_keluar='$id'";
    $sql3 = "UPDATE t_surat_masuk SET status='Belum Terbaca' WHERE no_surat_keluar_fk='$id'";


    if (mysql_query($sql) && mysql_query($sql3)) {
        $user_array = explode(",", $penerima);
        foreach ($user_array as $user) {
            if (cek_data_exist("SELECT id_user FROM t_user WHERE id_user='$user'")) {
                $sql2 = "INSERT INTO t_kirim_surat(no_surat_keluar,id_user,tgl_kirim,status) VALUES('$id','$user','" . date ("Y-m-d H:i:s") . "','Belum Terbaca')";
                mysql_query($sql2);
            }
        }
        echo "Surat Keluar Berhasil Dikirim ke semua Penerima";
    } else {
        echo "Gagal Mengirim Surat Ke Penerima";
    }
} else {
    echo "No Data";
}
?>
