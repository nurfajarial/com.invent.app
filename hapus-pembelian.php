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
if (isset($_GET['kode_beli']))
{
	$kode_beli = $_GET['kode_beli'];
	$query = "SELECT * FROM pembelian WHERE kode_beli = '$kode_beli'";
	$hasil = mysqli_query($buka, $query);
	$data = mysqli_fetch_array($hasil);
	$tgl_beli = $data['tanggal_beli'];
	$kd_po = $data['kode_po'];
	$sesi = substr($kd_po,13,1);
	$kd_sup = $data['kode_pemasok'];
	$jml = $data['jumlah']; 

}
else
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali!');
}

//proses delete data
if (!empty($kode_beli) && $kode_beli != '')
{
	//$hapus = "DELETE FROM modal INNER JOIN pembelian ON modal.kode_beli = pembelian.kode_beli WHERE modal.kode_beli = '$kode_beli'";
	$hapus = "DELETE a.*, b.*, c.* FROM modal AS a, po_detail AS b, pembelian AS c WHERE a.kode_beli = '$kode_beli' AND b.kode_po = '$kd_po' AND c.kode_beli = '$kode_beli'";
	$hapus2 = "DELETE FROM utang WHERE kode_pemasok = '$kd_sup' AND tanggal_hutang = '$tgl_beli' AND jumlah = '$jml'";

	$sql = mysqli_query($buka, $hapus);
	//echo $hapus.";<br />";
	//echo $hapus2."<br />";
	if ($sql)
	{
		mysqli_query($buka, $hapus2);
		echo "<script>alert('Data berhasil dihapus')</script>";
		echo "<script>document.location='home.php'</script>";
	}
	else
	{
		echo "<script>alert('Data gagal dihapus')</script>";
		echo "<script>document.location='home.php?page=pembelian-lihat'</script>";
	}
}
//Tutup koneksi engine MySQL
	//mysqli_close($buka);
?>