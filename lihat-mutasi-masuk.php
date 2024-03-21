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
    <h4><b>Daftar Mutasi Masuk</b></h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$query = mysqli_query($buka, "SELECT * FROM mutasi_masuk ORDER BY tanggal_mutasi_masuk")OR DIE(mysqli_error);;
while ($data = mysqli_fetch_array($query))
{
    $kode_mutasi_masuk = $data['kode_mutasi_masuk'];
    $tgl_mutasi_masuk = $data['tanggal_mutasi_masuk'];
    $kode_barang = $data['kode_barang'];
    $jumlah_masuk = $data['jumlah_masuk'];
    $pengirim = $data['pengirim'];
    $status_masuk = $data['status_masuk'];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_mutasi_masuk']."</h4>
                <table class='table-striped' width='100%' >
                    <tr>
                        <td>
                            <p class='list-group-item-text' id='subjectName' >
                                Tanggal      : <b>".$data['tanggal_mutasi_masuk']."</b><br />
                                Kode Barang  : <b>".$data['kode_barang']."</b><br />
                                Jumlah       : <b>".$data['jumlah_masuk']."</b>
                            </p>
                        </td>
                        <td align='center' width='30%'>";
                            if($_SESSION['level']=='1')
                            {
                                echo "
                                <a href='home.php?page=mutasi-masuk-detil&&kode_mutasi_masuk=".$kode_mutasi_masuk."' class='btn btn-primary'>
                                    <i class='glyphicon glyphicon-list'></i>
                                </a>";
                            }
                        echo "
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
