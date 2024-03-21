<?php
include 'config/koneksi.php';
$kodepemasok = $_POST['txt_kode_pemasok'];

if($kodepemasok == "")
{
	echo "<font color='red'><b>Data kosong</b></font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM pemasok WHERE kode_pemasok = '$kodepemasok'");
	$num = mysqli_num_rows($process);
	if($num != 0)
	{
		echo "<font color='red'><b>Kode sudah ada</b></font>";
	}
	else
	{
		echo "Kode tersedia";
	}

}

?>