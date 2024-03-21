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
<h4>Detail Mutasi Masuk</h4>
</div>";

include 'config/koneksi.php';
if (isset($_GET['kode_mutasi_masuk']))
{
$kode_mutasi_masuk = $_GET['kode_mutasi_masuk'];
}
else
{
die ('Error. Tidak ada yang dipilih! ');
}

//Tampilkan data dari tabel modal
$query = "SELECT * FROM mutasi_masuk JOIN karyawan ON karyawan.kode_user = mutasi_masuk.kode_user WHERE kode_mutasi_masuk = '$kode_mutasi_masuk'";
$sql = mysqli_query($buka, $query);
$hasil = mysqli_fetch_array($sql, MYSQLI_BOTH);
$kode_mutasi_masuk = $hasil['kode_mutasi_masuk'];
$tgl_mutasi_masuk = $hasil['tanggal_mutasi_masuk'];
$kode_barang = $hasil['kode_barang'];
$jumlah_masuk = $hasil['jumlah_masuk'];
$pengirim = $hasil['nama_karyawan'];
$status_masuk = $hasil['status_masuk'];

echo "
<div class='modal-dialog'>
    <div class='modal-content'>
         <div class='modal-header'>
            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                <td height='36'>&nbsp;Kode : ".$kode_mutasi_masuk."&nbsp;</td>
            </div>
        </div>
        <div class='modal-body'>                
            <table align='center'>               
                <tr align='left'>
                    <td colspan='' align='left'>
						<p>Kode Beli : ".$kode_mutasi_masuk."</p>
						<p>Tanggal : ".$tgl_mutasi_masuk."</p>
						<p>Kode Barang : ".$kode_barang."</p>
						<p>Jumlah : ".$jumlah_masuk."</p>
						<p>Pengirim : ".$pengirim."</p>
						<p>Status : <strong>".$status_masuk."</strong></p>
                    </td>
                </tr>
            </table>
        </div>
        <div class='modal-footer'>
            <div align='center'>";
                if($_SESSION['level']=='1' || $_SESSION['level']=='2')
                {
                    echo "
                    <a href='home.php?page=mutasi-masuk-lihat' class='btn btn-primary btn-icon-split'>
                        OK
                    </a>";
                }
                echo "
            </div>
        </div>
    </div>
</div>";

?>
