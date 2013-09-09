<?php
//include "koneksi.php";
?>
<div class="widget">
    <div class="widget-header">
        <h5>MANAJEMEN DATA JENIS SURAT</h5>
    </div>
    <div class="widget-content">
        <p><button class="btn btn-primary" id="cmdTambah"><i class="icon-plus icon-white"></i>Tambah Data</button></p>
        <p>
        <form class="form-horizontal">
            <legend>Menambah Jenis Surat</legend>
            <input type="hidden" name="tmp" id="tmp">
            <input type="hidden" name="MODE" id="MODE" value="ADD">
            <div class="control-group"> 
                <label class="control-label" for="txtID">ID</label>
                <div class="controls">
                    <input type="text" id="txtID" name="txtID" placeholder="Kode Jenis Surat" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtJenis">Jenis Surat</label>
                <div class="controls">
                    <input type="text" id="txtJenis" name="txtJenis" placeholder="Nama Jenis Surat" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Singkatan</label>
                <div class="controls">
                    <label class="">
                        <input type="text" id="txtSingkat" name="txtSingkat"  placeholder="Singkatan Nama Jenis Surat" required="required" />
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtDeskripsi">Dekripsi</label>
                <div class="controls">
                    <textarea id="txtDeskripsi" rows="3" name="txtDeskripsi" placeholder="Keterangan"></textarea>
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
        <p>
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Jenis Surat</th>
                <th>Singkatan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php
            $kueri = mysql_query("SELECT * FROM t_jenis_surat ORDER BY id_jenis ASC");
            $i = 1;
            while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                echo "<tr id='{$data['id_jenis']}'>";
                echo "<td>$i</td>";
                echo "<td>{$data['id_jenis']}</td>";
                echo "<td>{$data['jenis_surat']}</td>";
                echo "<td>{$data['singkat']}</td>";
                echo "<td>{$data['deskripsi']}</td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                echo "<button class='btn cmdEdit' data-id='{$data['id_jenis']}'><i class='icon-edit'></i></button>";
                echo "<button class='btn cmdHapus' data-id='{$data['id_jenis']}'><i class='icon-trash'></i></button>";
                echo "<button class='btn cmdView' data-id='{$data['id_jenis']}'><i class='icon-th'></i></button>";
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
<script>
    (function($) {
        $(window).load(function() {

            function mode(judul, disable, tombolVisible) {
                $(".form-horizontal legend").html(judul);
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).attr("disabled", disable);
                });
                $(".form-horizontal textarea").attr("disabled", disable);

                if (tombolVisible == "hide") {
                    $("#cmdSimpan").hide();
                } else {
                    $("#cmdSimpan").show();
                }

            }

            $("#cmdTambah").click(function() {
                $("#MODE").val("ADD");
                mode("Tambah Data Jenis Surat", false, "show");
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).val("");
                });
                 $(".form-horizontal textarea").val("");
                $(".form-horizontal").slideToggle("slow");

            });
            $("#cmdSimpan").click(function() {
                var data = $(".form-horizontal").serialize();
                $.ajax({
                    url: "JENIS_SURAT/jenis_proses.php",
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
            });

            $(".cmdView").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "JENIS_SURAT/jenis_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#txtJenis").val(n[1].toString());
                        $("#txtSingkat").val(n[2].toString());
                        $("#txtDeskripsi").val(n[3].toString());
                        mode("Informasi Data Jenis Surat", true, "hide");
                    }
                });

            });

            $(".cmdEdit").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "JENIS_SURAT/jenis_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#txtJenis").val(n[1].toString());
                        $("#txtSingkat").val(n[2].toString());
                        $("#txtDeskripsi").val(n[3].toString());
                        mode("Informasi Data Pengguna", false, "show");
                        $("#MODE").val("EDIT");
                    }
                });

            });
            $(".cmdHapus").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "JENIS_SURAT/jenis_hapus.php",
                    type: "POST",
                    data: "id=" + id,
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