<?php
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
if (isset($_GET['kd_byr'])) 
{
	$kd_byr = $_GET['kd_byr'];
	$query   = "SELECT * FROM pembayaran WHERE kode_bayar='$kd_byr'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kd_byr) && $kd_byr != '')
    {
		$hapus = "DELETE FROM pembayaran WHERE kode_bayar='$kd_byr'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php'</script>";
		}
		else 
		{
			echo "<script>alert('Data gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=pembayaran-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);

?>