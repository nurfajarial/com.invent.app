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

if (isset($_GET['kode_satuan']))
{
        $kode_satuan = $_GET['kode_satuan'];
}
else
{
    die ('Error. No Kode Selected! ');
}

//tampilkan data dari tabel satuan
$qry = mysqli_query($buka, "SELECT * FROM satuan WHERE kode_satuan = '$kode_satuan'");
$ls = mysqli_fetch_array($qry);

echo 
"
<form action='' method='' >
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <table align='center'>
                    <tr>
                        <td height='36'><h4><b>&nbsp;Detail Unit / Satuan&nbsp;</b></h4></td>
                    </tr>
                </table>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td align='left'>
                            <p>Nama : ".$ls['nama_satuan']."</p>
                            <p>Keterangan : ".$ls['keterangan']."</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <a href='home.php?page=satuan-ubah&&kode_satuan=".$kode_satuan."' class='btn btn-primary btn-icon-split'>Ubah</a>&nbsp;
                    <a href='home.php?page=satuan-lihat' class='btn btn-default'>Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>";

?>
    				