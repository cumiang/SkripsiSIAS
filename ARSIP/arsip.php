<?php
//include "koneksi.php";
?>
<div class="widget">
    <div class="widget-header">
        <h5>MANAJEMEN ARSIP SURAT DAN DOKUMEN</h5>
    </div>
    <div class="widget-content">
        <p><button class="btn btn-success" id="cmdTambah"><i class="icon-plus icon-white"></i>Tambah Data</button></p>
        <p>
        <form class="form-horizontal" id='frmArsip' method="POST" action="ARSIP/arsip_upload.php" enctype="multipart/form-data">
            <legend>Menambah Data Arsip</legend>
            <input type="hidden" name="tmp" id="tmp">
            <input type="hidden" name="MODE" id="MODE" value="ADD">
            <div class="control-group"> 
                <label class="control-label" for="txtID">ID</label>
                <div class="controls">
                    <input type="text" id="txtID" name="txtID" placeholder="Kode Arsip" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="cmbKategori">Kategori</label>
                <div class="controls">
                    <select id="cmbKategori" name="cmbKategori">
                        <option value="Surat Masuk">Surat Masuk</option>
                        <option value="Surat Keluar">Surat Keluar</option>
                        <option value="Dokumen">Dokumen</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Tgl Arsip</label>
                <div class="controls">
                    <label class="">
                        <input type="date" id="txtTgl" name="txtTgl"  placeholder="Tanggel file arsip"/>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Subjek / Perihal</label>
                <div class="controls">
                    <label class="">
                        <input type="text" class="input-xxlarge" id="txtSubjek" name="txtSubjek"  placeholder="Subjek atau Judul Arsip"/>
                    </label>
                </div>
            </div>            
            <div class="control-group">
                <label class="control-label" for="txtRingkasan">Ringkasan Isi Arsip</label>
                <div class="controls">
                    <textarea id="txtRingkasan" rows="4" class="input-xxlarge" name="txtRingkasan" placeholder="Keterangan Singkat"></textarea>
                </div>
            </div>
            <div class="control-group"  id='lampiranView'>
                <label class="control-label">File Lampiran</label>
                <div class="controls">
                    <label class="control-label">
                        <input type="file" id="upload" name="upload[]" multiple>
                    </label>
                </div>
            </div>       
            <div class="control-group" >
                <label class="control-label">Semua Lampiran</label>
                <div class="controls" id='lampiranEdit'>

                </div>
            </div>                
            <div class="control-group">
                <div class="controls">
                    <a id="cmdSimpan" class="btn btn-info">Simpan</a>
                </div>
            </div>
        </form>  
        <hr>
        </p>
        <div class="row">
            <div class="span8">
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                KATEGORI ARSIP UNTUK SURAT KELUAR
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse out">
                            <div class="accordion-inner">
                                <p>
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>No Arsip</th>
                                        <th>Subjek</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                    $kueri = mysql_query("SELECT * FROM t_arsip_surat WHERE kategori_arsip='Surat Keluar' ORDER BY id_arsip ASC");
                                    $i = 1;
                                    while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                                        echo "<tr id='{$data['id_arsip']}'>";
                                        echo "<td>$i</td>";
                                        echo "<td>{$data['id_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>";
                                        echo "<div class='btn-group'>";
                                        echo "<button class='btn cmdEdit' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-edit'></i></button>";
                                        echo "<button class='btn cmdHapus' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-trash'></i></button>";
                                        echo "<button class='btn cmdView' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-th'></i></button>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $i += 1;
                                    }
                                    ?>
                                    <tr></tr>
                                </table>  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                KATEGORI ARSIP UNTUK SURAT MASUK
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse out">
                            <div class="accordion-inner">
                                <p>
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>No Arsip</th>
                                        <th>Subjek</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                    $kueri = mysql_query("SELECT * FROM t_arsip_surat WHERE kategori_arsip='Surat Masuk' ORDER BY id_arsip ASC");
                                    $i = 1;
                                    while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                                        echo "<tr id='{$data['id_arsip']}'>";
                                        echo "<td>$i</td>";
                                        echo "<td>{$data['id_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>";
                                        echo "<div class='btn-group'>";
                                        echo "<button class='btn cmdEdit' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-edit'></i></button>";
                                        echo "<button class='btn cmdHapus' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-trash'></i></button>";
                                        echo "<button class='btn cmdView' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-th'></i></button>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $i += 1;
                                    }
                                    ?>
                                    <tr></tr>
                                </table>  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3">
                                KATEGORI ARSIP UNTUK DOKUMEN
                            </a>
                        </div>
                        <div id="collapse3" class="accordion-body collapse out">
                            <div class="accordion-inner">
                                <p>
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>No Dokumen</th>
                                        <th>Subjek</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                    $kueri = mysql_query("SELECT * FROM t_arsip_surat WHERE kategori_arsip='Dokumen' ORDER BY id_arsip ASC");
                                    $i = 1;
                                    while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                                        echo "<tr id='{$data['id_arsip']}'>";
                                        echo "<td>$i</td>";
                                        echo "<td>{$data['id_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>{$data['subjek_arsip']}</td>";
                                        echo "<td>";
                                        echo "<div class='btn-group'>";
                                        echo "<button class='btn cmdEdit' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-edit'></i></button>";
                                        echo "<button class='btn cmdHapus' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-trash'></i></button>";
                                        echo "<button class='btn cmdView' data-id='{$data['id_arsip']}' data-kategori='{$data['kategori_arsip']}'><i class='icon-th'></i></button>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $i += 1;
                                    }
                                    ?>
                                    <tr></tr>
                                </table>  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function($) {
        $(window).load(function() {

            function mode(judul, disable, tombolVisible) {
                $(".form-horizontal legend").html(judul);
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).attr("disabled", disable);
                });
                $(".form-horizontal textarea").attr("disabled", disable);
                $(".form-horizontal select").attr("disabled", disable);
                if (tombolVisible == "hide") {
                    $("#cmdSimpan").hide();
                } else {
                    $("#cmdSimpan").show();
                }

            }

            $("#cmdTambah").click(function() {
                $("#MODE").val("ADD");
                mode("Tambah Data Arsip", false, "show");
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).val("");
                });
                $(".form-horizontal textarea").val("");
                $(".form-horizontal").slideToggle("slow");

            });
            $("#cmdSimpan").click(function() {
                var data = $("#frmArsip").serialize();
               // alert(data);
                $.ajax({
                    url: "ARSIP/arsip_proses.php",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function(ret) {
                        $.pnotify({
                            title: "PESAN",
                            text: ret,
                            type: "info",
                            style: "bootstrap"
                        });

                    }
                });

                var upload = $("input[type='file']")[0].files;
                // alert(upload.length);
                if ((upload.length) > 0) {
                    $("#frmArsip").submit();
                }
            });

            $(".cmdView").click(function() {
                var id = $(this).attr("data-id");
                var kategori = $(this).attr("data-kategori");
                $.ajax({
                    url: "ARSIP/arsip_view.php",
                    type: "POST",
                    data: "id=" + id + "&kategori=" + kategori,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split("|");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#cmbKategori").val(n[1].toString());
                        $("#txtTgl").val(n[2].toString());
                        $("#txtSubjek").val(n[3].toString());
                        $("#txtRingkasan").val(n[4].toString());
                        var file = n[5].toString();
                        file = file.split(",");
                        var l = "";
                        $.each(file, function(i, v) {
                            var path = n[0];
                                path.replace(/[^a-zA-Z0-9]/g,'');
                            l = l + "<span class='badge badge-warning'>" + (i + 1) + "</span><a href='LAMPIRAN/"+path+"/"+v+"' class='btn btn-link'> " + v + "</a></br>";
                            //alert(l);
                        });
                        $("#lampiranEdit").html(l);
                        mode("Informasi Detail Data Arsip", true, "hide");
                        $("#lampiranView").hide();
                    }
                });

            });

            $(".cmdEdit").click(function() {
                var id = $(this).attr("data-id");
                var kategori = $(this).attr("data-kategori");
                $.ajax({
                    url: "ARSIP/arsip_view.php",
                    type: "POST",
                    data: "id=" + id + "&kategori=" + kategori,
                    cache: false,
                    success: function(n) {
                        //alert(n);
                        $(".form-horizontal").show();
                        var n = n.split("|");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#cmbKategori").val(n[1].toString());
                        $("#txtTgl").val(n[2].toString());
                        $("#txtSubjek").val(n[3].toString());
                        $("#txtRingkasan").val(n[4].toString());
                        var file = n[5].toString();
                        file = file.split(",");
                        var l = "";
                        $.each(file, function(i, v) {
                            l = l + "<span class='badge badge-warning'>" + (i + 1) + "</span><a class='btn btn-link'> " + v + "</a></br>";
                            //alert(l);
                        });
                        $("#lampiranEdit").html(l);
                        mode("Informasi Data Pengguna", false, "show");
                        $("#lampiranView").show();
                        $("#MODE").val("EDIT");
                    }
                });

            });
            $(".cmdHapus").click(function() {
                var id = $(this).attr("data-id");
                var kategori = $(this).attr("data-kategori");
                $.ajax({
                    url: "ARSIP/arsip_hapus.php",
                    type: "POST",
                    data: "id=" + id + "&kategori=" + kategori,
                    cache: false,
                    success: function(ret) {
                        $("#" + id).slideUp("slow", function() {
                            $(this).remove();
                        });
                        $.pnotify({
                            title: "PESAN",
                            text: ret,
                            type: "info",
                            style: "bootstrap"
                        });
                    }
                });
            });


        });
    })(jQuery);
</script>