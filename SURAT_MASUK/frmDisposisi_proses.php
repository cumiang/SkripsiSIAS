<?php
include "../koneksi.php";

$no = $_POST["no"];
$id = $_POST["id"];
$pendisposisi = $_POST["pendisposisi"];
$tgl = $_POST["tgl"];
$isi = $_POST["isi"];
$catatan = $_POST["catatan"];

if(empty($isi)){
    echo "Anda Harus Mengisi Kalimat Perintah";
}else{
                    $sql = "INSERT INTO t_disposisi_surat_masuk(id_surat_masuk_fk,id_pendisposisi,tgl_disposisi,isi_disposisi,catatan_disposisi) VALUES(
                        $no,
                        '$pendisposisi',
                        '$tgl',
                        '$isi',
                        '$catatan'
                         )";
                    if (mysql_query($sql)) {
                        echo "Berhasil menyimpan disposisi";
                    }else{
                        echo "gagal menyimpan disposisi";
                    }
                    
}

?>
