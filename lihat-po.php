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
    <center><h3><b>Daftar PO Tunggu</b></h3></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..' onkeyup='myFunction()'>
<br>";

$query = mysqli_query($buka, 'SELECT * FROM po_detail_temp GROUP BY kode_po')or die(mysqli_error);
while ($data = mysqli_fetch_assoc($query))
{
    $kode_po = $data['kode_po'];
    $sesi = $data['sesi'];
    $tanggal = $data['tanggal_po'];
    $kode_barang = $data['kode_barang'];
    $status = $data['status'];
    $li_que = mysqli_query($buka, "SELECT * FROM po_detail_temp JOIN barang ON barang.kode_barang=po_detail_temp.kode_barang WHERE kode_po='$kode_po'")or die(mysqli_error);
    echo
    "<form>
        <ul class='list-group' id='myList' style='list-style: none'>
            <li class='list-group-item' id='subjectName'>
                <table class='table table-striped table-bordered data'>
                    <thead>
                        <tr class='' bgcolor='#B0C4DE'>
                            <td colspan='2' align='center'>Kode : ".$kode_po."&nbsp;&nbsp;Sesi : ".$sesi."</td>
                        </tr>
                        <tr>
                            <td align='center'>Nama Barang</td>
                            <td align='center'>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody>";
                        while($list = mysqli_fetch_assoc($li_que))
                        {
                            $list_brg_a = $list['kode_barang'];
                            $list_brg_b = $list['nama_barang'];
                            $list_jml = $list['jumlah_beli'];
                            echo "<tr><td width='70%' align='left'>".$list_brg_b."</td><td width='30%' align='center'>".$list_jml."</td></tr>";
                        }
                        echo "
                        <tr>
                            <td colspan='2' align='center'>
                                <a href='home.php?page=po-setuju&&kode_po=".$kode_po."&&sesi=".$sesi."' class='btn btn-primary'>Konfirmasi</a>
                                <a href='home.php?page=po-hapus&&kode_po=".$kode_po."&&sesi=".$sesi."' class='btn btn-danger'>Hapus</a>
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

