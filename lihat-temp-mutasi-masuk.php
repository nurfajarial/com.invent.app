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
    <b><h3>Mutasi Masuk Sementara</h3></b>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Cari..' onkeyup='myFunction()'>
<br>
<br>";

$query = mysqli_query($buka, "SELECT * FROM temp_mutasi_masuk JOIN barang ON barang.kode_barang = temp_mutasi_masuk.kode_barang ORDER BY tanggal_mutasi_masuk");
while ($data = mysqli_fetch_array($query, MYSQLI_BOTH))
{
    $kode_mutasi_masuk = $data["kode_mutasi_masuk"];
    $tanggal_mutasi_masuk = $data["tanggal_mutasi_masuk"];
    $kode_barang = $data["kode_barang"];
    $jumlah_masuk = $data["jumlah_masuk"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_mutasi_masuk']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Tanggal      : <b>".$data['tanggal_mutasi_masuk']."</b><br />
                                Kode Barang  : <b>".$data['kode_barang']."</b><br />
                                Jumlah       : <b>".$data['jumlah_masuk']."</b>
                            </span>
                        </td>
                        <td width='30%' align='center'>
                            <a href='home.php?page=mutasi-masuk-temp-setuju&&kode_mutasi_masuk={$kode_mutasi_masuk}&&tanggal_mutasi_masuk={$tanggal_mutasi_masuk}&&kode_barang={$kode_barang}&&jumlah_masuk={$jumlah_masuk}' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-ok'></i>
                            </a>
                            <a href='home.php?page=mutasi-masuk-temp-hapus&&kode_mutasi_masuk={$kode_mutasi_masuk}&&tanggal_mutasi_masuk={$tanggal_mutasi_masuk}&&kode_barang={$kode_barang}&&jumlah_masuk={$jumlah_masuk}' class='btn btn-danger'>
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
    $('#myInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#myList div').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>