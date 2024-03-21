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
if (isset($_GET['kode_ukuran']))
{
	$kode_ukuran = $_GET['kode_ukuran'];
	$query   = "SELECT * FROM ukuran_barang WHERE kode_ukuran = '$kode_ukuran'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_ukuran) && $kode_ukuran != '') {
		$hapus = "DELETE FROM ukuran_barang WHERE kode_ukuran='$kode_ukuran'";
		$sql = mysqli_query($buka, $hapus);
		if ($sql) 
		{
		    //mysqli_query($buka, "DELETE FROM stok WHERE kode_barang='$kode_barang'");
			echo "<script>alert('Data berhasil dihapus')</script>";
			echo "<script>document.location='home.php?page=ukuran-lihat'</script>";
		}
        else
        {
			echo "<script>alert('Data gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=ukuran-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>