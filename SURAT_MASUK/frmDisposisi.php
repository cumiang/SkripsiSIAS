<?php
include "../koneksi.php";
include "../fungsi.php";
session_start();

$no = $_POST["no"];
$id = $_POST["id"];
$perihal = $_POST["perihal"];
$pendisposisi = $_SESSION['nama'];
$id_pendisposisi = $_SESSION['id'];
$tgl_disposisi = DATE("Y-m-d H:m:s");
if (isset($id) && isset($perihal)) {


    $data = "<dl class='dl-horizontal'>";
    $data = $data . "<input type='hidden' id='txt' data-id='$id' data-pendisposisi='$id_pendisposisi' data-tgl='$tgl_disposisi' data-no='$no'>";
    $data = $data . "<dt>NO. SURAT</dt>";
    $data = $data . "<dd>" . $id . "</dd>";
    $data = $data . "<dt>PENDISPOSISI</dt>";
    $data = $data . "<dd>" . $pendisposisi . "</dd>";
    $data = $data . "<dt>TGL DISPOSISI</dt>";
    $data = $data . "<dd>" . DATE("d F Y") . "</dd>";
    $data = $data . "<dt>JUDUL SURAT</dt>";
    $data = $data . "<dd>" . $perihal . "</dd>";
    $data = $data . "<dt>Kalimat Disposisi</dt>";
    $data = $data . "<dd><input class='input-large' type='text' id='txtDisposisi' placeholder='Kalimat Disposisi'></dd>";
    $data = $data . "<dt>Catatan</dt>";
    $data = $data . "<dd><textarea rows='3' id='txtCatatan' placeholder='Komentar'></textarea></dd>";
    $data = $data . "<hr>";
    $data = $data . '<dd><button class="btn btn-primary" type="button" id="cmdSimpan">Simpan</button></dd>';
    echo $data;
} else {
    echo "No Data";
}
?>
<hr>
<?php
$sql = "SELECT a.*,b.nama_user 
FROM t_disposisi_surat_masuk a
INNER JOIN t_user b
ON a.id_pendisposisi=b.id_user
WHERE id_surat_masuk_fk=$no ORDER BY id_disposisi DESC";
if ($kueri=mysql_query($sql)) {
    if (mysql_num_rows($kueri) > 0) {
        $i = 1;
        while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
?>            
<ul>
    <li><span class="badge badge-success"><?php echo $i;  ?></span>
        <blockquote>
            <p class="text-info"><?php echo $data["isi_disposisi"];  ?></p>
            <p><?php echo $data["catatan_disposisi"];  ?></p>
            <small>TTD, <?php echo $data["nama_user"]."_".$data["tgl_disposisi"];  ?></small>
        </blockquote>
    </li>
</ul>

<?php
      $i++;  
            }
    }
}
    ?>


<script>

    $("#cmdSimpan").click(function() {
        var no = $("#txt").attr("data-no");
        var id = $("#txt").attr("data-id");
        var pendisposisi = $("#txt").attr("data-pendisposisi");
        var tgl = $("#txt").attr("data-tgl");
        var isi = $("#txtDisposisi").val();
        var catatan = $("#txtCatatan").val();
        var data = "id=" + id + "&pendisposisi=" + pendisposisi + "&tgl=" + tgl + "&isi=" + isi + "&catatan=" + catatan + "&no=" + no;
        //alert(data);
        $.ajax({
            url: "../SURAT_MASUK/frmDisposisi_proses.php",
            type: "POST",
            data: data,
            cache: false,
            success: function(html) {
                $.pnotify({
                    title: "PESAN",
                    text: html,
                    type: "info",
                    style: "bootstrap"
                });
            }
        });

    });

</script>

