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
"<div>
    <center><h3><b>Daftar PO Konfirmasi</b></h3></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..' onkeyup='myFunction()'>
<br>";

$query = mysqli_query($buka, "SELECT * FROM po_detail WHERE status = 'OK' GROUP BY kode_po ORDER BY tanggal_po" );
while ($data = mysqli_fetch_array($query))
{
    $kode_po = $data['kode_po'];
    $sesi = $data['sesi'];
    $tanggal = $data['tanggal_po'];
    $kode_barang = $data['kode_barang'];
    $status = $data['status'];
    $li_que = mysqli_query($buka, "SELECT * FROM po_detail JOIN barang ON barang.kode_barang = po_detail.kode_barang WHERE kode_po='$kode_po' AND harga = '0' ")or die(mysqli_error);
    
    echo
    "<form action='#' method='POST' name='form-po_fix' enctype='multipart/form-data'>
        <ul class='list-group' id='myList1' style='list-style: none'>
            <li class='list-group-item' id='subjectName'>
                <table class='table table-striped table-bordered data'>
                    <thead>
                        <tr class='' bgcolor='#B0C4DE'>
                            <td colspan='3' align='center'>Kode : ".$kode_po."&nbsp;&nbsp;Sesi : ".$sesi."</td>
                        </tr>
                        <tr>
                            <td align='center'>Nama Barang</td>
                            <td align='center'>Jumlah</td>
                            <td align='center'>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        ";
                        while($row = mysqli_fetch_array($li_que))
                        {
                            $kd_po = $row['kode_po'];
                            $sess = $row['$sess'];
                            $tgl_po = $row['tanggal_po'];
                            $kd_brg = $row['kode_barang'];
                            $nm_brg = $row['nama_barang'];
                            $jml = $row['jumlah_beli'];
                            $harga = $row['harga'];
                            $status = $row['status'];
                            echo 
                            "
                            <tr>
                                <td align='center'><input type='hidden' class='form-control' value='$kd_brg' maxlength='6' size='6' readonly />$nm_brg</td>
                                <td align='center'>$jml</td>
                                <td align='center'>
                                    <a href='home.php?page=po-fix-hapus&&kode_barang=".$kd_brg."&&jumlah_beli=".$jml."&&kode_po=".$kd_po."&&tanggal_po=".$tgl_po."' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
                                </td>
                            <tr>                            
                            ";
                        }
                    echo
                        "
                        <tr>
                            <td colspan='3' align='center'>
                                <a href='home.php?page=pembelian-tambah&&kode_po=".$kode_po."&&sesi=".$sesi."' class='btn btn-primary'>Buat Faktur</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ul>
        </center>
    </form>";
}
?>

<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#myList1 tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>

