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
if (isset($_GET['kode_model']))
{
	$kode_model = $_GET['kode_model'];
	$query   = "SELECT * FROM model_barang WHERE kode_model = '$kode_model'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_model) && $kode_model != '') {
		$hapus = "DELETE FROM model_barang WHERE kode_model='$kode_model'";
		$sql = mysqli_query($buka, $hapus);
		if ($sql) 
		{
		    //mysqli_query($buka, "DELETE FROM stok WHERE kode_barang='$kode_barang'");
			echo "<script>alert('Data berhasil dihapus')</script>";
			echo "<script>document.location='home.php?page=model-lihat'</script>";
		}
        else
        {
			echo "<script>alert('Data gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=model-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>