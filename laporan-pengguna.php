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
			    <center><h2>LAPORAN DATA PENGGUNA</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <a href="export_xls_pengguna.php"><button>Export</button></a>
                </div><br>
                <div>
            	<table class='table table-striped table-bordered data' align='center'>
                	<thead>
                		<tr bgcolor='#B0C4DE'>
                            <td>Kode User</td>
                            <td>User</td>
                            <td>Level</td>
                            <td>Nama</td>
                            <td>Tanggal Lahir</td>
                            <td>NIK</td>
                            <td>Alamat</td>
                            <td>Status</td>
                            <td>HP</td>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php
					include 'config/koneksi.php';
					$cari = 'select * from karyawan order by kode_user';
					$tampil = mysqli_query($buka, $cari);
					$nomer=1;
					while ($hasil = mysqli_fetch_assoc($tampil))
					{
						$kode_user = $hasil['kode_user'];
						$user = $hasil['user'];
						$level = $hasil['level'];
                        $nama = $hasil['nama_karyawan'];
                        $tgl_lahir = $hasil['tanggal_lahir'];
                        $nik = $hasil['nik'];
                        $alamat = $hasil['alamat'];
                        $status = $hasil['status'];
                        $mobile = $hasil['no_hp1'].' '.$hasil['no_hp2'];
					?>
                    	<tr>
		          			<td align='center'><?php echo $kode_user; ?></td>
                            <td><?php echo $user; ?></td>
		          			<td><?php echo $level; ?></td>
		          			<td><?php echo $nama; ?></td>
		          			<td align='center'><?php echo $tgl_lahir; ?></td>
                            <td align='center'><?php echo $nik; ?></td>
                            <td><?php echo $alamat; ?></td>
                            <td align='center'><?php echo $status; ?></td>
                            <td><?php echo $mobile; ?></td>
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