<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'pesanan-beli' : include 'form-po.php';
    break;

    case 'lihat-cart' : include 'lihat-cart.php';
    break;

    case 'lihat-po' : include 'lihat-po.php';
    break;

    case 'po-setuju' : include 'po-konfirm.php';
    break;

    case 'po-hapus' : include 'hapus-po.php';
    break;

    case 'pembelian-temp' : include 'lihat-po-fix.php';
    break;

    case 'po-fix-hapus' : include 'hapus-po-fix.php';
    break;

    case 'pembelian-tambah' : include 'form-pembelian.php';
    break;

    case 'pembelian-lihat' : include 'lihat-pembelian.php';
    break;

    case 'pembelian-detail' : include 'detail-pembelian.php';
    break;

    case 'pembelian-hapus' : include 'hapus-pembelian.php';
    break;
}
?>