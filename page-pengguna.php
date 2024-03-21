<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'pengguna-tambah' : include 'form-pengguna.php';
    break;

    case 'pengguna-lihat' : include 'lihat-pengguna.php';
    break;

    case 'pengguna-detil' : include 'detail-pengguna.php';
    break;

    case 'pengguna-ubah' : include 'ubah-pengguna.php';
    break;

    case 'pengguna-hapus' : include 'hapus-pengguna.php';
    break;

    case 'pengguna-ubah-pass' : include 'ubah-password.php';
    break;

    case 'pengguna-hapus' : include 'hapus-pengguna.php';
    break;
}
?>