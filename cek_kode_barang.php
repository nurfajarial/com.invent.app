<?php
include 'config/koneksi.php';
$kode_barang = $_POST['txt_kode_barang'];

if($kode_barang == "")
{
	echo "<font color='red'><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM barang WHERE kode_barang = '$kode_barang'");
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