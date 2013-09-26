<?php

include "../koneksi.php";

$mode = $_POST["MODE"];
$tmp = $_POST["tmp"];
$id = $_POST["txtID"];
$kategori = $_POST["cmbKategori"];
$tgl = $_POST["txtTgl"];
$subjek = $_POST["txtSubjek"];
$ringkasan = $_POST["txtRingkasan"];

//validasi
if (empty($id)) {
    echo "Nomor Arsip Tidak boleh dikosongkan";
} else {
    if (empty($kategori)) {
        echo "Harus Memilih Kategori Arsip";
    } else {
        if (empty($subjek)) {
            echo "Harap Mengisi subjek atau perihal arsip";
        } else {
//mengecek data exist

            if ($mode == "ADD") {
                if (cek_data_exist("SELECT id_arsip FROM t_arsip_surat WHERE id_arsip='$id'")) {
                    echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
                    exit();
                }

                $sql = "INSERT INTO t_arsip_surat VALUES('$id','$kategori','$tgl','$subjek','$ringkasan','')";
                if (mysql_query($sql)) {
                    echo "Berhasil Menyimpan Data";
                } else {
                    echo "gagal menyimpan data";
                }
            } else if ($mode == "EDIT") {
                $sql = "UPDATE t_arsip_surat SET 
                        id_arsip='$id',
                        kategori_arsip='$kategori',
                        tgl_arsip='$tgl',
                        subjek_arsip='$subjek',
                        ringkasan_isi='$ringkasan'
                        WHERE id_arsip='$tmp';";
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
