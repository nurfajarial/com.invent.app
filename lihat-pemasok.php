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
"<div align='center'>
<b><h3>Daftar Pemasok</h3></b>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>
";

$query = mysqli_query($buka, "SELECT * FROM pemasok ORDER BY kode_pemasok")or die(mysqli_error);
while ($data = mysqli_fetch_assoc($query))
{
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data["kode_pemasok"]."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama  : <b>{$data["nama_pemasok"]}</b><br />
                                Alamat  : <b>{$data["alamat_pemasok"]}</b><br />
                                Kontak : <b>{$data["kontak"]}</b><br />
                                Telp : <b>{$data["telp"]}</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=pemasok-detil&&kode_pemasok={$data["kode_pemasok"]}' class='btn btn-primary'>
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
            var value = $(this).val().toLowerCase();$('#myList div').filter(function() 
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>