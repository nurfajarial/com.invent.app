<?php
include 'config/koneksi.php';
$kode_beli = $_GET['kode_beli'];
$query2 = mysqli_query($buka, "SELECT * FROM modal JOIN barang ON barang.kode_barang = modal.kode_barang WHERE kode_beli = '$kode_beli'");
echo "<option selected='selected' disabled='disabled'>- pilih -</option>";
while($row = mysqli_fetch_array($query2))
{
	echo "<option value='".$row['kode_barang']."'>".$row['nama_barang']."</option>\n";
}
?>