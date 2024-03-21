<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'omset-tambah' : include 'form-omset.php';
    break;

    case 'omset-lihat' : include 'lihat-omset.php';
    break;

    case 'omset-detil' : include 'detail-omset.php';
    break;

    case 'omset-ubah' : include 'ubah-omset.php';
    break;
}
?>