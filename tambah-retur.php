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
	$kd_retur = $_POST['txt_kd_retur'];
	$kd_beli = $_POST['txt_kdbeli'];
	$tgl_retur = $_POST['txt_tgl_retur'];
	$tgl_beli = $_POST['txt_tglbeli'];
	$tgl_tmp = $_POST['txt_tgltmp'];
	$kd_faktur = $_POST['cmb_kd_beli'];
	$kd_do = $_POST['txt_kddo'];
	$kd_brg1 = $_POST['cmb_kdbrg'];
	$kd_brg2 = $_POST['cmb_kd_brg'];
	$kd_po = $_POST['txt_kdpo'];
	$sesi = substr($kd_po, -1);
	$kd_supp = $_POST['txt_kd_supp'];
	$kd_cust = $_POST['txt_kd_cust'];
	$kd_byr = $_POST['txt_kdbyr'];
	$kd_usr1 = $_POST['cmb_user'];
	$kd_usr2 = $_POST['txt_kdusr'];
	$jum = $_POST['txt_jumlah'];
	$disc = $_POST['txt_dis'];
	$hrg = $_POST['txt_harga'];
	$ttl = $_POST['txt_total'];
	$stat = $_POST['r_button'];
	$ket = $_POST['txt_ket'];
	$plat = $_POST['txt_plat'];
	$supir = $_POST['txt_supir'];

	//Masukan data ke tabel Retur
	$inp1 = "INSERT INTO retur
	(
	kode_retur, 
	tanggal_retur, 
	kode_faktur, 
	kode_barang,
	kode_pelanggan,
	kode_user,
	jumlah,
	status,
	keterangan
	) 
	VALUES 
	(
	'$kd_retur',
	'$tgl_retur', 
	'$kd_beli', 
	'$kd_brg1',
	'$kd_cust',
	'$kd_usr1',
	'$jum',
	'$stat',
	'$ket'
	)";

	//update data ke tabel pembelian
	$inp2 = "UPDATE pembelian 
	SET kode_beli = '$kd_beli',
	kode_faktur = '$kd_faktur',
	kode_do = '$kd_do',
	kode_pemasok = '$kd_supp',
	tanggal_beli = '$tgl_beli',
	kode_po = '$kd_po',
	jumlah = '$jum',
	diskon = '$disc',
	total = '$ttl',
	kode_user = '$kd_usr2',
	kode_bayar = '$kd_byr',
	tanggal_tempo = '$tgl_tmp',
	no_plat = '$plat',
	nama_supir = '$supir' 
	WHERE kode_po = '$kd_po'";

	//update data ke tabel po_detail
	$inp3 = "UPDATE po_detail 
	SET kode_po = '$kd_po',
	sesi = '$sesi',
	tanggal_po = '$tgl_beli',
	kode_barang = '$kd_brg2',
	jumlah_beli = '$jum',
	harga = '$hrg',
	status = 'Order' 
	WHERE kode_po = '$kd_po' AND kode_barang = '$kd_brg'";

	//validasi data jika kosong
	if (empty($_POST['txt_kd_retur']))
	{
		echo "<script>alert('Data Harap Dilengkapi')</script>";
		echo "<script>document.location='home.php?page=retur-tambah'</script>";
	}
	//Jika Validasi Terpenuhi
	else 
	{
		include 'config/koneksi.php';
		//cek Kode Barang di database
		$cek = mysqli_query($buka, "SELECT kode_retur FROM retur WHERE kode_retur = '$_POST[txt_kode_retur]'");
		$dt_r = mysqli_fetch_array($cek, MYSQLI_BOTH);
		if ($dt_r['kode_retur'] == null ) 
		{
			if($_POST['r_button'] == 'Retur')
			{
				//echo $inp1;
				mysqli_query($buka, $inp1);

				echo "<script>alert('Data berhasil diinput')</script>";
				echo "<script>document.location='home.php?page=retur-lihat'</script>";
			}
			else
			{
				//echo $inp1."<br />";
				//echo $inp2."<br />";
				//echo $inp3."<br />";
				mysqli_query($buka, $inp1);
				mysqli_query($buka, $inp2);
				mysqli_query($buka, $inp3);

				echo "<script>alert('Data berhasil diinput dan di update')</script>";
				echo "<script>document.location='home.php?page=retur-lihat'</script>";
			}
		}
		else
		{
			echo "<script>alert('Kode Retur sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=retur-tambah'</script>";
		}

    //Tutup koneksi engine MySQL
    mysqli_close($buka);
	}
		
}

?>
</body>