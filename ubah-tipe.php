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

include 'config/koneksi.php';
if (isset($_GET['kode_tipe']))
{
    $kode_tipe = $_GET['kode_tipe'];
}
else
{
    die ('Error. No Kode Selected! '); 
}
//Tampilkan data dari tabel

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM tipe_barang WHERE kode_tipe = '$kode_tipe'");
$hasil = mysqli_fetch_array($query);
$idtipe = $hasil['idtipe'];
$kode_tipe = $hasil['kode_tipe'];
$nama_tipe = $hasil['nama_tipe'];
$ket = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_tipe1 = $_POST['txt_kode_tipe'];
    $nama_tipe1 = $_POST['txt_nama_tipe'];
    $ket1 = $_POST['txt_ket'];

    //update data
    $update = "UPDATE tipe_barang
    SET kode_tipe = '$kode_tipe1', nama_tipe = '$nama_tipe1', keterangan = '$ket1' WHERE idtipe = '$idtipe'";

    $sql1 = mysqli_query($buka, $update);
    
    //setelah berhasil update
    if ($sql1)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=tipe-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data User gagal diedit')</script>";
        echo "<script>document.location='home.php?page=tipe-lihat'</script>";
    }
}

echo "
<form action='#' method='POST' name='ubah-tipe' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM UBAH DATA TIPE&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
				<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Tipe</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_kode_tipe' name='txt_kode_tipe' class='form-control' value='{$kode_tipe}' />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>
							<span id='pesan1'></span>
						</td>
					</tr>
					<tr>
						<td>Nama Tipe</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_nama_tipe' name='txt_nama_tipe' class='form-control' value='{$nama_tipe}' />
						</td>
					</tr>
					<tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>
					        <spa id='pesan2'></span>
					    </td>
					<tr>
						<td>Keterangan</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<textarea id='txt_ket' name='txt_ket' class='form-control'>{$ket}</textarea>
						</td>
					</tr>
				</table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='Edit' value='Update' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=tipe-lihat&&kode_tipe=".$kode_tipe."' class='btn btn-default'>                
                </div>
            </div>
        </div>
    </div>
</form>";
?>
