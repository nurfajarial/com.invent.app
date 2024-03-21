<?php
include 'config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
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
<h4><b>Daftar Hutang</b></h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$no = 0;
$query = mysqli_query($buka, 'SELECT * FROM utang JOIN pemasok ON pemasok.kode_pemasok = utang.kode_pemasok JOIN pembayaran ON pembayaran.kode_bayar = utang.kode_bayar')or die(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$no++."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                            Kode : <b>{$data['kode_utang']}</b><br />
	                        Pemasok : <b>{$data['nama_pemasok']}</b><br />
	                        Cicilan : <b>{$data['keterangan']}</b><br />
	                        Jumlah : <b>{$data['jumlah']}</b><br />
	                        Tanggal Tempo : <b>".date('d', strtotime($data['tanggal_hutang']))."</b><br />
	                        Status : <b>{$data['status']}</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
						    <a href='home.php?page=utang-detil&&kode_utang=".$kd_u."' class='btn btn-primary'>
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

