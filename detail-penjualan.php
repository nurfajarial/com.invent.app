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

if (isset($_GET['kode_jual']))
{
    $kode_jual = $_GET['kode_jual'];
}
else
{
    die ('Error. No Kode Selected! ');
}

echo 
"<div class='card-header text-center'>
    <center><h4>Detail Penjualan</h4></center>
</div>
<div class='card-body text-center'>";

	//Tampilkan data dari tabel penjualan
	include 'config/koneksi.php';
	$query = mysqli_query($buka, "SELECT * FROM penjualan JOIN pelanggan ON pelanggan.kode_jual = penjualan.kode_jual WHERE penjualan.kode_jual = '$kode_jual'");
	while($data = mysqli_fetch_array($query))
	{
		$kd_jual = $data['kode_jual'];
		$kd_fktr = $data['kode_faktur'];
		$kd_cust = $data['kode_pelanggan'];
		$nm_cust = $data['nama_pelanggan'];
		$tgl_jual = $data['tanggal_jual'];
		$kd_do = $data['kode_do'];
		$kd_po = $data['kode_po'];
		$jml = $data['jumlah'];
		$dis = $data['diskon'];
		$ttl_hrg = $data['total_harga'];
		$byr = $data['bayar'];
		$kmbali = $data['kembalian'];
		$kd_user = $data['kode_user'];
		$kd_byr = $data['kode_bayar'];
		$tgl_temp = $data['tanggal_tempo'];

		echo 
		"
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<table align='center' class='table table-striped table-bordered data' >
						<tr bgcolor='#B0C4DE'>
							<td height='36'>&nbsp;Kode : ".$kode_jual."&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class='modal-body'>
					<table align='center'>
						<tr>
							<td colspan='2' align='center'>Kode Faktur : ".$kd_fktr."</td>
						</tr>
						<tr align='left'>
							<td colspan='' align='left'>Nama Pelanggan :".$nm_cust."</td>
						</tr>
					</table>
				</div>
				<div class='modal-footer'>

				</div>
			</div>
		</div>
		";
	}

echo 
"
</div>";
?>