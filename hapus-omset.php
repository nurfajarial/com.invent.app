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
?>
<br />
<body bgcolor='#EEF2F7'>
<?php
include 'config/koneksi.php';
// Cek Kode
if (isset($_GET['kode_omset'])) 
{
	$kode_omset = $_GET['kode_omset'];
	$query   = "SELECT * FROM omset WHERE kode_omset='$kode_omset'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_omset) && $kode_omset != '')
    {
		$hapus = "DELETE FROM omset WHERE kode_omset='$kode_omset'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=omset-lihat'</script>";
		} 
		else 
		{
			echo "<script>alert('Data Omset gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=omset-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
</body>