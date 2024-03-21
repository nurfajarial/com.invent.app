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
?>
        
<!-- Content -->
<div align='center'>
    <center><h2>LAPORAN STOK MINIM</h2></center>
    <div align='center'>
        <button onclick='window.print()'>Print</button>
        <a href='export_xls_stokminim.php'><button>Export</button></a>
    </div>
    <br>
    <div class='table-responsive'>
        <table class='table table-striped table-bordered data' align='center'>
            <thead>
                <tr bgcolor='#B0C4DE' align='center'>
                    <td>No</td>
                	<td>Barang</td>
                    <td>Lokasi</td>
                    <td>Stok Awal</td>
                    <td>Minimal Stok</td>
                    <td>Total</td>
                	<td>Satuan</td>
                </tr>
            </thead>
            <tbody>
            <?php
			include 'config/koneksi.php';
			$cari = 'SELECT * FROM stok
			JOIN barang ON barang.kode_barang = stok.kode_barang
			JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis
			JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
			JOIN tipe_barang ON tipe_barang.kode_tipe = barang.kode_tipe
			JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
			JOIN ukuran_barang ON ukuran_barang.kode_ukuran = barang.kode_ukuran
			JOIN lokasi ON lokasi.kode_lokasi = stok.kode_lokasi
			JOIN satuan ON satuan.kode_satuan = stok.kode_satuan
			WHERE total <= min_stok';
			$tampil = mysqli_query($buka, $cari);
			$nomer=0;
			while ($hasil = mysqli_fetch_array($tampil, MYSQLI_BOTH))
			{
				$a1=$hasil['nama_jenis']; if($a1=='0'){$a1='';}
				$b1=$hasil['nama_merk']; if($b1=='0'){$b1='';}
				$c1=$hasil['nama_tipe']; if($c1=='0'){$c1='';}
				$d1=$hasil['nama_seri']; if($d1=='0'){$d1='';}
				$e1=$hasil['nama_ukuran']; if($e1=='0'){$e1='';}
				$nomer++;
				?>
	            <tr>
	            	<td align='center'><?php echo $nomer; ?></td>
			        <td>
			        	<?php echo $a1.' '.$b1.' '.$c1.' '.$d1.' '.$e1; ?>
			        </td>
			        <td align='center'><?php echo $hasil['nama_lokasi']; ?></td>
			        <td align='center'><?php echo $hasil['stok_awal']; ?></td>
			        <td align='center'><?php echo $hasil['min_stok']; ?></td>
	                <td align='center'><?php echo $hasil['total']; ?></td>
			        <td align='center'><?php echo $hasil['nama_satuan']; ?></td>
	            </tr>
            <?php
			}
			?>
            </tbody>
        </table>
    </div>
</div>
<!-- /content -->


<script>
	$(document).ready(function()
	{
		$('.data').DataTable();
	});
	
</script>