<?php
include 'config/koneksi.php';
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

echo "
<div align='center'>
<h4>Daftar Pengiriman</h4>
</div>
<br>
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br>

<ul class='list-group' id='myList' style='list-style: none'>
	<li class='list-group-item' id='subjectName'>
		<div class='table-responsive'>
		<table class='table table-striped table-bordered data'>
			<thead>
				<tr class='' bgcolor='#B0C4DE' align='center'>
					<td>Kode DO</td>
					<td>Tanggal</td>
					<td>Nama Barang</td>
					<td>Nama Pelanggan</td>
					<td>Alamat</td>
					<td>Supir</td>
					<td>Plat</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody>";

			$no = 0;
			$query = mysqli_query($buka, "SELECT * FROM pengiriman JOIN barang ON barang.kode_barang = pengiriman.kode_barang WHERE status = 'Terkirim'")or die(mysqli_error);
			while ($data = mysqli_fetch_array($query))
			{
				$kd_do = $data['kode_do'];
				$tgl_do = $data['tanggal_do'];
				$kd_brg = $data['kode_barang'];
				$nm_brg = $data['nama_barang'];
				$kd_cust = $data['kode_pelanggan'];
				$alamat = $data['alamat'];
				$plat = $data['plat'];
				$supir = $data['supir'];
				$status = $data['status'];

				$no++;
				echo "
				<tr align='center'>
					<td>$kd_do</td>
					<td>$tgl_do</td>
					<td>$nm_brg</td>
					<td>$kd_cust</td>
					<td>$alamat</td>
					<td>$plat</td>
					<td>$supir</td>
					<td>$status</td>
				</tr>
				<tr align='center'>
					<td colspan='8'>
						<a href='home.php?page=utang-detil&&kode_utang=".$kd_jual."' class='btn btn-primary'>Rincian</a>
					</td>
				</tr>
			</tbody>";

			}
			echo "
		</table>
	</div>
	</li>
</ul>

</div>";
?>

<script>
$(document).ready(function()
{
	$('#myInput').on('keyup', function() 
	{
		var value = $(this).val().toLowerCase();
		$('#myList tr').filter(function() 
		{
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
</script>
