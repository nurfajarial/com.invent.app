<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
    case 'modal-tambah' : include 'form-modal.php';
    break;

    case 'modal-lihat' : include 'lihat-modal.php';
    break;

    case 'modal-detil' : include 'detail-modal.php';
    break;

    case 'modal-ubah' : include 'ubah-modal.php';
    break;

    case 'modal-hapus' : include 'hapus-modal.php';
    break;
}
?>