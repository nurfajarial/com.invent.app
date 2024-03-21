<?php
include 'config/koneksi.php';
$hari = $_POST['txt_hari'];

if($hari == "")
{
	echo "<font color='red'><b>Data kosong</b></font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM pembayaran WHERE hari = '$hari'");
	$num = mysqli_num_rows($process);
	if($num != 0)
	{
		echo "<font color='red'><b>Hari sudah ada!</b></font>";
	}
	else
	{
		echo "Hari belum ada";
	}

}

?>