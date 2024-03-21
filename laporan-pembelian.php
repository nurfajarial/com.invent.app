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
        
<!-- Content -->
<div class='table-responsive'>
    <center><h2>LAPORAN DATA PEMBELIAN</h2></center>
    <div align="center">
        <button onclick="window.print()">Print</button>
        <a href="export_xls_barang.php"><button>Export</button></a>
    </div><br>
    <div>
        <table class='table table-striped table-bordered data' align='center'>
            <thead>
                <tr bgcolor='#B0C4DE'>
                	<td>Kode Beli</td>
                    <td>Kode Faktur</td>
                    <td>Pemasok</td>
                    <td>Tanggal Beli</td>
                	<td>Kode PO</td>
                    <td>Jumlah</td>
                	<td>Diskon</td>
                	<td>Pengirim</td>
                	<td>Pembayaran</td>
                	<td>Tanggal Tempo</td>
                </tr>
            </thead>
            <tbody>
            <?php
			include 'config/koneksi.php';
			$cari = 'SELECT * FROM pembelian JOIN pemasok ON pemasok.kode_pemasok ORDER BY kode_beli';
			$tampil = mysqli_query($buka, $cari);
			$nomer=1;
			while ($hasil = mysqli_fetch_assoc($tampil))
			{
			    $kd_beli = $hasil['kode_beli'];
				$kd_faktur = $hasil['kode_faktur'];
				$nm_supp = $hasil['nama_pemasok'];
				$tgl_beli = $hasil['tanggal_beli'];
                $kd_po = $hasil['kode_po'];
				$jml = $hasil['jumlah'];
				$ket = $hasil['pembayaran'];
				$tgl_tmp = $hasil['tanggal_tempo'];
				//$image = $hasil['gambar'];
			?>
            <tr>
		        <td align='center'><?php echo $kd_beli; ?></td>
		        <td><?php echo $kd_faktur; ?></td>
		        <td align='center'><?php echo $nm_supp; ?></td>
		        <td align='center'><?php echo $tgl_beli; ?></td>
                <td align='center'><?php echo $kd_po; ?></td>
		        <td><?php echo $jml; ?></td>
		        <td align='center'><?php echo $satuan; ?></td>
		        <td align='center'><?php echo $min_stok; ?></td>
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