<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
     case 'gudang-tambah' : include 'form-gudang.php';
     break;

     case 'gudang-lihat' : include 'lihat-gudang.php';
     break;

     case 'gudang-detil' : include 'detail-gudang.php';
     break;

     case 'gudang-ubah' : include 'ubah-gudang.php';
     break;

     case 'gudang-hapus' : include 'hapus-gudang.php';
     break;
}
?>