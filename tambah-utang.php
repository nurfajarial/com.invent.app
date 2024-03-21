<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

if ($_POST['Submit'] == 'Submit')
{
	$kd_u = $_POST['txt_kd_u'];
	$kd_supp = $_POST['cmb_kd_supp'];
	$kd_byr = $_POST[''];
	$tgl_u = $_POST['']
	$tgl_tmp = $_POST[''];
	$jmlh = $_POST[''];
	$tgl1 = $_POST[''];
	$angs1 = $_POST[''];
	$tgl2 = $_POST[''];
	$angs2 = $_POST[''];
	$tgl3 = $_POST[''];
	$angs3 = $_POST[''];
	$tgl4 = $_POST[''];
	$angs4 = $_POST[''];
	$tgl5 = $_POST[''];
	$angs5 = $_POST[''];
	$tgl6 = $_POST[''];
	$angs6 = $_POST[''];
	$sisa = $_POST[''];

	//koneksi ke database
	include 'config/koneksi.php';
	$cek = mysqli_query($buka, "SELECT kode_utang FROM utang WHERE kode_utang = '$_POST[txt_kd_u]'");
	$row = mysqli_fetch_array($cek);
	{
		//Masukan data ke Table Utang

	}

}

?>