    <li class="dropdown">
        <a href="#" class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            Profil<span class='caret'></span>
        </a>
        <ul class="dropdown-menu">
            <?php
            if($_SESSION['level']=='1' || $_SESSION['level']=='2')
            {
            ?>
            <li>
                <a class="trigger right-caret">Pengguna</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href='home.php?page=pengguna-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=pengguna-lihat'>Lihat</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <li>
                <a class="trigger right-caret">Pemasok</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href='home.php?page=pemasok-tambah'>Tambah</a></li>
                        <li><a href='home.php?page=pemasok-lihat'>Lihat</a></li>
                </ul>
            </li>
            <li>
                <a class="trigger right-caret">Pelanggan</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href='home.php?page=pelanggan-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=pelanggan-lihat'>Lihat</a></li>
                </ul>
            </li>
        </ul>
    </li>