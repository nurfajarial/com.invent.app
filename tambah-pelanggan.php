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
if ($_POST['Submit'] == 'Submit') 
{
//Kirimkan Variabel
	$kode_pelanggan = $_POST['txt_kode_pelanggan'];
	$nama_pelanggan = $_POST['txt_nama_pelanggan'];
	$alamat_pelanggan = $_POST['txt_alamat_pelanggan'];
	$alamat_pengiriman = $_POST['txt_alamat_pengiriman'];
	$alamat_penagihan = $_POST['txt_alamat_penagihan'];
	$telp = $_POST['txt_telp'];
	$mobile = $_POST['txt_mobile'];
	$fax = $_POST['txt_fax'];
	$email = $_POST['txt_email'];

	//validasi data jika kosong
	if (empty($_POST['txt_kode_pelanggan']) ||
		empty($_POST['txt_nama_pelanggan']) ||
		empty($_POST['txt_alamat_pelanggan']) ||
		empty($_POST['txt_alamat_pengiriman']) ||
		empty($_POST['txt_alamat_penagihan']) ||
		empty($_POST['txt_telp']) ||
		empty($_POST['txt_mobile']) || 
		empty($_POST['txt_fax']) ||
		empty($_POST['txt_email'])) 
	{
		echo "<script>alert('Data Harap Dilengkapi')</script>";
		echo "<script>document.location='home.php?page=pelanggan-tambah'</script>";
	}
	//Jika Validasi Terpenuhi
	else 
	{
		include 'config/koneksi.php';
		//cek Kode Customer di database
		$cek = mysqli_query($buka, "SELECT kode_pelanggan FROM pelanggan WHERE kode_pelanggan='$_POST[txt_kode_pelanggan]'");
		$row = mysqli_fetch_array($cek);
		if ($row['kode_pelanggan'] == null )
		{
			//Masukan data ke Table Order
			$input = "INSERT INTO pelanggan
			(
			kode_pelanggan,
			nama_pelanggan,
            alamat_pelanggan,
			alamat_pengiriman,
			alamat_penagihan,
			telp, 
			hp,
			fax,
			email
			) 
			VALUES 
			(
			'$kode_pelanggan',
			'$nama_pelanggan',
   			'$alamat_pelanggan',
			'$alamat_pengiriman',
			'$alamat_penagihan',
			'$telp',
			'$mobile',
			'$fax', 
			'$email'
			)";

			$user = $_SESSION['user'];
			$tgl = date('Y-m-d');
			$jam = date('H:i');
			$audit = "INSERT INTO audit_log 
			(
			    user, aksi, data_lama, data_baru, tabel, alat, IP, tanggal, jam
			)
			VALUES 
			(
			    '$user', 
			    'INSERT',
			    '',
			    '$nama_pelanggan',
			    'pelanggan',
			    '',
			    '',
			    '$tgl', 
			    '$jam'
			)";

			mysqli_query($buka, $input);
			mysqli_query($buka, $audit);
			//Jika Sukses

			echo "<script>alert('Data Pelanggan Berhasil diinput')</script>";
			echo "<script>document.location='home.php?page=pelanggan-lihat'</script>";
		}
		else
		{
			echo "<script>alert('Kode Pelanggan sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=pelanggan-tambah'</script>";
		}

		//Tutup koneksi engine MySQL
			mysqli_close($buka);
	}
		
}

?>
</body>