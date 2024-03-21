<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
// Cek Kode
if (isset($_GET['kode_retur'])) 
{
	$kode_retur = $_GET['kode_retur'];
	$query   = "SELECT * FROM retur WHERE kode_retur = '$kode_retur'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_retur) && $kode_retur != '') 
	{
		$hapus = "DELETE FROM retur WHERE kode_retur = '$kode_retur'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=retur-lihat'</script>";
		}
		else 
		{
			echo "<script>alert('Data Retur gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=retur-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>