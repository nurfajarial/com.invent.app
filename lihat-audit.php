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

echo 
"
<div align='center'>
	<h3><b>Audit Log</b></h3>
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Search..'>
<br />
<div class='table-responsive'>
	<table align='center' class='table'>
		<thead>
			<tr bgcolor='#B0C4DE'>
				<td align='center'><b>No</b></td>
				<td align='center'><b>Nama User</b></td>
				<td align='center'><b>Aksi</b></td>
				<td align='center'><b>Data Lama</b></td>
				<td align='center'><b>Data Baru</b></td>
				<td align='center'><b>Nama Tabel</b></td>
				<td align='center'><b>Nama Alat</b></td>
				<td align='center'><b>No IP</b></td>
				<td align='center'><b>Tanggal</b></td>
				<td align='center'><b>Jam</b></td>
			</tr>
		</thead>
		<tbody>";

$query = mysqli_query($buka, "SELECT * FROM audit_log");
while( $data = mysqli_fetch_array($query, MYSQLI_BOTH))
{
	echo "
		<tr>
			<td>{$data["id_log"]}</td>
			<td>{$data["user"]}</td>
			<td align='center'>{$data["aksi"]}</td>
			<td align='center'>{$data["data_lama"]}</td>
			<td align='center'>{$data["data_baru"]}</td>
			<td align='center'>{$data["tabel"]}</td>
			<td align='center'>{$data["alat"]}</td>
			<td align='center'>{$data["IP"]}</td>
			<td align='center'>{$data["tanggal"]}</td>
			<td align='center'>{$data["jam"]}
		</tr>";
}
echo "
		</tbody>
	</table>
</div>";

?>