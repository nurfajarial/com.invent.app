    <li class='dropdown'>
        <a href='#' class='dropdown-submenu-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            Fasilitas<span class='caret'></span>
        </a>
        <ul class='dropdown-menu'>
            <li>
                <a class='trigger right-caret'>Database</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href="home.php?page=backup-data">Backup/Restore</a></li>
                </ul>
            </li>
            <li>
                <a class="trigger right-caret">Satuan</a>
                <ul class="dropdown-menu sub-menu">
                    <li><a href="home.php?page=satuan-tambah">Tambah</a></li>
                    <li><a href="home.php?page=satuan-lihat">Lihat</a></li>
                </ul>
            </li>            
            <li>
                <a class='trigger right-caret'>Pembayaran</a>
                <ul class='dropdown-menu sub-menu'>
                    <li><a href='home.php?page=pembayaran-tambah'>Tambah</a></li>
                    <li><a href='home.php?page=pembayaran-lihat'>Lihat</a></li>
                </ul>
            </li>
            <li>
                <?php if($_SESSION['level']=='1'){ ?>
            	<a href='home.php?page=audit-lihat'>Audit Log</a>
                <?php }?>
            </li>
        </ul>
    </li>