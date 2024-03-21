<?php
include 'config/koneksi.php';

$kode_barang = $_GET['kode_barang'];
$kode_barang1 = $_POST['txt_kode_barang'];
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$data_lama = $kode_barang;
$alat = $_SESSION['alat'];
$ip  = $_SERVER['REMOTE_ADDR'];

if($kode_barang1 == $kode_barang)
{
    $data_baru = '';
}
else
{
    $data_baru = $kode_barang1;
}

$add1 = "INSERT INTO audit_log 
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
	'UPDATE',
	'$data_lama',
	'$data_baru',
	'barang',
	'$alat',
	'$ip',
	'$tgl',
	'$jam'
)";

//echo $add1."<br /><br />";
mysqli_query($buka, $add1);
mysqli_close($buka);

?>