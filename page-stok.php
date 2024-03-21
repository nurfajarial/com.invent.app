<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'stok-tambah' : include 'form-stok.php';
    break;

    case 'stok-lihat' : include 'lihat-stok.php';
    break;

    case 'stok-detil' : include 'detail-stok.php';
    break;

    case 'stok-ubah' : include 'ubah-stok.php';
    break;

    case 'stok-hapus' : include 'hapus-stok.php';
    break;
}
?>