<?php

include 'koneksi.php';

if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
    $user = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($_POST["user"], ENT_QUOTES))));
    $pass = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($_POST["pass"]), ENT_QUOTES)));
    $sql = ("SELECT * FROM t_user WHERE nama_user='$user' AND password='$pass'");

    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) == 1) {
        $data = mysql_fetch_row($kueri);
        session_start();
        $_SESSION['id'] = $data[0];
        $_SESSION['nama'] = $data[1];
        $_SESSION['key'] = $data[2];
        $_SESSION['sessid'] = session_id();
        $_SESSION['level'] = $data[8];
        header('location:utama.php?p=');
    } else {
        header('location:index.php');
    }
}
?>