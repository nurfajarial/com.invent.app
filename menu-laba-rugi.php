   
    <li class='dropdown'>
        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            Laba/Rugi<span class='caret'></span>
        </a>
        <ul class='dropdown-menu'>
            <?php
            if($_SESSION['level']=='1' || $_SESSION['level']=='2')
            {
            ?>
            <li>
                <a class='trigger right-caret'>Modal</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href='home.php?page=modal-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=modal-lihat'>Lihat</a></li>
                </ul>
            </li>
            <li>
                <a class='trigger right-caret'>Tagihan</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href='home.php?page=tagihan-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=tagihan-lihat'>Lihat</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <li role='separator' class='divider'></li>
            <li>
                <a class='trigger right-caret'>Retur</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href='home.php?page=retur-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=retur-lihat'>Lihat</a></li>
                </ul>
            </li>
            <li>
                <a class='trigger right-caret'>Utang</a>
                <ul class='dropdown-menu sub-menu'>
                    <!-- <li><a href='home.php?page=utang-tambah'>Tambah</a></li> -->
                    <li><a href='home.php?page=utang-lihat'>Lihat</a></li>
                </ul>
            </li>
            <li role='separator' class='divider'></li>
            <li>
                <a class='trigger right-caret'>Omset</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href='home.php?page=omset-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=omset-lihat'>Lihat</a></li>
                </ul>
            </li>
        </ul>
    </li>
