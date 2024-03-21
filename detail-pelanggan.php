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
<!-- Card Content -->
<div class='card-header text-center'>
<h4>Detail Pelanggan</h4>
</div>";

include 'config/koneksi.php';
if (isset($_GET['kode_pelanggan']))
{
    $kode_pelanggan = $_GET['kode_pelanggan'];
}
else
{
    die ('Error. Tidak ada yang dipilih! ');
}

//Tampilkan data dari tabel pelanggan
include 'config/koneksi.php';
$query = "SELECT * FROM pelanggan WHERE kode_pelanggan='$kode_pelanggan' order by kode_pelanggan";
$sql = mysqli_query($buka, $query);
$hasil = mysqli_fetch_array($sql);
$kode_pelanggan = $hasil['kode_pelanggan'];
$nama_pelanggan = $hasil['nama_pelanggan'];
$alamat_pelanggan = $hasil['alamat_pelanggan'];
$alamat_pengiriman = $hasil['alamat_pengiriman'];
$alamat_penagihan = $hasil['alamat_penagihan'];
$telp = $hasil['telp'];
$mobile = $hasil['hp'];
$fax = $hasil['fax'];
$email = $hasil['email'];

echo "
<div class='modal-dialog'>
    <div class='modal-content'>
         <div class='modal-header'>
            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                <td height='36'>&nbsp;Kode : ".$kode_pelanggan."&nbsp;</td>
            </div>
        </div>
        <div class='modal-body'>                
            <table align='center'>
                <tr>
                    <td colspan='2' align='center'>Nama Pelanggan : ".$nama_pelanggan."</td>
                </tr>                
                <tr align='left'>
                    <td colspan='' align='left'>
                        <p>Alamat".$alamat_pelanggan."</p>
                        <p>Telp : ".$telp."</p>
                        <p>HP : ".$mobile."</p>
                        <p>Fax : ".$fax."</p>
                        <p>Email : ".$email."</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class='modal-footer'>
            <div align='center'>";
                if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                {
                    echo "
                    <a href='home.php?page=pelanggan-ubah&&kode_pelanggan=".$kode_pelanggan."' class='btn btn-primary btn-icon-split'>
                        Ubah
                    </a>
                    <a href='#' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                        Hapus
                    </a>";
                }
                echo "
            </div>
        </div>
    </div>
</div>

<div id='deleteModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Yakin dihapus?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                    <a class='btn btn-primary' href='home.php?page=pelanggan-hapus&&kode_pelanggan=<?=$kode_pelanggan?>'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
";

?>