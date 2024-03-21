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
<div>
    <center><h4>Daftar Unit</h4></center>
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Search..' onkeyup='myFunction()'>
<br />";

$no = 0;
include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM satuan")or die(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    $kd_satuan = $data['kode_satuan'];
    $no++;

    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_satuan']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama       : <b>".$data['nama_satuan']."</b><br />
                                Keterangan : <b>".$data['keterangan']."</b><br />
                        </td>
                        <td align='center' width='30%'>
                            &nbsp;&nbsp;
                            <a href='home.php?page=satuan-detil&&kode_satuan=".$kd_satuan."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>&nbsp;
                            <a href='#'' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                                <i class='glyphicon glyphicon-remove'></i>
                            </a>
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
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Yakin dihapus?</h5>
            </div>
            <div class="modal-body">Pilih "Hapus" untuk menghapus</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="home.php?page=satuan-hapus&&kode_satuan=<?=$kode_satuan?>">Hapus</a>
            </div>
        </div>div>
    </div>
</div>
<!-- End of Modal Hapus -->

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

