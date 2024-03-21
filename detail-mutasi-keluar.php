<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

//Card Content
echo "<div class=' card-header text-center'>";
echo "<h4>Daftar Mutasi Keluar</h4>";
echo "</div>";
echo "<div class='card-body text-center'>";
include 'config/koneksi.php';
if (isset($_GET['kode_mutasi_keluar']))
{
$kode_mutasi_keluar = $_GET['kode_mutasi_keluar'];
}
else
{
die ('Error. Tidak ada yang dipilih! ');
}

//Tampilkan data dari tabel modal
$query = "SELECT * FROM mutasi_keluar WHERE kode_mutasi_keluar = '$kode_mutasi_keluar'";
$sql = mysqli_query($buka, $query);
$hasil = mysqli_fetch_array($sql);
$kode_mutasi_keluar = $hasil['kode_mutasi_keluar'];
$tgl_mutasi_keluar = $hasil['tanggal_mutasi_keluar'];
$kode_barang = $hasil['kode_barang'];
$jumlah_keluar = $hasil['jumlah_keluar'];
$pengambil = $hasil['pengambil'];
$status_keluar = $hasil['status_keluar'];

echo "<p>Kode Mutasi : ".$kode_mutasi_keluar."</p>";
echo "<p>Tanggal : ".$tgl_mutasi_keluar."</p>";

$query2 = mysqli_query($buka, "SELECT nama_barang FROM barang WHERE kode_barang='$kode_barang'");
$list = mysqli_fetch_array($query2);

echo "<p>Nama Barang : ".$list['nama_barang']."</p>";
echo "<p>Jumlah : ".$jumlah_keluar."</p>";
echo "<p>Pengambil : ".$pengambil."</p>";
echo "<p>Status : <strong>".$status_keluar."</strong></p>";
echo "</div>";
//content
?>
