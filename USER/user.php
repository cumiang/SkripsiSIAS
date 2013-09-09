<?php
//include "koneksi.php";
?>
<div class="widget">
    <div class="widget-header">
        <h5>MANAJEMEN DATA PENGGUNA</h5>
    </div>
    <div class="widget-content">
        <p><button class="btn btn-primary" id="cmdTambah"><i class="icon-plus icon-white"></i>Tambah Data</button></p>
        <p>
        <form class="form-horizontal">
            <legend>Menambah Data Pengguna</legend>
            <input type="hidden" name="tmp" id="tmp">
            <input type="hidden" name="MODE" id="MODE" value="ADD">
            <div class="control-group"> 
                <label class="control-label" for="txtID">ID Pengguna</label>
                <div class="controls">
                    <input type="text" id="txtID" name="txtID" placeholder="ID pengguna" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtUser">Informasi Login</label>
                <div class="controls">
                    <input type="text" id="txtUser" name="txtUser" placeholder="Nama User Login" required="required">
                    <input type="text" id="txtPass" name="txtPass" placeholder="Password Login" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Hak Akses</label>
                <div class="controls" required="required">
                    <select id="cmbHakAkses" name="cmbHakAkses">
                        <option value="ADMIN">ADMIN</option>
                        <option value="STAFF">STAFF</option>
                        <option value="PIC">PIC</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Nama Lengkap</label>
                <div class="controls">
                    <label class="">
                        <input type="text" id="txtNama" name="txtNama"  placeholder="Nama Lengkap" required="required" />
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Kategori</label>
                <div class="controls">
                    <select id="cmbKategori" name="cmbKategori">
                        <option value="Internal">Internal</option>
                        <option value="Eksternal">Eksternal</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtID">Unit Kerja</label>
                <div class="controls">
                    <input type="text" id="txtUnit" name="txtUnit" placeholder="Unit Kerja">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtID">Jurusan</label>
                <div class="controls">
                    <input type="text" id="txtJurusan" name="txtJurusan" placeholder="Jurusan Di Instansi">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtID">Jabatan</label>
                <div class="controls">
                    <input type="text" id="txtJabatan" name="txtJabatan" placeholder="Jabatan di Instansi">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                    <select id="cmbStatus" name="cmbStatus">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
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
                <th>Nama User</th>
                <th>Unit Kerja</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php
            $kueri = mysql_query("SELECT * FROM t_user");
            $i = 1;
            while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                echo "<tr id='{$data['id_user']}'>";
                echo "<td>$i</td>";
                echo "<td>{$data['id_user']}</td>";
                echo "<td>{$data['nama_lengkap']}</td>";
                echo "<td>{$data['unit_kerja']}</td>";
                echo "<td>{$data['jabatan']}</td>";
                echo "<td>{$data['status']}</td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                echo "<button class='btn cmdEdit' data-id='{$data['id_user']}'><i class='icon-edit'></i></button>";
                echo "<button class='btn cmdHapus' data-id='{$data['id_user']}'><i class='icon-trash'></i></button>";
                echo "<button class='btn cmdProfil' data-id='{$data['id_user']}'><i class='icon-user'></i></button>";
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
                $(".form-horizontal select").each(function() {
                    $(this).attr("disabled", disable);
                });
                if (tombolVisible == "hide") {
                    $("#cmdSimpan").hide();
                } else {
                    $("#cmdSimpan").show();
                }

            }

            $("#cmdTambah").click(function() {
                $("#MODE").val("ADD");
                mode("Tambah Data Pengguna", false, "show");
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).val("");
                });
                $(".form-horizontal").slideToggle("slow");

            });
            $("#cmdSimpan").click(function() {
                var data = $(".form-horizontal").serialize();
                $.ajax({
                    url: "USER/user_proses.php",
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

            $(".cmdProfil").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "USER/user_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");

                        $("#txtID").val(n[0].toString());
                        $("#txtUser").val(n[1].toString());
                        $("#txtPass").val(n[2].toString());
                        $("#txtNama").val(n[3].toString());
                        $("#cmbKategori").val(n[4].toString());
                        $("#txtUnit").val(n[5].toString());
                        $("#txtJurusan").val(n[6].toString());
                        $("#txtJabatan").val(n[7].toString());
                        $("#cmbHakAkses").val(n[8].toString());
                        $("#cmbStatus").val(n[9].toString());
                        mode("Informasi Data Pengguna", true, "hide");
                    }
                });

            });

            $(".cmdEdit").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "USER/user_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#txtUser").val(n[1].toString());
                        $("#txtPass").val(n[2].toString());
                        $("#txtNama").val(n[3].toString());
                        $("#cmbKategori").val(n[4].toString());
                        $("#txtUnit").val(n[5].toString());
                        $("#txtJurusan").val(n[6].toString());
                        $("#txtJabatan").val(n[7].toString());
                        $("#cmbHakAkses").val(n[8].toString());
                        $("#cmbStatus").val(n[9].toString());
                        mode("Informasi Data Pengguna", false, "show");
                        $("#MODE").val("EDIT");
                        //  $("#txtID").attr("disabled",true);


                    }
                });

            });
            $(".cmdHapus").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "USER/user_hapus.php",
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