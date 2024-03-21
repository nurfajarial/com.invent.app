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
if (isset($_GET['kode_seri']))
{
    $kode_seri = $_GET['kode_seri'];
}
else
{
    die ('Error. No Kode Selected! '); 
}
//Tampilkan data dari tabel

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM seri_barang WHERE kode_seri = '$kode_seri'");
$hasil = mysqli_fetch_array($query);
$idseri = $hasil['idseri'];
$kode_seri = $hasil['kode_seri'];
$nama_seri = $hasil['nama_seri'];
$ket = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_seri1 = $_POST['txt_kode_seri'];
    $nama_seri1 = $_POST['txt_nama_seri'];
    $ket1 = $_POST['txt_ket'];

    //update data
    $update = "UPDATE seri_barang
    SET kode_seri = '$kode_seri1', nama_seri = '$nama_seri1', keterangan = '$ket1' WHERE idseri = '$idseri'";

    $sql1 = mysqli_query($buka, $update);
    
    //setelah berhasil update
    if ($sql1)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=seri-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data gagal diedit')</script>";
        echo "<script>document.location='home.php?page=seri-lihat'</script>";
    }
}

echo "
<form action='#' method='POST' name='ubah-merk' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM UBAH DATA JENIS&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
				<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Seri</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_kode_seri' name='txt_kode_seri' class='form-control' value='{$kode_seri}' />
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
						<td>Nama Jenis</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_nama_seri' name='txt_nama_seri' class='form-control' value='{$nama_seri}' />
						</td>
					</tr>
					<tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>
					        <span id='pesan2'></span>
					    </td>
					</tr>
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
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=seri-lihat&&kode_seri=".$kode_seri."' class='btn btn-default'>                
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
    $('#txt_kode_seri').focus(function()
    {
        $('#pesan1').html('');        
    });

    $('#txt_kode_seri').blur(function()
    {
        
        var kode_seri = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_seri.php',
            data : 'txt_kode_seri='+kode_seri,
            success : function(data)
            {
                $('#pesan1').html(data);
            }
        });
       
    });
});
</script>