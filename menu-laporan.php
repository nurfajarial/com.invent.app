    <li class='dropdown'>
        <a href='#' class='dropdown-submenu-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            Laporan<span class='caret'></span>
        </a>
        <ul class='dropdown-menu'>
            <li>
                <a class="trigger right-caret">Profil</a>
                <ul class="dropdown-menu sub-menu">
                    <?php
                    if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                    {
                        ?>
                        <li><a href='home.php?page=lap-pengguna'>Pengguna</a></li>
                        <?php
                        }
                        ?>
                        <li><a href='home.php?page=lap-pemasok'>Pemasok</a></li>
                        <li><a href='home.php?page=lap-pelanggan'>Pelanggan</a></li>
                </ul>
            </li>
            <li role='separator' class='divider'></li>
            <li>
                <a class="trigger right-caret">Rugi/Laba</a>
                <ul class="dropdown-menu sub-menu">
                    <?php
                    if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                    {
                    ?>
                    <li><a href='home.php?page=lap-modal'>Modal</a></li>
                    <li><a href='home.php?page=lap-omset'>Omset</a></li>
                    <li><a href='home.php?page=lap-tagihan'>Tagihan</a></li>
                    <?php
                    }
                    ?>
                    <li role='separator' class='divider'></li>
                    <li><a href='home.php?page=lap-retur'>Retur</a></li>
                    <?php
                    if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                    {
                    ?>
                    <li><a href='home.php?page=lap-utang'>Utang</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li role='separator' class='divider'></li>
            <li>
                <a class="trigger right-caret">Barang</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href='home.php?page=lap-master-barang'>Master</a></li>
                    <li><a href='home.php?page=lap-stok-minim'>Stok Minim</a></li>
                    <li><a href='home.php?page=lap-pesanan-masuk'>Mutasi Masuk</a></li>
                    <li><a href='home.php?page=lap-pesanan-keluar'>Mutasi Keluar</a></li>
                </ul>
            </li>
            <li role='separator' class='divider'></li>
            <li><a href='home.php?page=lap-penawaran'>Penawaran</a></li>
            <li role='separator' class='divider'></li>
            <li>
                <a class="trigger right-caret">Transaksi</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href='home.php?page=lap-pembelian'>Pembelian</a></li>
                    <li role='separator' class='divider'></li>
                    <li><a href='home.php?page=lap-penjualan'>Penjualan</a></li>
                </ul>
            </li>
        </ul>
    </li>