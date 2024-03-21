<?php
include 'config/koneksi.php';
$kode_lokasi = $_POST['txt_kode_lokasi'];

if($kode_lokasi == "")
{
	echo "<font color='red' ><b>Data kosong</b></font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM lokasi WHERE kode_lokasi = '$kode_lokasi'");
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