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

echo "
<div align='center'>
<h4>Daftar Modal</h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$query = mysqli_query($buka, "SELECT * FROM modal ")or die(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>{$data["kode_modal"]}</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Barang : <b>{$data["kode_barang"]}</b><br />
                                Tanggal : <b>{$data["tanggal"]}</b><br />
                                Harga Beli : <b>{$data["harga_beli"]}</b><br />
                                Harga Jual 1 : <b>{$data["harga_jual1"]}</b><br />
                                Harga Jual 2 : <b>{$data["harga_jual2"]}</b><br />
                                Harga Jual 3 : <b>{$data["harga_jual3"]}</b>
                            </span>
                        </td>
                        <td align='center' width='30%'>
							<a class='btn btn-primary' href='home.php?page=modal-detil&&kode_modal=".$kd_mdl."'>
							    <i class='glyphicon glyphicon-list'></i>
							</a>
							<a class='btn btn-danger' href='home.php?page=modal-hapus&&kode_modal=".$kd_mdl."'>
							    <i class='glyphicon glyphicon-remove'></i>
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

