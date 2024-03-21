<?php
session_start();
include 'config/koneksi.php';

$kode_barang = $_POST['txt_kode_barang'];
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$ip = $_SERVER['REMOTE_ADDR'];
$alat = $_SERVER['alat'];

$add2 = "
INSERT INTO audit_log
(
    user,
    aksi,
    data_lama,
    data_baru,
    jumlah,
    tabel,
    alat,
    IP,
    tanggal,
    jam
)
VALUES
(
    '$user',
    'INSERT',
    '',
    '$kode_barang',
    '',
    'barang',
    '$alat',
    '$ip',
    '$tgl',
    '$jam'
)";

//echo $add2."<br /><br />";
mysqli_query($buka, $add2);

?>