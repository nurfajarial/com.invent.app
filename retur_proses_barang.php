<?php
include 'config/koneksi.php';

$kode_po = $_GET['kode_po'];
$query2 = mysqli_query($buka, "SELECT * FROM po_detail JOIN barang ON barang.kode_barang = po_detail.kode_barang WHERE kode_po = '$kode_po'");
echo "<option selected='selected' disabled='disabled'>- pilih -</option>";
while($row = mysqli_fetch_array($query2, MYSQLI_BOTH))
{
	echo "<option value='".$row['kode_barang']."'>".$row['nama_barang']."</option>\n";
}
?>