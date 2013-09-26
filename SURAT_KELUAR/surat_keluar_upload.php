<?php

include "../koneksi.php";

//$mode = $_POST["MODE"];
$urut = $_POST["txtUrut"];
$prefix = $_POST["txtPrefix"];
$lampiran_store_db = "";
if (empty($urut)) {
    echo "<script>
          alert('Nomor Urut Surat belum terset');
          window.location.href = '../SURAT_KELUAR/surat_keluar.php';
          </script>";
    exit();
}
$no = trim($urut);
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
          window.location.href = '../SURAT_KELUAR/surat_keluar.php';
          </script>";
    } else {
        echo "<script>
          alert('Gagal Mengupload File');
          window.location.href = '../SURAT_KELUAR/surat_keluar.php';
          </script>";
    }
}
$no_surat = trim($urut."/".$prefix);
$lampiran_store_db = trim($lampiran_store_db,",");
$sql="UPDATE t_surat_keluar SET lampiran_file='$lampiran_store_db' WHERE no_surat_keluar='$no_surat'";
eksekusi_sql($sql);
?>
