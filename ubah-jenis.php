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
if (isset($_GET['kode_jenis']))
{
    $kode_jenis = $_GET['kode_jenis'];
}
else
{
    die ('Error. No Kode Selected! '); 
}
//Tampilkan data dari tabel

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM jenis_barang WHERE kode_jenis = '$kode_jenis'");
$hasil = mysqli_fetch_array($query);
$idjenis = $hasil['idjenis'];
$kode_jenis = $hasil['kode_jenis'];
$nama_jenis = $hasil['nama_jenis'];
$ket = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_jenis1 = $_POST['txt_kode_jenis'];
    $nama_jenis1 = $_POST['txt_nama_jenis'];
    $ket1 = $_POST['txt_ket'];

    //update data
    $update = "UPDATE jenis_barang
    SET kode_jenis = '$kode_jenis1', nama_jenis = '$nama_jenis1', keterangan = '$ket1' WHERE idjenis = '$idjenis'";

    $sql1 = mysqli_query($buka, $update);
    
    //setelah berhasil update
    if ($sql1)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=jenis-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data gagal diedit')</script>";
        echo "<script>document.location='home.php?page=jenis-lihat'</script>";
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
						<td>Kode Jenis</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_kode_jenis' name='txt_kode_jenis' class='form-control' value='{$kode_jenis}' />
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
							<input id='txt_nama_jenis' name='txt_nama_jenis' class='form-control' value='{$nama_jenis}' />
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
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=jenis-lihat&&kode_jenis=".$kode_jenis."' class='btn btn-default'>                
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
    $('#txt_kode_jenis').focus(function()
    {
        $('#pesan1').html('');        
    });

    $('#txt_kode_jenis').blur(function()
    {
        
        var kode_jenis = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_jenis.php',
            data : 'txt_kode_jenis='+kode_jenis,
            success : function(data)
            {
                $('#pesan1').html(data);
            }
        });
       
    });
});
</script>