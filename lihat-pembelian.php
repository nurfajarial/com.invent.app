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
echo "<br />";
echo "<body bgcolor='#EEF2F7'>";
echo "
<div>
    <center><b><h3>Daftar Pembelian</h3></b></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..' onkeyup='myFunction()'>
<br>";

$query = mysqli_query($buka, 'SELECT * FROM pembelian JOIN pemasok ON pemasok.kode_pemasok = pembelian.kode_pemasok JOIN pembayaran ON pembayaran.kode_bayar = pembelian.kode_bayar ORDER BY tanggal_beli DESC')or die(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    $kode_beli = $data['kode_beli'];
    $kode_faktur = $data['kode_faktur'];
    $kode_pemasok = $data['kode_pemasok'];
    $nama_pemasok = $data['nama_pemasok'];
    $tanggal_beli = $data['tanggal_beli'];
    $kode_po = $data['kode_po'];
    $jumlah = $data['jumlah'];
    $pengirim = $data['kode_user'];
    $kode_bayar = $data['kode_bayar'];
    $ket = $data['keterangan'];
    date_default_timezone_set('Asia/Jakarta');
    echo "
    <form>
        <ul class='list-group' id='myList1' style='list-style: none'>
            <li class='list-group-item' id='subjectName'>
                <table class='table table-striped table-bordered data'>
                    <thead>
                        <tr class='' bgcolor='#B0C4DE' align='center'>
                            <td>Kode Faktur : ".$kode_faktur."</td>
                            <td>Tanggal : ".$kode_po."</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan='2'>
                            <i>Pemasok : ".$nama_pemasok."</i><br />
                            <i>Tanggal : ".$tanggal_beli."</i><br />
                            <i>Jumlah : ".$jumlah."</i><br />
                            <i>Pembayaran : ".$ket."</i><br />
                        </tr>
                        <tr align='center'>
                            <td colspan='2'>
                                <a href='home.php?page=pembelian-detail&&kode_beli=".$kode_beli."' class='btn btn-primary'>Rincian</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
    </form>";
}
?>

<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() 
    {
        var value = $(this).val().toLowerCase();
        $('#myList tr').filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>