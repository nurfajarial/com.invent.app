<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'mutasi-keluar-temp-tambah' : include 'form-mutasi-keluar-temp.php';
    break;

    case 'mutasi-keluar-temp-lihat' : include 'lihat-temp-mutasi-keluar.php';
    break;

    case 'mutasi-keluar-temp-setuju' : include 'konfirmasi-temp-mutasi-keluar.php';
    break;    

    case 'mutasi-keluar-temp-detil' : include 'detail-mutasi-keluar-temp.php';
    break;

    case 'mutasi-keluar-temp-ubah' : include 'ubah-temp-mutasi-keluar.php';
    break;

    case 'mutasi-keluar-temp-hapus' : include 'hapus-mutasi-keluar-temp.php';
    break;

    case 'mutasi-keluar-lihat' : include 'lihat-mutasi-keluar.php';
    break;

    case 'mutasi-keluar-detil' : include 'detail-mutasi-keluar.php';
}
?>