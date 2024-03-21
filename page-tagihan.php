<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'tagihan-tambah' : include 'form-tagihan.php';
    break;

    case 'tagihan-lihat' : include 'lihat-tagihan.php';
    break;

    case 'tagihan-detil' : include 'detail-tagihan.php';
    break;

    case 'tagihan-ubah' : include 'ubah-tagihan.php';
    break;

    case 'tagihan-hapus' : include 'hapus-tagihan.php';
    break;
}
?>