<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
if (isset($_GET['kode_tagihan']))
{
	$kode_tagihan = $_GET['kode_tagihan'];
}
else
{
	die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel utang
$q_tghn = mysqli_query($buka, "SELECT * FROM tagihan JOIN pelanggan ON pelanggan.kode_pelanggan = tagihan.kode_pelanggan JOIN pembayaran ON pembayaran.kode_bayar = tagihan.kode_bayar WHERE kode_tagihan='$kode_tagihan' " );
$dt_t = mysqli_fetch_array($q_tghn);
$kd_tagihan = $dt_t['kode_tagihan'];
$kd_pelanggan = $dt_t['kode_pelanggan'];
$nm_pelanggan = $dt_t['nama_pelanggan'];
$kd_byr = $dt_t['kode_bayar'];
$ket = $dt_t['keterangan'];
$tgl = $dt_t['tanggal_tagihan'];
$tgl_tmp = $dt_t['tanggal_tempo'];
$jmlh = $dt_t['jumlah'];
$tgl1 = $dt_t['tanggal1'];
$angs1 = $dt_t['angsuran1'];
$tgl2 = $dt_t['tanggal2'];
$angs2 = $dt_t['angsuran2'];
$tgl3 = $dt_t['tanggal3'];
$angs3 = $dt_t['angsuran3'];
$tgl4 = $dt_t['tanggal4'];
$angs4 = $dt_t['angsuran4'];
$tgl5 = $dt_t['tanggal5'];
$angs5 = $dt_t['angsuran5'];
$tgl6 = $dt_t['tanggal6'];
$angs6 = $dt_t['angsuran6'];
$sisa = $dt_t['sisa'];
$status = $dt_t['status'];

//proses edit data user
if (isset($_POST['Edit']))
{
				//
	$kd_tagihan1 = $_POST['txt_kd_tagihan'];
	$kd_pelanggan1 = $_POST['txt_kd_pelanggan'];
	$kd_byr1 = $_POST['txt_kd_byr'];
	$tgl1 = $_POST['txt_tgl'];
	$tgl_tmp1 = $_POST['txt_tgl_tmp'];
	$jmlh1 = $_POST['txt_jumlah'];
	$t1 = $_POST['txt_tgl1'];
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
					
	//update data
	$update = "UPDATE tagihan
	SET kode_tagihan = '$kd_tagihan1',
	kode_pelanggan = '$kd_pelanggan1',
    kode_bayar = '$kd_byr1',
	tanggal_tagihan = '$tgl1',
	tanggal_tempo = '$tgl_tmp1',
	jumlah = '$jmlh1',
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
	kode_tagihan='$kd_tagihan'";
	$sql = mysqli_query($buka, $update);
	
	//setelah berhasil update
	if ($sql)
	{
        echo "<script>alert('Data Tagihan Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=tagihan-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Data Tagihan gagal diedit')</script>";
        echo "<script>document.location='home.php?page=tagihan-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-tagihan' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <font color='black' face='arial'><b>UBAH DATA TAGIHAN</b></font>
			    </div>
		    </div>
		    <div class='modal-body'>
			    <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
            		<tr>
            			<td colspan='3'>&nbsp;</td>
            		</tr>                
					<tr>
            			<td>Kode Tagihan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='text' id='txt_kd_tagihan' name='txt_kd_tagihan' readonly class='form-control' value='".$kd_tagihan."' />
                        </td>
            		</tr>
            		<tr>
            			<td>Nama Pelanggan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                		    <input type='hidden' id='txt_kd_pelanggan' name='txt_kd_pelanggan' readonly class='form-control' value='".$kd_pelanggan."' />
                        	<input type='text' id='txt_nm_pelanggan' name='txt_nm_pelanggan' readonly class='form-control' value='".$nm_pelanggan."' />
                        </td>
            		</tr>
            		<tr>
            			<td>Cicilan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                		    <input type='hidden' id='txt_kd_byr' name='txt_kd_byr' class='form-control' readonly value='".$kd_byr."' />
                        	<input type='text' id='txt_ket' name='txt_ket' class='form-control' readonly value='".$ket."' />
                        </td>
            		</tr>
            		<tr>
            			<td>Tanggal</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='date' id='txt_tgl' name='txt_tgl' class='form-control' readonly value='".$tgl."' />
                        </td>
            		</tr>
            		<tr>
            			<td>Tanggal Tempo</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='date' id='txt_tgl_tmp' name='txt_tgl_tmp' class='form-control' readonly value='".$tgl_tmp."' />
                        </td>
            		</tr>
            		<tr>
            			<td>Jumlah</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
	                        <input type='number' id='txt_jumlah' name='txt_jumlah' class='form-control' readonly value='".$jmlh."' />
                        </td>
            		</tr>
                    <tr>
                        <table align='center'>
                            <thead>
                                <tr bgcolor='#B0C4DE'>
                                    <td align='center' colspan='2' height='36'><b>Angsuran</b></td>
                                    <td align='center' colspan=''><b>Tanggal</b></td>
                                    <td>&nbsp;&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                        		<tr>
                        		    <td>&nbsp;1&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs1' name='txt_angs1' class='form-control' value='".$angs1."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl1' name='txt_tgl1' class='form-control' value='".$tgl1."' />
                        		    </td>
                        		</tr>
                        		<tr>
                        		    <td>&nbsp;2&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs2' name='txt_angs2' class='form-control' value='".$angs2."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl2' name='txt_tgl2' class='form-control' value='".$tgl2."' />
                        		    </td>
                        		</tr>
                        		<tr>
                        		    <td>&nbsp;3&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs3' name='txt_angs3' class='form-control' value='".$angs3."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl3' name='txt_tgl3' class='form-control' value='".$tgl3."' />
                        		    </td>
                        		</tr>
                        		<tr>
                        		    <td>&nbsp;4&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs4' name='txt_angs4' class='form-control' value='".$angs4."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl4' name='txt_tgl4' class='form-control' value='".$tgl41."' />
                        		    </td>
                        		</tr>
                        		<tr>
                        		    <td>&nbsp;5&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs5' name='txt_angs5' class='form-control' value='".$angs5."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl5' name='txt_tgl5' class='form-control' value='".$tgl51."' />
                        		    </td>
                        		</tr>
                        		<tr>
                        		    <td>&nbsp;6;&nbsp;</td>
                        		    <td>
                                        <input type='number' id='txt_angs6' name='txt_angs6' class='form-control' value='".$angs6."' onkeyup='kalkulasi()' />
                                    </td>
                        		    <td>
                        		        <input type='date' id='txt_tgl6' name='txt_tgl6' class='form-control' value='".$tgl61."' />
                        		    </td>
                        		</tr>
                            </tbody>
                        </table>                    
            		<tr>
            		    <td>Sisa</td>
            		    <td>&nbsp;:&nbsp;</td>
            		    <td>
            		        <input type='number' id='txt_sisa' name='txt_sisa' class='form-control' value='".$sisa."' readonly ' />
            		    </td>
            		</tr>
                    <tr>
                    	<td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='text' id='txt_status' name='txt_status' class='form-control' value='".$status1."' readonly />
                        </td>
                    </tr>
                    <tr>
                    	<td colspan='3'>&nbsp;</td>
                    </tr>
        		</table>
		    </div>
		    <div class='modal-footer'>
			    <div align='center'>
                    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=tagihan-detil&&kode_tagihan=".$kode_tagihan."' title='kembali ke lihat data tagihan' class='btn btn-default'>
                </div>
            </div>
        </div>
    </div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>

<script>
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
}

</script>