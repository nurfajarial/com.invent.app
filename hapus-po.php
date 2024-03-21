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
if (isset($_GET['kode_po']) && isset($_GET['sesi']))
{
    $kode_po = $_GET['kode_po'];
    $sesi = $_GET['sesi'];
    $query   = "SELECT * FROM po_detail_temp WHERE kode_po='$kode_po' AND sesi='$sesi'";
    $hasil   = mysqli_query($buka, $query);
    $data    = mysqli_fetch_array($hasil);
}
else
{
    die ('Error. Tidak ada Kode yang dipilih Silakan cek kembali! ');
}

//proses delete data
if (!empty($kode_po) && $kode_po != '')
{
    $hapus = "DELETE FROM po_detail_temp WHERE kode_po='$kode_po' AND sesi='$sesi'";
    $sql = mysqli_query($buka, $hapus);
    if ($sql)
    {
        echo "<script>alert('Data PO Berhasil dihapus')</script>";
        echo "<script>document.location='home.php?page=lihat-po'</script>";
    }
    else
    {
        echo "<script>alert('Data PO gagal dihapus')</script>";
        echo "<script>document.location='home.php?page=lihat-po'</script>";
    }
}
//Tutup koneksi engine MySQL
    unset($_SESSION["l_kd_brg"]);
    unset($_SESSION["l_jml_brg"]);
    mysqli_close($buka);
?>
</body>