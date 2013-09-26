<?php

include "../koneksi.php";
include "../fungsi.php";

$id = $_POST["id"];

if (isset($id)) {
    $sql = "SELECT a.*,b.nama_kop AS kop,c.nama_user AS pengirim,d.jenis_surat AS jenis
       FROM t_surat_keluar a 
       INNER JOIN t_kop_surat b 
       ON a.id_kop_fk = b.id_kop 
       INNER JOIN t_user c 
       ON a.pengirim_surat_fk = c.id_user 
       INNER JOIN t_jenis_surat d 
       ON a.id_jenis_surat_fk = d.id_jenis
       WHERE a.no_surat_keluar = '$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $a = mysql_fetch_assoc($kueri);
        $data = "<dl class='dl-horizontal'>";
        $data = $data."<dt>NO. SURAT</dt>";
        $data = $data."<dd>".$a["no_surat_keluar"]."</dd>";
        $data = $data."<dt>KOP SURAT</dt>";
        $data = $data."<dd>".$a["kop"]."</dd>";
        $data = $data."<dt>TGL SURAT</dt>";
        $data = $data."<dd>".$a["tgl_surat"]."</dd>";
        $data = $data."<dt>JUDUL SURAT</dt>";
        $data = $data."<dd>".$a["perihal_surat"]."</dd>";
        $data = $data."<dt>DARI</dt>";
        $data = $data."<dd>".$a["pengirim"]."</dd>";
        $data = $data."<dt>KEPADA</dt>";
        $data = $data."<dd>".nama_penerima($a["penerima_surat"])."</dd>";
        $data = $data."<dt>JENIS SURAT</dt>";
        $data = $data."<dd>".$a["jenis"]."</dd>";
        $data = $data."<dt>ISI SURAT</dt>";
        $data = $data."<dd>".$a["isi_surat"]."</dd>";
        $data = $data."<dt>PENANGGUNGJAWAB</dt>";
        $data = $data."<dd>".nama_penerima($a["penandatangan"])."</dd>";
        $data = $data."<dt>PRIORITAS</dt>";
        $data = $data."<dd>".$a["prioritas_surat"]."</dd>";
        $data = $data."<dt>TEMBUSAN</dt>";
        $data = $data."<dd>".nama_penerima($a["tembusan"])."</dd>";
        $data = $data."<dt>LAMPIRAN</dt>";
        $file_array = explode(",",$a["lampiran_file"]);
        $urut = ambil_no_urut($a["no_surat_keluar"]);
        $l="";
        foreach ($file_array as $index=>$file) {
            $l = $l."<a href='"."../LAMPIRAN/$urut/$file"."' class='btn btn-link' type='button'>".$file."</a></br>";
        }
        $data = $data."<dd>".$l."</dd>";
        $data = $data."</dl>";
        echo $data;
    } else {
        echo "tidak ditemukan data";
    }
} else {
    echo "No Data";
}
?>
