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

if(isset($_GET['kode_utang']))
{
	$kode_utang = $_GET['kode_utang'];
}
else
{
	echo "<script>alert('Kode kosong')</script>";
	echo "<script>document.location='home.php?page=utang-lihat'</script>";
}

echo 
"<div class='card-header text-center'>
    <center><h4>Detail Utang</h4></center>
</div>
<div class='card-body text-center'>";

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM utang JOIN pemasok ON pemasok.kode_pemasok = utang.kode_pemasok JOIN pembayaran ON pembayaran.kode_bayar = utang.kode_bayar WHERE kode_utang = '$kode_utang'");
while($row = mysqli_fetch_array($query))
{
	$kd_u = $row['kode_utang'];
	$kd_supp = $row['kode_pemasok'];
	$nm_supp = $row['nama_pemasok'];
	$kd_byr = $row['kode_bayar'];
	$ket = $row['keterangan'];
	$tgl_u = $row['tanggal_hutang'];
	$tgl_temp = $row['tanggal_tempo'];
	$jml = $row['jumlah'];
	$tgl1 = $row['tanggal1'];
	$angs1 = $row['angsuran1'];
	$tgl2 = $row['tanggal2'];
	$angs2 = $row['angsuran2'];
	$tgl3 = $row['tanggal3'];
	$angs3 = $row['angsuran3'];
	$tgl4 = $row['tanggal4'];
	$angs4 = $row['angsuran4'];
	$tgl5 = $row['tanggal5'];
	$angs5 = $row['angsuran5'];
	$tgl6 = $row['tanggal6'];
	$angs6 = $row['angsuran6'];
	$sisa = ($jml) - ($angs1 + $angs2 + $angs3 + $angs4 + $angs5 + $angs6);
	$stat = $row['status'];

	echo "
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
					<b>&nbsp;Kode : ".$kd_u."&nbsp;</b>
				</div>
			</div>
			<div class='modal-body'>
				<table align='center' class='table table-striped table-bordered data'>
					<tr align='center'>
						<td align='left'>Nama Pemasok</td> 
						<td>:</td> 
						<td>$nm_supp</td>
					</tr>
					<tr align='center'>
						<td align='left'>Jenis Pembayaran </td>
						<td>:</td> 
						<td>$ket</td>
					</tr>
					<tr align='center'>
						<td align='left'>Tanggal Utang</td>
						<td>:</td> 
						<td>$tgl_u</td>
					</tr>
					<tr align='center'>
						<td align='left'>Tanggal Tempo</td>
						<td>:</td> 
						<td>$tgl_temp</td>
					</tr>
					<tr align='center'>
						<td align='left'>Jumlah Utang</td>
						<td>:</td> 
						<td>$jml</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 1</td>
						<td>:</td> 
						<td>$angs1</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 2</td>
						<td>:</td> 
						<td>$angs2</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 3</td>
						<td>:</td>
						<td>$angs3</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 4</td>
						<td>:</td> 
						<td>$angs4</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 5</td>
						<td>:</td> 
						<td>$angs5</td>
					</tr>
					<tr align='center'>
						<td align='left'>Angsuran 6</td>
						<td>:</td>
						<td>$angs6</td>
					</tr>
					<tr align='center'>
						<td align='left'>Sisa</td>
						<td>:</td>
						<td>$sisa</td>
					</tr>
					<tr align='center'>
						<td align='left'>Status</td>
						<td>:</td> 
						<td><b>$stat</b></td>
					</tr>
				</table>
			</div>
			<div class='modal-footer'>
				<div align='center'>
                    <a href='home.php?page=utang-ubah&&kode_utang=".$kd_u."' class='btn btn-primary'>Ubah</a>&nbsp;
                    <a href='home.php?page=utang-lihat' class='btn btn-default'>Batal</a>
                </div>
			</div>
		</div>
	</div>";
}
echo "
</div>";
?>
