<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
     case 'merk-tambah' : include 'form-merk.php';
     break;

     case 'merk-lihat' : include 'lihat-merk.php';
     break;

     case 'merk-ubah' : include 'ubah-merk.php';
     break;

     case 'merk-hapus' : include 'hapus-merk.php';
     break;

     case 'jenis-tambah' : include 'form-jenis.php';
     break;

     case 'jenis-lihat' : include 'lihat-jenis.php';
     break;

     case 'jenis-ubah' : include 'ubah-jenis.php';
     break;

     case 'jenis-hapus' : include 'hapus-jenis.php';
     break;

     case 'model-tambah' : include 'form-model.php';
     break;

     case 'model-lihat' : include 'lihat-model.php';
     break;

     case 'model-ubah' : include 'ubah-model.php';
     break;

     case 'model-hapus' : include 'hapus-model.php';
     break;

     case 'tipe-tambah' : include 'form-tipe.php';
     break;

     case 'tipe-lihat' : include 'lihat-tipe.php';
     break;

     case 'tipe-ubah' : include 'ubah-tipe.php';
     break;

     case 'tipe-hapus' : include 'hapus-tipe.php';
     break;

     case 'seri-tambah' : include 'form-seri.php';
     break;

     case 'seri-lihat' : include 'lihat-seri.php';
     break;

     case 'seri-ubah' : include 'ubah-seri.php';
     break;

     case 'seri-hapus' : include 'hapus-seri.php';
     break;
     
     case 'ukuran-tambah' : include 'form-ukuran.php';
     break;
     
     case 'ukuran-lihat' : include 'lihat-ukuran.php';
     break;
     
     case 'ukuran-ubah' : include 'ubah-ukuran.php';
     break;
     
     case 'ukuran-hapus' : include 'hapus-ukuran.php';
     break;
}
?>