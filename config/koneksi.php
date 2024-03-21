<?php
//buka koneksi ke engine MySQL
//$HOST = "localhost";
$HOST = "sql300.byetcluster.com";
//$USER = "root";
$USER = "ezyro_36184485";
//$PASS = "";
$PASS = "wy18r0jc";
//$DB = "simstok_tes3";
$DB = "ezyro_36184485_simstok_tes";

$db1 = new mysqli($HOST, $USER, $PASS, $DB);
//$buka = mysqli_connect("localhost","id18011524_root","[Purnama1980]", "id18011524_simstok");
$buka = mysqli_connect($HOST, $USER, $PASS, $DB);
if (!$buka)
{
	die ("Koneksi ke Engine MySQL Gagal !<br>");
}

?>