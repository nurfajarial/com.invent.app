<?php
include 'config/koneksi.php';
session_start();

$kode_user = $_GET['kode_user'];
$username1 = $_POST['txt_user'];
$pass1 = $_POST['txt_password'];
$pwd1 = md5($pass1);
$level1 = $_POST['cmb_level'];
$nama1 = $_POST['txt_nama'];
$status1 = $_POST['cmb_status'];
$hp11 = $_POST['txt_hp1'];
$hp21 = $_POST['txt_hp2'];

$qry = mysqli_query($buka, "SELECT * FROM karyawan JOIN level ON level.kode_level = karyawan.kode_level WHERE kode_user='$kode_user'");
$dt= mysqli_fetch_array($qry, MYSQLI_BOTH);
$username = $dt['user'];
$pass = $dt['temp_pass'];
$pwd = $dt['password'];
$level = $dt['kode_level'];
$nama = $dt['nama_karyawan'];
$status = $dt['status'];
$hp1 = $dt['no_hp1'];
$hp2 = $dt['no_hp2'];

function kueri($data_lama, $data_baru)
{
    $user = $_SESSION['user'];
    $tgl = date('Y-m-d');
    $jam = date('H:i');
    $alat = $_SESSION['alat'];
    $ip  = $_SERVER['REMOTE_ADDR'];
    
    $add1 = "
    INSERT INTO audit_log
    (
        user, aksi, data_lama, data_baru, tabel, alat, IP, tanggal, jam
    )
    VALUES
    (
        '$user', 'UPDATE', '$data_lama', '$data_baru', 'karyawan', '$alat', '$ip', '$tgl', '$jam'
    )";
    
    //echo "<br />".$add1;
    mysqli_query($buka, $add1);
}

if($username1 != $username)
{
    include 'config/koneksi.php';
    //$data_lama = $username;
    //$data_baru = $username1;
    kueri($username, $username1);
}

if($pass1 != $pass)
{
    $data_lama = $pwd;
    $data_baru = $pwd1;
    kueri();
}

if($level1 != $level)
{
    $data_lama = $level;
    $data_baru = $level1;
    kueri();
}

if($nama1 != $nama)
{
    $data_lama = $nama;
    $data_baru = $nama1;
    kueri();
}

if($status1 != $status)
{
    $data_lama = $status;
    $data_baru = $status1;
    kueri();
}

if($hp11 != $hp1)
{
    $data_lama = $hp1;
    $data_baru = $hp11;
    kueri();
}

if($hp21 != $hp2)
{
    $data_lama = $hp2;
    $data_baru = $hp21;
    kueri();
}

?>