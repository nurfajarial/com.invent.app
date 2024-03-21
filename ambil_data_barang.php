<?php 
error_reporting (E_ALL ^ E_NOTICE); 

session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';

//get search term
$searchTerm = $_REQUEST['term'];

//get matched data from skills table


$query1 = "SELECT * FROM barang WHERE kode_barang LIKE '%$searchTerm%' ";

$result1 = mysqli_query($buka, $query1);

while($row1 = mysqli_fetch_array($result1))

{
	$data[] = $row1['kode_barang'];
}


//return json data

echo json_encode($data);
?>