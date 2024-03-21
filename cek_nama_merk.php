<?php
include 'config/koneksi.php';
$nama_merk = $_POST['txt_nama_merk'];

if($nama_merk == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM merk_barang WHERE nama_merk = '$nama_merk'");
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