<?php
include "config/koneksi.php";
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
    <center><h4>Daftar Pengguna</h4></center>
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Search..' />
<br />";

$query = mysqli_query($buka, "SELECT * FROM karyawan JOIN level ON level.kode_level = karyawan.kode_level")or die('Ada kesalahan pada query : '.$mysqli->error);
while ($data = mysqli_fetch_array ($query))
{
    $kode_user = $data["kode_user"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_user']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama   : <b>{$data["nama_karyawan"]}</b><br />
                                Level  : <b>{$data["jenis_level"]}</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%' >
                            <a href='home.php?page=pengguna-detil&&kode_user={$kode_user}' class='btn btn-default glyphicon glyphicon-search'></a>
                            <a href='#' class='btn btn-default glyphicon glyphicon-remove' data-toggle='modal' data-target='#deleteModal'></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>";
}
?>

<!-- Modal Hapus -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin dihapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body">Pilih "Hapus" untuk menghapus</div>
            <div class="modal-footer">
                <div align='center'>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="home.php?page=pengguna-hapus&&kode_user=<?=$kode_user?>">Hapus</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Hapus -->

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