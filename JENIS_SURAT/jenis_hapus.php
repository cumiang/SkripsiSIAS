<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Anda harus memilih dahulu data yang ingin dihapus";
} else {
    $sql = "DELETE FROM t_jenis_surat WHERE id_jenis='$id'";
    if (eksekusi_sql($sql)) {
        echo "berhasil menghapus data $id";
    } else {
        echo "gagal menghapus data";
    }
}
?>
