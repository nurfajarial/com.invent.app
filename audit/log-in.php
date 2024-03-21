<?php
session_start();
include 'config/koneksi.php';
//include 'config/cek-device.php';
date_default_timezone_set('Asia/Jakarta');

$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$ip = $_SERVER['REMOTE_ADDR'];
$alat = $_SESSION['alat'];

$masuk = "
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
    'login',
    '',
    '',
    '',
    '',
    '$alat',
    '$ip',
    '$tgl',
    '$jam'
)";

//echo $masuk;
mysqli_query($buka, $masuk);
//mysqli_close($buka);
?>