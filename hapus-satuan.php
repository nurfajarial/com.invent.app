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
if (isset($_GET['kode_satuan']))
{
	$kode_satuan = $_GET['kode_satuan'];
	$query   = "SELECT * FROM satuan WHERE kode_satuan='$kode_satuan'";
	$hasil   = mysqli_query($buka, $query);
	$data    = mysqli_fetch_array($hasil);
}
else 
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');	
}
	//proses delete data
	if (!empty($kode_satuan) && $kode_satuan != '') {
		$hapus = "DELETE FROM satuan WHERE kode_satuan='$kode_satuan'";
		$sql = mysqli_query($buka, $hapus);
		if ($sql) 
		{
		    //mysqli_query($buka, "DELETE FROM stok WHERE kode_barang='$kode_barang'");
			echo "<script>alert('Data Unit Berhasil dihapus')</script>";
			echo "<script>document.location='home.php?page=satuan-lihat'</script>";
		}
        else
        {
			echo "<script>alert('Data Unit gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=satuan-lihat'</script>";
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
?>
</body>