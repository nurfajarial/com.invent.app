<?php 
error_reporting (E_ALL ^ E_NOTICE);
//session_start();
//cek apakah user sudah login
//if(!isset($_SESSION['user']))
//{
//    //jika belum login jangan lanjut
//	echo '<script>alert('Anda belum login')</script>';
//	echo '<script>document.location='index.php'</script>';
//}
//?>
<body>
<?php
	include 'config/koneksi.php';

	$cari = mysqli_query($buka, 'SELECT * FROM stok JOIN barang ON barang.kode_barang = stok.kode_barang WHERE stok.total <= stok.min_stok');
	while($data = mysqli_fetch_array($cari))
	{
		$kd_brg = $data['kode_barang'];
		$nm_brg = $data['kode_jenis'];
		$stokminim = $data['total'];

        echo "<div class=''>";
        echo "<ul id='myList' class='list-group' overflow-y: scroll>";
        echo "<li class='list-group-item'>";
        echo "<a href='home.php?page=stok-detil&&kode_barang=".$data['kode_barang']."&&kode_lokasi=".$data['kode_lokasi']."'>$kd_brg</a>";
		echo "&nbsp;&nbsp;'<font color='red'>$stokminim'</font>";
        echo "</li>";
        echo "</ul>";
        echo "</div>";
	}
?>
</body>