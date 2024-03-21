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

if (isset($_GET['kode_pemasok']))
{
    $kode_pemasok = $_GET['kode_pemasok'];
}
else
{
    die ('Error. No Kode Selected! ');
}

echo 
"<div class='card-header text-center'>
    <center><h4>Detail Pemasok</h4></center>
</div>";

//Tampilkan data dari tabel user
include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM pemasok WHERE kode_pemasok = '$kode_pemasok'");
while($data = mysqli_fetch_array($query))
{
    $kode_pemasok = $data['kode_pemasok'];
    $nama_pemasok = $data['nama_pemasok'];
    $alamat_pemasok = $data['alamat_pemasok'];
    $npwp = $data['npwp'];
    $kontak = $data['kontak'];
    $email = $data['email'];
    $telp = $data['telp'];
    $hp = $data['hp'];
    $rek1 = $data['rek1'];
    $rek2 = $data['rek2'];
    $rek3 = $data['rek3'];
}
echo "
<div class='modal-dialog'>
    <div class='modal-content'>
         <div class='modal-header'>
            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                <td height='36'>&nbsp;Kode : ".$kode_pemasok."&nbsp;</td>
            </div>
        </div>
        <div class='modal-body'>                
            <table align='center'>
                <tr>
                    <td colspan='2' align='center'>Nama Pemasok : ".$nama_pemasok."</td>
                </tr>                
                <tr align='left'>
                    <td colspan='' align='left'>
                        <i>Alamat    : ".$alamat_pemasok."</i><br />
                        <i>Kontak    : ".$kontak."</i><br />
                        <i>No. NPWP  : ".$npwp."</i><br />
                        <i>Email     : ".$email."</i><br />
                        <i>Telp      : ".$telp."</i><br />
                        <i>HP        : ".$hp."</i><br />
                        <i>No. Rek 1 : ".$rek1."</i><br />
                        <i>No. Rek 2 : ".$rek2."</i><br />
                        <i>No. Rek 3 : ".$rek3."</i><br />
                    </td>
                </tr>
            </table>
        </div>
        <div class='modal-footer'>
           	<div align='center'>
                <a href='home.php?page=pemasok-ubah&&kode_pemasok=".$kode_pemasok."' class='btn btn-primary'>Ubah</a>&nbsp;
                <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal'>Hapus</a>
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
                    <a class='btn btn-primary' href='home.php?page=pemasok-hapus&&kode_pemasok=".$kode_pemasok."'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
";

?>