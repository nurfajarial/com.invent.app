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
	$kode_pemasok = $_POST['txt_kode_pemasok'];
	$nama_pemasok = $_POST['txt_nama_pemasok'];
	$alamat_pemasok = $_POST['txt_alamat_pemasok'];
	$npwp = $_POST['txt_npwp'];
	$kontak = $_POST['txt_kontak'];
	$email = $_POST['txt_email'];
	$telp = $_POST['txt_telp'];
	$hp = $_POST['txt_hp'];
	$rek1 = $_POST['txt_rek1'];
	$rek2 = $_POST['txt_rek2'];
	$rek3 = $_POST['txt_rek3'];

	//validasi data jika kosong
	if (empty($_POST['txt_kode_pemasok'])) 
	{
		echo "<script>alert('Data Harap Dilengkapi')</script>";
		echo "<script>document.location='home.php?page=pemasok-tambah'</script>";
	}
	//Jika Validasi Terpenuhi
	else 
	{
		include 'config/koneksi.php';
		//cek Kode Barang di database
		$cek = mysqli_query($buka, "SELECT kode_pemasok FROM pemasok WHERE kode_pemasok = '$_POST[txt_kode_pemasok]'");
		$row = mysqli_fetch_array($cek);
		if ($row['kode_supplier'] == null ) 
		{
			//Masukan data ke Table Retur
			$input = "INSERT INTO pemasok
			(
			kode_pemasok,
			nama_pemasok,
			alamat_pemasok,
			npwp,
			kontak,
			email,
			telp,
			hp,
			rek1,
			rek2,
			rek3
			) 
			VALUES 
			(
			'$kode_pemasok',
			'$nama_pemasok',
			'$alamat_pemasok',
			'$npwp',
			'$kontak',
			'$email',
			'$telp',
			'$hp',
			'$rek1',
			'$rek2',
			'$rek3'
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
			    '$nama_pemasok',
			    'pemasok',
			    '',
			    '',
			    '$tgl', 
			    '$jam'
			)";

			mysqli_query($buka, $input);
			//Jika Sukses

			echo "<script>alert('Data berhasil diinput')</script>";
			echo "<script>document.location='home.php?page=pemasok-lihat'</script>";
		}
		else
		{
			echo "<script>alert('Kode Pemasok sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=pemasok-tambah'</script>";
		}

		//Tutup koneksi engine MySQL
			mysqli_close($buka);
	}
}

?>
</body>