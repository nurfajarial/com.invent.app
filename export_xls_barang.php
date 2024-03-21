<?php
// koneksi database
include 'config/koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=laporan_barang.xls");
	?>

	<center>
		<h1>List Item Barang</h1>
	</center>

	<table border="1">
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Merk</th>
			<th>Seri</th>
			<th>Tipe</th>
			<th>No Serial</th>
			<th>Deskripsi</th>
		</tr>
		<?php 

		// menampilkan data pegawai
		$data = mysqli_query($buka ,"SELECT * FROM barang 
		JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis
		JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
		JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
		JOIN tipe_barang ON tipe_barang.kode_tipe =barang.kode_tipe");
		$no = 1;
		while($d = mysqli_fetch_array($data))
		{
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['kode_barang']; ?></td>
			<td><?php echo $d['nama_jenis']; ?></td>
			<td><?php echo $d['nama_merk']; ?></td>
			<td><?php echo $d['nama_seri']; ?></td>
			<td><?php echo $d['nama_tipe']; ?></td>
			<td><?php echo $d['kode_serial']; ?></td>
			<td><?php echo $d['deskripsi']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>