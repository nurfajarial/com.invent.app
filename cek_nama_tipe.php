<?php
include 'config/koneksi.php';
$knama_merk = $_POST['txt_nama_tipe'];

if($nama_tipe == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM tipe_barang WHERE nama_tipe = '$nama_tipe'");
	$num = mysqli_num_rows($process);
	if($num != 0)
	{
		echo "<font color='red' ><b>Nama sudah ada</b></font>";
	}
	else
	{
		echo "Nama tersedia";
	}

}

?>