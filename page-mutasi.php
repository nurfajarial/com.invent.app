<?php
                $page = (isset($_GET['page']))? $_GET['page'] : 'main';
                switch($page)
                {
                    case 'mutasi-masuk-tambah' : include 'form-mutasi-masuk.php';
                    break;

                    case 'mutasi-masuk-temp' : include 'lihat-mutasi-masuk-temp.php';
                    break;

                    case 'mutasi-masuk-lihat' : include 'lihat-mutasi-masuk.php';
                    break;

                    case 'mutasi-masuk-detil' : include 'detail-mutasi-masuk.php';
                    break;

                    case 'mutasi-masuk-ubah' : include 'ubah-mutasi-masuk.php';
                    break;

                    case 'mutasi-masuk-hapus' : include 'hapus-mutasi-masuk.php';
                    break;
                }
?>