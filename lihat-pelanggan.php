<?php
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

echo 
"
<div align='center'>
    <center><h4><b>Daftar Pelanggan</b></h4></center>
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br />";

$query = mysqli_query($buka, "SELECT * FROM pelanggan")or die(mysqli_error);
while ($data = mysqli_fetch_assoc($query))
{
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data["kode_pelanggan"]."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama  : <b>{$data["nama_pelanggan"]}</b><br />
                                Alamat  : <b>{$data["alamat_pelanggan"]}</b><br />
                                Telp : <b>{$data["telp"]}</b><br />
                                HP : <b>{$data["mobile"]}</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=pelanggan-detil&&kode_pelanggan=".$kd_cust."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>";
}
?>

<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() 
    {
        var value = $(this).val().toLowerCase();
        $('#myList div').filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
