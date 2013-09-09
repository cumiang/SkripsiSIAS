<?php

include "../koneksi.php";

$id = $_POST["id"];
$logo = $_POST["logo"];

//validasi
if (empty($id)) {
    echo "Anda harus memilih dahulu data yang ingin dihapus";
} else {
    $sql = "DELETE FROM t_kop_surat WHERE id_kop='$id'";
    if (eksekusi_sql($sql)) {
            $space = "../KOP_SURAT/$logo";
            if (file_exists($space)) {
                unlink($space);
            }
        echo "berhasil menghapus data $id $space";
    } else {
        echo "gagal menghapus data";
    }
}
?>
