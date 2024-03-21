<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
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
//cek button
if ($_POST['Submit'] == 'Submit') {
//Kirimkan Variabel
	$kode_omset = $_POST['txt_kode'];
	$tanggal = $_POST['txt_tanggal'];
	$bulan = $_POST['txt_bulan'];
	$tahun = $_POST['txt_tahun'];
	$jumlah = $_POST['txt_jumlah'];
	$harga = $_POST['txt_harga'];

	//validasi data jika kosong
	if (empty($_POST['txt_kode_omset']) ||
		empty($_POST['txt_tanggal']) || 
		empty($_POST['txt_bulan']) || 
		empty($_POST['txt_tahun']) || 
		empty($_POST['txt_jumlah']) ||
		empty($_POST['txt_harga'])) 
	{
	?>
	<script language='JavaScript'>
		alert('Data Harap Dilengkapi');
		document.location='home.php?page=omset-tambah';
	</script>
	<?php
	}
	//Jika Validasi Terpenuhi
	else 
	{
	include 'config/koneksi.php';


	//cek Kode Barang di database
	$cek=mysqli_num_rows(mysqli_query($buka, "SELECT kode_omset FROM omset WHERE kode_omset='$_POST[txt_kode_omset]'"));
	if ($cek > 0) 
	{
		echo "<script>alert('Kode Retur sudah ada !, silahkan diulang kembali')</script>";
		echo "<script>document.location='home.php?page=omset-tambah'</script>";
	}


	//Masukan data ke Table Omset
	$input = 
	"INSERT INTO omset
	(
	kode_omset,
	tanggal, 
	bulan, 
	tahun, 
	jumlah, 
	harga
	) 
	VALUES 
	(
	'$kode_omset',
	'$tanggal', 
	'$bulan', 
	'$tahun', 
	'$jumlah', 
	'$harga'
	)";
$query_input = mysqli_query($buka, $input);
	if ($query_input) {
	//Jika Sukses
		echo "<script>alert('Data Omset Berhasil diinput')</script>";
		echo "<script>document.location='home.php?page=omset-lihat'</script>";
	}
	else
    {
	//Jika Gagal
	    echo "<script>alert('Data Omset Gagal diinput, Silahkan diulangi!')</script>";
        echo "<script>document.location='home.php?page=omset-tambah'</script>";
	}
//Tutup koneksi engine MySQL
	mysqli_close($buka);
	}
}
?>
</body>