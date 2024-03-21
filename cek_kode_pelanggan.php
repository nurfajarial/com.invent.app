<?php
include 'config/koneksi.php';
$kodepelanggan = $_POST['txt_kode_pelanggan'];

if($kodepelanggan == "")
{
	echo "<font color='red'><b>Data kosong</b></font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM pelanggan WHERE kode_pelanggan = '$kodepelanggan'");
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