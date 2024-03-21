<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'mutasi-masuk-temp-tambah' : include 'form-mutasi-masuk-temp.php';
    break;

    case 'mutasi-masuk-temp-lihat' : include 'lihat-temp-mutasi-masuk.php';
    break;

    case 'mutasi-masuk-temp-setuju' : include 'konfirmasi-temp-mutasi-masuk.php';
    break;

    case 'mutasi-masuk-temp-detil' : include 'detail-mutasi-masuk-temp.php';
    break;

    case 'mutasi-masuk-temp-ubah' : include 'ubah-temp-mutasi-masuk.php';
    break;

    case 'mutasi-masuk-temp-hapus' : include 'hapus-mutasi-masuk-temp.php';
    break;

    case 'mutasi-masuk-lihat' : include 'lihat-mutasi-masuk.php';
    break;

    case 'mutasi-masuk-detil' : include 'detail-mutasi-masuk.php';
    break;

}
?>