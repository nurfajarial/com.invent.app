<?php

//fetch_item.php

include 'config/koneksi.php';
$item_q = "SELECT * FROM barang
JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk
JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis
JOIN model_barang ON model_barang.kode_model = barang.kode_model
JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri
JOIN ukuran_barang ON ukuran_barang.kode_ukuran = barang.kode_ukuran";
$tampil = mysqli_query($buka, $item_q);
$output = "";
/*
$output .= "
<form >
<ul class='list-group' id='myList' style='list-style: none'>
	<li class='list-group-item' id='subjectName'>";
	    while ($row = mysqli_fetch_array($tampil, MYSQLI_BOTH))
        {
            $output .="
		    <div class='col-md-3' style='margin-top:12px;'>
			    <div style='border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px;' align='center'>
				    <h5 class='text-info' align='center'>{$row["kode_barang"]}</h5>
				    <input type='text' name='quantity' id='quantity{$row["idbarang"]}' class='form-control' value='1' />
				    <input type='hidden' name='hidden_name' id='name{$row["idbarang"]}' value='".$row['nama_barang']."' />	
				    <input type='button' name='add_to_cart' id='{$row["idbarang"]}' style='margin-top:5px;' class='btn btn-success form-control add_to_cart' value='Tambah' />
			    </div>
		    </div>";
        }
        $output .= "
	</li>
</ul>
</form>";
*/

$output .= "
<input class='form-control' id='myInput' type='text' placeholder='Cari..' onkeyup='myFunction()'><br />
<ul class='list-group' id='myList' style='list-style: none'>
	<li class='list-group-item'>
		<div class='table-responsive'>
			<table class='table table-striped' align='center'>
				<thead>
					<tr bgcolor='#B0C4DE' align='center'>
						<td><b>Merk</b></td>
						<td><b>Nama Barang</b></td>
						<td><b>Jumlah</b></td>
						<td>&nbsp;</td>
					</tr>
				</thead>
				</tbody>";
			while( $row = mysqli_fetch_array($tampil, MYSQLI_BOTH))
			{
				$output .= "
					<tr id='subjectName'>".
						"<td><input type='hidden' name='merk' id='merk{$row["idbarang"]}' value='{$row["nama_merk"]}' readonly />{$row["nama_merk"]}</td>".
						"<td><input type='hidden' name='jenis' id='jenis{$row["idbarang"]}' value='{$row["nama_jenis"]}' readonly />{$row["nama_jenis"]}</td>".
						//<td><input type='hidden' name='model' id='model{$row["idbarang"]}' value='{$row["nama_model"]}' />{$row["nama_model"]}</td>
						//<td><input type='hidden' name='seri' id='seri{$row["idbarang"]}' value='{$row["nama_seri"]}' />{$row["nama_seri"]}</td>
						//<td><input type='hidden' name='ukuran' id='ukuran{$row["idbarang"]}' value='{$row["nama_ukuran"]}' />{$row["nama_ukuran"]}</td>
						"<td><input type='number' name='quantity' id='quantity{$row["idbarang"]}' class='form-control' value='1' maxlength='3' /></td>
						<td><input type='button' name='add_to_cart' id='{$row["idbarang"]}' style='margin-top:5px;' class='btn btn-success form-control add_to_cart' value='Tambah' /></td>
					</tr>";
			}
			$output .= "
				</tbody>
			</table>
		</div>
	</li>
</ul>
";

echo $output;
?>

<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() 
    {
        var value = $(this).val().toLowerCase();
        $('#myList tr').filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
</script>