<?php

function ambil_no_urut($no) {
    $pos_char = strpos($no, "/", 0);
    $urut_no = substr($no, 0, $pos_char);
    return $urut_no;
}

function hapus_dir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir")
                    rrmdir($dir . "/" . $object);
                else
                    unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

function nama_penerima($array) {
    $user = explode(",", $array);
    $tmp = "";
    foreach ($user as $value) {
        $sql = "SELECT nama_user FROM t_user WHERE id_user='$value'";
        $kueri = mysql_query($sql);
        if (mysql_num_rows($kueri)) {
            $data = mysql_fetch_row($kueri);
            $tmp = $tmp . "," . $data[0];
        } else {
            $tmp = $tmp . "," . $value;
        }
    }
    return trim($tmp, ",");
}
function remove_Special_char($string) {
   $string = str_replace(" ", "", $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return preg_replace('/-+/', '', $string);
}
?>
