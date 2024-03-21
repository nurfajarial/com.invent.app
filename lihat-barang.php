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

$dir = "images/img/";
echo "
<div>
    <center><h4><b>Daftar Barang</b></h4></center>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Cari..' onkeyup='myFunction()'>
<br>";

$query = mysqli_query($buka, "SELECT * FROM barang 
	JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
	JOIN model_barang ON model_barang.kode_model = barang.kode_model
	JOIN tipe_barang ON tipe_barang.kode_tipe = barang.kode_tipe
	JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
	JOIN ukuran_barang ON ukuran_barang.kode_ukuran = barang.kode_ukuran
	JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis");

while ($data = mysqli_fetch_array($query))
{
	$kode_barang = $data["kode_barang"];
	$gambar = $data["idgambar"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_barang']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td width='25%'>
                            &nbsp;<img src='".$dir.$gambar."' width='110px' height='90px' />&nbsp;
                        </td>
                        <td>
                            <span class='list-group-item-text' id='subjectName' align='left' >
                                &nbsp;Nama   : <b>{$data["nama_jenis"]}</b><br />
                                &nbsp;Merk   : <b>{$data["nama_merk"]}</b><br />
                                &nbsp;Ukuran : <b>{$data["nama_ukuran"]}</b><br />
                            </span>
                        </td>
                        <td align='center' width='20%'>";
                            if($data["status"] == '1')
                            {
                                echo "
                               <a href='home.php?page=barang-detil&&kode_barang=".$kode_barang."' class='btn btn-primary'>
                                    <i class='glyphicon glyphicon-list'></i>
                                </a>";
                                    if($_SESSION["level"]=="1")
                                    {
                                        echo "
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

<!-- Modal Hapus -->
<?php
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
                    <a class='btn btn-primary' href='home.php?page=barang-hapus&&kode_barang=".$kode_barang."'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
?>
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