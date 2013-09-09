<?php
$HOST = "localhost";
$USER = "root";
$PASSWORD = "";
$DATABASE = "dbsurat";
$bd = mysql_connect($HOST, $USER, $PASSWORD) or die("Tidak dapat menghubungkan ke database");
mysql_select_db($DATABASE, $bd) or die("Tidak dapat memilih database");

function cek_data_exist($sql){
    $hasil = mysql_query($sql);
    $jumlah = mysql_num_rows($hasil);
    if($jumlah>0){
        return 1;
    }else{
        return 0;
    }
    mysql_free_result($hasil);
}


function ambil_data_sql($sql) {
    $kueri = mysql_query($sql);
    $data = mysql_fetch_array($kueri,MYSQL_NUM);
    if($data){
        return $data;
    }else{
        return 0;
    }
    mysql_free_result($hasil);
}

function eksekusi_sql($sql) {
        if(mysql_query($sql)){
            return 1;
        }else{
            return 0;
        }
}

?>