<?php
//include "koneksi.php";
?>
<div class="widget">
    <div class="widget-header">
        <h5>DATA KOP SURAT</h5>
    </div>
    <div class="widget-content">
        <p><button class="btn btn-primary" id="cmdTambah"><i class="icon-plus icon-white"></i>Tambah Data</button></p>
        <p>
        <form class="form-horizontal" id="frmKop" method="POST" enctype="multipart/form-data" action="KOP_SURAT/kop_proses.php">
            <legend>Menambah Kop Surat</legend>
            <input type="hidden" name="tmp" id="tmp">
            <input type="hidden" name="MODE" id="MODE" value="ADD">
            <div class="control-group"> 
                <label class="control-label" for="txtID">ID KOP</label>
                <div class="controls">
                    <input type="text" id="txtID" name="txtID" placeholder="Kode Kop Surat" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtNama">Nama Kop Surat</label>
                <div class="controls">
                    <input type="text" id="txtNama" name="txtNama" placeholder="Nama Kop Surat" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtFile">Gambar KOP</label>
                <div class="controls">
                    <img src="KOP_SURAT/logo_kop.png" class="img-polaroid" name="imgLogo" id="imgLogo"></br>
                    <input type="file" id="txtFile" name="txtFile">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtLembaga">Nama Lembaga</label>
                <div class="controls">
                    <input type="text" id="txtLembaga" name="txtLembaga" placeholder="Nama Institusi" required="required">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Alamat</label>
                <div class="controls">
                    <label class="">
                        <textarea rows="3" id="txtAlamat" name="txtAlamat"  placeholder="Alamat Lengkap"/></textarea>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtTelp">Nomor Telpon</label>
                <div class="controls">
                    <input type="text" id="txtTelp" name="txtTelp" placeholder="No. Telpon">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtKodePos">Kode Pos</label>
                <div class="controls">
                    <input type="text" id="txtKodePos" name="txtKodePos" placeholder="Kode Pos">
                </div>
            </div>  
            <div class="control-group">
                <label class="control-label" for="txtFax">Nomor Fax</label>
                <div class="controls">
                    <input type="text" id="txtFax" name="txtFax" placeholder="No. Fax">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtWeb">Alamat Situs</label>
                <div class="controls">
                    <input type="text" id="txtWeb" name="txtWeb" placeholder="Alamat Web">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txtEmail">Email</label>
                <div class="controls">
                    <input type="text" id="txtEmail" name="txtEmail" placeholder="E-Mail">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button id="cmdSimpan" class="btn btn-info">Simpan</button>
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
                <th>Logo</th>
                <th>Nama Kop Surat</th>
                <th>Nama Lembaga</th>
                <th>Aksi</th>
            </tr>
            <?php
            $kueri = mysql_query("SELECT * FROM t_kop_surat");
            $i = 1;
            while ($data = mysql_fetch_array($kueri, MYSQL_ASSOC)) {
                echo "<tr id='{$data['id_kop']}'>";
                echo "<td>$i</td>";
                echo "<td>{$data['id_kop']}</td>";
           
                if (empty($data['logo'])) {
                    $imgOri = "KOP_SURAT/logo_kop.PNG";
                } else {
                    if (file_exists("KOP_SURAT/" . $data['logo'])) {
                        $imgOri = "KOP_SURAT/".$data['logo'];
                    } else {
                        $imgOri = "KOP_SURAT/logo_kop.PNG";
                    }
                }
                               
            echo "<td><img src='$imgOri' class='img-rounded' width='40' height='40'></td>";
            echo "<td>{$data['nama_kop']}</td>";
            echo "<td>{$data['nama_lembaga']}</td>";
            echo "<td>";
                echo "<div class='btn-group'>";
                    echo "<button class='btn cmdEdit' data-id='{$data['id_kop']}'><i class='icon-edit'></i></button>";
                    echo "<button class='btn cmdHapus' data-id='{$data['id_kop']}' data-logo='{$data['logo']}'><i class='icon-trash'></i></button>";
                    echo "<button class='btn cmdView' data-id='{$data['id_kop']}'><i class='icon-picture'></i></button>";
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
                mode("Tambah Data Kop Surat", false, "show");
                $(".form-horizontal input[type=text]").each(function() {
                    $(this).val("");
                });
                $(".form-horizontal textarea").val("");
                $(".form-horizontal").slideToggle("slow");

            });
            $("#cmdSimpan").click(function() {
                $("#frmKop").submit(function(e) {
                });
            });

            $(".cmdView").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "KOP_SURAT/kop_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");
                        
                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#txtNama").val(n[1].toString());
                        $("#txtLembaga").val(n[2].toString());
                        $("#txtAlamat").val(n[3].toString());
                        $("#txtTelp").val(n[4].toString());
                        $("#txtKodePos").val(n[5].toString());
                        $("#txtFax").val(n[6].toString());
                        $("#txtWeb").val(n[7].toString());
                        $("#txtEmail").val(n[8].toString());
                        var logo = n[9].toString();
                        if(logo==""){
                            $("#imgLogo").attr("src","KOP_SURAT/logo_kop.PNG");
                        }else{
                            $("#imgLogo").attr("src","KOP_SURAT/"+logo);                            
                        }
                        mode("Informasi Kop Surat", true, "hide");
                    }
                });

            });

            $(".cmdEdit").click(function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "KOP_SURAT/kop_view.php",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    success: function(n) {
                        $(".form-horizontal").show();
                        var n = n.split(",");

                        $("#tmp").val(n[0].toString());
                        $("#txtID").val(n[0].toString());
                        $("#txtNama").val(n[1].toString());
                        $("#txtLembaga").val(n[2].toString());
                        $("#txtAlamat").val(n[3].toString());
                        $("#txtTelp").val(n[4].toString());
                        $("#txtKodePos").val(n[5].toString());
                        $("#txtFax").val(n[6].toString());
                        $("#txtWeb").val(n[7].toString());
                        $("#txtEmail").val(n[8].toString());
                        var logo = n[9].toString();
                        if(logo==""){
                            $("#imgLogo").attr("src","KOP_SURAT/logo_kop.PNG");
                        }else{
                            $("#imgLogo").attr("src","KOP_SURAT/"+logo);                            
                        }
                        mode("Informasi Kop Surat", false, "show");
                        $("#MODE").val("EDIT");
                        //  $("#txtID").attr("disabled",true);
                    }
                });

            });
            $(".cmdHapus").click(function() {
                var id = $(this).attr("data-id");
                var logo = $(this).attr("data-logo");
                $.ajax({
                    url: "KOP_SURAT/kop_hapus.php",
                    type: "POST",
                    data: "id=" + id+"&logo="+logo,
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