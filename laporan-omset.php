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
                        <div class='table-responsive'>
			
            	<center><h2>LAPORAN DATA OMSET</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <button>Export</button>
                </div><br>
                <div>
            	<table class='table table-striped table-bordered data' align='center'>
                	<thead>
                		<tr bgcolor='#B0C4DE'>
                    		<td>No</td>
                            <td>Kode Omset</td>
                            <td>Tanggal</td>
                            <td>Bulan</td>
                            <td>Tahun</td>
                            <td>Jumlah</td>
                            <td>Harga</td>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
					include 'config/koneksi.php';
					$cari = 'select * from omset';
					$tampil = mysqli_query($buka, $cari);
					$nomer=1;
					while ($hasil = mysqli_fetch_assoc($tampil))
					{
						$kode_omset = $hasil['kode_omset'];
						$tanggal = $hasil['tanggal'];
						$bulan = $hasil['bulan'];
						$tahun = $hasil['tahun'];
						$jumlah = $hasil['jumlah'];
						$harga = $hasil['harga'];
					?>
                    	<tr>
		          			<td align='center'><?php echo $nomer++; ?></td>
		          			<td align='center'><?php echo $kode_omset; ?></td>
		          			<td align='center'><?php echo $tanggal; ?></td>
		          			<td align='center'><?php echo $bulan; ?></td>
		          			<td align='center'><?php echo $tahun; ?></td>
		          			<td align='center'><?php echo $jumlah; ?></td>
                            <td align='right'><?php echo $harga; ?></td>
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