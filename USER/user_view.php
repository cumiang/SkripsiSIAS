<?php

include "../koneksi.php";

$id = $_POST["id"];

//validasi
if (empty($id)) {
    echo "Data Profil Tidak Dapat Ditampilkan";
} else {
    $sql = "SELECT * FROM t_user WHERE id_user='$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $data = mysql_fetch_row($kueri);
        /*echo "{";
        echo "id =>'$data[0]',";
        echo "user =>'$data[1]',";
        echo "pass =>'$data[2]',";
        echo "nama =>'$data[3]',";
        echo "kategori =>'$data[4]',";
        echo "unit =>'$data[5]',";
        echo "jurusan =>'$data[6]',";
        echo "jabatan =>'$data[7]',";
        echo "hak =>'$data[8]',";
        echo "status =>'$data[9]'";
        echo "}";*/
       //echo $data;
       // echo json_encode($data);
        echo $data[0].",".$data[1].",".$data[2].",".$data[3].",".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9];
    } else {
        echo "tidak ditemukan data";
    }
}
?>
