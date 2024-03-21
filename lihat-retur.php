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
    <b><h4>Daftar Retur</h4></b>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>";

$no = 0;
$query = mysqli_query($buka, "SELECT * FROM retur JOIN barang ON barang.kode_barang = retur.kode_barang JOIN pelanggan ON pelanggan.kode_pelanggan = retur.kode_pelanggan JOIN karyawan ON karyawan.kode_user = retur.kode_user ORDER BY kode_retur")OR DIE(mysqli_error);
while ($data = mysqli_fetch_array($query))
{
    $kode_retur = $data['kode_retur'];
    $tgl_retur = $data['tanggal_retur'];
    $kode_faktur = $data['kode_faktur'];
    $kode_barang = $data['kode_barang'];
    $nama_barang = $data['nama_barang'];
    $kode_pelanggan = $data['kode_pelanggan'];
    $nama_pelanggan = $data['nama_pelanggan'];
    $penerima = $data['penerima'];
    $jumlah = $data['jumlah'];
    $keterangan = $data['keterangan'];
    $no++;
    
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$no."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Tanggal : <b>".$data['tanggal_retur']."</b><br />
                                Faktur : <b>".$data['kode_faktur']."</b><br />
                                Barang : <b>".$data['kode_barang']."</b><br />
                                Pelanggan : <b>".$data['nama_pelanggan']."</b><br />
                                Jumlah : <b>".$data['jumlah']."</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=retur-detil&&kode_retur=".$kode_retur."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>
                            <a class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                                <i class='glyphicon glyphicon-remove'></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>";
}

//<!-- Modal Hapus -->
echo "
<div id='deleteModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
                <h5 class='modal-title' id='exampleModalLabel'>Yakin dihapus?</h5>
            </div>
            <div class='modal-body'>Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                        <a class='btn btn-primary' href='home.php?page=retur-hapus&&kode_retur=".$kode_retur."'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
//<!-- End of Modal Hapus -->
?>

<script>
$(document).ready(function()
{
  $('#myInput').on('keyup', function() {
    var value = $(this).val().toLowerCase();
    $('#myList div').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
