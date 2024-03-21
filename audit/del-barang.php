<?php
include 'config/koneksi.php';

$kode_barang = $_GET['kode_barang'];
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$ip = $_SERVER['REMOTE_ADDR'];
$alat = $_SESSION['alat'];

$add1 = "
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
    'DELETE',
    '$kode_barang',
    '',
    '',
    'barang',
    '$alat',
    '$ip',
    '$tgl',
    '$jam'
)";

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
    'DELETE',
    '$kode_barang',
    '',
    '',
    'stok',
    '$alat',
    '$ip',
    '$tgl',
    '$jam'
)";

//echo $add1."<br /><br />";
//echo $add2."<br /><br />"

mysqli_query($buka, $add1);
mysqli_query($buka, $add2);

mysqli_close($buka);
?>