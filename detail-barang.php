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

include 'config/koneksi.php';
$dir = "images/img/";
if (isset($_GET['kode_barang']))
{
    $kode_barang = $_GET['kode_barang'];
}
else
{
    die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel user
$query = "SELECT * FROM barang 
JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
JOIN model_barang ON model_barang.kode_model = barang.kode_model
JOIN tipe_barang ON tipe_barang.kode_tipe = barang.kode_tipe
JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
JOIN ukuran_barang ON ukuran_barang.kode_ukuran = barang.kode_ukuran
JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis
WHERE kode_barang='$kode_barang'";

$sql = mysqli_query($buka, $query);
$hasil = mysqli_fetch_array($sql);
$kode_barang = $hasil['kode_barang'];
$gambar = $hasil["idgambar"];

echo 
"
<div class='modal-dialog'>
    <div class='modal-content'>
         <div class='modal-header'>
            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                <td height='36'>&nbsp;Kode : <b>".$kode_barang."</b>&nbsp;</td>
            </div>
        </div>
        <div class='modal-body'>
            <table width='100%'>
                <tr>
                    <td align='center'>
                        <img src='".$dir.$gambar."' width='110px' height='90px' />
                    </td>
                    <td align='left'>                
                        <span>
                        Jenis     : <b>{$hasil["nama_jenis"]}</b><br />
                        Merk      : <b>{$hasil["nama_merk"]}</b><br />
                        Model     : <b>{$hasil["nama_model"]}</b><br />
                        Seri      : <b>{$hasil["nama_seri"]}</b><br />
                        Ukuran    : <b>{$hasil["nama_ukuran"]}</b><br />
                        Deskripsi : <b>{$hasil["$deskripsi"]}</b><br />
                        Status    : <b>";if($hasil["status"]=1){echo "Aktif | (1)";}else{echo "Tidak Aktif | 0";} 
                        echo "</b>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class='modal-footer'>
            <div align='center'>
                <a href='home.php?page=barang-ubah&&kode_barang=".$kode_barang."' class='btn btn-primary btn-icon-split'>
                Ubah
                </a>
                <a href='home.php?page=barang-lihat' class='btn btn-default' data-toggle='modal'>
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
";
?>