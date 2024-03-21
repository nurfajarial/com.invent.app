<?php
$page = (isset($_GET['page']))? $_GET['page'] : 'main';
switch($page)
{
                    case 'lap-pengguna' : include 'laporan-pengguna.php';
                    break;

                    case 'lap-pemasok' : include 'laporan-pemasok.php';
                    break;

                    case 'lap-pelanggan' : include 'laporan-pelanggan.php';
                    break;

                    case 'lap-master-barang' : include 'laporan-barang.php';
                    break;

                    case 'lap-stok-minim' : include 'laporan-stok-minim.php';
                    break;

                    case 'lap-modal' : include 'laporan-modal.php';
                    break;

                    case 'lap-omset' : include 'laporan-omset.php';
                    break;

                    case 'lap-retur' : include 'laporan-retur.php';
                    break;

                    case 'lap-penawaran' : include 'laporan-penawaran.php';
                    break;

                    case 'lap-utang' : include 'laporan-utang.php';
                    break;

                    case 'lap-tagihan' : include 'laporan-tagihan.php';
                    break;

                    case 'lap-pesanan-masuk' : include 'laporan-pesanan-masuk.php';
                    break;

                    case 'lap-pembelian' : include 'laporan-pembelian.php';
                    break;

                    case 'lap-pesanan-keluar' : include 'laporan-pesanan-keluar.php';
                    break;

                    case 'lap-penjualan' : include 'laporan-penjualan.php';
                    break;
}
?>