<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
if (isset($_GET['kode_mutasi_masuk']))
{
    $kode_mutasi_masuk = $_GET['kode_mutasi_masuk'];
    $tanggal_mutasi_masuk = $_GET['tanggal_mutasi_masuk'];
    $kode_barang = $_GET['kode_barang'];
    $jumlah_masuk = $_GET['jumlah_masuk'];
}
else
{
    die ('Error. No Kode Selected! ');
    echo "<a href='home.php'>ke Beranda</a>";
}

//mendapatkan variabel
$mut_in = mysqli_query($buka, "SELECT * FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$kode_mutasi_masuk'");
$dmt = mysqli_fetch_array($mut_in, MYSQLI_BOTH);
$tgl_mutasi_masuk = $dmt['tanggal_mutasi_masuk'];
$kode_barang = $dmt['kode_barang'];
$jumlah_masuk = $dmt['jumlah_masuk'];
$kode_lokasi = $dmt['kode_lokasi'];
$kode_user = $dmt['kode_user'];

//input data ke mutasi masuk
$input1 = "INSERT INTO mutasi_masuk
(kode_mutasi_masuk, tanggal_mutasi_masuk, kode_barang, jumlah_masuk, kode_user, status_masuk) VALUES
('$kode_mutasi_masuk', '$tgl_mutasi_masuk', '$kode_barang', '$jumlah_masuk', '$kode_user', 'OK')
";

//input ke tabel audit
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$audit1 = "INSERT INTO audit_log 
(
	user, aksi, data_lama, data_baru, jumlah, tabel, alat, IP, tanggal, jam
)
VALUES 
(
	'$user', 
	'INSERT',
	'',
	'$kode_barang',
	'$jumlah_masuk',
	'mutasi_masuk',
	'',
	'',
	'$tgl', 
	'$jam'
)";

//update data di tabel stok
$q_stok = mysqli_query($buka, "SELECT * FROM stok WHERE kode_barang='$kode_barang'");
$ds = mysqli_fetch_array($q_stok, MYSQLI_BOTH);
	/*
	echo "<br />
	idstok = {$ds["idstok"]}
	kode barang = {$ds["kode_barang"]}
	kode lokasi = {$ds["kode_lokasi"]}
	stok awal = {$ds["stok_awal"]}
	min stok = {$ds["min_stok"]}
	total = {$ds["total"]}
	kode satuan = {$ds["kode_satuan"]}<br />";
	*/
$new_total = $ds["total"] + $jumlah_masuk;
	//echo "<br />$new_total<br />";

$update1 = "UPDATE stok SET 
idstok='{$ds["idstok"]}', 
kode_barang='$kode_barang', 
kode_lokasi='{$ds["kode_lokasi"]}', 
stok_awal='{$ds["stok_awal"]}', 
min_stok='{$ds["min_stok"]}', 
total='$new_total', 
kode_satuan='{$ds["kode_satuan"]}'
WHERE idstok='{$ds["idstok"]}'";

//input ke tabel audit
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$audit2 = "INSERT INTO audit_log 
(
	user, aksi, data_lama, data_baru, jumlah, tabel, alat, IP, tanggal, jam
)
VALUES 
(
	'$user', 
	'UPDATE',
	'{$ds["total"]}',
	'$new_total',
	'$jumlah_masuk',
	'stok',
	'',
	'',
	'$tgl', 
	'$jam'
)";

//hapus data di tabel temp mutasi masuk
$temp_mut_in = mysqli_query($buka, "SELECT * FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$kode_mutasi_masuk' AND tanggal_mutasi_masuk='$tanggal_mutasi_masuk' AND kode_barang='$kode_barang' AND jumlah_masuk='$jumlah_masuk'");
$dtmt = mysqli_fetch_array($temp_mut_in, MYSQLI_BOTH);
$kode_mutasi_masuk3 = $dtmt['kode_mutasi_masuk'];
$tanggal_mutasi_masuk3 = $dtmt['tanggal_mutasi_masuk'];
$kode_barang3 = $dtmt['kode_barang'];
$jumlah_masuk3 = $dtmt['jumlah_masuk'];
$kode_lokasi3 = $dtmt['kode_lokasi'];
$kode_user3 = $dtmt['kode_user'];

$del1 = "DELETE FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$kode_mutasi_masuk3' AND tanggal_mutasi_masuk='$tanggal_mutasi_masuk3' AND kode_barang='$kode_barang3' AND jumlah_masuk='$jumlah_masuk3'";

//input ke tabel audit
$user = $_SESSION['user'];
$tgl = date('Y-m-d');
$jam = date('H:i');
$audit3 = "INSERT INTO audit_log 
(
	user, aksi, data_lama, data_baru, jumlah, tabel, alat, IP, tanggal, jam
)
VALUES 
(
	'$user', 
	'DELETE',
	'$kode_barang3',
	'',
	'',
	'temp_mutasi_masuk',
	'',
	'',
	'$tgl', 
	'$jam'
)";

//echo $input1."<br />".$audit1."<br /><br />";
mysqli_query($buka, $input1);
mysqli_query($buka, $audit1);
//echo $update1."<br />".$audit2."<br /><br />";
mysqli_query($buka, $update1);
mysqli_query($buka, $audit2);
//echo $del1."<br />".$audit3."<br /><br />";
mysqli_query($buka, $del1);
mysqli_query($buka, $audit3);

echo "<script>alert('Data disetujui')</script>";
echo "<script>document.location='home.php?page=mutasi-masuk-temp-lihat'</script>"
?>