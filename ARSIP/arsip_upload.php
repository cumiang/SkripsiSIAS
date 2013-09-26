<?php

include "../koneksi.php";
include "../fungsi.php";

$mode = $_POST["MODE"];
$id = $_POST["txtID"];
$lampiran_store_db = "";
if (empty($id)) {
    echo "<script>
          alert('Nomor ID Arsip belum terset');
          window.location.href = 'arsip.php';
          </script>";
    exit();
}
$no = remove_Special_char($id);
$jumlah_file = count($_FILES["upload"]["name"]);
$path = "../LAMPIRAN/$no/";
if (!file_exists($path)) {
    umask(0);
    mkdir($path, 0777, TRUE);
}
for ($i = 0; $i < $jumlah_file; $i++) {
    $tmp_file = $_FILES['upload']['tmp_name'][$i];
    $filetype = $_FILES['upload']['type'][$i];
    $filesize = $_FILES['upload']['size'][$i];
    $filename = $_FILES['upload']['name'][$i];
    if (move_uploaded_file($tmp_file, $path . $filename)) {
        $lampiran_store_db = $lampiran_store_db.",".$filename;
        echo "<script>
          alert('Berhasil Mengupload File');
          window.location.href = 'arsip.php';
          </script>";
    } else {
        echo "<script>
          alert('Gagal Mengupload File');
          window.location.href = 'arsip.php';
          </script>";
    }
}

$lampiran_store_db = trim($lampiran_store_db,",");
$sql="UPDATE t_arsip_surat SET lampiran_file='$lampiran_store_db' WHERE id_arsip='$id'";
eksekusi_sql($sql);
?>
