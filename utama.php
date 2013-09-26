<?php
include "koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/SIAS.css" rel="stylesheet">
        <link href="css/jquery.pnotify.default.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.pnotify.min.js"></script>

        <title>SISTEM INFORMASI DIGITALISASI SURAT DAN DOKUMEN</title>
        <script>
            $(document).ready(function() {
                $(".form-horizontal").hide();

            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <img class="img-rounded" src="img/stia.jpg" style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <header>
                                <a class="brand" href="utama.php?p=">SISTEM DIGITALISASI ARSIP SURAT</a>    
                            </header>
                            <div class="nav-collapse">
                                <nav>
                                    <ul class="nav pull-right">
                                        <li class='active'>
                                            <a href="utama.php?p=">
                                                <i class="icon-home icon-white"></i>
                                                <span>Beranda</span>
                                            </a>                        
                                        </li>
                                        <li class=''>
                                            <a href="logout.php">
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
                        <div class="span3 well" style="max-width: 340px; padding: 8px 0;">
                            <ul class="nav nav-list">
                                <li class="nav-header"><i class="icon-envelope"></i>Menu</li>
                                <li><a href="SURAT_MASUK/surat_masuk.php">Surat Masuk</a></li>
                                <li><a href="SURAT_KELUAR/surat_keluar.php">Surat Keluar</a></li>
                                <li><a href="utama.php?p=arsip">Arsip Surat Dan Dokumen</a></li>
                                <li class="divider"></li>
                                <li class="nav-header"><i class="icon-bell"></i>Notifikasi</li>
                                
                                <?php
                                    $id_user = $_SESSION['id'];
                                    $sql = "SELECT count(*) as tot FROM t_kirim_surat WHERE id_user='$id_user' AND status='Belum Terbaca'";
                                    $data = ambil_data_sql($sql);
                                    $tot = $data[0];
                                ?>
                                
                                <li><a href="#">ada <span class="badge badge-warning"><?php echo $tot; ?></span> surat masuk</a></li>
                                <li class="divider"></li>
                                <li class="nav-header"><i class="icon-th-list"></i>MASTER DATA</li>
                                <li><a href="utama.php?p=user">Data User</a></li>
                                <li><a href="utama.php?p=kop">Data Kop Surat</a></li>
                                <li><a href="utama.php?p=jenis">Data Jenis Surat</a></li>
                                <li><a href="utama.php?p=disposisi">Data Disposisi Masuk</a></li>
                                <li class="divider"></li>
                                <li class="nav-header"><i class="icon-user"></i>informasi login</li>
                                <li><a href="#"><?php echo $_SESSION['nama']; ?></a></li>
                                <li><a href="#"><?php echo DATE("d F Y, H:m:s"); ?></a></li>
                                <li><a href="#"><?php echo $_SESSION['level']; ?></a></li>
                            </ul>
                        </div>
                        <div class="span8">
                            <?php
                            $page = $_GET["p"];
                            if (!empty($page)) {
                                switch ($page) {
                                  case "user":
                                     include "USER/user.php";
                                      break;
                                    case "jenis":
                                        include "JENIS_SURAT/jenis.php";
                                        break;
                                    case "kop":
                                        include "KOP_SURAT/kop.php";
                                        break;
                                    case "surat_keluar":
                                        include "SURAT_KELUAR/surat_keluar.php";
                                        break;
                                    case "disposisi":
                                        include "DISPOSISI_SURAT/disposisi.php";
                                        break;
                                    case "arsip":
                                        include "ARSIP/arsip.php";
                                        break;
                                }
                            } else {
                                include "welcome.php";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
