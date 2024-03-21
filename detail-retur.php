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

if (isset($_GET['kode_retur']))
{
    $kode_retur = $_GET['kode_retur'];
}
else
{
    die ('Error. Tidak ada yang dipilih! ');
}

echo "
<form action='' method=''>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='card-header text-center'>
                    <h4>Detail Retur</h4>
                </div>
            </div>
            <div class='modal-body' align='center'>";
                $query = "SELECT * FROM retur JOIN pelanggan ON pelanggan.kode_pelanggan = retur.kode_pelanggan JOIN barang ON barang.kode_barang = retur.kode_barang JOIN karyawan ON karyawan.kode_user = retur.kode_user WHERE kode_retur='$kode_retur'";
                $sql = mysqli_query($buka, $query);
                $hasil = mysqli_fetch_array($sql);

                echo "
                <div align='left'>
                    <p>Kode : ".$hasil['kode_retur']."</p>
                    <p>Tanggal : ".$hasil['tanggal_retur']."</p>
                    <p>Faktur : ".$hasil['$kode_faktur']."</p>
                    <p>Barang : ".$hasil['kode_barang']."</p>
                    <p>Pelanggan : ".$hasil['nama_pelanggan']."</p>
                    <p>Penerima : ".$hasil['nama_karyawan']."</p>
                    <p>Jumlah : ".$hasil['jumlah']."</p>
                    <p>Keterangan : ".$hasil['keterangan']."</p>
                </div>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <a href='home.php?page=retur-ubah&&kode_retur=".$kode_retur."' class='btn btn-primary btn-icon-split' >
                        <i class='glyphicon glyphicon-list'></i>
                    </a>
                    <a href='home.php?page=retur-lihat&&kode_retur=".$kode_retur."' class='btn btn-default btn-icon-split' >
                        <i class='glyphicon glyphicon-repeat'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
";

?>