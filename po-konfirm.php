<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
if (isset($_GET['kode_po']) && isset($_GET['sesi']))
{
    $kode_po = $_GET['kode_po'];
    $sesi = $_GET['sesi'];

    //echo "Kode PO : ".$kode_po."<br />";
    //echo "Sesi : ".$sesi."<br />";

    $li_qry = mysqli_query($buka, "SELECT * FROM po_detail_temp WHERE kode_po='$kode_po' AND sesi='$sesi'")or die(mysqli_error());

    $cek_qry2 = mysqli_query($buka, "SELECT * FROM po_detail WHERE kode_po='$kode_po' AND sesi='$sesi'") or die(mysqli_error());
    $row2 = mysqli_fetch_array($cek_qry2);

    if($row2['kode_po'] == null)
    {
        //echo "Kode kosong<br /><br />";
        $kode_po3 = $kode_po;
        $sesi3 = $sesi;
    }
    else
    {
        //echo "<br />Kode sudah ada<br /><br />";
        
        $cek_qry3 = mysqli_query($buka, "SELECT sesi, kode_po FROM po_detail ORDER BY kode_po DESC LIMIT 1") or die(mysqli_error());
        while( $row3 = mysqli_fetch_array($cek_qry3))
        {
            $kode_po2 = $row3['kode_po'];
            $sesi2 = $row3['sesi'];
        }
        $sesi3 = $sesi2 + 1;
        $kode_po3 = 'PO-'.date('dmY').'-'.$sesi3;
        //echo "<br />".$kode_po3;
        //echo "<br />".$sesi3."<br /><br />";

    }

    $app_que = "INSERT INTO po_detail (kode_po, sesi, tanggal_po, kode_barang, jumlah_beli, harga, status) VALUES ";
        
    while($list2 = mysqli_fetch_assoc($li_qry))
    {
        $tgl_po2 = $list2['tanggal_po'];
        $kd_brg2 = $list2['kode_barang'];
        $list_jml2 = $list2['jumlah_beli'];
        $app_que .= "('".$kode_po3."', '".$sesi3."', '".$tgl_po2."', '".$kd_brg2."', '".$list_jml2."', '0', 'OK'),";

    }

    $app_que = substr($app_que, 0, strlen($app_que) - 1);
    mysqli_query($buka, $app_que);
    //echo $app_que;

    mysqli_query($buka, "DELETE FROM po_detail_temp WHERE kode_po = '$kode_po' AND sesi = '$sesi'");

    echo "<script>alert('PO disetujui')</script>";        
    echo "<script>document.location='home.php?page=lihat-po'</script>";

}
else
{
    die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');
}

unset($_SESSION["l_kd_brg"]);
unset($_SESSION["l_jml_brg"]);

//Tutup koneksi engine MySQL
mysqli_close($buka);

?>