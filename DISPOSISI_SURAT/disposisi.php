<?php
//include "koneksi.php";
?>
<div class="widget">
    <div class="widget-header">
        <h5>MANAJEMEN DATA DISPOSISI SURAT MASUK</h5>
    </div>
    <div class="widget-content">
        <p><button class="btn btn-danger" id="cmdTambah">Buka Form</button></p>
        <p>
        <form class="form-horizontal">
            <legend>Detail Data Disposisi</legend>
            <input type="hidden" name="tmp" id="tmp">
            <div class="control-group"> 
                <label class="control-label" for="txtID">ID</label>
                <div class="controls">
                    <input type="text" id="txtID" name="txtID">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtNo">NO SURAT</label>
                <div class="controls">
                    <input type="text" id="txtNO" name="txtNO">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">TGL DISPOSISI</label>
                <div class="controls">
                    <label class="">
                        <input type="text" id="txtTgl" name="txtTgl"/>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">PENDISPOSISI</label>
                <div class="controls">
                    <label class="">
                        <input type="text" id="txtUser" name="txtUser"/>
                    </label>
                </div>
            </div>             
            <div class="control-group">
                <label class="control-label">ISI DISPOSISI</label>
                <div class="controls">
                    <label class="">
                        <textarea class="input-xlarge" id="txtIsi" rows="3" name="txtIsi"></textarea>
                    </label>
                </div>
            </div>                       
            <div class="control-group">
                <label class="control-label" for="txtDeskripsi">CATATAN</label>
                <div class="controls">
                    <textarea class="input-xlarge" id="txtCatatan" rows="3" name="txtCatatan"></textarea>
                </div>
            </div>
        </form>  
        <hr>
        </p>
        <p>
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>No. Surat</th>
                <th>Tgl Disposisi</th>
                <th>Isi Disposisi</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
            <?php
            $sql = "SELECT a.*,b.nama_user,c.no_surat_keluar_fk 
                    FROM t_disposisi_surat_masuk a
                    INNER JOIN t_user b
                    ON a.id_pendisposisi=b.id_user
                    INNER JOIN t_surat_masuk c
                    ON a.id_surat_masuk_fk=c.id_surat_masuk
                    ORDER BY id_disposisi ASC";
            $kueri = mysql_query($sql);
            $i = 1;
            while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                echo "<tr id='{$data['id_disposisi']}'>";
                echo "<td>$i</td>";
                echo "<td>{$data['no_surat_keluar_fk']}</td>";
                echo "<td>{$data['tgl_disposisi']}</td>";
                echo "<td>{$data['isi_disposisi']}</td>";
                echo "<td>{$data['catatan_disposisi']}</td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                echo "<button class='btn cmdHapus' data-id='{$data['id_disposisi']}'><i class='icon-trash'></i></button>";
                echo "<button class='btn cmdView' data-id='{$data['id_disposisi']}'><i class='icon-th'></i></button>";
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

            function mode(disable) {
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).attr("disabled", disable);
                });
                $(".form-horizontal textarea").attr("disabled", disable);
            }

            $("#cmdTambah").click(function() {
                $("#MODE").val("ADD");
                mode(false);
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).val("");
                });
                 $(".form-horizontal textarea").val("");
                $(".form-horizontal").slideToggle("slow");
                $("#cmdTambah").html("Buka form");
            });

            $(".cmdView").click(function() {
                var id = $(this).attr("data-id");
                $("#cmdTambah").html("Tutup form");
                $.ajax({
                    url: "DISPOSISI_SURAT/disposisi_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split("|");
                        $("#txtID").val(n[0].toString());
                        $("#txtNO").val(n[1].toString());
                        $("#txtTgl").val(n[2].toString());
                        $("#txtUser").val(n[3].toString());
                        $("#txtIsi").val(n[4].toString());
                        $("#txtCatatan").val(n[5].toString());
                        mode(true);
                    }
                });

            });

            $(".cmdHapus").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "DISPOSISI_SURAT/disposisi_hapus.php",
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