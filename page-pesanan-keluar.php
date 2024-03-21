<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'pesanan-keluar-tambah' : include 'form-pesanan-keluar.php';
    break;

    case 'pesanan-keluar-lihat' : include 'lihat-pesanan-keluar.php';
    break;

    case 'pesanan-keluar-detil' : include 'detail-pesanan-keluar.php';
    break;

    case 'pesanan-keluar-ubah' : include 'ubah-pesanan-keluar.php';
    break;
}
?>