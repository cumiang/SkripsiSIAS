<?php
include "../koneksi.php";
session_start();

function ambil_nomor_urut() {
    $urut = ambil_data_sql("SELECT no_surat_keluar FROM t_surat_keluar ORDER BY urut DESC LIMIT 1");
    $pos_char = strpos($urut[0], "/", 0);
    $urut_no = substr($urut[0], 0, $pos_char);
    $urut_no = $urut_no + 1;
    return $urut_no;
}
?>
<legend class="pull-left">FORM INPUT SURAT</legend>
<form id="frmUpload" method="POST" action="surat_keluar_upload.php" enctype="multipart/form-data">
    <table class="table table-bordered table-striped">
        <tr>
            <td>Nomor Urut</td>
            <td><input class="span1" type="text" name="txtUrut" id="txtUrut" placeholder="No. Urut" value="<?php echo ambil_nomor_urut(); ?>"> <a class="text-error">Nomor Urut Kemudian Dipisahkan dengan tanda Penghubung " / "</a></td>
        </tr>
        <tr>
            <td>Nomor Surat</td>
            <td><input class="span3" type="text" name="txtPrefix" id="txtPrefix" placeholder="No. Prefix Surat" ></td>
        </tr>
        <tr>
            <td>Pilih Kop Surat</td>
            <td>
                <select id="cmbKopSurat">
                    <?php
                    $kueri = mysql_query("SELECT id_kop,nama_kop FROM t_kop_surat ORDER BY id_kop ASC");

                    if (mysql_num_rows($kueri) > 0) {
                        while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                            echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
                        }
                    }
                    ?>

                </select>                            
            </td>
        </tr>
        <tr>
            <td>Tanggal Surat</td>
            <td><input class="span2" type="date" id="txtTgl" placeholder="Tanggal" value="<?php echo DATE("Y-m-d"); ?>"></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td><input class="input-xxlarge" type="text" id="txtPerihal" placeholder="Judul Surat"></td>
        </tr>
        <tr>
            <td>Dari</td>
            <td>
                <input type="text" id="txtPengirim" placeholder="txtPengirim" data="<?php echo$_SESSION['id']; ?>" value="<?php echo $_SESSION['nama']; ?>">
            </td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td>
                <select multiple="multiple" id="cmbPenerima" class="itemUser">
                    <?php
                    $kueri = mysql_query("SELECT id_user,nama_user FROM t_user ORDER BY id_user ASC");

                    if (mysql_num_rows($kueri) > 0) {
                        while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                            echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
                        }
                    }
                    ?>
                </select>
                <a class="btn btn-primary tambahItem"><i class="icon-plus icon-white"></i></a>                
            </td>
        </tr>
        <tr>
            <td>Tembusan/CC</td>
            <td>
                <select multiple="multiple" id="cmbTembusan" class="itemUser">
                    <?php
                    $kueri = mysql_query("SELECT id_user,nama_user FROM t_user ORDER BY id_user ASC");

                    if (mysql_num_rows($kueri) > 0) {
                        while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                            echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
                        }
                    }
                    ?>
                </select>
                <a class="btn btn-primary tambahItem"><i class="icon-plus icon-white"></i></a>  
            </td>
        </tr>
        <tr>
            <td>Jenis Surat</td>
            <td>
                <select id="cmbJenisSurat">
                    <?php
                    $kueri = mysql_query("SELECT id_jenis,jenis_surat FROM t_jenis_surat ORDER BY id_jenis ASC");

                    if (mysql_num_rows($kueri) > 0) {
                        while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                            echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Isi Surat</td>
            <td>
                <textarea id="txtIsi"></textarea>
            </td>
        </tr>
        <tr>
            <td>Penandatangan</td>
            <td>
                <select id="cmbPenandatangan" multiple="multiple" class="itemUser">
                    <?php
                    $kueri = mysql_query("SELECT id_user,nama_user FROM t_user ORDER BY id_user ASC");

                    if (mysql_num_rows($kueri) > 0) {
                        while ($data = mysql_fetch_array($kueri, MYSQL_NUM)) {
                            echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
                        }
                    }
                    ?>
                </select>
                <a class="btn btn-primary tambahItem" data-content="<input type='text' class='txtItem'><button class='btn btn-mini btn-warning cmdItem' type='button'>Tambah</button>"><i class="icon-plus icon-white"></i></a>  
            </td>
        </tr>
        <tr>
            <td>Prioritas Surat</td>
            <td>
                <input type="radio" id="optPrioritas" name="optPrioritas" value="Normal" checked> Normal
                <input type="radio" id="optPrioritas" name="optPrioritas" value="Penting"> Penting<br>
            </td>
        </tr>

        <tr>
            <td>Lampiran File</td>
            <td>
                <input type="file" id="upload" name="upload[]" multiple>

            </td>
        </tr>
        <tr>
            <td>
                <button class="btn btn-large btn-danger" type="button" id="cmdSimpan">SIMPAN</button>
            </td>
        </tr> 
    </table>
</form>
<script src="../js/bootstrap-popover.js"></script> <!-- Custom codes -->
<script>
    $(".tambahItem").popover({
        html: "true",
        placement: "right",
        toggle: "popover",
        title: "Tambah Data",
        content: '<input type="text" id="txtItem"><button class="btn btn-mini btn-warning" id="cmdItem" type="button">Tambah</button>'
    }).parent().delegate('button#cmdItem', 'click', function() {
        var item = $("#txtItem").val();
        $(".itemUser").append("<option value='" + item + "'>" + item + "</option>");
    });
</script>

<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 800,
        height: 200
    });
</script>

<script type="text/javascript">
    $("#cmdSimpan").click(function() {
        $("#txtUrut").removeAttr("disabled");
        var urut = $("#txtUrut").val() + "/" + $("#txtPrefix").val();
        var kop = $("#cmbKopSurat").val();
        var tgl = $("#txtTgl").val();
        var perihal = $("#txtPerihal").val();
        var pengirim = $("#txtPengirim").attr("data");
        var penerima = $("#cmbPenerima").val();
        var tembusan = $("#cmbTembusan").val();
        var jenis = $("#cmbJenisSurat").val();
        var isi = tinyMCE.get('txtIsi').getContent({format: 'text'});
        var penandatangan = $("#cmbPenandatangan").val();
        var prioritas = $("input[type='radio']:checked").val();
        var data = "urut=" + urut + "&kop=" + kop + "&tgl=" + tgl + "&perihal=" + perihal + "&pengirim=" + pengirim +
                "&penerima=" + penerima + "&tembusan=" + tembusan + "&jenis=" + jenis + "&isi=" + isi +
                "&penandatangan=" + penandatangan + "&prioritas=" + prioritas + "&MODE=ADD";
        //alert($("#frmUpload").serialize());
        $.ajax({
            url: "surat_keluar_proses.php",
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
            $("#frmUpload").submit();
        }

    });
</script>