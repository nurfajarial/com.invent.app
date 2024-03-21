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
	$kode_mutasi_keluar = $_POST['txt_kode_mutasi_keluar'];
	$tgl_mutasi_keluar = $_POST['txt_tgl_mutasi_keluar'];
	$kode_barang = $_POST['cmb_kode_barang'];
	$jumlah_keluar = $_POST['txt_jumlah_keluar'];
	$pengirim = $_POST['cmb_pengirim'];


	//Masukan data ke Table Login
	$input1 =
	"INSERT INTO temp_mutasi_keluar
	(
		kode_mutasi_keluar,
		tanggal_mutasi_keluar,
		kode_barang,
		jumlah_keluar,
		kode_user, 
		status_keluar
	) 
	VALUES 
	(
		'$kode_mutasi_keluar',
		'$tgl_mutasi_keluar',
		'$kode_barang',
		'$jumlah_keluar',
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
		'$jumlah_keluar',
		'temp_mutasi_keluar',
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
	echo "<script>document.location = 'home.php?page=mutasi-keluar-temp-lihat'</script>";

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
	echo "<script>document.location = 'home.php?page=mutasi-keluar-temp-tambah'</script>";	
}
mysqli_close($buka);

?>