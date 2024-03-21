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
"
<div align='center'>
    <h3><b>Daftar Model</b></h3>    
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Cari..' onkeyup='myFunction()'>
<br />";

$query = mysqli_query($buka, "SELECT * FROM model_barang ");
while ($data = mysqli_fetch_array($query))
{
    $kode_model = $data["kode_model"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_model']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama        : <b>".$data['nama_model']."</b><br />
                                Keterangan  : <b>".$data['keterangan']."</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=model-ubah&&kode_model=".$kode_model."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>&nbsp;
                            <a href='#' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
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
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='modal-body'>Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                    <a class='btn btn-primary' href='home.php?page=model-hapus&&kode_model={$kode_model}'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
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
