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
$qry_u = mysqli_query($buka, "SELECT * FROM utang JOIN pemasok ON pemasok.kode_pemasok = utang.kode_pemasok WHERE status = 'Belum Lunas'");
$jsArrKode = "var prdKode = new Array();\n";
$jsArrKdBayar = "var prdKdBayar = new Array();\n";
$jsArrTglTempo = "var prdTglTempo = new Array();\n";
$jsArrJumlah = "var prdJumlah = new Array();\n";
$jsArrTglAng1 = "var prdTglAng1 = new Array();\n";
$jsArrAngs1 = "var prdAngs1 = new Array();\n";
$jsArrTglAng2 = "var prdTglAng2 = new Array();\n";
$jsArrAngs2 = "var prdAngs2 = new Array();\n";
$jsArrTglAng3 = "var prdTglAng3 = new Array();\n";
$jsArrAngs3 = "var prdAngs3 = new Array();\n";
$jsArrTglAng4 = "var prdTglAng4 = new Array();\n";
$jsArrAngs4 = "var prdAngs4 = new Array();\n";
$jsArrTglAng5 = "var prdTglAng5 = new Array();\n";
$jsArrAngs5 = "var prdAngs5 = new Array();\n";
$jsArrTglAng6 = "var prdTglAng6 = new Array();\n";
$jsArrAngs6 = "var prdAngs6 = new Array();\n";
$jsArrSisa .= "var prdSisa = new Array();\n";

echo "
<form action='tambah-hutang.php' method='' enctype=''>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <b>&nbsp;Form Pembayaran Hutang&nbsp;</b>
			    </div>
		    </div>
		    <div class='modal-body'>
			    <table align='center'>
				    <tr>
					    <td>&nbsp;Nama Pemasok&nbsp;</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <select name='cmb_kd_supp' class='form-control' onchange='pilih1(this.value); cek()'>
							    <option disabled='' selected=''>Pilih</option>";
							    while($row = mysqli_fetch_array($qry_u))
							    {
								    echo "<option value='".$row['kode_utang'];."'>".$row['nama_pemasok'];."</option>";
								    $jsArrKode .= "prdKode['".$row['kode_utang']."'] = {kode: '".$row['kode_pemasok'];."'};\n";
							    }
							    echo "
						    </select>
					    </td>
					    <td>
						    <input type='text' id='txt_kd_supp' class='form-control' readonly />
					    </td>
				    </tr>
				    <tr>
					    <td>&nbsp;Tanggal&nbsp;</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td colspan='2'>
						    <select id='cmb_tanggal' name='cmb_tanggal' class='form-control' onchange='pilih2(this.value)'>
							    <option disabled='' selected=''>Pilih</option>";
							    $qry_u2 = mysqli_query($buka, "SELECT * FROM utang JOIN pembayaran ON pembayaran.kode_bayar = utang.kode_bayar WHERE utang.kode_utang = '$kd_u'");
							    while($row2 = mysqli_fetch_array($qry_u2))
							   {
								    $kd_u2 = $row2['kode_utang'];
								    $tgl = $row2['tanggal_hutang'];
								    $kd_byr = $row2['kode_bayar'];
								    $hr = $row2['hari'];
								    
								    //$tgl_u = $row2['tanggal_utang'];
								    $kd_byr = $row2['kode_bayar'];
								    $nm_byr = $row2['keterangan'];
								    $tgl_tempo = $row2['tanggal_tempo'];
								    $jmlh = $row2['jumlah'];
								    $tgl1 = $row2['tanggal1'];
								    $angs1 = $row2['angsuran1'];
								    $tgl2 = $row2['tanggal2'];
								    $angs2 = $row2['angsuran2'];
								    $tgl3 = $row2['tanggal3'];
								    $angs3 = $row2['angsuran3'];
								    $tgl4 = $row2['tanggal4'];
								    $angs4 = $row2['angsuran4'];
								    $tgl5 = $row2['tanggal5'];
								    $angs5 = $row2['angsuran5'];
								    $tgl6 = $row2['tanggal6'];
								    $angs6 = $row2['angsuran6']; 
								    $sisa = $jmlh - ($angs6 + $angs5 + $angs4 + $angs3 + $angs2 + $angs1);
								    $ket = $row2['keterangan'];
								
								    echo "<option value='$kd_u2'>$tgl</option>";
								    $jsArrKdBayar .= "prdKdBayar['$tgl'] = {nm_byr: '$nm_byr'};\n";								
								    $jsArrTglTempo .= "prdTglTempo['$tgl'] = {tempo: '".date('d', strtotime($tgl_tempo))."'};\n";
								    $jsArrJumlah .= "prdJumlah['$tgl'] = {jumlah: '$jmlh'};\n";
								    $jsArrTglAng1 .= "prdTglAng1['$tgl'] = {tgl1: '$tgl1'};\n";
								    $jsArrAngs1 .= "prdAngs1['$tgl'] = {angs1: '$angs1'};\n";
								    $jsArrTglAng2 .= "prdTglAng2['$tgl'] = {tgl2: '$tgl2'};\n";
								    $jsArrAngs2 .= "prdAngs2['$tgl'] = {angs2: '$angs2'};\n";
								    $jsArrTglAng3 .= "prdTglAng3['$tgl'] = {tgl3: '$tgl3'};\n";
								    $jsArrAngs3 .= "prdAngs3['$tgl'] = {angs3: '$angs3'};\n";
								    $jsArrTglAng4 .= "prdTglAng4['$tgl'] = {tgl4: '$tgl4'};\n";
								    $jsArrAngs4 .= "prdAngs4['$tgl'] = {angs4: '$angs4'};\n";
								    $jsArrTglAng5 .= "prdTglAng5['$tgl'] = {tgl5: '$tgl5'};\n";
								    $jsArrAngs5 .= "prdAngs5['$tgl'] = {angs5: '$angs5'};\n";
								    $jsArrTglAng6 .= "prdTglAng6['$tgl'] = {tgl6: '$tgl6'};\n";
								    $jsArrAngs6 .= "prdAngs6['$tgl'] = {angs6: '$angs6'};\n";
								    $jsArrSisa .= "prdSisa['$tgl'] = {sisa: '$sisa'};\n";
                                }
							    echo "
						    </select>
					    </td>
				    </tr>
				    <tr>
					    <td>Tempo</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td colspan='2'>
						    <input type='text' id='txt_kd_byr' class='form-control' readonly />
					    </td>
				    </tr>
				    <tr>
					    <td>&nbsp;Tanggal Tempo&nbsp;</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td colspan='2'>
						    <input type='text' id='txt_tgl_tempo' class='form-control' readonly />
					    </td>
				    </tr>
				    <tr>
					    <td>&nbsp;Jumlah Utang&nbsp;</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td colspan='2'>
						    <input type='text' id='txt_jumlah' class='form-control' readonly />
					    </td>
				    </tr>
				    <tr id='tr_ang1'>
					    <td>Angsuran 1</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs1' class='form-control' />
					    </td>					
					<td>
						<input type='date' id='txt_tgl1' class='form-control' maxlength='10' maxsize='10' />
					</td>
				    </tr>
				    <tr id='tr_ang2'>
					    <td>Angsuran 2</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs2' class='form-control' />
					    </td>					
					    <td>
						    <input type='date' id='txt_tgl2' class='form-control' maxlength='10' maxsize='10' />
					    </td>					
				    </tr>
				    <tr id='tr_ang3'>
					    <td>Angsuran 3</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs3' class='form-control' />
					    </td>					
					    <td>
						    <input type='date' id='txt_tgl3' class='form-control' maxlength='10' maxsize='10' />
					    </td>					
				    </tr>
				    <tr id='tr_ang4'>
					    <td>Angsuran 4</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs4' class='form-control' />
					    </td>					
					    <td>
						    <input type='date' id='txt_tgl4' class='form-control' maxlength='10' maxsize='10' />
					    </td>					
				    </tr>
				    <tr id='tr_ang5'>
					    <td>Angsuran5</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs5' class='form-control' />
					    </td>					
					    <td>
						    <input type='date' id='txt_tgl5' class='form-control' maxlength='10' maxsize='10' />
					    </td>					
				    </tr>
				    <tr>
					    <td>Angsuran 6</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td>
						    <input type='text' id='txt_angs6' class='form-control' />
					    </td>					
					    <td>
						    <input type='date' id='txt_tgl6' class='form-control' maxlength='10' maxsize='10' />
					    </td>					
				    </tr>
				    <tr>
					    <td>Sisa</td>
					    <td>&nbsp;:&nbsp;</td>
					    <td colspan='2'>
						    <input type='text' id='txt_sisa' class='form-control' readonly />
					    </td>
				    </tr>												
			    </table>
		    </div>
		    <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='Submit' value='Submit' class='btn btn-primary btn-icon-split'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php' class='btn btn-danger btn-icon-split'>
                </div>
		    </div>
	    </div>
    </div>
</form>";
?>

<script type='text/javascript'>
$(document).ready(function()
{
	//var cmb_dis = document.getElementById('cmb_tanggal');
	kunci();
});

function cek()
{
	var a = document.getElementById('txt_kd_supp').value;
	if(a == '')
	{
		kunci();
	}
	else
	{
		buka();
	}
}

function kunci()
{
	document.getElementById('cmb_tanggal').disabled = true;
}

function buka()
{
	document.getElementById('cmb_tanggal').disabled = false;
};

function pilih1(x)
{
	<?php echo $jsArrKode; ?>
	document.getElementById('txt_kd_supp').value = prdKode[x].kode; 
};

function pilih2(x)
{
	var a1 = document.getElementById('txt_angs1');
	var t1 = document.getElementById('txt_tgl1');
	var a2 = document.getElementById('txt_angs2');
	var t2 = document.getElementById('txt_tgl2');
	var a3 = document.getElementById('txt_angs3');
	var t3 = document.getElementById('txt_tgl3');
	var a4 = document.getElementById('txt_angs4');
	var t4 = document.getElementById('txt_tgl4');
	var a5 = document.getElementById('txt_angs5');
	var t5 = document.getElementById('txt_tgl5');
	var a6 = document.getElementById('txt_angs6');
	var t6 = document.getElementById('txt_tgl6');
	
	var tsisa = document.getElementById('txt_sisa');

	<?php echo $jsArrKdBayar ?>
	<?php echo $jsArrTglTempo; ?>	
	<?php echo $jsArrJumlah; ?>
	<?php echo $jsArrTglAng1; ?>
	<?php echo $jsArrAngs1; ?>
	<?php echo $jsArrTglAng2; ?>
	<?php echo $jsArrAngs2; ?>
	<?php echo $jsArrTglAng3; ?>
	<?php echo $jsArrAngs3; ?>
	<?php echo $jsArrTglAng4; ?>
	<?php echo $jsArrAngs4; ?>
	<?php echo $jsArrTglAng5; ?>
	<?php echo $jsArrAngs5; ?>
	<?php echo $jsArrTglAng6; ?>
	<?php echo $jsArrAngs6; ?>
	<?php echo $jsArrSisa; ?>

	document.getElementById('txt_kd_byr').value = prdKdBayar[x].nm_byr;
	document.getElementById('txt_tgl_tempo').value = prdTglTempo[x].tempo;
	document.getElementById('txt_jumlah').value = prdJumlah[x].jumlah;
	
	a1.value = prdAngs1[x].angs1;
	t1.value = prdTglAng1[x].tgl1;
	if(a1.value != null)
	{
	    a1.disabled = true;
	}
	
	a2.value = prdAngs2[x].angs2;
	t2.value = prdTglAng2[x].tgl2;
	
	a3.value = prdAngs3[x].angs3;
	t3.value = prdTglAng3[x].tgl3;
	
	a4.value = prdAngs4[x].angs4;
	t4.value = prdTglAng4[x].tgl4;
	
	a5.value = prdAngs5[x].angs5;
	t5.value = prdTglAng5[x].tgl5;
	
	a6.value = prdAngs6[x].angs6;
	t6.value = prdTglAng6[x].tgl6;
	
	tsisa.value = prdSisa[x].sisa;
};
</script>";