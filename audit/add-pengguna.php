<?php
session_start();
include 'config/koneksi.php';

$userñame = $_POST['txt_user'];
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$ip = $_SERVER['REMOTE_ADDR'];
$alat = $_SESSION['alat'];

$add2 = "INSERT INTO audit_log 
(
    user, 
    aksi, 
    data_lama, 
    data_baru, 
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
	'$username',
	'karyawan',
	'$alat',
	'$ip',
	'$tgl', 
	'$jam'
)";

mysqli_query($buka, $add2);

?>