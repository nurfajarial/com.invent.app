<?php

error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
$tables = '*';
$folder = "backup"; //Sesuaikan Folder nya
if(!($buka_folder = opendir($folder))) die ("eRorr... Tidak bisa membuka Folder");

echo "
<form method='post'>
    <div align='center' class='panel panel-default'>
        <div class='panel-heading'>
            <h3>Database Maintenance</h3>
        </div>
        <div class='panel-body'>";
            $file_array = array();
            while($baca_folder = readdir($buka_folder))
            {
                $file_array[] = $baca_folder;
            }
            $jumlah_array = count($file_array);
            for($i=2; $i<$jumlah_array; $i++)
            {
                $nama_file = $file_array;
                $nomor = $i - 1;
                echo $nomor. ".<input type='checkbox' name='db_list[]' value='".$nama_file[$i]."'>$nama_file[$i]</input><br />";
            }
        echo "
        </div>
        <div class='panel-footer'>
            <button id='btnBackup' formaction='process_backup.php'>Backup</button>";
            if($_SESSION['level']=='1' || $_SESSION['level']=='2')
            {
                echo "<button id='btnRestore' formaction='process_restore.php'>Restore</button>";
            }
            echo "
        </div>
    </div>
</form>";
?>

<script>
function nama_backup()
{
    var chkdb_list = document.getElementsByName('db_list');
    var nama_db = document.innerHTML('nama_db')
}
</script>