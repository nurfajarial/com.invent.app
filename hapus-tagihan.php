<?php
include 'config/koneksi.php';
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

// Cek Kode
if (isset($_GET['kode_tagihan'])) 
{
	$kode_tagihan = $_GET['kode_tagihan'];
	$query = "SELECT * FROM tagihan WHERE kode_tagihan='$kode_tagihan'";
	$hasil = mysqli_query($buka, $query);
	$data = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_tagihan) && $kode_tagihan != '') 
	{
		$hapus = "DELETE FROM tagihan WHERE kode_tagihan='$kode_tagihan'";
		$sql = mysqli_query($buka, $hapus);
		if($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=tagihan-lihat'</script>";
		}
		else 
		{
			echo "<script>alert('Data Tagihan gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=tagihan-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
</body>