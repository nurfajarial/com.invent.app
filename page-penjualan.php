<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'penjualan-tambah' : include 'form-penjualan.php';
    break;

    case 'lihat-cart-jual' : include 'lihat-cart-jual.php';
    break;
    
    case 'penjualan-lihat' : include 'lihat-penjualan.php';
    break;

    case 'penjualan-detil' : include 'detail-penjualan.php';
    break;

    case 'penjualan-ubah' : include 'ubah-penjualan.php';
    break;

    case 'pengiriman-tambah' : include 'form-do.php';
    break;

    case 'pengiriman-lihat' : include 'lihat-pengiriman.php';
    break;

    case 'pengiriman-detil' : include '';
    break;

    case 'pengiriman-ubah' : include '';
    break;
}
?>