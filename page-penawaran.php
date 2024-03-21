<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'penawaran-tambah' : include 'form-penawaran.php';
    break;

    case 'penawaran-lihat' : include 'lihat-penawaran.php';
    break;

    case 'penawaran-detil' : include 'data-penawaran.php';
    break;

    case 'penawaran-ubah' : include 'ubah-penawaran.php';
    break;
}
?>