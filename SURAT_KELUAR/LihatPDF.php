<?php

include "../koneksi.php";
include "../fungsi.php";

$id = $_POST["id"];

if (isset($id)) {
    $sql = "SELECT a.*,b.*,c.nama_user AS pengirim,d.jenis_surat AS jenis
       FROM t_surat_keluar a 
       INNER JOIN t_kop_surat b 
       ON a.id_kop_fk = b.id_kop 
       INNER JOIN t_user c 
       ON a.pengirim_surat_fk = c.id_user 
       INNER JOIN t_jenis_surat d 
       ON a.id_jenis_surat_fk = d.id_jenis
       WHERE a.no_surat_keluar = '$id'";
    $kueri = mysql_query($sql);
    if (mysql_num_rows($kueri) > 0) {
        $a = mysql_fetch_assoc($kueri);
        $no = $a["no_surat_keluar"];
        $kop = "../KOP_SURAT/".$a["logo"];
        $lembaga = $a["nama_lembaga"];
        $alamat = $a["alamat"];
        $telp = $a["no_telp"];
        $pos = $a["kode_pos"];
        $fax = $a["no_fax"];
        $site = $a["site"];
        $email = $a["email"];         
        $tgl = $a["tgl_surat"];
        $perihal = $a["perihal_surat"];
        $pengirim = $a["pengirim"];
        $penerima = nama_penerima($a["penerima_surat"]);
        $jenis = $a["jenis"];
        $isi = $a["isi_surat"];
        $penandatangan = nama_penerima($a["penandatangan"]);
        $prioritas = $a["prioritas_surat"];
        $tembusan = nama_penerima($a["tembusan"]);
        $lampiran = $a["lampiran_file"];
    }



    require('../PDF/fpdf.php'); // file fpdf.php harus diincludekan
    $pdf = new FPDF('P','mm','A4');
    $pdf->SetTitle("SURAT ".$perihal);
    $pdf->SetMargins(10, 10,10);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    
    //HEADER
    $LP = 200; //lebar halaman
    $X = 10; //titik horizontal awal
    $Y = 10; //titik vertikal awal
    $pdf->Image($kop,15,10,30,30,'','http://www.fpdf.org');    
    $pdf->SetFont('Arial','B',20);
    $pdf->Cell($LP,10,$lembaga,1,0,'C');  
    $pdf->Cell($LP,50,$alamat,0,0,'C');  
    $pdf->Cell(132);
    $pdf->Line(60,10,$LP,18);
    $pdf->Ln(20);
    //FOOTER

    $pdf->Output();




    echo "Surat Telah Disimpan Sebagai file PDF";
} else {
    echo "NO Data";
}
?>
