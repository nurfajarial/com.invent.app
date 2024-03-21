<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();

include 'config/koneksi.php';
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

echo "        
<div align='center'>
    <center><h2>LAPORAN DATA BARANG</h2></center>
    <div align='center'>
        <button onclick='window.print()'>Print</button>
        <a href='export_xls_barang.php'><button>Export</button></a>
    </div>
    <br>
    <div class='table-responsive'>
        <table class='table table-striped table-bordered data' >
            <thead>
                <tr bgcolor='#B0C4DE' >
                	<td align='center'><b>Kode Barang</b></td>
                    <td align='center'><b>Nama Barang</b></td>
                    <td align='center'><b>Merk</b></td>
                    <td align='center'><b>Seri</b></td>
                    <td align='center'><b>Tipe</b></td>
                    <td align='center'><b>Kode Serial</b></td>
                	<td align='center'><b>Deskripsi</b></td>
                </tr>
            </thead>
            <tbody>";

			$cari = "SELECT * FROM barang 
			JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis 
			JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
			JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
			JOIN tipe_barang ON tipe_barang.kode_tipe = barang.kode_tipe";
			$tampil = mysqli_query($buka, $cari);
			$nomer=0;
			while ($hasil = mysqli_fetch_array($tampil))
			{
				$nomer++;
				echo "
	            <tr>
			        <td align='left'>{$hasil["kode_barang"]}</td>
			        <td align='center'>{$hasil["nama_jenis"]}</td>
			        <td align='center'>{$hasil["nama_merk"]}</td>
			        <td align='center'>{$hasil["nama_seri"]}</td>
			        <td>{$hasil["nama_tipe"]}</td>
	                <td align='center'>{$hasil["kode_serial"]}</td>
			        <td>{$hasil["deskripsi"]}</td>
	            </tr>";
			}
			echo "
            </tbody>
        </table>
    </div>
</div>";
?>

<script>
	$(document).ready(function()
	{
		$('.data').DataTable();
	});
	
</script>