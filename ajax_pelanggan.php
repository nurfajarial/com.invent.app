<?php
include 'config/koneksi.php';

if(isset($_POST['query']))
{
	$output = '';
	$key = '%'.$_POST['query'].'%';
	$query = "SELECT * FROM pelanggan WHERE nama_pelanggan LIKE ? LIMIT 5";

	$dewan1 = $db1 -> prepare($query);
	$dewan1 -> bind_Param('s', $key);
	$dewan1 -> execute();
	$res1 = $dewan1 -> get_result();

	//$output = "<ul class='list-unstyled'>";
	$output = "<ul class='list-group'>";
	if($res1->num_rows > 0)
	{
		while($row = $res1->fetch_assoc())
		{
			$output .= "<li class='list-group-item'>".$row['nama_pelanggan']."</li>";
		}
	}
	else
	{
		$output .= "<li class='list-group-item'>Tidak ada yang cocok</li>";
	}
	$output .= '</ul>';
	echo $output;

}
?>