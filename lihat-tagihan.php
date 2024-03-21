<?php 
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
<center><h4><b>Daftar Tagihan</b></h4></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

include 'config/koneksi.php';
$q_tgh = mysqli_query($buka, 'SELECT * FROM tagihan JOIN pelanggan ON pelanggan.kode_pelanggan = tagihan.kode_pelanggan JOIN pembayaran ON pembayaran.kode_bayar = tagihan.kode_bayar' )or die(mysql_error);
while ($data = mysqli_fetch_array($q_tgh, MYSQLI_BOTH))
{
    $kode_tagihan = $data['kode_tagihan'];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_tagihan']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <img src='images/img/no-img.png' width='100' height='90' />
                        </td>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Pelanggan : <b>".$data['nama_pelanggan']."</b><br />
                                Pembayaran : <b>".$data['keterangan']."</b><br />
                                Tanggal : <b>".$data['tanggal_tagihan']."</b><br />
                                Tempo : <b>".$data['tanggal_tempo']."</b><br />
                                Jumlah : <b>".$data['jumlah']."</b><br />
                            </span>
                        </td>
                        <td>
                            <a class='btn btn-primary' href='home.php?page=tagihan-detil&&kode_tagihan=".$kd_tagihan."'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>
                            <a class='btn btn-danger' href='' data-toggle='modal' data-target='#deleteModal'>
                                <i class='glyphicon glyphicon-remove'></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>";
}

echo "
<div id='deleteModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Yakin dihapus?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>�</span>
                </button>
            </div>
            <div class='modal-body'>Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                    <a class='btn btn-primary' href='home.php?page=tagihan-hapus&&kode_tagihan=".$kode_tagihan."'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
//End of Modal Hapus 
?>

<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() 
    {
        var value = $(this).val().toLowerCase();
        $('#myList div').filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>