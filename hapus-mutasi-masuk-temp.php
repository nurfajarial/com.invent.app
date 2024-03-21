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
if (isset($_GET['kode_mutasi_masuk']) && isset($_GET['tanggal_mutasi_masuk']) && isset($_GET['kode_barang']) && isset($_GET['jumlah_masuk'])) 
{
	$kode_mutasi_masuk = $_GET['kode_mutasi_masuk'];
	$tanggal_mutasi_masuk = $_GET['tanggal_mutasi_masuk'];
	$kode_barang = $_GET['kode_barang'];
	$jumlah_masuk = $_GET['jumlah_masuk'];
	$query   = "SELECT * FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$kode_mutasi_masuk' AND tanggal_mutasi_masuk='$tanggal_mutasi_masuk' AND kode_barang='$kode_barang' AND jumlah_masuk='$jumlah_masuk'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil, MYSQLI_BOTH);
}
else 
{
		die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_mutasi_masuk) && $kode_mutasi_masuk != '')
	{
		$hapus = "DELETE FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$kode_mutasi_masuk' AND tanggal_mutasi_masuk='$tanggal_mutasi_masuk' AND kode_barang='$kode_barang' AND jumlah_masuk='$jumlah_masuk'";
		$sql = mysqli_query ($buka, $hapus);
		if ($sql) 
		{		
			echo "<script>alert('Data terhapus')</script>";
			echo "<script>document.location='home.php?page=mutasi-masuk-temp-lihat'</script>";
		}
		else 
		{
			echo "<script>alert('Data Pesanan gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=mutasi-masuk-temp-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
</body>