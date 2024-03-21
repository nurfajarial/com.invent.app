<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
     case 'barang-tambah' : include 'form-barang.php';
     break;

     case 'barang-lihat' : include 'lihat-barang.php';
     break;

     case 'barang-detil' : include 'detail-barang.php';
     break;

     case 'barang-ubah' : include 'ubah-barang.php';
     break;

     case 'barang-hapus' : include 'hapus-barang.php';
     break;
}
?>