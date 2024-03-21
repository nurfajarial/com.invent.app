<?php
include 'config/koneksi.php';
$kode_seri = $_POST['txt_kode_seri'];

if($kode_seri == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM seri_barang WHERE kode_seri = '$kode_seri'");
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