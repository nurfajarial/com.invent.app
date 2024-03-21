<?php
//koneksi ke database
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

$rand = rand();
$dir = 'images/img/';

//cek button
if(isset($_POST["submit"])) 
{
    $kode_merk = $_POST['cmb_merk'];
    $kode_model = $_POST['cmb_model'];
    $kode_tipe = $_POST['cmb_tipe'];
    $kode_seri = $_POST['cmb_seri'];
    $kode_ukuran = $_POST['cmb_ukuran'];
    $kode_jenis = $_POST['cmb_jenis'];
    $kode_warna = $_POST['cmb_warna'];
	$kode_barang = $_POST['txt_kode_barang'];
    $kode_serial = $_POST['txt_kode_serial'];
	$deskripsi = $_POST['txt_deskripsi'];	
    $imagename = $_FILES['foto']['name'];
    $imagetemp = $_FILES['foto']['tmp_name'];
    $ukuran = $_FILES['foto']['size'];
	
    if($imagename == '')
    {
        //echo "<script>alert('kosong')</script>";
        $target = 'no-img.png';
    }
    else
    {
        $maxDim = 800;
        $source = $dir.$imagename;
        $sumber = pathinfo($source);
        $target = $rand.'_'.$sumber['filename'].'.png';
        move_uploaded_file($imagetemp,$source);
        list($width, $height, $type, $attr) = getimagesize($source);
        if($width > $maxDim || $height > $maxDim)
        {
            $rasio = 0.50;
            if($rasio > 1)
            {
                    $n_width = $maxDim;
                    $n_height = $maxDim/$rasio;                
            }
            else
            {
                    $n_width = $maxDim*$rasio;
                    $n_height = $maxDim;                
            }
            $n_width = $width * $rasio;
            $n_height = $height * $rasio;
     
        }
        else
        {
            $n_width = $width;
            $n_height = $height;
        }
        $src = imagecreatefromstring(file_get_contents($source));
        $dst = imagecreatetruecolor($n_width, $n_height);         
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
        imagedestroy($src);
        imagepng($dst, $dir.$target);
        imagedestroy($dst);
        unlink($source);    
    }

    //masukan data ke tabel barang
    $add1 = "INSERT INTO barang
	(
		kode_merk,
		kode_model,
		kode_tipe,
		kode_seri,
		kode_ukuran,
		kode_warna,
		kode_jenis,
		kode_barang,
        kode_serial,
		deskripsi,
		idgambar,
		status
	) 
	VALUES 
	(
		'$kode_merk',
		'$kode_model',
		'$kode_tipe',
		'$kode_seri',
		'$kode_ukuran',
		'$kode_warna',
		'$kode_jenis',
		'$kode_barang',
        '$kode_serial',
		'$deskripsi',
		'$target',
		'1'
	)";

	//echo $add1;
    mysqli_query($buka, $add1);
	include 'audit/add-barang.php';

	//Jika Sukses
	echo "<script>alert('Data berhasil diinput')</script>";
	echo "<script>document.location='home.php?page=barang-lihat'</script>";
}
else
{
	echo "<script>alert('ada kesalahan, silahkan diulang kembali')</script>";
	echo "<script>document.location='home.php?page=barang-tambah'</script>";
}		

//tutup koneksi ke database
mysqli_close($buka);

?>