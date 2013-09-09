<?php

include "../koneksi.php";

$mode = $_POST["MODE"];
$tmp = $_POST["tmp"];
$id = $_POST["txtID"];
$jenis = $_POST["txtJenis"];
$singkat = $_POST["txtSingkat"];
$deskripsi = $_POST["txtDeskripsi"];

//validasi
if (empty($id)) {
    echo "Kode Jenis Surat Tidak boleh dikosongkan";
} else {
    if (empty($jenis)) {
        echo "Jenis Surat tidak boleh dikosongkan";
    } else {
        if (empty($singkat)) {
            echo "Harap Mengisi singkatan";
        } else {
//mengecek data exist

            if ($mode == "ADD") {
                if (cek_data_exist("SELECT id_jenis FROM t_jenis_surat WHERE id_jenis='$id'")) {
                    echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
                    exit();
                }

                $sql = "INSERT INTO t_jenis_surat VALUES('$id','$jenis','$singkat','$deskripsi')";
                if (mysql_query($sql)) {
                    echo "Berhasil Menyimpan Data";
                } else {
                    echo "gagal menyimpan data";
                }
            } else if ($mode == "EDIT") {
                $sql = "UPDATE t_jenis_surat SET 
                        id_jenis='$id',
                        jenis_surat='$jenis',
                        singkat='$singkat',
                        deskripsi='$deskripsi' WHERE id_jenis='$tmp';";
                if (mysql_query($sql)) {
                    echo "Berhasil Mengubah Data";
                } else {
                    echo "gagal mengubah data";
                }
            }
        }
    }
}
?>
