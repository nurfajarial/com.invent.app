<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'backup-data' : include 'form_backup.php';
    break;
    
    case 'rek-tambah' : include 'form_rek.php';
    break;
    
    case 'rek-lihat' : include 'lihat-rek.php';
    break;

    case 'satuan-tambah' : include 'form-satuan.php';
    break;

    case 'satuan-lihat' : include 'lihat-satuan.php';
    break;

    case 'satuan-detil' : include 'detail-satuan.php';
    break;

    case 'satuan-ubah' : include 'ubah-satuan.php';
    break;

    case 'satuan-hapus' : include 'hapus-satuan.php';
    break;    

    case 'pembayaran-tambah' : include 'form-pembayaran.php';
    break;

    case 'pembayaran-lihat' : include 'lihat-pembayaran.php';
    break;

    case 'pembayaran-ubah' : include 'ubah-pembayaran.php';
    break;

    case 'pembayaran-hapus' : include 'hapus-pembayaran.php';
    break;

    case 'audit-lihat' : include 'lihat-audit.php';
    break;

    case 'about' : include 'about.php';
    break;
}
?>