<?php

include "../koneksi.php";

$mode = $_POST["MODE"];
$tmp = $_POST["tmp"];
$id = $_POST["txtID"];
$user = $_POST["txtUser"];
$pass = $_POST["txtPass"];
$hak = $_POST["cmbHakAkses"];
$nama = $_POST["txtNama"];
$kategori = $_POST["cmbKategori"];
$unit = $_POST["txtUnit"];
$jurusan = $_POST["txtJurusan"];
$jabatan = $_POST["txtJabatan"];
$status = $_POST["cmbStatus"];

//validasi
if (empty($id)) {
    echo "ID Pengguna Tidak boleh dikosongkan";
} else {
    if (empty($user)) {
        echo "Nama User tidak boleh dikosongkan";
    } else {
        if (empty($nama)) {
            echo "Harap Mengisi nama lengkap anda";
        } else {
//mengecek data exist

            if ($mode == "ADD") {
                if (cek_data_exist("SELECT id_user FROM t_user WHERE id_user='$id'")) {
                    echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
                    exit();
                }

                $sql = "INSERT INTO t_user VALUES('$id','$user','$pass','$nama','$kategori','$unit','$jurusan','$jabatan','$hak','$status')";
                if (mysql_query($sql)) {
                    echo "Berhasil Menyimpan Data user";
                } else {
                    echo "gagal menyimpan data user";
                }
            } else if ($mode == "EDIT") {
                $sql = "UPDATE t_user SET 
                        id_user='$id',
                        nama_user='$user',
                        password='$pass',
                        nama_lengkap='$nama',
                        kategori='$kategori',
                        unit_kerja='$unit',
                        jurusan='$jurusan',
                        jabatan='$jabatan',
                        hak_akses='$hak',
                        status='$status' WHERE id_user='$tmp';";
                if (mysql_query($sql)) {
                    echo "Berhasil Mengubah Data user";
                } else {
                    echo "gagal mengubah data user";
                }
            }
        }
    }
}
?>
