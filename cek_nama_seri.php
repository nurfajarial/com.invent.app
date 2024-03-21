<?php
include 'config/koneksi.php';
$nama_seri = $_POST['txt_nama_seri'];

if($nama_seri == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM seri_barang WHERE nama_seri = '$nama_seri'");
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