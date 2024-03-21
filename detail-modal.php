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

if(isset($_GET['kode_modal']))
{
    $kode_modal = $_GET['kode_modal'];
}
else
{
    die ('Error. No Kode Selected! ');
}
                
//Tampilkan data dari tabel modal
$query = mysqli_query($buka, "SELECT * FROM modal a, barang b WHERE kode_modal='$kode_modal'");
$hasil = mysqli_fetch_array($query);
$kode_modal = $hasil['kode_modal'];
$kode_beli = $hasil['kode_beli'];
$kode_barang = $hasil['kode_barang'];
$nama_barang = $hasil['nama_barang'];
$tgl = $hasil['tanggal'];
$hrg_beli = $hasil['harga_beli'];
$tgl_jual = $hasil['tanggal_jual1'];
$hrg_jual1 = $hasil['harga_jual1'];
$tgl_jual2 = $hasil['tanggal_jual2'];
$hrg_jual2 = $hasil['harga_jual2'];
$tgl_jual3 = $hasil['tanggal_jual3'];
$hrg_jual3 = $hasil['harga_jual3'];

echo "
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <div class='card-header text-center'>
                <h4>Detail Modal</h4>
            </div>            
        </div>
        <div class='modal-body'>
            <div class='card-body'>
                <table align='center'>
                    <tr align='left'>
                        <td>
                            <span>Kode Modal : $kode_modal</span><br />
                            <span>Kode Beli : $kode_beli</span><br />
                            <span>Kode Barang : $kode_barang</span><br />
                            <span>Nama Barang : $nama_barang</span><br />
                            <span>Harga Beli : $hrg_beli</span><br />
                            <span>Harga Jual 1 : $hrg_jual1</span><br />
                            <span>Harga Jual 2 : $hrg_jual2</span><br />
                            <span>Harga Jual 3 : $hrg_jual3</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class='modal-footer'>
            <div align='center'>";
            if($_SESSION['level']=='1' || $_SESSION['level']=='2')
            {
                echo "
                <a href='home.php?page=modal-ubah&&kode_modal=".$kode_modal."' class='btn btn-primary btn-icon-split'>Ubah</a>
                ";
            }
            echo "
            </div>      
        </div>
    </div>
</div>
";
?>
