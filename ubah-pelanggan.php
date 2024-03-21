<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
if (isset($_GET['kode_pelanggan']))
{
	$kode_pelanggan = $_GET['kode_pelanggan'];
}
else
{
	die ('Error. No Kode Selected! ');
}
			
//Tampilkan data dari tabel customer
$query = mysqli_query($buka, "SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan'");
$hasil = mysqli_fetch_array($query);
$kode_pelanggan = $hasil['kode_pelanggan'];
$nama_pelanggan = $hasil['nama_pelanggan'];
$alamat_pelanggan = $hasil['alamat_pelanggan'];
$alamat_pengiriman = $hasil['alamat_pengiriman'];
$alamat_penagihan = $hasil['alamat_penagihan'];
$telp = $hasil['telp'];
$mobile = $hasil['hp'];
$fax = $hasil['fax'];
$email = $hasil['email'];
			
//proses edit data customer
if (isset($_POST['Edit']))
{
	//
	$kode_pelanggan1 = $_POST['txt_kode_pelanggan'];
	$nama_pelanggan1 = $_POST['txt_nama_pelanggan'];
    $alamat_pelanggan1 = $_POST['txt_alamat_pelanggan'];
	$alamat_pengiriman1 = $_POST['txt_alamat_pengiriman'];
	$alamat_penagihan1 = $_POST['txt_alamat_penagihan'];
	$telp1 = $_POST['txt_telp'];
	$mobile1 = $_POST['txt_mobile'];
	$fax1 = $_POST['txt_fax'];
	$email1 = $_POST['txt_email'];
					
	//update data
	$update = "UPDATE pelanggan
	SET kode_pelanggan = '$kode_pelanggan1',
	nama_pelanggan = '$nama_pelanggan1',
	alamat_pelanggan = '$alamat_pelanggan1',
	alamat_pengiriman = '$alamat_pengiriman1',
	alamat_penagihan = '$alamat_penagihan1',
	telp = '$telp1',
	hp = '$mobile1',
	fax = '$fax1',
	email = '$email1'
	WHERE 	
	kode_pelanggan='$kode_pelanggan'";
	$sql = mysqli_query($buka, $update);
	
	//setelah berhasil update
	if ($sql)
	{
    	echo "<script>alert('Data Pelanggan berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=pelanggan-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Data Pelanggan gagal diedit')</script>";
		echo "<script>document.location='home.php?page=pelanggan-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-customer' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <center><font> <b>&nbsp;UBAH DATA PELANGGAN&nbsp;</b></font></center>
                </div>
            </div>
            <div class='modal-body'>
			    <table align='center'>
                    <tr>
            			<td colspan='3'>&nbsp;</td>
            	    </tr>
				    <tr>
						<td>Kode Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
                            <input type='text' id='txt_kode_pelanggan' name='txt_kode_pelanggan' size='15' maxlength='15' class='form-control' value='".$kode_pelanggan."' />
                        </td>
				    </tr>
				    <tr>
						<td>Nama Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
						<td>
						    <input type='text' id='txt_nama_pelanggan' name='txt_nama_pelanggan' maxlength='30' class='form-control' value='".$nama_pelanggan."' />
						</td>
				    </tr>
                    <tr>
                        <td>Alamat Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='30' rows='5' id='txt_alamat_pelanggan' name='txt_alamat_pelanggan' class='form-control'>".$alamat_pelanggan."</textarea>
                        </td>
                    <tr>
				    <tr>
						<td>Alamat Pengiriman</td>
                        <td>&nbsp;:&nbsp;
			  			<td>
                            <textarea cols='30' rows='5' id='txt_alamat_pengiriman' name='txt_alamat_pengiriman' class='form-control'>".$alamat_pengiriman."</textarea>
                        </td>
				    </tr>
                    <tr>
                        <td>Alamat Penagihan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='30' rows='5' id='txt_alamat_penagihan' name='txt_alamat_penagihan' class='form-control'>".$alamat_penagihan."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>&nbsp;:&nbsp;
                        <td>
                            <input type='text' id='txt_telp' name='txt_telp' maxlength='15' class='form-control' value='".$telp."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Handphone;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_mobile' name='txt_mobile' maxlength='15' class='form-control' value='".$mobile."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_fax' name='txt_fax' maxlength='15'  class='form-control' value='".$fax."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_email' name='txt_email' maxlength='30' class='form-control' value='".$email."' />
                        </td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=pelanggan-detil&&kode_pelanggan=".$kode_pelanggan."' title='kembali ke lihat data customer' class='btn btn-default'>
                </div>
            </div>
        </div>
    </div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>