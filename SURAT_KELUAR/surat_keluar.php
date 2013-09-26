<?php
include "../koneksi.php";
include "../fungsi.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/SIAS.css" rel="stylesheet">
        <link href="../css/jquery.pnotify.default.css" rel="stylesheet">
        <link href="../css/jquery.cleditor.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.pnotify.min.js"></script>
        <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>

        <title>MEMBUAT SURAT KELUAR</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <img class="img-rounded" src="../img/stia.jpg" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <header>
                                <a class="brand" href="../utama.php?p=">SISTEM DIGITALISASI ARSIP SURAT</a>    
                            </header>
                            <div class="nav-collapse">
                                <nav>
                                    <ul class="nav pull-right">
                                        <li class='active'>
                                            <a href="../utama.php?p=">
                                                <i class="icon-home icon-white"></i>
                                                <span>Beranda</span>
                                            </a>                        
                                        </li>
                                        <li class=''>
                                            <a href="../logout.php">
                                                <i class="icon-off icon-white"></i>
                                                <span>Log Out</span>
                                            </a>                        
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <div class="row">
                        <div class="span12 ">
                            <a class="btn btn-success" href="../utama.php?p=" type="button"><i class="icon-home icon-white"></i> MENU UTAMA</a>
                            <a class="btn btn-primary" href="surat_keluar.php" type="button"><i class="icon-list icon-white"></i> Daftar Surat Keluar</a>
                            <div class="btn-group">
                                <button id="cmdTambahSuratKeluar" class="btn btn-warning"><i class="icon-plus icon-white"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="span12" id="konten">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Jenis Surat</th>
                                    <th>No. Surat</th>
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                </tr>

                                <?php
                                $sql = "SELECT b.jenis_surat,a.no_surat_keluar,c.nama_user,
                        a.penerima_surat,a.tgl_surat,a.perihal_surat,a.lampiran_file,a.status 
                        FROM t_surat_keluar a 
                        INNER JOIN t_jenis_surat b 
                        ON a.id_jenis_surat_fk = b.id_jenis 
                        INNER JOIN t_user c 
                        ON a.pengirim_surat_fk = c.id_user order by a.urut ASC";

                                $kueri = mysql_query($sql);

                                if (mysql_num_rows($kueri) > 0) {
                                    while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                                        echo "<tr id='" . $data[1] . "'>";
                                        echo "<td>";
                                        echo '<div class="btn-toolbar">';
                                        echo '<div class="btn-group">';
                                        echo '<a class="btn btnKirim" data="' . $data[1] . '" data-penerima="' . $data[3] . '"> <i class="icon-envelope"></i></a>';
                                        echo '<a class="btn btnView" data="' . $data[1] . '"> <i class="icon-eye-open"></i></a>';
                                        echo '<a class="btn btnPDF" data="' . $data[1] . '"> PDF</i></a>';
                                        echo '<a class="btn btnHapus" data="' . $data[1] . '"> <i class="icon-trash"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo "</td>";
                                        echo"<td>" . $data[0] . "</td>";
                                        echo"<td>" . $data[1] . "</td>";
                                        echo"<td>" . $data[2] . "</td>";
                                        echo"<td>" . nama_penerima($data[3]) . "</td>";
                                        echo"<td>" . $data[4] . "</td>";
                                        echo"<td>" . $data[5] . "</td>";

                                        if (!empty($data[6])) {
                                            $tot_file = count(explode(",", $data[6]));
                                            echo"<td class='link' data-link='" . $data[6] . "'><a class='btn btn-link fileView' data-id='" . ambil_no_urut($data[1]) . "' type='button'>Ada <span class='badge badge-info'>$tot_file</span> File</a></td>";
                                        } else {
                                            echo"<td><span class='label'>Tidak Ada File</span></td>";
                                        }
                                        echo"<td>" . $data[7] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="myModalLabel"><i class="icon-envelope"></i> DETAIL SURAT KELUAR</h4>
            </div>
            <div class="modal-body">
                <div id="modalHasil">
                </div>
            </div>
        </div>
    </body>
</html>
<script src="../js/bootstrap-modal.js"></script> <!-- Custom codes -->
<script>
    $(".btnView").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "../SURAT_KELUAR/SuratKeluarDetail.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            success: function(data) {
                $("#modalHasil").html(data);
            }
        });
        $('#myModal').modal('toggle');
    });

    $(".btnPDF").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "../SURAT_KELUAR/LihatPDF.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            success: function(data) {
                $.pnotify({
                    title: "PESAN",
                    text: data,
                    type: "info",
                    style: "bootstrap"
                });
            }
        });
    });

    $(".btnKirim").click(function() {
        var id = $(this).attr('data');
        var penerima = $(this).attr('data-penerima');
        $.ajax({
            url: "../SURAT_KELUAR/kirim_surat_keluar.php",
            type: "POST",
            data: "id=" + id + "&penerima="+penerima,
            cache: false,
            success: function(data) {
                $.pnotify({
                    title: "PESAN",
                    text: data,
                    type: "info",
                    style: "bootstrap"
                });
            }
        });
    });

            $(".btnHapus").click(function() {
                var id = $(this).attr('data');
                //alert(id);
                $.ajax({
                    url: "../SURAT_KELUAR/SuratKeluarHapus.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(data) {
                     //  alert(data);
                        if (data == 1) {
                            window.location.href = '../SURAT_KELUAR/surat_keluar.php';
                        }
                    }
                });
            });


    $("#cmdTambahSuratKeluar").click(function() {
        $("#konten").html("<img src='../img/loading.gif'> </br>Sedang Memuat Konten, Harap Tunggu..</img>");
        $.ajax({
            url: "../SURAT_KELUAR/frmTambahSuratKeluar.php",
            beforeSend: function() {
                $("#konten").attr("align", "center");
                $("#konten").html("<img src='../img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $("#konten").removeAttr("align");
                $("#konten").slideDown("slow").html(html);
                $("#txtUrut").attr("disabled", true);
            }
        });
    });
</script>

<script src="../js/bootstrap-popover.js"></script> <!-- Custom codes -->
<script>
    /*   var link = $("td.link").attr("data-link");
     var konten_popover = "";
     link = link.split(",");
     for (var i = 0; i < link.length; i++) {
     konten_popover = konten_popover + "<a class='btn btn-link link' type='button' data='" + link[i] + "'>" + link[i] + "</a>" + "</br>";
     }
     $(".fileView").popover({
     html: "true",
     placement: "top",
     toggle: "popover",
     title: "Open File",
     content: konten_popover
     }).parent().delegate('a.link', 'click', function() {
     var item = $(".link").attr("data");
     var no = $(".fileView").attr("data-id");
     var path = "../LAMPIRAN/" + no + "/" + item;
     $("a.link").attr("href", path);
     });*/
</script>