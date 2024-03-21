<?php
include 'config/koneksi.php';
$mx = 'SELECT COUNT(temp_mutasi_masuk.status_masuk) as jumlah FROM temp_mutasi_masuk';
$my = mysqli_query($buka, $mx);
$mz = mysqli_fetch_array($my);
echo "<span class='badge'>".$mz['jumlah']."</span>";
?>