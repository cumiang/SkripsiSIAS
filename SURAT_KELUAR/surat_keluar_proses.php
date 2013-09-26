<?php

include "../koneksi.php";
//$tmp
$mode = $_POST["MODE"];
$urut = $_POST["urut"];
$kop = $_POST["kop"];
$tgl = $_POST["tgl"];
$perihal = $_POST["perihal"];
$pengirim = $_POST["pengirim"];
$penerima = $_POST["penerima"];
$tembusan = $_POST["tembusan"];
$jenis = $_POST["jenis"];
$isi = $_POST["isi"];
$penandatangan = $_POST["penandatangan"];
$prioritas = $_POST["prioritas"];
//validasi
if (empty($urut)) {
    echo "nomor Surat Tidak boleh dikosongkan";
} else {
    if (empty($kop)) {
        echo "Anda Harus Memilih Kop Surat";
    } else {
        if (empty($tgl)) {
            echo "Tanggal Surat Harus Diset";
        } else {
            if (empty($penerima) || is_null($penerima)) {
                echo "Anda Harus Memilih Tujuan Penerima Surat";
            } else {
//mengecek data exist
            }

            if ($mode == "ADD") {
                if (cek_data_exist("SELECT no_surat_keluar FROM t_surat_keluar WHERE no_surat_keluar='$urut'")) {
                    echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
                    exit();
                }

                $sql = "INSERT INTO t_surat_keluar VALUES(
                        '$urut',
                        '$kop',
                        '$tgl',
                        '$perihal',
                        '$pengirim',
                        '$penerima',
                        '$jenis',
                        '$isi',
                        '$penandatangan',
                        '$prioritas',
                        '$tembusan',
                        '',
                        'Draft',''
                         )";
                if (mysql_query($sql)) {
                    $sql2 = "INSERT INTO t_surat_masuk(no_surat_keluar_fk,tgl_surat_masuk,status) VALUES(
                        '$urut',
                        '" . date("Y-m-d") . "',
                        'Belum Terbaca'
                         )";
                    if (mysql_query($sql2)) {
                        echo "Berhasil Menyimpan Draft Surat";
                    }
                } else {
                    echo "gagal menyimpan data";
                }
            }
        }
    }
}
?>
