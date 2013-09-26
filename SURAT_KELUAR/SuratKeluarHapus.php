<?php

include "../koneksi.php";
include "../fungsi.php";

$id = $_POST["id"];
$ada = mysql_query("DELETE FROM t_surat_keluar WHERE no_surat_keluar='$id'");
if ($ada == 1) {
    $space = "../LAMPIRAN/" . ambil_no_urut($id);
    hapus_dir($space);
    echo $ada;
}
?>
