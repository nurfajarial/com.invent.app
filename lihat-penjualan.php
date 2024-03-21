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
<h4>Daftar Penjualan</h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$no = 0;
$query = mysqli_query($buka, "SELECT * FROM penjualan JOIN pelanggan ON pelanggan.kode_pelanggan = penjualan.kode_pelanggan")or die(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_jual']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <img src='images/img/no-img.png' width='100' height='90' />
                        </td>
                        <td>
                            <span class='list-group-item-text' id='subjectName'
                                Faktur : <b>".$data['kode_faktur']."</b><br />
                                Pelanggan : <b>".$data['kode_jual']."/b><br />
                                Tanggal : <b>".$data['tanggal_jual']."</b><br />
                                PO : <b>".$data['kode_po']."</b><br />
                                Jumlah : <b>".$data['jumlah']."</b><br />
                            </span>
                        </td>
                        <td>
                            &nbsp;&nbsp;
							<a href='home.php?page=penjualan-detil&&kode_jual=".$kd_jual."' class='btn btn-primary'>
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
