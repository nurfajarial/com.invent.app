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

echo "<div>";
echo "<center><h4>Daftar Mutasi Keluar</h4></center>";
echo "</div>";
echo "<br>";
echo "<input class='form-control' id='myInput' type='text' placeholder='Search..'>";
echo "<br>";

$query = mysqli_query($buka, 'select * from mutasi_keluar order by tanggal_mutasi_keluar')or die(mysql_error);;
while ($data = mysqli_fetch_array($query))
{
    
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_mutasi_keluar']."</h4>
                <table class='table-striped' width='100%' >
                    <tr>
                        <td>
                            <p class='list-group-item-text' id='subjectName' >
                                Tanggal     : <b>".$data['tanggal_mutasi_keluar']."</b><br />
                                Kode Barang : <b>".$data['kode_barang']."</b><br />
                                Jumlah      : <b>".$data['jumlah_keluar']."
                            </p>
                        </td>
                        <td align='center' width='30%'>";
                            if($_SESSION['level']=='1')
                            {
                                echo "
                                <a href='home.php?page=mutasi-keluar-detil&&kode_mutasi_keluar=".$data['kode_mutasi_keluar']."' class='btn btn-primary' >
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
