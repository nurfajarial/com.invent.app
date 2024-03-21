<?php

//fetch_item.php

include 'config/koneksi.php';

?>

<?php
$item_q = "SELECT * FROM barang ORDER BY kode_barang DESC";
$tampil = mysqli_query($buka, $item_q);
$output = "";

$output .= "
<ul class='list-group' id='myList' style='list-style: none'>
	<li class='list-group-item' id='subjectName'>";
while ($row = mysqli_fetch_array($tampil, MYSQLI_BOTH))
{

    $output .="
		<div class='col-md-3' style='margin-top:12px;'>
			<div style='border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px;' align='center'>
				<h5 class='text-info' align='center'>".$row['kode_barang']."</h5>
				<input type='number' name='quantity' id='quantity" . $row['kode_barang'] ."' class='form-control' value='1' />
				<input type='hidden' name='hidden_name' id='name".$row['kode_barang']."' value='".$row['nama_barang']."' />	
				<input type='button' name='add_to_cart' id='".$row['kode_barang']."' style='margin-top:5px;' class='btn btn-success form-control add_to_cart' value='Tambah' />
			</div>
		</div>";
}
$output .= "

	</li>
</ul>
";
echo $output;
?>
