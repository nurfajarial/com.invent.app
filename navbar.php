
<!-- Menu Navbar atas -->
<nav class='navbar navbar-inverse navbar-fixed-top'>
	<div class='container-fluid'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-navbar-collapse-1' aria-expanded='false'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
    	</div>
		<div class='collapse navbar-collapse' id='bs-navbar-collapse-1'>
            <ul class='nav navbar-nav'>
                <li>
                	<a href='home.php'>Beranda</a>
                </li>
                <?php
                    include 'menu-profil.php';
                    include 'menu-laba-rugi.php';
                    include 'menu-item.php';
                    include 'menu-gudang.php';
                    include 'menu-transaksi.php';
                    include 'menu-laporan.php';
                    include 'menu-fasilitas.php';
                ?>
            </ul>

            <!-- Menu Navbar kanan -->

            <!-- Alert Pesan -->              
            <ul class='nav navbar-nav navbar-right'>
 

                <!-- Stok Minim - Alert -->
                <li class='nav-item dropdown no-arrow mx-1'>
               	    <a class='nav-link dropdown-toggle' href='#' id='alertsDropdown3' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <span>
                            <?php
                    		include 'config/koneksi.php';
                    		$a = 'select count(min_stok) as jumlah from stok where total <= min_stok';
                    		$b = mysqli_query($buka, $a);
                    		$c = mysqli_fetch_array($b);
                    		echo "<i class='glyphicon glyphicon-bell'></i>".$c['jumlah'];
                    		?>
                    	</span>
                	</a>
                	<!-- Dropdown - Alerts -->
                	<!-- <div class='dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in' aria-labelledby='alertsDropdown'> -->
                	<div class='dropdown-list dropdown-menu dropdown-menu-right' aria-labelledby='alertsDropdown'>
                		<center><h5 class='dropdown-header'>Minimal Stok</h5></center>
                    	   <?php include 'stokminim.php'; ?>
                	</div>
        		</li>

                <!-- Menu User -->
        		<li class='nav-item dropdown no-arrow'>
        		    <a href='#' class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        		        <span class='glyphicon glyphicon-user'>
        		            <span class='mr-2 d-none d-lg-inline text-gray-600 small'>
                                <strong>
                                <?php
                                $are = $_SESSION['user'];
                                $asd = mysqli_query($buka, "select * from karyawan where user='$are'");
                                $dsa = mysqli_fetch_array($asd);
								print($dsa['nama_karyawan']);
								?>
                                </strong>
        		            </span>
        		        </span>
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in' aria-labelledby='userDropdown'>
                        <a href='home.php?page=pengguna-ubah-pass' class='list-group-item'>
                            <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                            Ganti Password
                        </a>
                        <div class='dropdown-divider'></div>
                        <a href='#' data-toggle='modal' data-target='#logoutModal' class='list-group-item'>
                            <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                            Keluar
                        </a>
                    </div>
                </li>
			</ul>
    		<!-- batas Menu Navbar kanan -->
            
		</div><!-- /.navbar-collapse -->
	</div><!-- /container -->
</nav>
<!-- batas Menu Navbar atas -->
