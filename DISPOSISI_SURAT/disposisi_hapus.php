<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Anda harus memilih dahulu data yang ingin dihapus";
} else {
    $sql = "DELETE FROM t_disposisi_surat_masuk WHERE id_disposisi='$id'";
    if (eksekusi_sql($sql)) {
        echo "berhasil menghapus data $id";
    } else {
        echo "gagal menghapus data";
    }
}
?>
