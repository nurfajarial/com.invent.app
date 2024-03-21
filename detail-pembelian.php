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

if (isset($_GET['kode_beli']))
{
    $kode_beli = $_GET['kode_beli'];
}
else
{
    die ('Error. No Kode Selected!');
}

echo 
"<div class='card-header text-center'>
    <center><h4>Detail Pembelian</h4></center>
</div>
<div class='card-body text-center'>";

//Tampilkan data dari tabel user
include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM pembelian JOIN pemasok ON pemasok.kode_pemasok = pembelian.kode_pemasok JOIN karyawan ON karyawan.kode_user = pembelian.kode_user JOIN pembayaran ON pembayaran.kode_bayar = pembelian.kode_bayar WHERE kode_beli = '$kode_beli'")or die(mysql_error);
while($data = mysqli_fetch_assoc($query))
{
    $kode_beli = $data['kode_beli'];
    $kd_faktur = $data['kode_faktur'];
    $kd_do = $data['kode_do'];
    $kd_pemasok = $data['kode_pemasok'];
    $nm_pemasok = $data['nama_pemasok'];
    $tgl_beli = $data['kode_beli'];
    $kd_po = $data['kode_po'];
    $jmlh = $data['jumlah'];
    $kd_user = $data['kode_user'];
    $nm_karyawan = $data['nama_karyawan'];
    $kd_byr = $data['kode_bayar'];
    $ket = $data['keterangan'];
    $tgl_tempo = $data['tanggal_tempo'];
    $plat = $data['no_plat'];
    $supir = $data['nama_supir'];

    echo "
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <table align='center'>
                    <tr class='table table-striped table-bordered data' bgcolor='#B0C4DE'>
                        <td height='36'>&nbsp;Kode : ".$kode_beli."&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class='modal-body'>                
                <table align='center'>
                    <tr align='left'>
                        <td>Nama Pemasok : ".$nm_pemasok."</td>
                    </tr>                
                    <tr align='left'>
                        <td>
                            <i>Kode Beli : ".$kode_beli."</i><br />
                            <i>Kode Faktur : ".$kd_faktur."</i><br />
                            <i>Kode DO : ".$kd_do."</i><br />
                            <i>Tanggal Beli : ".$tgl_beli."</i><br />
                            <i>Kode PO : ".$kd_po."</i><br />
                            <i>Jumlah : ".$jmlh."</i><br />
                            <i>Pengirim : ".$nm_karyawan."</i><br />
                            <i>Pembayaran : ".$ket."</i><br />
                            <i>Tanggal Tempo : ".$tgl_tempo."</i><br />
                            <i>No Plat : ".$plat."</i><br />
                            <i>Nama Supir : ".$supir."</i><br />
                        </td>
                    </tr>
                </table>
            </div>
            <div class='modal-footer'>
                <table align='center'>
                    <tr>
                        <td align='center'>
                            <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal'>Hapus</a>
                        </td>
                    </tr>                
                </table>
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
                <div class='modal-footer'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                        <a class='btn btn-primary' href='home.php?page=pembelian-hapus&&kode_beli=".$kode_beli."'>Hapus</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
";
}
?>