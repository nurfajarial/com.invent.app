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

echo 
"

";

if (isset($_GET['kode_barang']) && isset($_GET['kode_lokasi']))
{
    $kode_barang = $_GET['kode_barang'];
    $kode_lokasi = $_GET['kode_lokasi'];    
}
else
{
    die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel user
$query = mysqli_query($buka, "SELECT * FROM stok JOIN barang ON barang.kode_barang = stok.kode_barang JOIN lokasi ON lokasi.kode_lokasi = stok.kode_lokasi JOIN satuan ON satuan.kode_satuan = stok.kode_satuan WHERE barang.kode_barang = '$kode_barang' AND lokasi.kode_lokasi = '$kode_lokasi'");
while($row = mysqli_fetch_array($query))
{
    $kd_brg = $row['kode_barang'];
    $kd_lokasi = $row['kode_lokasi'];
    $nm_lokasi = $row['nama_lokasi'];
    $stok_awal = $row['stok_awal'];
    $min_stok = $row['min_stok'];
    $total = $row['total'];
    $satuan = $row['kode_satuan'];

    echo 
    "
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='card-header text-center'>
                    <h3>Detail Barang</h3>
                </div>
            </div>
            <div class='modal-body'>
                <div align='left'>
                    <p>Kode Barang : $kd_brg</p>
                    <p>Kode Lokasi : $nm_lokasi</p>
                    <p>Stok Awal : $stok_awal</p>
                    <p>Minimal Stok : $min_stok</p>
                    <p>Total : $total</p>
                    <p> Unit : ".$row['nama_satuan']."</p>
                </div>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <a href='home.php?page=stok-ubah&&kode_barang=".$kode_barang."&&kode_lokasi=".$kode_lokasi."' class='btn btn-primary btn-icon-split'>
                        Ubah
                    </a>
                    <a href='home.php?page=stok-lihat' class='btn btn-default' >
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>";
}

?>