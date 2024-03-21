<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'utang-tambah' : include 'form-hutang.php';
    break;

    case 'utang-lihat' : include 'lihat-hutang.php';
    break;

    case 'utang-detil' : include 'detail-utang.php';
    break;

    case 'utang-ubah' : include 'ubah-utang.php';
    break;
}
?>