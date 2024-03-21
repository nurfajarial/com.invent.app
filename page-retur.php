<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'retur-tambah' : include 'form-retur.php';
    break;

    case 'retur-lihat' : include 'lihat-retur.php';
    break;

    case 'retur-detil' : include 'detail-retur.php';
    break;

    case 'retur-ubah' : include 'ubah-retur.php';
    break;

    case 'retur-hapus' : include 'hapus-retur.php';
    break;
}
?>