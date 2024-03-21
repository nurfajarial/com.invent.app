<?php
include 'config/koneksi.php';
$ax = "SELECT (SELECT COUNT(temp_mutasi_masuk.status_masuk) as jumlah FROM temp_mutasi_masuk) + (SELECT COUNT(temp_mutasi_keluar.status_keluar) as jumlah FROM temp_mutasi_keluar) as ttl_jml";
$ay = mysqli_query($buka, $ax);
$az = mysqli_fetch_array($ay);
echo "<span class='badge'>".$az['ttl_jml']."</span>";
?>