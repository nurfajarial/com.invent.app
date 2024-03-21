<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'pesanan-tambah' : include 'form-order.php';
    break;

    case 'pesanan-lihat' : include 'lihat-order.php';
    break;

    case 'pesanan-detil' : include 'detail-order.php';
    break;

    case 'pesanan-ubah' : include 'ubah-order.php';
    break;
}
?>