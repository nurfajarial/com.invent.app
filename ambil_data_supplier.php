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
//$q = $_REQUEST['q'];
$searchTerm = $_REQUEST['term'];

//get matched data from skills table


$query1 = "SELECT * from supplier WHERE nama_supplier LIKE '%$searchTerm%' ";

$result1 = mysqli_query($buka, $query1);
//$json=array();

while($row1 = mysqli_fetch_array($result1))
{
	$data[] = $row1['nama_supplier'];
	//array_push($json, $row['nama_supplier']);
}


//return json data

echo json_encode($data);
?>