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
			
            	<center><h2>LAPORAN DATA PELANGGAN</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <a href="export_xls_pelanggan.php"><button>Export</button></a>
                </div><br>
                <div>
            	<table class='table table-striped table-bordered data' align='center'>
                	<thead>
                		<tr bgcolor='#B0C4DE'>
                            <td>Kode Pelanggan</td>
                            <td>Nama Pelanggan</td>
                            <td>Alamat Pelanggan</td>
                            <td>Alamat Pengiriman</td>
                            <td>Alamat Penagihan</td>
                            <td>Telp</td>
                            <td>HP</td>
                            <td>Fax</td>
                            <td>Email</td>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
					include 'config/koneksi.php';
					$cari = 'select * from pelanggan';
					$tampil = mysqli_query($buka, $cari);
					$nomer=1;
					while ($hasil = mysqli_fetch_assoc($tampil))
					{
						$kode_pelanggan = $hasil['kode_pelanggan'];
						$nama_pelanggan = $hasil['nama_pelanggan'];
   						$alamat_pelanggan = $hasil['alamat_pelanggan'];
						$alamat_pengiriman = $hasil['alamat_pengiriman'];
						$alamat_penagihan = $hasil['alamat_penagihan'];
						$telp = $hasil['telp'];
						$mobile = $hasil['hp'];
						$fax = $hasil['fax'];					
						$email = $hasil['email'];
					?>
                    	<tr>
		          			<td align='center'><?php echo $kode_pelanggan; ?></td>
		          			<td><?php echo $nama_pelanggan; ?></td>
   		          			<td><?php echo $alamat_pelanggan; ?></td>
		          			<td><?php echo $alamat_pengiriman; ?></td>
		          			<td><?php echo $alamat_penagihan; ?></td>
		          			<td align='center'><?php echo $telp; ?></td>
		          			<td align='center'><?php echo $mobile; ?></td>
		          			<td align='center'><?php echo $fax; ?></td>
                            <td><?php echo $email; ?></td>
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
