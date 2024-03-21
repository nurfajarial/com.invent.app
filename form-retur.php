<?php 
error_reporting (E_ALL ^ E_NOTICE);

//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
$jsArrKdBl = "var prdKdBl = new Array();\n";
$jsArrKdDO = "var prdKdDO = new Array();\n";
$jsArrTglBl = "var prdTglBl = new Array();\n";
$jsArrKdPO = "var prdKdPO = new Array();\n";
$jsArrSup = "var prdSup = new Array();\n";
$jsArrKdUsr = "var prdKdUsr = new Array();\n";
$jsArrKdByr = "var prdKdByr = new Array();\n";
$jsArrTglTmp = "var prdTglTmp = new Array();\n";
$jsArrHrg = "var prdHrg = new Array();\n";
$jsArrJumBl = "var prdJumBl = new Array();\n";
$jsArrDisc = "var prdDisc = new Array();\n";
$jsArrTtl = "var prdTtl = new Array();\n";
$jsArrPlat = "var prdPlat = new Array();\n";
$jsArrSupir = "var prdSupir = new Array();\n";

echo
"
<form action='tambah-retur.php' method='post' name='form-retur' enctype='multipart/form-data'> 
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b><center>&nbsp;FORM RETUR&nbsp;</center></b></font>
                </div>
		    </div>
		    <div class='modal-body'>
				<table align='center'>
				    <tr>
				        <td>Jenis Retur</td>
				        <td>&nbsp;:&nbsp;</td>
				        <td align='center'>
				            <input type='radio' name='r_button' id='r_button_R' value='Retur' class='form-check-input' onclick='ret_nor()' />Retur
				            <input type='radio' name='r_button' id='r_button_F' value='Faktur' class='form-check-input' onclick='ret_fktr()' />Faktur
				        </td>
				    </tr>
					<tr>
						<td>Kode Retur</td>
						<td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kd_retur' name='txt_kd_retur' class='form-control'>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_kdbeli' name='txt_kdbeli' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrKdBl;
	                        	echo "
	                        	</script>
                        </td>
					</tr>
                    <tr>
                        <td>Tanggal Retur</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_retur' name='txt_tgl_retur'  class='form-control'>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_tglbeli' name='txt_tglbeli' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrTglBl;
	                        	echo "
	                        	</script>
                        </td>
                    </tr>
					<tr id='tr_kdfaktur'>
						<td>Kode Faktur</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<select name='cmb_kd_faktur' id='cmb_kd_faktur' class='form-control' onchange='opsi_kdbeli(this.value)'>
								<option selected='selected' disabled='disabled'>- pilih -</option>";
									$query = mysqli_query($buka, " SELECT * FROM pembelian JOIN pemasok ON pemasok.kode_pemasok = pembelian.kode_pemasok JOIN po_detail ON po_detail.kode_po = pembelian.kode_po ");
									while($p = mysqli_fetch_array($query, MYSQLI_BOTH))
									{
										echo "<option value='".$p['kode_po']."'>".$p['kode_beli']."</option>";
										$jsArrSup .= "prdSup['".$p['kode_po']."'] = {sup: '".$p['nama_pemasok']."'};\n";
										$jsArrKdBl .= "prdKdBl['".$p['kode_po']."'] = {kdbl: '".$p['kode_beli']."'};\n";
										$jsArrKdDO .= "prdKdDO['".$p['kode_po']."'] = {kddo: '".$p['kode_do']."'};\n";
										$jsArrTglBl .= "prdTglBl['".$p['kode_po']."'] = {tglbl: '".$p['tanggal_beli']."'};\n";
										$jsArrKdPO .= "prdKdPO['".$p['kode_po']."'] = {kdpo: '".$p['kode_po']."'};\n";
										$jsArrKdUsr .= "prdKdUsr['".$p['kode_po']."'] = {kdusr: '".$p['kode_user']."'};\n";
										$jsArrKdByr .= "prdKdByr['".$p['kode_po']."'] = {kdbyr: '".$p['kode_bayar']."'};\n";
										$jsArrTglTmp .= "prdTglTmp['".$p['kode_po']."'] = {tgltmp: '".$p['tanggal_tempo']."'};\n";
										$jsArrDisc .= "prdDisc['".$p['kode_po']."'] = {dis: '".$p['diskon']."'};\n";
										$jsArrTtl .= "prdTtl['".$p['kode_po']."'] = {ttl: '".$p['total']."'};\n";
										$jsArrPlat .= "prdPlat['".$p['kode_po']."'] = {plat: '".$p['no_plat']."'};\n";
										$jsArrSupir .= "prdSupir['".$p['kode_po']."'] = {supir: '".$p['nama_supir']."'};\n";			
									}
                            echo "
							</select>
						</td>
						<td>
							<input type='hidden' id='txt_kddo' name='txt_kddo' readonly class='form-control' />
								<script>";
								echo $jsArrKdDO;
								echo "
								</script>
						</td>
					</tr>
					<tr id='tr_kdbrg1'>
						<td>Kode Barang</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<select name='cmb_kdbrg' id='cmb_kdbrg' class='form-control' >
								<option selected='selected' disabled='disabled' >- pilih -</option>";
								$qbrg = mysqli_query($buka, "SELECT * FROM barang");
								while( $dtb = mysqli_fetch_array($qbrg, MYSQLI_BOTH))
								{
									echo "<option value='".$dtb['kode_barang']."'>".$dtb['kode_barang']."</option>";
								}
								echo"
							</select>
						</td>
					</tr>
					<tr id='tr_kdbrg2'>
						<td>Kode Barang</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<select name='cmb_kd_brg' id='cmb_kd_brg' class='form-control' onchange='opsi_kdbrg(this.value)' >
								<option selected='selected' disabled='disabled'>- pilih -</option>";
								$q_brg2 = mysqli_query($buka, "SELECT * FROM po_detail");
								while( $dt_b = mysqli_fetch_array($q_brg2, MYSQLI_BOTH))
								{
									$jsArrJumBl .= "prdJumBl['".$dt_b['kode_barang']."'] = {jumbl: '".$dt_b['jumlah_beli']."'};\n";
									$jsArrHrg .= "prdHrg['".$dt_b['kode_barang']."'] = {hrg: '".$dt_b['harga']."'};\n";
								}
								echo "
							</select>
						</td>
						<td>
							<input type='hidden' id='txt_kdpo' name='txt_kdpo' readonly class='form-control' />
							<script>";
							echo $jsArrKdPO;
							echo "
							</script>
						</td>
					</tr>
                    <tr id='tr_kdsup'>
                        <td>Nama Pemasok</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input id='txt_kd_supp' name='txt_kd_supp' class='form-control' readonly />
                            <script>";
                            echo $jsArrSup;
                            echo "
                            </script>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_kdusr' name='txt_kdusr' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrKdUsr;
	                        	echo "
	                        	</script>
                        </td>
                    </tr>
                    <tr id='tr_kdcust'>
                        <td>Nama Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='txt_kd_cust' name='txt_kd_cust' class='form-control' />
                            	<option value='' selected='selected' disabled='disabled'>- pilih -</option>";
                            		$q_cus = mysqli_query($buka, "SELECT * FROM pelanggan");
                            		while($pa = mysqli_fetch_array($q_cus))
                            		{
                            			echo "<option value='".$pa['kode_pelanggan']."'>".$pa['nama_pelanggan']."</option>";
                            		}
                            	echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_kdbyr' name='txt_kdbyr' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrKdByr;
	                        	echo "
	                        	</script>
                        </td>
                    </tr>
                    <tr id='tr_kdusr'>
                        <td>Penerima</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_user' name='cmb_user' class='form-control' />
                            	<option value='' selected='selected' disabled='disabled'>- pilih -</option>";
                            		$q_usr = mysqli_query($buka, "SELECT * FROM karyawan");
                            		while($pb = mysqli_fetch_array($q_usr))
                            		{
                            			echo "<option value='".$pb['kode_user']."'>".$pb['nama_karyawan']."</option>";
                            		}
                            echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_tgltmp' name='txt_tgltmp' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrTglTmp;
	                        	echo "
	                        	</script>
                        </td>
                    </tr>
                    <tr id='tr_jum'>
                    	<td>Jumlah</td>
                    	<td>&nbsp;:&nbsp;</td>
                    	<td>
                    		<input type='number' id='txt_jumlah' name='txt_jumlah' class='form-control' onchange='hitung()' />
                    		    <script>";
                    		    echo $jsArrJumBl;
                    		    echo "
                    		    </script>
                    	</td>
                    	<td>
                    		<input type='hidden' id='txt_dis' name='txt_dis' readonly class='form-control' />
                    			<script>";
                    			echo $jsArrDisc;
                    			echo "
                    			</script>
                    	</td>
                    </tr>
                    <tr id='tr_hrg'>
                        <td>Harga</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_harga' name='txt_harga' readonly class='form-control'  />
                            <script>";
                            	echo $jsArrHrg;
                            	echo "
                            </script>
                        </td>
                    </tr>
                    <tr id='tr_ttl'>
                        <td>Total</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_total' name='txt_total' readonly class='form-control' />
	                            <script>";
	                            echo $jsArrTtl;
	                            echo "
	                            </script>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_plat' name='txt_plat' readonly class='form-control' />
	                        	<script>";
	                        	echo $jsArrPlat;
	                        	echo "
	                        	</script>
                        </td>
                    </tr>
                    <tr id='tr_ket'>
                        <td>Keterangan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_ket' name='txt_ket' class='form-control'></textarea>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_supir' name='txt_supir' readonly class='form-control' />
                        		<script>";
                        		echo $jsArrSupir;
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

<script type="text/javascript">
$(document).ready(function()
{
    ngumpet();
    
	$('#cmb_kd_faktur').change(function()
	{
		var kode_po = $('#cmb_kd_faktur').val();
		$.ajax(
		{
			url: 'retur_proses_barang.php',
			data: 'kode_po=' + kode_po,
			success: function(data)
			{
				$('#cmb_kd_brg').html(data);
			}
		});
	});

	$('#cmb_kd_brg').change(function()
	{
		var jumlah = $('cmb_kd_brg').val();
		$.ajax(
		{
			url: 'retur_proses_jumlah.php',
			data: 'jumlah=' + jumlah,
			success: function(data)
			{
				$('#txt_jumlah').html(data);
			}
		});
	});
});

window.setTimeout("waktu()", 1000);

function waktu()
{
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    var a = document.getElementById("txt_kd_retur");
    a.value = 'RTR-' + moment(waktu).format('DDMM-HH') + waktu.getMinutes();   
};

function opsi_kdbeli(x)
{
	<?php echo $jsArrSup; ?>
	<?php echo $jsArrKdBl; ?>
	<?php echo $jsArrKdDO; ?>
	<?php echo $jsArrTglBl; ?>
	<?php echo $jsArrKdPO; ?>
	<?php echo $jsArrKdUsr; ?>
	<?php echo $jsArrKdByr; ?>
	<?php echo $jsArrTglTmp; ?>
	<?php echo $jsArrDisc; ?>
	<?php echo $jsArrTtl; ?>
	<?php echo $jsArrPlat; ?>
	<?php echo $jsArrSupir; ?>

	document.getElementById('txt_kd_supp').value = prdSup[x].sup;
	document.getElementById('txt_tglbeli').value = prdTglBl[x].tglbl;
	document.getElementById('txt_kdbeli').value = prdKdBl[x].kdbl;
	document.getElementById('txt_kddo').value = prdKdDO[x].kddo;
	document.getElementById('txt_kdpo').value = prdKdPO[x].kdpo;
	document.getElementById('txt_kdusr').value = prdKdUsr[x].kdusr;
	document.getElementById('txt_kdbyr').value = prdKdByr[x].kdbyr;
	document.getElementById('txt_tgltmp').value = prdTglTmp[x].tgltmp;
	document.getElementById('txt_dis').value = prdDisc[x].dis;
	document.getElementById('txt_total').value = prdTtl[x].ttl;
	document.getElementById('txt_plat').value = prdPlat[x].plat;
	document.getElementById('txt_supir').value = prdSupir[x].supir;
};

function opsi_kdbrg(x)
{
	<?php echo $jsArrJumBl; ?>
	<?php echo $jsArrHrg; ?>

	document.getElementById('txt_jumlah').value = prdJumBl[x].jumbl;
	document.getElementById('txt_harga').value = prdHrg[x].hrg;
};

function ret_nor()
{
    document.getElementById('tr_kdfaktur').style.visibility = 'hidden';
    document.getElementById('tr_kdbrg1').style.visibility = 'visible';
    document.getElementById('tr_kdbrg2').style.visibility = 'hidden';
    document.getElementById('tr_kdsup').style.visibility = 'hidden';
    document.getElementById('tr_kdcust').style.visibility = 'visible';
    document.getElementById('tr_kdusr').style.visibility = 'visible';
    document.getElementById('tr_jum').style.visibility = 'visible';
    document.getElementById('tr_hrg').style.visibility = 'hidden';
    document.getElementById('tr_ttl').style.visibility = 'hidden';
    document.getElementById('tr_ket').style.visibility = 'visible';
};

function ret_fktr()
{

    document.getElementById('tr_kdfaktur').style.visibility = 'visible';
    document.getElementById('tr_kdbrg1').style.visibility = 'hidden';
    document.getElementById('tr_kdbrg2').style.visibility = 'visible';
    document.getElementById('tr_kdsup').style.visibility = 'visible';
    document.getElementById('tr_kdcust').style.visibility = 'visible';
    document.getElementById('tr_kdusr').style.visibility = 'visible';
    document.getElementById('tr_jum').style.visibility = 'visible';
    document.getElementById('tr_hrg').style.visibility = 'visible';
    document.getElementById('tr_ttl').style.visibility = 'visible';
    document.getElementById('tr_ket').style.visibility = 'visible';
};

function ngumpet()
{
	//document.getElementById('txt_kdbeli').style.visibility = 'hidden';
	//document.getElementById('txt_tglbeli').style.visibility = 'hidden';
	//document.getElementById('txt_kddo').style.visibility = 'hidden';
	//document.getElementById('txt_kdpo').style.visibility = 'hidden';
	//document.getElementById('txt_kdbyr').style.visibility = 'hidden';
	//document.getElementById('txt_tgltmp').style.visibility = 'hidden';
    document.getElementById('tr_kdfaktur').style.visibility = 'hidden';
    document.getElementById('tr_kdbrg1').style.visibility = 'hidden';
    document.getElementById('tr_kdbrg2').style.visibility = 'hidden';
    document.getElementById('tr_kdsup').style.visibility = 'hidden';
    document.getElementById('tr_kdcust').style.visibility = 'hidden';
    document.getElementById('tr_kdusr').style.visibility = 'hidden';
    document.getElementById('tr_jum').style.visibility = 'hidden';
    document.getElementById('tr_hrg').style.visibility = 'hidden';
    document.getElementById('tr_ttl').style.visibility = 'hidden';
    document.getElementById('tr_ket').style.visibility = 'hidden';
};

function hitung()
{
	var ttl = 0;
	var jml = document.getElementById('txt_jumlah').value;
	var hrg = document.getElementById('txt_harga').value;
	var ttl = (parseFloat(jml) * parseFloat(hrg));
	document.getElementById('txt_total').value = ttl;
};

</script>