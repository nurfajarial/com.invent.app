<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}
?>
<br />
<body bgcolor='#EEF2F7'>
<?php
include 'config/koneksi.php';
// Cek Kode
if (isset($_GET['kode_pelanggan']))
{
	$kode_pelanggan = $_GET['kode_pelanggan'];
	$query   = "SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_pelanggan) && $kode_pelanggan != '')
	{
		$hapus = "DELETE FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=pelanggan-lihat'</script>";
		} 
		else 
		{
			echo "<script>alert('Data Customer gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=pelanggan-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
</body>