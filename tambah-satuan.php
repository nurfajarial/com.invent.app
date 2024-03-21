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

	//$file = $_FILES['image']['name'];
	
	$kode_satuan = $_POST['txt_kode_satuan'];
	$nama_satuan = $_POST['txt_nama_satuan'];
	$ket = $_POST['txt_ket'];
	
	//validasi data jika kosong
	if (empty($_POST['txt_kode_satuan']) ||
		empty($_POST['txt_nama_satuan']) ||
		empty($_POST['txt_ket']))
 		{
			echo "<script>alert('Data Harap Dilengkapi')</script>";
			echo "<script>document.location='home.php?page=satuan-tambah'</script>";
		}
	else
	{
		//koneksi ke database
		include 'config/koneksi.php';
		
		$cek = mysqli_query($buka, "SELECT kode_satuan FROM satuan WHERE kode_satuan='$_POST[txt_kode_satuan]'");
		$row = mysqli_fetch_array($cek);
		if ($row['kode_satuan'] == null )
		{
			//Masukan data ke Table Order
			$input1 = "INSERT INTO satuan
			(
			kode_satuan,
			nama_satuan,
			keterangan
			) 
			VALUES 
			(
			'$kode_satuan',
			'$nama_satuan',
			'$ket'
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
			    '$nama_satuan',
			    'satuan',
			    '',
			    '',
			    '$tgl', 
			    '$jam'
			)";

			$query_input = mysqli_query($buka, $input1);
			//Jika Sukses

			echo "<script>alert('Data Unit Berhasil diinput')</script>";
			echo "<script>document.location='home.php?page=satuan-lihat'</script>";
		}
		else
		{
			echo "<script>alert('Kode Unit sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=satuan-tambah'</script>";
		}		
		//tutup koneksi ke database
        mysqli_close($buka);
	}
}

?>
</body>