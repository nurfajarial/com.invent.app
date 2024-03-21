<?php
include 'config/koneksi.php';
$kode_ukuran = $_POST['txt_kode_ukuran'];

if($kode_ukuran == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM ukuran_barang WHERE kode_ukuran = '$kode_ukuran'");
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