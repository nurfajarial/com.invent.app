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
    <h3><b>Daftar Stok</b></h3>    
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Search..' onkeyup='myFunction()'>
<br />";

//$query = mysqli_query($buka, "SELECT * FROM stok JOIN satuan ON satuan.kode_satuan = stok.kode_satuan JOIN lokasi ON lokasi.kode_lokasi = stok.kode_lokasi ");
$query = mysqli_query($buka, "SELECT * FROM stok 
    JOIN barang ON barang.kode_barang = stok.kode_barang 
    JOIN lokasi ON lokasi.kode_lokasi = stok.kode_lokasi 
    JOIN satuan ON satuan.kode_satuan = stok.kode_satuan 
    JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis");
while ($data = mysqli_fetch_array($query))
{
    $kode_barang = $data["kode_barang"];
    $kode_lokasi = $data["kode_lokasi"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_barang']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td width='30%'>
                            <img src='images/img/no-img.png' width='110px' height='90px' />
                        </td>
                        <td align='left'>
                            Nama : <b>".$data['nama_jenis']."</b><br />
                            Lokasi : <b>".$data['nama_lokasi']."</b><br />
                            <span class='list-group-item-text' id='subjectName' >
                                Min Stok  : <b>".$data['min_stok']."</b><br />
                                Total     : <b>".$data['total']."</b><br />
                            </span>
                        </td>
                        <td align='center' width='20%'>";
                            if($data["status"] == '1')
                            {
                                if($_SESSION["level"]=="1")
                                {
                                    echo "
                                    <a href='home.php?page=stok-detil&&kode_barang=".$data['kode_barang']."&&kode_lokasi=".$data['kode_lokasi']."' class='btn btn-primary'>
                                        <i class='glyphicon glyphicon-list'></i>
                                    </a>&nbsp;
                                    <a href='#' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                                        <i class='glyphicon glyphicon-remove'></i>
                                    </a>";
                                }
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
                    <a class='btn btn-primary' href='home.php?page=stok-hapus&&kode_barang=<?= $kode_barang ?>&&kode_lokasi=<?= $kode_lokasi ?>'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>

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
