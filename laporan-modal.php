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

            	<center><h2>LAPORAN DATA MODAL</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <button>Export</button>
                </div><br>
                <div>
            	<table class='table table-striped table-bordered data' align='center'>
                	<thead>
                		<tr bgcolor='#B0C4DE'>
                    		<td>No</td>
                            <td>Kode Modal</td>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Harga Beli</td>
                            <td>Harga Jual</td>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
					include 'config/koneksi.php';
					$cari = 'select * from modal';
					$tampil = mysqli_query($buka, $cari);
					$nomer=1;
					while ($hasil = mysqli_fetch_assoc($tampil))
					{
						$kode_modal = $hasil['kode_modal'];
						$kode_barang = $hasil['kode_barang'];
						$nama_barang = $hasil['nama_barang'];
						$harga_beli = $hasil['harga_beli'];
						$harga_jual = $hasil['harga_jual'];
					?>
                    	<tr>
		          			<td align='center'><?php echo $nomer++; ?></td>
		          			<td align='center'><?php echo $kode_modal; ?></td>
		          			<td align='center'><?php echo $kode_barang; ?></td>
		          			<td><?php echo $nama_barang; ?></td>
		          			<td><?php echo $harga_beli; ?></td>
		          			<td><?php echo $harga_jual; ?></td>
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