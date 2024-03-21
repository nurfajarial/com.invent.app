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
if (isset($_GET['kode_barang']) && isset($_GET['kode_lokasi']))
{
	$kode_barang = $_GET['kode_barang'];
    $kode_lokasi = $_GET['kode_lokasi'];
	$query   = "SELECT * FROM stok WHERE kode_barang = '$kode_barang' and kode_lokasi = '$kode_lokasi'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if((!empty($kode_barang) && $kode_barang != '') && (!empty($kode_lokasi) && $kode_lokasi != ''))
    {
		$hapus = "DELETE FROM stok WHERE kode_barang = '$kode_barang' AND kode_lokasi = '$kode_lokasi'";
		$sql = mysqli_query($buka, $hapus);
		if ($sql) 
		{
		    //mysqli_query($buka, "DELETE FROM stok WHERE kode_stok='$kode_stok'");
			echo "<script>alert('Data berhasil dihapus')</script>";
			echo "<script>document.location='home.php?page=stok-lihat'</script>";
		}
        else
        {
			echo "<script>alert('Data barang gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=stok-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>