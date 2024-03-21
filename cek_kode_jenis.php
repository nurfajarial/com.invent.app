<?php
include 'config/koneksi.php';
$kodejenis = $_POST['txt_kode_jenis'];

if($kodejenis == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM jenis_barang WHERE kode_jenis = '$kodejenis'");
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