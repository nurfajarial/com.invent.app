<?php error_reporting (E_ALL ^ E_NOTICE);
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
	$kd_tagihan = $_POST['txt_kode_tagihan'];
	$kd_pelanggan = $_POST['cmb_pelanggan'];
	$kd_byr = $_POST['cmb_pembayaran'];
	$tgl_tagihan = $_POST['txt_tgl_tagihan'];
	$tgl_tempo = $_POST['txt_tgl_pelunasan'];
	$jumlah = $_POST['txt_jumlah'];

	//validasi data jika kosong
	if(empty($_POST['txt_kode_tagihan']))
	{
		echo "<script>alert('Data Harap Dilengkapi')</script>";
		echo "<script>document.location='home.php?page=tagihan-tambah'</script>";
	}
	//Jika Validasi Terpenuhi
	else 
	{
		include 'config/koneksi.php';
		//cek Kode Barang di database
		$cek = mysqli_query($buka, "SELECT kode_tagihan FROM tagihan WHERE kode_tagihan='$_POST[txt_kode_tagihan]'");
		$row = mysqli_fetch_array($cek);
		if ($row['kode_order'] == null ) 
		{
			//Masukan data ke Table Order
			$input = 
			"INSERT INTO tagihan
			(
			kode_tagihan, 
			kode_pelanggan,
			kode_bayar,
			tanggal_tagihan,
			tanggal_tempo,
			jumlah,
		    tanggal1,
		    angsuran1,
		    tanggal2,
		    angsuran2,
		    tanggal3,
		    angsuran3,
		    tanggal4,
		    angsuran4,
		    tanggal5,
		    angsuran5,
		    tanggal6,
		    angsuran6,
		    sisa,
		    status
			) 
			VALUES 
			(
			'$kd_tagihan',
			'$kd_pelanggan',
			'$kd_byr',
			'$tgl_tagihan',
			'$tgl_tempo',
			'$jumlah',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
			''
			)";
			$query_input = mysqli_query($buka, $input);
			//Jika Sukses
			
			echo "<script>alert('Data Tagihan Berhasil diinput')</script>";
			echo "<script>document.location='home.php?page=tagihan-lihat'</script>";
		}
		else
		{
			echo "<script>alert('Kode Tagihan sudah ada !, silahkan diulang kembali')</script>";
			echo "<script>document.location='home.php?page=tagihan-tambah'</script>";
		}

		//Tutup koneksi engine MySQL
			mysqli_close($buka);
	}		
}

?>
</body>