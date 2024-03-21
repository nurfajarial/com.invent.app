<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}
?>
<?php
include 'config/koneksi.php';
if (isset($_GET['kode_lokasi']))
{
	$kode_lokasi = $_GET['kode_lokasi'];
} 
else 
{
	die ('Error. No Kode Selected! ');	
}
//Tampilkan data dari tabel barang
	$query = $sql = mysqli_query($buka, "SELECT * FROM lokasi WHERE kode_lokasi='$kode_lokasi'");
	$hasil = mysqli_fetch_array ($query);
	$kode_lokasi = $hasil['kode_lokasi'];
	$nama_lokasi = $hasil['nama_lokasi'];
	$ket = $hasil['keterangan'];
	
//proses edit data barang
if (isset($_POST['Edit']))
{
	$kode_lokasi1 = $_POST['txt_kode_lokasi'];
	$nama_lokasi1 = $_POST['txt_nama_lokasi'];
	$ket1 = $_POST['txt_ket'];
	
	//update data
	$update = "UPDATE lokasi
	SET
    kode_lokasi='$kode_lokasi1',
	nama_lokasi='$nama_lokasi1',
	keterangan='$ket1'
	WHERE 
	kode_lokasi='$kode_lokasi'";
	$sql = mysqli_query ($buka, $update);

    //setelah berhasil update
	if ($sql) 
	{
		echo "<script>alert('Data Gudang Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=gudang-lihat'</script>";
	}
	else 
	{
		echo "<script>alert('Data Gudang gagal diedit')</script>";
		echo "<script>document.location='home.php?page=gudang-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-gudang' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <b>UBAH DATA GUDANG</b>
			    </div>
		    </div>
		    <div class='modal-body'>
				<table border='0' align='center' cellpadding='0' cellspacing='0'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Lokasi</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
                            <input type='text' id='txt_kode_lokasi' name='txt_kode_lokasi' maxlength='15' class='form-control' value='".$kode_lokasi."' />
                        </td>
					</tr>
					<tr>
						<td>Nama Lokasi</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
                            <input type='text' id='txt_nama_lokasi' name='txt_nama_lokasi' maxlength='30' class='form-control' value='".$nama_lokasi."' />
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
            </form>
		</div>
		<div class='modal-footer'>
			<div align='center'>
                <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
				<input type='button' value='Cancel' onclick=location.href='home.php?page=gudang-detil&&kode_lokasi=".$kode_lokasi."' title='kembali ke lihat data barang' class='btn btn-default'>
			</div>
		</div>
	</div>
</div>";


//Tutup koneksi engine MySQL
mysqli_close($buka);
?>