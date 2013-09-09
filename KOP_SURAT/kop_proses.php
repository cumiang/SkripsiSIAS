<?php

include "../koneksi.php";

//untuk mengambil ekstensi nama file
function getExtension($str) {

    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

//untuk mengambil nama file tanpa ekstensi
function getName($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $nama = substr($str, 0, $i);
    return $nama;
}

function pesan($pesan, $path) {
//    echo "<script>alert($pesan);window.location.href='../$path';</script>";
    echo "<script>
                            alert('$pesan');
                            window.location.href = '../$path';
                          </script>";
}


//mulai---------------------------------------------------------------------------
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $mode = $_POST["MODE"];
    $tmp = $_POST["tmp"];
    $id = $_POST["txtID"];
    $nama = $_POST["txtNama"];
    $lembaga = $_POST["txtLembaga"];
    $alamat = $_POST["txtAlamat"];
    $telp = $_POST["txtTelp"];
    $kodepos = $_POST["txtKodePos"];
    $fax = $_POST["txtFax"];
    $site = $_POST["txtWeb"];
    $email = $_POST["txtEmail"];
    // $logo = $_POST["txtID"];

    if ($mode == "ADD") {
        if (cek_data_exist("SELECT id_kop FROM t_kop_surat WHERE id_kop='$id'")) {
            echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
            exit();
        }
        $sql = "INSERT INTO t_kop_surat(id_kop,nama_kop,nama_lembaga,alamat,no_telp,kode_pos,no_fax,site,email) 
                VALUES('$id','$nama','$lembaga','$alamat','$telp','$kodepos','$fax','$site','$email')";
        if (mysql_query($sql)) {
            pesan("berhasil menyimpan data", "utama.php?p=kop");
        } else {
            pesan("gagal menyimpan data", "utama.php?p=kop");
        }
    } else if ($mode == "EDIT") {
        $sql = "UPDATE t_kop_surat SET 
                        id_kop='$id',
                        nama_kop='$nama',
                        nama_lembaga='$lembaga',
                        alamat='$alamat',
                        no_telp='$telp',
                        kode_pos='$kodepos',
                        no_fax='$fax',
                        site='$site',
                        email='$email' WHERE id_kop='$tmp';";
        if (mysql_query($sql)) {
            pesan("berhasil mengubah data", "utama.php?p=kop");
        } else {
            pesan("gagal mengubah data", "utama.php?p=kop");
        }
    }

    //cek file upload terset
    if (empty($_FILES['txtFile'])) {
        exit();
    } else {
        // no file uploaded..

        $nama_upload = $_FILES['txtFile']['name'];
        $size_upload = $_FILES['txtFile']['size'];
        $tmp_upload = $_FILES['txtFile']["tmp_name"];

        //validasi format gambar
        $nama = strtolower(stripslashes($nama_upload));
        $nama_ext = strtolower(getExtension($nama));
        if (($nama_ext != "jpg") && ($nama_ext != "jpeg") && ($nama_ext != "png") && ($nama_ext != "gif")) {
            pesan("format gambar tidak diizinkan kecuali (jpg,jpeg,png,gif)", "utama.php?p=kop");
            exit();
        }


        $path_upload = "../KOP_SURAT/";
        $foto_upload = $path_upload . $nama;

        if (strlen($nama)) {
            if ($size_upload < (1024 * 100)) {
                if (move_uploaded_file($tmp_upload, $foto_upload)) {
                    if ($nama_ext == "jpg" || $nama_ext == "jpeg") {
                        $sumber = imagecreatefromjpeg($foto_upload);
                    } else if ($nama_ext == "png") {
                        $sumber = imagecreatefrompng($foto_upload);
                    } else if ($nama_ext == "gif") {
                        $sumber = imagecreatefromgif($foto_upload);
                    }
                    //mengambil ukuran tinggi dan lebar file
                    list($lebar, $tinggi) = getimagesize($foto_upload);
                    //ukuran gambar 140x140 pixel
                    $lebar_new = 140;
                    $tinggi_new = ($tinggi / $lebar) * $lebar_new;
                    $tmp = imagecreatetruecolor($lebar_new, $tinggi_new);

                    if (imagecopyresampled($tmp, $sumber, 0, 0, 0, 0, $lebar_new, $tinggi_new, $lebar, $tinggi)) {
                        //simpan gambar
                        if ($nama_ext == "jpg" || $nama_ext == "jpeg") {
                            imagejpeg($tmp, $foto_upload);
                        } else if ($nama_ext == "png") {
                            imagepng($tmp, $foto_upload);
                        } else if ($nama_ext == "gif") {
                            imagegif($tmp, $foto_upload);
                        }
                        //bebaskan variabel dr memori
                        imagedestroy($sumber);
                        imagedestroy($tmp);


                        if (cek_data_exist("SELECT id_kop FROM t_kop_surat WHERE id_kop='$id'")) {
                            echo "Maaf data yang anda masukkan sudah ada, coba data yang lain";
                            if ($mode == "ADD") {
                                $sql = "UPDATE t_kop_surat SET logo='$nama' WHERE id_kop='$id';";
                            } elseif ($mode == "EDIT") {
                                $sql = "UPDATE t_kop_surat SET logo='$nama' WHERE id_kop='$tmp';";
                            }
                            mysql_query($sql);
                        }
                        pesan("Sukses Mengupload gambar Logo", "utama.php?p=kop");
                    }
                }
            } else {
                pesan("Ukuran file gambarnya tidak boleh melebih 100 Kb", "utama.php?p=kop");
                //echo "Ukuran file gambar anda melebihi 200kb";
            }
        } else {
            pesan("Pilih dahulu gambarnya", "utama.php?p=kop");
        }
    }
} else {
    pesan("Ada kesalahan", "utama.php?p=kop");
}

//end-----------------------------------------------------------------------------                

?>
