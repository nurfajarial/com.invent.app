<?php
include 'config/koneksi.php';
$kode_tipe = $_POST['txt_kode_tipe'];

if($kode_tipe == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM tipe_barang WHERE kode_tipe = '$kode_tipe'");
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