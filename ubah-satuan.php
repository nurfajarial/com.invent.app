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

include 'config/koneksi.php';
if (isset($_GET['kode_satuan']))
{
	$kode_satuan = $_GET['kode_satuan'];
} 
else 
{
	die ('Error. No Kode Selected! ');	
}
//Tampilkan data dari tabel barang
	$query = $sql = mysqli_query($buka, "SELECT * FROM satuan WHERE kode_satuan='$kode_satuan'");
	$hasil = mysqli_fetch_array ($query);
	$kode_satuan = $hasil['kode_satuan'];
	$nama_satuan = $hasil['nama_satuan'];
	$ket = $hasil['keterangan'];
	
//proses edit data barang
if (isset($_POST['Edit']))
{
	$kode_satuan1 = $_POST['txt_kode_satuan'];
	$nama_satuan1 = $_POST['txt_nama_satuan'];
	$ket1 = $_POST['txt_ket'];
	
	//update data
	$update = "UPDATE satuan
	SET
    kode_satuan='$kode_satuan1',
	nama_satuan='$nama_satuan1',
	keterangan='$ket1'
	WHERE 
	kode_satuan='$kode_satuan'";
	$sql = mysqli_query ($buka, $update);

    //setelah berhasil update
	if ($sql) 
	{
		echo "<script>alert('Data Unit Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=satuan-lihat'</script>";
	}
	else 
	{
		echo "<script>alert('Data Unit gagal diedit')</script>";
		echo "<script>document.location='home.php?page=satuan-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-satuan' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <b>UBAH DATA SATUAN / UNIT</b>
			    </div>
		    </div>
		    <div class='modal-body'>
				<table border='0' align='center' cellpadding='0' cellspacing='0'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Satuan</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
                            <input type='text' id='txt_kode_satuan' name='txt_kode_satuan' maxlength='15' class='form-control' value='".$kode_satuan."' />
                        </td>
					</tr>
					<tr>
						<td>Nama Lokasi</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
                            <input type='text' id='txt_nama_satuan' name='txt_nama_satuan' maxlength='30' class='form-control' value='".$nama_satuan."' />
                        </td>
					</tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='50' rows='6' id='txt_ket' name='txt_ket' class='form-control'>".$ket."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
				</table>
		    </div>
		    <div class='modal-footer'>                
			    <div align='center'>
                    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
				    <input type='button' value='Cancel' onclick=location.href='home.php?page=satuan-detil&&kode_satuan=".$kode_satuan."' title='kembali ke lihat data barang' class='btn btn-default'>
			    </div>
		    </div>
	    </div>
    </div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>