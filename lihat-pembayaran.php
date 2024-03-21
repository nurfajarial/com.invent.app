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

$query = mysqli_query($buka, "SELECT * FROM pembayaran")or die(mysqli_error);
while ($data = mysqli_fetch_assoc($query))
{

    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_bayar']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <p class='list-group-item-text' id='subjectName' >
                            Hari       : <b>".$data['hari']."</b><br />
                            Keterangan : <b>".$data['keterangan']."</b><br />
                            </p>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=pembayaran-ubah&&kd_byr=".$data['kode_bayar']."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>
                            <a href='home.php?page=pembayaran-hapus&&kd_byr=".$data['kode_bayar']."' class='btn btn-danger'>
                                <i class='glyphicon glyphicon-remove'></i>
                            </a>
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
        $('#myList1 div').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>