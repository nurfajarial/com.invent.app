<?php
include 'config/koneksi.php';
$kode_merk = $_POST['txt_kode_merk'];

if($kode_merk == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM merk_barang WHERE kode_merk = '$kode_merk'");
	$num = mysqli_num_rows($process);
	if($num != 0)
	{
		echo "<font color='red' ><b>Kode sudah ada</b></font>";
	}
	else
	{
		echo "Kode tersedia";
	}

}

?>