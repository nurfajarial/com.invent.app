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
if (isset($_GET['kode_merk']))
{
    $kode_merk = $_GET['kode_merk'];
}
else
{
    die ('Error. No Kode Selected! '); 
}
//Tampilkan data dari tabel

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM merk_barang WHERE kode_merk = '$kode_merk'");
$hasil = mysqli_fetch_array($query);
$idmerk = $hasil['idmerk'];
$kode_merk = $hasil['kode_merk'];
$nama_merk = $hasil['nama_merk'];
$ket = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_merk1 = $_POST['txt_kode_merk'];
    $nama_merk1 = $_POST['txt_nama_merk'];
    $ket1 = $_POST['txt_ket'];

    //update data
    $update = "UPDATE merk_barang
    SET kode_merk = '$kode_merk1', nama_merk = '$nama_merk1', keterangan = '$ket1' WHERE idmerk = '$idmerk'";

    $sql1 = mysqli_query($buka, $update);
    
    //setelah berhasil update
    if ($sql1)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=merk-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data User gagal diedit')</script>";
        echo "<script>document.location='home.php?page=merk-lihat'</script>";
    }
}

echo "
<form action='#' method='POST' name='ubah-merk' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM UBAH DATA MERK&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
				<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Merk</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_kode_merk' name='txt_kode_merk' class='form-control' value='{$kode_merk}' />
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
						<td>Nama Merk</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_nama_merk' name='txt_nama_merk' class='form-control' value='{$nama_merk}' />
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
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=merk-lihat&&kode_merk=".$kode_merk."' class='btn btn-default'>                
                </div>
            </div>
        </div>
    </div>
</form>";
?>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
$(document).ready(function()
{
    $('#txt_kode_merk').focus(function()
    {
        $('#pesan1').html('');        
    });

    $('#txt_kode_merk').blur(function()
    {
        
        var kode_merk = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_merk.php',
            data : 'txt_kode_merk='+kode_merk,
            success : function(data)
            {
                $('#pesan1').html(data);
            }
        });
       
    });
});
</script>