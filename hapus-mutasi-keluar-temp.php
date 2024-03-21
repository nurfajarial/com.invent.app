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
// Cek Kode
if (isset($_GET['kode_mutasi_keluar']) && isset($_GET['tanggal_mutasi_keluar']) && isset($_GET['kode_barang']) && isset($_GET['jumlah_keluar'])) 
{
    $kode_mutasi_keluar = $_GET['kode_mutasi_keluar'];
    $tanggal_mutasi_keluar = $_GET['tanggal_mutasi_keluar'];
    $kode_barang = $_GET['kode_barang'];
    $jumlah_keluar = $_GET['jumlah_keluar'];
    $query   = "SELECT * FROM temp_mutasi_keluar WHERE kode_mutasi_keluar='$kode_mutasi_keluar' AND tanggal_mutasi_keluar='$tanggal_mutasi_keluar' AND kode_barang='$kode_barang' AND jumlah_keluar='$jumlah_keluar'";
    $hasil   = mysqli_query($buka, $query);
    $data    = mysqli_fetch_array($hasil, MYSQLI_BOTH);
}
else 
{
        die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');   
}
    //proses delete data
    if (!empty($kode_mutasi_keluar) && $kode_mutasi_keluar != '')
    {
        $hapus = "DELETE FROM temp_mutasi_keluar WHERE kode_mutasi_keluar='$kode_mutasi_keluar' AND tanggal_mutasi_keluar='$tanggal_mutasi_keluar' AND kode_barang='$kode_barang' AND jumlah_keluar='$jumlah_keluar'";
        $sql = mysqli_query ($buka, $hapus);
        if ($sql) 
        {       
            echo "<script>alert('Data terhapus')</script>";
            echo "<script>document.location='home.php?page=mutasi-keluar-temp-lihat'</script>";
        }
        else 
        {
            echo "<script>alert('Data Pesanan gagal dihapus')</script>";
            echo "<script>document.location='home.php?page=mutasi-keluar-temp-lihat'</script>";
        }
    }
//Tutup koneksi engine MySQL
    mysqli_close($buka);
?>
</body>