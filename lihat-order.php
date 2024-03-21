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
<div>
    <center><h4>Daftar Order</h4></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$no = 0;					    
$query = mysqli_query($buka, "SELECT * FROM permintaan JOIN pemasok ON pemasok.kode_pemasok = permintaan.kode_pemasok JOIN barang ON barang.kode_barang = permintaan.kode_barang ")or die(mysql_error);;
while ($data = mysqli_fetch_assoc($query))
{
	$kode_order = $data['kode_order'];
	$kode_pemasok = $data['kode_supplier'];
	$nama_pemasok = $data['nama_supplier'];
	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
	$tanggal = $data['tanggal'];
	$jam = $data['jam'];
    $no++;
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_barang']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <img src='images/img/no-img.png' width='100' height='90' />
                        </td>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                            No : <b>".$no."</b><br />
                            Pemasok : <b>".$data['nama_pemasok']."</b><br />
                            Barang : <b>".$data['nama_barang']."</b><br />
                            Tanggal : <b>".$data['tanggal']."</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=pesanan-detil&&kode_order=".$kode_order."'>
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

