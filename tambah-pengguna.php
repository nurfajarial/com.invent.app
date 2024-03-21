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

//cek button
if ($_POST['Submit'] == 'Submit') 
{
//Kirimkan Variabel
	$user = $_POST['txt_user'];
	$password = $_POST['txt_password'];
	$level = $_POST['cmb_level'];
    $nama = $_POST['txt_nama'];
    $tgl_lahir = $_POST['txt_tgl_lahir'];
    $kelamin = $_POST['cmb_seks'];
    $nik = $_POST['txt_nik'];
    $alamat = $_POST['txt_alamat'];
    $status = $_POST['cmb_status'];
    $hp1 = $_POST['txt_hp1'];
    $hp2 = $_POST['txt_hp2'];

	//Jika Validasi Terpenuhi
	include 'config/koneksi.php';
	
	//cek User di database
	$cek = mysqli_query($buka, "SELECT user FROM karyawan WHERE user='$_POST[txt_user]'");
	$row = mysqli_fetch_array($cek);
	if ($row['user'] == null ) 
	{
	    //Masukan data ke Table Login
		$input = "INSERT INTO karyawan
		(
		    user,
		    password,
		    temp_pass,
		    kode_level,
            nama_karyawan,
            tanggal_lahir,
            jenis_kelamin,
            nik,
            alamat,
            status,
            no_hp1,
            no_hp2
		)
		VALUES 
		(
			'$user',
			 md5('$password'),
			'$password',
			'$level',
   			'$nama',
            '$tgl_lahir',
            '$kelamin',
            '$nik',
            '$alamat',
            '$status',
            '$hp1',
            '$hp2'
		)";

		mysqli_query($buka, $input);
		include 'audit/add-pengguna.php';
		//Jika Sukses

		echo "<script>alert('Data User Berhasil diinput')</script>";
		echo "<script>document.location='home.php?page=pengguna-lihat'</script>";

	}
	else
	{
		echo "<script>alert('USERNAME sudah dipakai !, silahkan diulang kembali')</script>";
		echo "<script>document.location='home.php?page=pengguna-tambah'</script>";
	}
    //Tutup koneksi engine MySQL
	mysqli_close($buka);
}
?>