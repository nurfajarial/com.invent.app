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
//cek button
if ($_POST['Submit'] == 'Submit') 
{
	//Kirimkan Variabel
	$kode_mutasi_masuk = $_POST['txt_kode_mutasi_masuk'];
	$tgl_mutasi_masuk = $_POST['txt_tgl_mutasi_masuk'];
	$kode_barang = $_POST['cmb_kode_barang'];
	$jumlah_masuk = $_POST['txt_jumlah_masuk'];
	$pengirim = $_POST['cmb_pengirim'];


	//Masukan data ke Table Login
	$input1 =
	"INSERT INTO temp_mutasi_masuk
	(
		kode_mutasi_masuk,
		tanggal_mutasi_masuk,
		kode_barang,
		jumlah_masuk,
		kode_user, 
		status_masuk
	) 
	VALUES 
	(
		'$kode_mutasi_masuk',
		'$tgl_mutasi_masuk',
		'$kode_barang',
		'$jumlah_masuk',
		'$pengirim', 
		'Tunggu'
	)";

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
		'',
		'$jumlah_masuk',
		'temp_mutasi_masuk',
		'',
		'',
		'$tgl', 
		'$jam'
	)";

	//echo "<br />".$input1."<br />".$audit1."<br /><br />";
				
	mysqli_query($buka, $input1);
	mysqli_query($buka, $audit1);
	//Jika Sukses
	echo "<script>alert('Data Mutasi sukses di input')</script>";
	echo "<script>document.location = 'home.php?page=mutasi-masuk-temp-lihat'</script>";

	//if(isset($input)==null) 
	//{
		//Jika Gagal
		//echo "<script>alert('Data Mutasi sudah ada, Silahkan diulangi!')</script>";
		//echo "<script>document.location = 'home.php?page=mutasi-masuk-temp-tambah'</script>";
	//}
	//Tutup koneksi engine MySQL

}
else
{
	//Jika Gagal
	echo "<script>alert('Data Mutasi sudah ada, Silahkan diulangi!')</script>";
	echo "<script>document.location = 'home.php?page=mutasi-masuk-temp-tambah'</script>";	
}
mysqli_close($buka);

?>