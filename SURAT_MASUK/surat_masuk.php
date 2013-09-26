<?php
include "../koneksi.php";
include "../fungsi.php";
session_start();
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

        <title>SURAT MASUK</title>

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
                            <a class="btn btn-warning" href="surat_masuk.php" type="button"><i class="icon-list icon-white"></i> Daftar Surat Masuk</a>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="span12" id="konten">
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Masuk</th>
                                    <th>No. Surat</th>
                                    <th>Perihal</th>
                                    <th>Pengirim Surat</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>

                                <?php
                               // if($_SESSION['level']=="ADMIN"){
                                $sql = "SELECT a.no_surat_keluar_fk,a.tgl_surat_masuk,a.status,
                                        b.perihal_surat,b.lampiran_file,c.nama_user,a.id_surat_masuk
                                        FROM t_surat_masuk a 
                                        INNER JOIN t_surat_keluar b 
                                        ON a.no_surat_keluar_fk = b.no_surat_keluar
                                        INNER JOIN t_user c 
                                        ON c.id_user = b.pengirim_surat_fk
                                        ORDER BY a.status ASC";
  
                                $kueri = mysql_query($sql);

                                if (mysql_num_rows($kueri) > 0) {
                                    $no = 1;
                                    while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                                        echo "<tr id='" . $data[0] . "'>";
                                        echo"<td>" . $no . "</td>";
                                        echo"<td>" . $data[1] . "</td>";
                                        echo"<td>" . $data[0] . "</td>";
                                        echo"<td>" . $data[3] . "</td>";
                                        echo"<td>" . $data[5] . "</td>";

                                        if (!empty($data[4])) {
                                            $tot_file = count(explode(",", $data[4]));
                                            echo"<td class='link'><a class='btn btn-link' type='button'>Ada <span class='badge badge-info'>$tot_file</span> File</a></td>";
                                        } else {
                                            echo"<td><span class='label'>Tidak Ada File</span></td>";
                                        }
                                        echo"<td>" . $data[2] . "</td>";
                                        echo "<td>";
                                        echo '<div class="btn-toolbar">';
                                        echo '<div class="btn-group">';
                                        echo '<a class="btn btnPDF" data="' . $data[0] . '"> PDF</a>';
                                        echo '<a class="btn btnView" data="' . $data[0] . '"> Baca</i></a>';
                                        echo '<a class="btn btnDisposisi" data="' . $data[0] . '" data-perihal="' . $data[3]. '" data-no="' . $data[6]. '"> Disposisi</i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo "</td>";
                                        echo "</tr>";
                                        $no++;
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
                <h4 id="myModalLabel"><i class="icon-envelope"></i> DETAIL SURAT MASUK</h4>
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
        $("#myModalLabel").html("DETAIL SURAT MASUK");
        $.ajax({
            url: "../SURAT_MASUK/SuratMasukDetail.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            success: function(data) {
                $("#modalHasil").html(data);
            }
        });
        $('#myModal').modal('toggle');
    });

    $(".btnDisposisi").click(function() {
        var id = $(this).attr('data');
        var perihal = $(this).attr('data-perihal');
        var no = $(this).attr('data-no');
        $("#myModalLabel").html("FORM DISPOSISI");
        $.ajax({
            url: "../SURAT_MASUK/frmDisposisi.php",
            type: "POST",
            data: "id=" + id + "&perihal="+perihal+"&no="+no,
            cache: false,
            success: function(data) {
                $("#modalHasil").html(data);
            }
        });
        $('#myModal').modal('toggle');
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
