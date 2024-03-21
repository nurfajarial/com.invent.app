<?php
include 'config/koneksi.php';
session_start();
include 'audit/log-out.php';

unset($_SESSION['user']);
unset($_SESSION['level']);
session_destroy();
echo "<script>document.location='index.php'</script>";
?>