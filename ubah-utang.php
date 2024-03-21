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

if (isset($_GET['kode_utang'])) 
{
	$kd_u = $_GET['kode_utang'];
} 
else 
{
	die ('Error. No Kode Selected! ');	
}

include 'config/koneksi.php';
$qry_u = mysqli_query($buka, "SELECT * FROM utang JOIN pemasok ON pemasok.kode_pemasok = utang.kode_pemasok JOIN pembayaran ON pembayaran.kode_bayar = utang.kode_bayar WHERE kode_utang = '$kd_u'");
$row = mysqli_fetch_array($qry_u);
$kd_u = $row['kode_utang'];
$kd_supp = $row['kode_pemasok'];
$nm_supp = $row['nama_pemasok'];
$kd_byr = $row['kode_bayar'];
$ket = $row['keterangan'];
$tgl_u = $row['tanggal_hutang'];
$tgl_tmp = $row['tanggal_tempo'];
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
$sisa = $row['sisa'];
$status = $row['status'];

//proses edit data barang
if (isset($_POST['Edit']))
{
	$kd_u1 = $_POST['txt_kd_u'];
	$kd_supp1 = $_POST['txt_kd_supp'];
	$kd_byr1 = $_POST['txt_kd_byr'];
	$tgl_u1 = $_POST['txt_tgl_u'];
	$tgl_tmp1 = $_POST['txt_kd_tmp'];
	$jml1 = $_POST['txt_jumlah'];
	$t1 = $_POST['txt_tgl_u'];
	$a1 = $_POST['txt_angs1'];
	$t2 = $_POST['txt_tgl2'];
	$a2 = $_POST['txt_angs2'];
	$t3 = $_POST['txt_tgl3'];
	$a3 = $_POST['txt_angs3'];
	$t4 = $_POST['txt_tgl4'];
	$a4 = $_POST['txt_angs4'];
	$t5 = $_POST['txt_tgl5'];
	$a5 = $_POST['txt_angs5'];
	$t6 = $_POST['txt_tgl6'];
	$a6 = $_POST['txt_angs6'];
	$sisa1 = $_POST['txt_sisa'];
	$status1 = $_POST['txt_status'];

	$upd_ut = "UPDATE utang
	SET kode_utang = '$kd_u1',
	kode_pemasok = '$kd_supp1',
	kode_bayar = '$kd_byr1',
	tanggal_hutang = '$tgl_u1',
	tanggal_tempo = '$tgl_tmp1',
	jumlah = '$jml1',
	tanggal1 = '$t1',
	angsuran1 = '$a1',
	tanggal2 = '$t2',
	angsuran2 = '$a2',
	tanggal3 = '$t3',
	angsuran3 = '$a3',
	tanggal4 = '$t4',
	angsuran4 = '$a4',
	tanggal5 = '$t5',
	angsuran5 = '$a5',
	tanggal6 = '$t6',
	angsuran6 = '$a6',
	sisa = '$sisa1',
	status = '$status1'
	WHERE
	kode_utang = '$kd_u'";
	$sql = mysqli_query($buka, $upd_ut);
	//$sql = $upd_ut;

    //setelah berhasil update
	if ($sql) 
	{
	    //echo "Data berhasil dirubah";
	    //echo $upd_ut;
        mysqli_query($buka, $upd_ut);
        echo "<script>alert('Data berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=utang-lihat'</script>";
	}
	else
	{
	    //echo "Data gagal dirubah";
		echo "<script>alert('Data Barang gagal diedit')</script>";
		echo "<script>document.location='home.php?page=utang-ubah&&kode_utang=".$kd_u."'</script>";
	}

}

echo "
<form action='#' method='POST' name='ubah-data-utang' enctype='multipart/form-data'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
					<b>&nbsp;UBAH DATA UTANG&nbsp;</b>
				</div>
			</div>
			<div class='modal-body'>	
				<table align='center'>
					<tr>
						<td>Kode</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='text' id='txt_kd_u' name='txt_kd_u' value='$kd_u' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<td>Nama Pemasok</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='hidden' id='txt_kd_supp' name='txt_kd_supp' value='$kd_supp' />&nbsp;
							<input type='text' id='txt_nm_supp' class='form-control' value='$nm_supp' readonly />
						</td>
					</tr>
					<tr>
						<td>Pembayaran</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='hidden' id='txt_kd_byr' name='txt_kd_byr' value='$kd_byr' />&nbsp
							<input type='text' id='txt_ket' value='$ket' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>&nbsp;:&nbsp;</td>
						<td colspan=''>
							<input type='text' id='txt_tgl_u' name='txt_tgl_u' value='$tgl_u' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<td>Tanggal Tempo</td>
						<td>&nbsp;:&nbsp;</td>
						<td colspan='2'>
							<input type='text' id='txt_kd_tmp' name='txt_kd_tmp' value='$tgl_tmp' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<td>Jumlah Utang</td>
						<td>&nbsp;:&nbsp;</td>
						<td colspan='2'>
							<input type='text' id='txt_jumlah' name='txt_jumlah' value='$jml' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<table align='center' class=''>
							<thead>
								<tr bgcolor='#B0C4DE'>
									<td align='center' colspan='2' height='36'><b>Angsuran</b></td>
									<td align='center' colspan=''><b>Tanggal</b></td>
									<td>&nbsp;&nbsp;</td>
								</tr>
							</thead>
							<tbody>
								<tr id='tr_ang1'>
									<td>&nbsp;1&nbsp;</td>
									<td>
										<input type='text' id='txt_angs1' name='txt_angs1' value='$angs1' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl1' name='txt_tgl1' value='$tgl1' class='form-control' />
									</td>
								</tr>
								<tr id='tr_ang2'>
									<td>&nbsp;2&nbsp;</td>
									<td>
										<input type='text' id='txt_angs2' name='txt_angs2' value='$angs2' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl2' name='txt_tgl2' value='$tgl2' class='form-control' />
									</td>													
									</tr>
								<tr id='tr_ang3'>
									<td>&nbsp;3&nbsp;</td>
									<td>
										<input type='text' id='txt_angs3' name='txt_angs3' value='$angs3' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl3' name='txt_tgl3' value='$tgl3' class='form-control' />
									</td>													
								</tr>
								<tr id='tr_ang4'>
									<td>&nbsp;4&nbsp;</td>
									<td>
										<input type='text' id='txt_angs4' name='txt_angs4' value='$angs4' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl4' name='txt_tgl4' value='$tgl4' class='form-control' />
									</td>														
								</tr>
								<tr id='tr_ang5'>
									<td>&nbsp;5&nbsp;</td>
									<td>
										<input type='text' id='txt_angs5' name='txt_angs5' value='$angs5' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl5' name='txt_tgl5' value='$tgl5' class='form-control' />
									</td>														
								</tr>
								<tr>
									<td>&nbsp;6&nbsp;</td>
									<td>
										<input type='text' id='txt_angs6' name='txt_angs6' value='$angs6' class='form-control' onkeyup='kalkulasi()' />
									</td>					
									<td>
										<input type='date' id='txt_tgl6' name='txt_tgl6' value='$tgl6' class='form-control' />
									</td>														
								</tr>
							</tbody>
						</table>
					</tr>
					<tr>
						<td>Sisa</td>
						<td>&nbsp;:&nbsp;</td>
						<td colspan='2'>
							<input type='number' id='txt_sisa' name='txt_sisa' value='$sisa' class='form-control' readonly />
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
	                        <input type='text' id='txt_status' name='txt_status' value='$status' class='form-control' readonly />
						</td>
					</tr>												
				</table>
			</form>
		</div>
		<div class='modal-footer'>
            <table align='center'>
                    <td colspan='3'>
                        <input type='submit' name='Edit' value='Simpan' class='btn btn-primary' />&nbsp;
                        <input type='button' value='Cancel' onclick=location.href='home.php?page=utang-lihat' class='btn btn-danger btn-icon-split' />
                    </td>                        
            </table>
		</div>
	</div>
</div>";
?>

<script type='text/javascript'>
$(document).ready(function()
{
    kalkulasi();
});

			
function kalkulasi()
{
	var jml = document.getElementById('txt_jumlah').value;
	var a1 = document.getElementById('txt_angs1').value;
	var t1 = document.getElementById('txt_tgl1');
	var a2 = document.getElementById('txt_angs2').value;
	var t2 = document.getElementById('txt_tgl2');
	var a3 = document.getElementById('txt_angs3').value;
	var t3 = document.getElementById('txt_tgl3');
	var a4 = document.getElementById('txt_angs4').value;
	var t4 = document.getElementById('txt_tgl4');
	var a5 = document.getElementById('txt_angs5').value;
	var t5 = document.getElementById('txt_tgl5');
	var a6 = document.getElementById('txt_angs6').value;
	var t6 = document.getElementById('txt_tgl6');
	
	var tsisa = document.getElementById('txt_sisa');

	var tsisa = (parseFloat(jml) - (parseFloat(a1)+parseFloat(a2)+parseFloat(a3)+parseFloat(a4)+parseFloat(a5)+parseFloat(a6)));
	document.getElementById('txt_sisa').value = tsisa;
	
    var s1 = document.getElementById('txt_sisa');
    var st = document.getElementById('txt_status');
    if(s1.value == 0)
    {
        //st.disabled = true;
        st.value = 'Lunas'
    }
    else
    {
        //st.disabled = false;
        st.value = 'Belum Lunas';
    }
};
</script>