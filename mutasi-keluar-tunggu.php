<?php
include 'config/koneksi.php';
$kx = 'SELECT COUNT(temp_mutasi_keluar.status_keluar) as jml FROM temp_mutasi_keluar';
$ky = mysqli_query($buka, $kx);
$kz = mysqli_fetch_array($ky);
echo "<span class='badge'>".$kz['jml']."</span>";
?>