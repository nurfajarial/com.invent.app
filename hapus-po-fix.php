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
// cek Kode PO
if (isset($_GET['kode_barang']) && isset($_GET['jumlah_beli']) && isset($_GET['kode_po']) && isset($_GET['tanggal_po']))
{
	$kd_brg = $_GET['kode_barang'];
	$jml = $_GET['jumlah_beli'];
	$kd_po = $_GET['kode_po'];
	$tgl_po = $_GET['tanggal_po'];
	$query = mysqli_query($buka, "SELECT * FROM po_detail WHERE kode_barang = '$kd_brg' AND jumlah_beli = '$jml' AND kode_po = '$kd_po' AND status = 'OK'");
	while($data = mysqli_fetch_array($query))
	{
		$sesi = $data['sesi'];
		$tgl = date($data['tanggal_po']);
	}
}
else
{
	die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');
}

//proses delete data
if (!empty($kd_brg) && $kd_brg != '')
{
	$inp_balik = "INSERT INTO po_detail_temp (kode_po, sesi, tanggal_po, kode_barang, jumlah_beli, status) VALUES ('$kd_po', '$sesi', '$tgl', '$kd_brg', '$jml', 'Tunggu')";
	$hapus = "DELETE FROM po_detail WHERE kode_barang = '$kd_brg' AND jumlah_beli = '$jml' AND kode_po = '$kd_po' AND status = 'OK'";
	
	//echo $inp_balik;
	mysqli_query($buka, $inp_balik);
	//echo $hapus;
	mysqli_query($buka, $hapus);

	//jika berhasil
	echo "<script>alert('Item terhapus')</script>";
	echo "<script>document.location='home.php?page=pembelian-temp'</script>";
}
else
{
	echo "<script>alert('Data gagal dihapus')</script>";
	echo "<script>document.location='home.php?page=pembelian-temp'</script>";
}

?>