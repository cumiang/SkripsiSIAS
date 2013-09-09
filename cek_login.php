<?php
include 'koneksi.php';

if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
    $user = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($_POST["user"], ENT_QUOTES))));
    $pass = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars(md5($_POST["pass"]), ENT_QUOTES))));
    $data = ambil_data_sql("SELECT * FROM t_user WHERE nama_user='$user' AND password='$pass'");
    
echo($data);
exit();
        session_start();
        $_SESSION['nama'] = $ketemu[0][1];
        $_SESSION['key'] = $ketemu[0][2];
        $_SESSION['sessid'] = session_id();
        $_SESSION['level'] = $ketemu[0][3];
        header('location:utama.php?p=');
    } else {
        header('location:index.php');
}



?>