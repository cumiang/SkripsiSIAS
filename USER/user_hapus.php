<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Anda harus memilih dahulu user yang ingin dihapus";
} else {
    $sql = "DELETE FROM t_user WHERE id_user='$id'";
    if (eksekusi_sql($sql)) {
        echo "berhasil menghapus data user $id";
    } else {
        echo "gagal menghapus data";
    }
}
?>
