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
if (isset($_GET['kode_seri']))
{
	$kode_seri = $_GET['kode_seri'];
	$query   = "SELECT * FROM seri_barang WHERE kode_seri = '$kode_seri'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_seri) && $kode_seri != '') {
		$hapus = "DELETE FROM seri_barang WHERE kode_seri='$kode_seri'";
		$sql = mysqli_query($buka, $hapus);
		if ($sql) 
		{
		    //mysqli_query($buka, "DELETE FROM stok WHERE kode_barang='$kode_barang'");
			echo "<script>alert('Data berhasil dihapus')</script>";
			echo "<script>document.location='home.php?page=seri-lihat'</script>";
		}
        else
        {
			echo "<script>alert('Data gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=seri-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>