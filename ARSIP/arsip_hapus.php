<?php

include "../koneksi.php";
include "../fungsi.php";

$id = $_POST["id"];
$kategori = $_POST["kategori"];
//validasi
if (empty($id)) {
    echo "Anda harus memilih dahulu data yang ingin dihapus";
} else {
    $sql = "DELETE FROM t_arsip_surat WHERE kategori_arsip='$kategori' AND id_arsip='$id'";
    $ada = eksekusi_sql($sql);
    if ($ada == 1) {
        $space = "../LAMPIRAN/" . remove_Special_char($id);
        hapus_dir($space);
        echo "berhasil menghapus data $id";
    } else {
        echo "gagal menghapus data";
    }
}
?>
