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
$jsArrTgl = "var prdTgl = new Array();\n";
$jsArrHrgBl = "var prdHrgBl = new Array();\n";
$jsArrTglJ1 = "var prdTglJ1 = new Array();\n";
$jsArrHrgJ1 = "var prdHrgJ1 = new Array();\n";
$jsArrTglJ2 = "var prdTglJ2 = new Array();\n";
$jsArrHrgJ2 = "var prdHrgJ2 = new Array();\n";
$jsArrTglJ3 = "var prdTglJ3 = new Array();\n";
$jsArrHrgJ3 = "var prdHrgJ3 = new Array();\n";

echo "
<form action='tambah-modal.php' method='post' enctype='multipart/form-data'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
					<center><font size='3'> <b>&nbsp;FORM DATA MODAL&nbsp;</b></font></center>
				</div>
			</div>
			<div class='modal-body'>			
				<table align='center'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>					
					<tr>
						<td>Kode Beli</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<select name='cmb_kd_beli' id='cmb_kd_beli' class='form-control' onchange=''>
								<option selected='selected' disabled='disabled'>- pilih -</option>";
								include 'config/koneksi.php';
								$q_mdl = mysqli_query($buka, 'SELECT * FROM modal GROUP BY kode_beli');
								while($dt_m = mysqli_fetch_array($q_mdl, MYSQLI_BOTH))
								{
									echo "<option value='".$dt_m['kode_beli']."'>".$dt_m['kode_beli']."</option>\n";
								}
								echo "
							</select>
						</td>
					</tr>
					<tr>
						<td>Kode Barang</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<select name='cmb_kd_brg' id='cmb_kd_brg' class='form-control' onchange='opsi_kdbrg(this.value)'>
								<option selected='selected' disabled='disabled'>- pilih -</option>";
								$q_brg = mysqli_query($buka, "SELECT * FROM modal");
								while($dt_b = mysqli_fetch_array($q_brg, MYSQLI_BOTH))
								{
									$jsArrTgl .= "prdTgl['".$dt_b['kode_barang']."'] = {tgl: '".$dt_b['tanggal']."'};\n";
									$jsArrHrgBl .= "prdHrgBl['".$dt_b['kode_barang']."'] = {beli: '".$dt_b['harga_beli']."'};\n";
									$jsArrTglJ1 .= "prdTglJ1['".$dt_b['kode_barang']."'] = {tgl1: '".$dt_b['tanggal_jual1']."'};\n";
									$jsArrHrgJ1 .= "prdHrgJ1['".$dt_b['kode_barang']."'] = {jual1: '".$dt_b['harga_jual1']."'};\n";
									$jsArrTglJ2 .= "prdTglJ2['".$dt_b['kode_barang']."'] = {tgl2: '".$dt_b['tanggal_jual2']."'};\n";
									$jsArrHrgJ2 .= "prdHrgJ2['".$dt_b['kode_barang']."'] = {jual2: '".$dt_b['harga_jual2']."'};\n";
									$jsArrTglJ3 .= "prdTglJ3['".$dt_b['kode_barang']."'] = {tgl3: '".$dt_b['tanggal_jual3']."'};\n";
									$jsArrHrgJ3 .= "prdHrgJ3['".$dt_b['kode_barang']."'] = {jual3: '".$dt_b['harga_jual3']."'};\n";
								}
								echo "
							</select>
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='date' id='txt_tgl' name='txt_tgl' class='form-control' readonly />
							<script>";
							echo $jsArrTgl;
							echo "
							</script>
						</td>
					</tr>
					<tr>
						<td>Harga Beli</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='number' id='txt_hrg_beli' name='txt_hrg_beli' class='form-control' value='0' readonly />
							<script>";
							echo $jsArrHrgBl;
							echo "
							</script>
						</td>
					</tr>
						<td>Tanggal Jual 1</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='date' id='txt_tgl_jual1' name='txt_tgl_jual1' class='form-control' />
							    <script>";
							    echo $jsArrTglJ1;
							    echo "
							    </script>
						</td>
					</tr>
	            	<tr>
	            		<td>Harga Jual 1</td>
	                	<td>&nbsp;:&nbsp;</td>
	                	<td>
							<input type='number' id='txt_hrg_jual1' name='txt_hrg_jual1' class='form-control' value='0' />
								<script>";
								echo $jsArrHrgJ1;
								echo "
								</script>
						</td>
	            	</tr>
					<tr>
						<td>Tanggal Jual 2</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='date' id='txt_tgl_jual2' name='txt_tgl_jual2' class='form-control' />
							    <script>";
							    echo $jsArrTglJ2;
							    echo "
							    </script>
						</td>
					</tr>					
					<tr>
						<td>Harga Jual 2</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='number' id='txt_hrg_jual2' name='txt_hrg_jual2' class='form-control' value='0' />
							    <script>";
							    echo $jsArrHrgJ2;
							    echo "
							    </script>
						</td>
					</tr>
					<tr>
						<td>Tanggal Jual 3</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='date' id='txt_tgl_jual3' name='txt_tgl_jual3' class='form-control' />
							    <script>";
							    echo $jsArrTglJ3;
							    echo "
							    </script>
						</td>
					</tr>					
					<tr>
						<td>Harga Jual 3</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='number' id='txt_hrg_jual3' name='txt_hrg_jual3' class='form-control' value='0' />
							<script>";
							echo $jsArrHrgJ3;
							echo "
							</script>
						</td>
					</tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>					
				</table>
			</div>
			<div class='modal-footer'>
				<div align='center'>
					<input type='submit' name='Submit' value='Submit' class='btn btn-primary'>&nbsp;
	            	<input type='button' value='Cancel' onclick=location.href='home.php' class='btn btn-default'>
				</div>
			</div>
		</div>
	</div>
</form>";
?>

<script src='js/jquery-3.4.1.min.js'></script>
<script type='text/javascript'>

$(document).ready(function()
{
	$('#cmb_kd_beli').change(function()
	{
		var kode_beli = $('#cmb_kd_beli').val();
		$.ajax(
		{
			url: 'modal_proses_barang.php',
			data: 'kode_beli=' + kode_beli,
			success: function(data)
			{
				$('#cmb_kd_brg').html(data);
			}
		});
	});

});

function opsi_kdbrg(x)
{
	<?php echo $jsArrTgl; ?>
	<?php echo $jsArrHrgBl; ?>
	<?php echo $jsArrTglJ1; ?>
	<?php echo $jsArrHrgJ1; ?>
	<?php echo $jsArrTglJ2; ?>
	<?php echo $jsArrHrgJ2; ?>
	<?php echo $jsArrTglJ3; ?>
	<?php echo $jsArrHrgJ3; ?>

	document.getElementById('txt_tgl').value = prdTgl[x].tgl;
	document.getElementById('txt_hrg_beli').value = prdHrgBl[x].beli;
	document.getElementById('txt_tgl_jual1').value = prdTglJ1[x].tgl1;
	document.getElementById('txt_hrg_jual1').value = prdHrgJ1[x].jual1;
	document.getElementById('txt_tgl_jual2').value = prdTglJ2[x].tgl2;
	document.getElementById('txt_hrg_jual2').value = prdHrgJ2[x].jual2;
	document.getElementById('txt_tgl_jual3').value = prdTglJ3[x].tgl3;
	document.getElementById('txt_hrg_jual3').value = prdHrgJ3[x].jual3;

};
</script>