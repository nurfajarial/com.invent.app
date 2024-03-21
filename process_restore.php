<?php
include 'config/koneksi.php';
$tabel = $_POST['db_list'];
if(empty($tabel))
{
    echo "<script>alert('pilih item')</script>";
    echo "<script>document.location='home.php?page=backup-data'</script>";
}
else
{
    foreach($tabel as $item_backup)
    {
        echo $item_backup;
    }
}

?>