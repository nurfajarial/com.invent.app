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
if (isset($_GET['kode_modal'])) 
{
	$kode_modal = $_GET['kode_modal'];
	$query   = "SELECT * FROM modal WHERE kode_modal='$kode_modal'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_modal) && $kode_modal != '') 
	{
		$hapus = "DELETE FROM modal WHERE kode_modal='$kode_modal'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=modal-lihat'</script>";
		}
		else 
		{
			echo "<script>alert('Data Modal gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=modal-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
