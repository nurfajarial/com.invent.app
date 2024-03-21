<?php
include 'config/koneksi.php';
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

//cek button
if ($_POST['Submit'] == 'Submit') 
{
	$kode_jenis = $_POST['txt_kode_jenis'];
	$nama_jenis = $_POST['txt_nama_jenis'];
	$ket = $_POST['txt_ket'];

	$cek = mysqli_query($buka, "SELECT * FROM jenis_barang WHERE kode_jenis='$_POST[txt_kode_jenis]'");
	$row = mysqli_fetch_array($cek);
	if ($row['kode_jenis'] == null ) 
	{
		$input1 = "INSERT INTO jenis_barang
		(
			kode_jenis,
			nama_jenis,
			keterangan
		)
		VALUES
		(
			'$kode_jenis',
			'$nama_jenis',
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
		    '$nama_jenis',
		    'jenis_barang',
		    '',
		    '',
		    '$tgl', 
		    '$jam'
		)";

		mysqli_query($buka, $input1);
		mysqli_query($buka, $audit);

		echo "<script>alert('Data berhasil diinput')</script>";
		echo "<script>document.location='home.php?page=jenis-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Kode Merk sudah ada !, silahkan diulang kembali')</script>";
		echo "<script>document.location='home.php?page=jenis-tambah'</script>";
	}

	//tutup koneksi ke database
    mysqli_close($buka);			
}

?>