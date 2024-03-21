<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
include "config/koneksi.php";

//if(isset($_POST['Submit']))
//{
    $kd_po = $_POST['txt_kd_po'];
    $tgl_po = $_POST['txt_tgl_po'];
    $sesi = $_POST['txt_sesi'];
    $jml_item = $_POST['jml_item'];
    $kd_brg = $_POST['kd_brg'];
    $nm_brg = $_POST['nm_brg'];
    $jml_brg = $_POST['jml_brg'];

    $saveque = "INSERT INTO po_detail_temp (kode_po, sesi, tanggal_po, kode_barang, jumlah_beli, status) VALUES ";
    $index = 0;

    foreach($kd_brg as $key)
    {
        $saveque .= "('".$kd_po."', '".$sesi."', '".$tgl_po."', '".$key."', '".$jml_brg[$index]."', 'Tunggu'),";
        $index++;
    }

    $saveque = substr($saveque, 0, strlen($saveque) - 1);
    //mysqli_query($buka, $saveque);
    //unset($_SESSION["shopping_cart"]);
    //mysqli_close($buka);

    //echo "<script>alert('PO tersimpan')</script>";
    //echo "<script>document.location='home.php'</script>";

//}
//else
//{
    //echo "<script>alert('variabel kosong')</script>";
    //echo "<script>document.location='home.php?page=lihat-cart'</script>";
//}
if($saveque)
{
    $result = "
    <div class='text-center alert alert-dismissible fade show' align='center'>
        <font color='green'>
            <b>".$saveque."</b>
        <font>
        <button class='btn btn-outline-dark' data-bs-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
}
else
{
    $result = "
    <div class='text-center alert alert-dismissible fade show' align='center'>
        <font color='red'>
            <b>".$saveque."</b>
        <font>
        <button class='btn btn-outline-dark' data-bs-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
}

echo json_encode($result);