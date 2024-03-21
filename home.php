<?php
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

require_once('config/functions.php');
?>
<!doctype html>
<html lang='en' class='h-100'>
<head>
	<title>SIM Stok Barang</title>
	<meta charset='utf-8'>
   	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=yes'>
	<link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='css/jquery-ui.css'>
    <link rel='stylesheet' type='text/css' href='css/jquery.dataTables.min.css'>
    <link rel='stylesheet' type='text/css' href='css/jquery.simple-dtpicker.css'>
    <link rel='stylesheet' type='text/css' href='css/sweetalert.css'>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href='css/ie10-viewport-bug-workaround.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='css/sticky-footer-navbar.css' rel='stylesheet'>    

    <style>
    .dropdown-menu>li
    {
        position:relative;
        -webkit-user-select: none; /* Chrome/Safari */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* IE10+ */
        /* Rules below not implemented in browsers yet */
        -o-user-select: none;
        user-select: none;
        cursor:pointer;
    }
    .dropdown-menu .sub-menu
    {
        left: 100%;
        position: absolute;
        top: 0;
        display:none;
        margin-top: -1px;
        border-top-left-radius:0;
        border-bottom-left-radius:0;
        border-left-color:#fff;
        box-shadow:none;
    }
    .right-caret:after,.left-caret:after
     {
         content:"";
            border-bottom: 5px solid transparent;
            border-top: 5px solid transparent;
            display: inline-block;
            height: 0;
            vertical-align: middle;
            width: 0;
        margin-left:5px;
    }
    .right-caret:after
    {
        border-left: 5px solid #ffaf46;
    }
    .left-caret:after
    {
        border-right: 5px solid #ffaf46;
    }
    .main-content
    {
        background: #C7D3F0;
        padding: 100px;
        /* height:calc(100vh - 100px); */
        width: 100%;
    }
    </style>
    <style>
    .bd-placeholder-img 
    {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    }

    @media (min-width: 768px) {
    .bd-placeholder-img-lg {
    font-size: 3.5rem;
    }
    }
    </style>    

</head>

<body>
    <!-- memanggil file menu Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- batas memanggil file menu Navbar -->


<!-- Konten -->
<div class='container'>
    <div class='row'>
        <!-- bagian untuk konten -->
        
        <?php
            echo "
            <div align='center'>
                <h4>Selamat datang ,&nbsp;<b>".$_SESSION['user']."</b></h4>
            </div>";        
               //page profill
                    include 'page-pengguna.php';
                    include 'page-pemasok.php';
                    include 'page-pelanggan.php';

                    //page laba rugi
                    include 'page-modal.php';
                    include 'page-omset.php';
                    include 'page-tagihan.php';
                    include 'page-retur.php';
                    include 'page-utang.php';
                    include 'page-penawaran.php';

                    //page item
                    include 'page-item.php';

                    //page gudang
                    include 'page-barang.php';
                    include 'page-stok.php';
                    include 'page-gudang.php';
                    include 'page-mutasi-masuk.php';
                    include 'page-mutasi-keluar.php';

                    //page transaksi
                    include 'page-pembelian.php';
                    include 'page-penjualan.php';

                    //page laporan
                    include 'page-laporan.php';

                    //page fasilitas
                    include 'page-fasilitas.php';
            ?>

        <!-- batas konten --->
    </div>
</div>

<!-- Footer -->

<footer class='footer'>
    <div class='container'>
        <div class='copyright text-center'>
            <font color='grey'>Copyright &copy; Sinar Hidayah 2019</font><br />
            <font color='grey'><a href='home.php?page=about'>Tentang</a></font>
        </div>
    </div>
</footer>
<!-- batas Footer -->

<!-- Logout Modal-->
<div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
    	<div class='modal-content'>
        	<div class='modal-header'>
          		<button class='close' type='button' data-dismiss='modal' aria-label='Close'>
            		<span aria-hidden='true'>X</span>
          		</button>
          		<h5 class='modal-title' id='exampleModalLabel'>Yakin Keluar?</h5>
        	</div>
        	<div class='modal-body'>Pilih 'Logout' untuk mengakhiri</div>
        	<div class='modal-footer'>
          		<button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
          		<a class='btn btn-primary' href='logout.php'>Logout</a>
        	</div>
		</div>
    </div>
</div>
        
</body>
    <script src='js/jquery-3.4.1.min.js'></script>
    <!-- <script src='js/jquery-1.11.1.min.js'></script> -->
    <script src='js/bootstrap.min.js'></script>
    <!-- <script src='js/demo-scripts.js'></script> -->
    <script src='js/jquery-ui.js'></script>
    <script src='js/jquery.simple-dtpicker.js'></script>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/jquery.js'></script>
    <script type='text/javascript' src='js/fungsi_validasi_karakter.js'></script>
    <script type='text/javascript' src='js/sweetalert.min.js'></script>
    <script type='text/javascript' src='js/sweetalert-dev.js'></script>

    <script type = "text/javascript" >
    function preventBack()
    {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload=function()
    {
        null
    };
    </script>

    <script>
    $(function(){
        $(".dropdown-menu > li > a.trigger").on("click",function(e){
            var current=$(this).next();
            var grandparent=$(this).parent().parent();
            if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
                $(this).toggleClass('right-caret left-caret');
            grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
            grandparent.find(".sub-menu:visible").not(current).hide();
            current.toggle();
            e.stopPropagation();
        });
        $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
            var root=$(this).closest('.dropdown');
            root.find('.left-caret').toggleClass('right-caret left-caret');
            root.find('.sub-menu:visible').hide();
        });
    });
    </script>    
</html>