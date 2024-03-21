<?php
include 'config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$ip = $_SERVER['REMOTE_ADDR'];
$alat = $_SESSION['alat'];

$keluar = "
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
    'logout',
    '',
    '',
    '',
    '',
    '$alat',
    '$ip',
    '$tgl',
    '$jam'
)";

//echo $keluar;
mysqli_query($buka, $keluar);
//mysqli_close($buka);
?>