<?php
include 'config/koneksi.php';
$nama_jenis = $_POST['txt_nama_jenis'];

if($nama_jenis == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM jenis_barang WHERE nama_jenis = '$nama_jenis'");
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