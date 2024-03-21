<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
     case 'pelanggan-tambah' : include 'form-pelanggan.php';
     break;

     case 'pelanggan-lihat' : include 'lihat-pelanggan.php';
     break;

     case 'pelanggan-detil' : include 'detail-pelanggan.php';
     break;

     case 'pelanggan-ubah' : include 'ubah-pelanggan.php';
     break;

     case 'pelanggan-hapus' : include 'hapus-pelanggan.php';
     break;
}
?>