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



//if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ))
if ($_POST['Submit'] == 'Submit') 
{
	$kode_merk = $_POST['txt_kode_merk'];
	$nama_merk = $_POST['txt_nama_merk'];
	$ket = $_POST['txt_ket'];

	$cek = mysqli_query($buka, "SELECT * FROM merk_barang WHERE kode_merk='$kode_merk'");
	$row = mysqli_fetch_array($cek);
	if($row['kode_merk'] == null)
	{
		$input1 = "INSERT INTO merk_barang
		(
			kode_merk,
			nama_merk,
			keterangan
		)
		VALUES
		(
			'$kode_merk',
			'$nama_merk',
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
	        '$nama_merk',
	        'merk_barang',
	        '',
	        '',
	        '$tgl', 
	        '$jam'
	    )";	

		mysqli_query($buka, $input1);
		mysqli_query($buka, $audit);


		//echo "sukses";
		//echo "<script>window.location='home.php?page=merk-lihat'</script>";
		echo "<script>alert('Data berhasil diinput')</script>";
		echo "<script>document.location='home.php?page=merk-lihat'</script>";
	}
	else
	{
		//echo "gagal";
		//echo "<script>window.location='home.php?page=merk-lihat'</script>";
		echo "<script>alert('Kode sudah ada !, silahkan diulang kembali')</script>";
		echo "<script>document.location='home.php?page=merk-tambah'</script>";
	}

	//tutup koneksi ke database
	mysqli_close($buka);			

}
?>