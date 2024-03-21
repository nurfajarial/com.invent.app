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
	$kd_beli = $_POST['cmb_kd_beli'];
	$kd_brg = $_POST['cmb_kd_brg'];
	$tgl = $_POST['txt_tgl'];
	$hrg_beli = $_POST['txt_hrg_beli'];
	$tgl_jual1 = $_POST['txt_tgl_jual1'];
	$hrg_jual1 = $_POST['txt_hrg_jual1'];
	$tgl_jual2 = $_POST['txt_tgl_jual2'];
	$hrg_jual2 = $_POST['txt_hrg_jual2'];
	$tgl_jual3 = $_POST['txt_tgl_jual3'];
	$hrg_jual3 = $_POST['txt_hrg_jual3'];


	include 'config/koneksi.php';

	//$cek = mysqli_query('SELECT * FROM modal');
	//$row = mysqli_fetch_array($cek);
	//if ($row['kode_modal'] == null )
	//{
		//Masukan data ke Table Modals
		$input = 
		"UPDATE modal SET
		kode_beli = '$kd_beli',
		kode_barang = '$kd_brg',
		tanggal = '$tgl', 
		harga_beli = '$hrg_beli',
		tanggal_jual1 = '$tgl_jual1', 
		harga_jual1 = '$hrg_jual1',
		tanggal_jual2 = '$tgl_jual2',
		harga_jual2 = '$hrg_jual2',
		tanggal_jual3 = '$tgl_jual3',
		harga_jual3 = '$hrg_jual3'
		WHERE kode_beli = '$kd_beli' AND kode_barang = '$kd_brg'";
		
		//mysqli_query($buka, $input);
		echo $input;

		//Jika Sukses
		//echo "<script>alert('Data berhasil diinput')</script>";
		//echo "<script>document.location='home.php?page=modal-lihat'</script>";
	//}
	//else 
	//{
		//Jika Gagal
		//echo "<script>alert('Data gagal diinput, Silahkan diulangi!')</script>";
        //echo "<script>document.location='home.php?page=modal-tambah'</script>";
	//}
	//Tutup koneksi engine MySQL
	mysqli_close($buka);
}
?>
