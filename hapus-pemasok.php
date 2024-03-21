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
?>
<br />
<body bgcolor='#EEF2F7'>
<?php
include 'config/koneksi.php';
// Cek Kode
if (isset($_GET['kode_pemasok']))
{
    $kode_pemasok = $_GET['kode_pemasok'];
    $query   = "SELECT * FROM pemasok WHERE kode_pemasok = '$kode_pemasok'";
    $hasil   = mysqli_query($buka, $query);
    $data    = mysqli_fetch_array($hasil);
}
else
{
        die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');
}
    //proses delete data
    if (!empty($kode_pemasok) && $kode_pemasok != '')
    {
        $hapus = "DELETE FROM pemasok WHERE kode_pemasok = '$kode_pemasok'";
        $sql = mysqli_query ($buka, $hapus);
        if ($sql)
        {
            echo "<script>alert('Data terhapus')</script>";
            echo "<script>document.location='home.php?page=pemasok-lihat'</script>";
        }
        else
        {
            echo "<script>alert('Data gagal dihapus')</script>";
			echo "<script>document.location='home.php?page=pemasok-lihat'</script>";
        }
    }
//Tutup koneksi engine MySQL
    mysqli_close($buka);
?>
</body>