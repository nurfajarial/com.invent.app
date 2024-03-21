<?php
include 'config/koneksi.php';
$username = $_POST['txt_user'];

if($username == "")
{
	echo "<font color='red'><b>Data kosong</b></font>";
}
else
{

	$process = mysqli_query($buka, "SELECT * FROM karyawan WHERE user = '$username'");
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