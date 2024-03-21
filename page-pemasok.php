<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'pemasok-tambah' : include 'form-pemasok.php';
    break;

    case 'pemasok-lihat' : include 'lihat-pemasok.php';
    break;

    case 'pemasok-detil' : include 'detail-pemasok.php';
    break;

    case 'pemasok-ubah' : include 'ubah-pemasok.php';
    break;

    case 'pemasok-hapus' : include 'hapus-pemasok.php';
    break;
}
?>