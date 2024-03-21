<?php
include 'config/koneksi.php';
$kodesatuan = $_POST['txt_kode_satuan'];

if($kodesatuan == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM satuan WHERE kode_satuan = '$kodesatuan'");
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