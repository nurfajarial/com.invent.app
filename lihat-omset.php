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
    <h4>Daftar Omset</h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Cari..'>
<br>";
				        
$query = mysqli_query($buka, "SELECT * FROM omset")or die(mysqli_error);
while ($data = mysqli_fetch_assoc($query))
{
	$kode_omset = $data['kode_omset'];
	$tanggal = $data['tanggal'];
	$bulan = $data['bulan'];
	$tahun = $data['tahun'];
	$jumlah = $data['jumlah'];
	$harga = $data['harga'];

    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>{$data['kode_omset']}</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Tanggal : <b>".$tanggal."-".$bulan."-".$tahun."</b><br />
                                Jumlah : <b>{$data["harga"]}</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=omset-detil&&kode_omset=".$kode_omset."' >
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
  $('#myInput').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $('#myList div').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



