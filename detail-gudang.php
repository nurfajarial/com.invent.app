<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}
?>

<!-- Card Content -->
<?php
include 'config/koneksi.php';
if (isset($_GET['kode_lokasi']))
{
	$kode_lokasi = $_GET['kode_lokasi'];
}
else
{
	die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel user
$query = "SELECT * FROM lokasi WHERE kode_lokasi='$kode_lokasi'";
$sql = mysqli_query($buka, $query);
$hasil = mysqli_fetch_array($sql);
$kode_lokasi = $hasil['kode_lokasi'];
$nama_lokasi = $hasil['nama_lokasi'];
$ket = $hasil['keterangan'];;

echo "
<form>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center'>
                    <h3>Detail Gudang</h3>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr align='left'>
                        <td colspan='' align='left'>
                            <p>Kode : {$hasil["kode_lokasi"]}</p>
                            <p>Nama : {$hasil["nama_lokasi"]}</p>
                            <p>Keterangan : {$hasil["$ket"]}</p>
                        </td>
                    </tr>
                </table>                                       
            </div>
            <div class='modal-footer'>
                <div align='center'>";
                    if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                    {
                        echo "                
                        <a href='home.php?page=gudang-ubah&&kode_lokasi=<?=$kode_lokasi?>' class='btn btn-primary btn-icon-split'>
                            Ubah
                        </a>
                        <a href='#'' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                            Hapus
                        </a>";
                    }
                echo "
                </div>
            </div>
        </div>
    </div>
</form>";

?>
</div>
<!-- /end of card content -->
    				
        <!-- Modal Hapus -->
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin dihapus?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">�</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Hapus" untuk menghapus</div>
                    <div class="modal-footer">
                        <div align='center'>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-primary" href="home.php?page=gudang-hapus&&kode_lokasi=<?=$kode_lokasi?>">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal Hapus -->