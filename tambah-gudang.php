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
	
	$kode_lokasi = $_POST['txt_kode_lokasi'];
	$nama_lokasi = $_POST['txt_nama_lokasi'];
	$ket = $_POST['txt_ket'];
	
	//validasi data jika kosong
	if (empty($_POST['txt_kode_lokasi']) ||
		empty($_POST['txt_nama_lokasi']) ||
		empty($_POST['txt_ket']))
 		{
			echo "<script>alert('Data Harap Dilengkapi')</script>";
			echo "<script>document.location='home.php?page=gudang-tambah'</script>";
		}
	else
	{
		//koneksi ke database
		include 'config/koneksi.php';
		
		$cek = mysqli_query($buka, "SELECT kode_lokasi FROM lokasi WHERE kode_lokasi='$_POST[txt_kode_lokasi]'");
		$row = mysqli_fetch_array($cek);
		if ($row['kode_lokasi'] == null )
		{
			//Masukan data ke Table Order
			$input1 = "INSERT INTO lokasi
			(
			kode_lokasi,
			nama_lokasi,
			keterangan
			) 
			VALUES 
			(
			'$kode_lokasi',
			'$nama_lokasi',
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
			    '$nama_lokasi',
			    'gudang',
			    '',
			    '',
			    '$tgl', 
			    '$jam'
			)";

			mysqli_query($buka, $input1);
			mysqli_query($buka, $audit);

			//Jika Sukses

			echo "<script>alert('Data berhasil diinput')</script>";
			echo "<script>document.location='home.php?page=gudang-lihat'</script>";
		}
		else
		{
			echo "<script>alert('Kode Gudang sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=gudang-tambah'</script>";
		}		
		//tutup koneksi ke database
        mysqli_close($buka);
	}
}

?>
</body>