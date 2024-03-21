<?php
include 'config/koneksi.php';
$nama_ukuran = $_POST['txt_nama_ukuran'];

if($nama_ukuran == "")
{
	echo "<font color='red' ><b>Data kosong</b><font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM ukuran_barang WHERE nama_ukuran = '$nama_ukuran'");
	$num = mysqli_num_rows($process);
	if($num != 0)
	{
		echo "<font color='red' ><b>Ukuran sudah ada</b></font>";
	}
	else
	{
		echo "Ukuran tersedia";
	}

}

?>