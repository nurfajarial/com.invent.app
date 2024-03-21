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
if (isset($_GET['kode_modal']))
{
	$kode_modal = $_GET['kode_modal'];
}
else
{
	die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel modal
$query = mysqli_query($buka, "SELECT * FROM modal WHERE kode_modal='$kode_modal'");
$hasil = mysqli_fetch_array($query);
$kode_modal = $hasil['kode_modal'];
$kode_beli = $hasil['kode_beli'];
$kode_barang = $hasil['kode_barang'];
$tgl = $hasil['tanggal'];
$hrg_beli = $hasil['harga_beli'];
$tgl_jual1 = $hasil['tanggal_jual1'];
$hrg_jual1 = $hasil['harga_jual1'];
$tgl_jual2 = $hasil['tanggal_jual2'];
$hrg_jual2 = $hasil['harga_jual2'];
$tgl_jual3 = $hasil['tanggal_jual3'];
$hrg_jual3 = $hasil['harga_jual3'];

//proses edit data user
if (isset($_POST['Edit']))
{
	//$urut = $_POST['no_urut'];
    $kode_modal1 = $_POST['txt_kode_modal'];
    $kode_beli1 = $_POST['txt_kode_beli'];
	$kode_barang1 = $_POST['txt_kode_barang'];
	$nama_barang1 = $_POST['txt_nama_barang'];
	$tgl1 = $_POST['txt_tgl_beli'];
	$hrg_beli1 = $_POST['txt_hrg_beli'];
	$tgl_jual11 = $_POST['txt_tgl_jual1'];
	$hrg_jual11 = $_POST['txt_hrg_jual1'];
	$tgl_jual21 = $_POST['txt_tgl_jual2'];
	$hrg_jual21 = $_POST['txt_hrg_jual2'];
	$tgl_jual31 = $_POST['txt_tgl_jual3'];
	$hrg_jual31 = $_POST['txt_hrg_jual3'];

	//update data
	$update = "UPDATE modal
	SET kode_modal='$kode_modal1',
	kode_beli='$kode_beli1',
	kode_barang='$kode_barang1',
	tanggal='$tgl1',
	harga_beli='$hrg_beli1',
	tanggal_jual1='$tgl_jual11',
	harga_jual1='$hrg_jual11',
	tanggal_jual2='$tgl_jual21',
	harga_jual2='$hrg_jual21',
	tanggal_jual3='$tgl_jual31',
	harga_jual3='$hrg_jual31'
	WHERE
	kode_modal='$kode_modal'";
	$sql = mysqli_query($buka, $update);

	//setelah berhasil update
	if ($sql)
	{
        echo "<script>alert('Data Modal Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=modal-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Data Modal gagal diedit')</script>";
        echo "<script>document.location='home.php?page=modal-ubah&&kode_modal=".$kode_modal."'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-modal' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font color='black' face='arial'><b>Ubah Data Modal</b></font>
                </div>
		    </div>
		    <div class='modal-body'>
				<table align='center'>
					<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
						<tr>
							<td colspan='3'></td>
						</tr>
			            <tr>
			                <td>&nbsp;Kode Modal</td>
			                <td>&nbsp;:&nbsp;</td>
			        		<td>
			                    <input id='txt_kode_modal' name='txt_kode_modal' class='form-control' value='".$kode_modal."' readonly />
			                </td>
			            </tr>
			            <tr>
			                <td>&nbsp;Kode Beli</td>
			                <td>&nbsp;:&nbsp;</td>
			                <td>
			                	<input id='txt_kode_beli' name='txt_kode_beli' class='form-control' value='".$kode_beli."' readonly />
			                </td>
			            </tr>
			    		<tr>
			        		<td>&nbsp;Kode Barang&nbsp;</td>
			        		<td>&nbsp;:&nbsp;</td>
			        		<td>
			                    <input id='txt_kode_barang' name='txt_kode_barang' class='form-control' value='".$kode_barang."' readonly />
			                </td>
			    		</tr>
						<tr>
							<td>&nbsp;Tanggal Beli&nbsp;</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='text' id='txt_tgl_beli' name='txt_tgl_beli' class='form-control' value='".$tgl."' readonly />
							</td>
						</tr>
						<tr>
							<td>&nbsp;Harga Beli</td>
			        		<td>&nbsp;:&nbsp;</td>
							<td>
			                    <input type='text' id='txt_hrg_beli' name='txt_hrg_beli' class='form-control' value='$hrg_beli' readonly />
			                </td>
						</tr>
						<tr>
							<td>&nbsp;Tanggal Harga Jual 1&nbsp;</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='date' id='txt_tgl_jual1' name='txt_tgl_jual1' class='form-control' value='$tgl_jual1' />
							</td>
						</tr>
						<tr>
							<td>&nbsp;Harga Jual 1</td>
			        		<td>&nbsp;:&nbsp;</td>
							<td>
			                    <input type='text' id='txt_hrg_jual1' name='txt_hrg_jual1' class='form-control' value='".$hrg_jual1."' onkeyup='hrg_1()' />
			                </td>
			                <td>
			                	<input type='text' id='txt_p_harga1' class='form-control' onkeyup='prsn1()' maxlength='4' size='4' />
			                </td>
						</tr>
						<tr>
							<td>&nbsp;Tanggal Harga Jual 2&nbsp;</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='date' id='txt_tgl_jual2' name='txt_tgl_jual2' class='form-control' value='".$tgl_jual2."' />
							</td>
						</tr>
						<tr>
							<td>&nbsp;Harga Jual 2</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='text' id='txt_hrg_jual2' name='txt_hrg_jual2' class='form-control' value='".$hrg_jual2."' onkeyup='hrg_2()' />
							</td>
							<td>
								<input type='text' id='txt_p_harga2' class='form-control' onkeyup='prsn2()' maxlength='4' size='4' />
							</td>
						</tr>
						<tr>
							<td>&nbsp;Tanggal Harga Jual 3&nbsp;</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='date' id='txt_tgl_jual3' name='txt_tgl_jual3' class='form-control' value='".$tgl_jual3."' />
							</td>
						</tr>
						<tr>
							<td>&nbsp;Harga Jual 3</td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<input type='text' id='txt_hrg_jual3' name='txt_hrg_jual3' class='form-control' value='".$hrg_jual3."' onkeyup='hrg_3()' />
							</td>
							<td>
								<input type='text' id='txt_p_harga3' class='form-control' onkeyup='prsn3()' maxlength='4' size='4' />
							</td>
						</tr>
			            <tr>
			                <td colspan='3'>&nbsp;</td>
			            </tr>
					</table>
				</table>
		    </div>
		    <div class='modal-footer'>
			    <div align='center'>
		    	    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
		    	    <input type='button' value='Cancel' onclick=location.href='home.php?page=modal-lihat&&kode_modal=".$kode_modal."' class='btn btn-default'>
		        </div>
		    </div>
	    </div>
    </div>
</form>
";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>

<script>
$(document).ready(function()
{

	var x = document.getElementById('txt_p_harga1').value = 10.5;
	var y = document.getElementById('txt_p_harga2').value = 12.5;
	var z = document.getElementById('txt_p_harga3').value = 15;

	var b1 = document.getElementById('txt_hrg_beli').value;
	var a = document.getElementById('txt_hrg_jual1').value;
	var b = document.getElementById('txt_hrg_jual2').value;
	var c = document.getElementById('txt_hrg_jual3').value;

	if( a == 0 )
	{
		var hj1 = (b1 * x)/100;
		var hjx1 = parseInt(b1) + parseInt(hj1);
		document.getElementById('txt_hrg_jual1').value = hjx1;
	}

	if( b == 0 )
	{
		var hj2 = (b1 * y)/100;
		var hjx2 = parseInt(b1) + parseInt(hj2);
		document.getElementById('txt_hrg_jual2').value = hjx2;
	}

	if( c == 0 )
	{
		var hj3 = (b1 * z)/100;
		var hjx3 = parseInt(b1) + parseInt(hj3);
		document.getElementById('txt_hrg_jual3').value = hjx3;
	}
});


function prsn1()
{
	var x = document.getElementById('txt_p_harga1').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hjx1 = 0;
	var hj1 = (b1 * x)/100;
	var hjx1 = parseInt(b1) + parseInt(hj1);
	document.getElementById('txt_hrg_jual1').value = hjx1;
}

function prsn2()
{
	var y = document.getElementById('txt_p_harga2').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hjx2 = 0;
	var hj2 = (b1 * y)/100;
	var hjx2 = parseInt(b1) + parseInt(hj2);
	document.getElementById('txt_hrg_jual2').value = hjx2;	
}

function prsn3()
{
	var z = document.getElementById('txt_p_harga3').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hjx3 = 0;
	var hj3 = (b1 * z)/100;
	var hjx3 = parseInt(b1) + parseInt(hj3);
	document.getElementById('txt_hrg_jual3').value = hjx3;	
}

function hrg_1()
{
	var a = document.getElementById('txt_hrg_jual1').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hrg_n1 = 0;
	var pj1 = parseInt(a) - parseInt(b1);
	var hrg_n1 = (pj1 * 100) / parseInt(b1) ;
	document.getElementById('txt_p_harga1').value = hrg_n1;
}

function hrg_2()
{
	var b = document.getElementById('txt_hrg_jual2').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hrg_n2 = 0;
	var pj2 = parseInt(b) - parseInt(b1);
	var hrg_n2 = (pj2 * 100) / parseInt(b1);
	document.getElementById('txt_p_harga2').value = hrg_n2;
}

function hrg_3()
{
	var c = document.getElementById('txt_hrg_jual3').value;
	var b1 = document.getElementById('txt_hrg_beli').value;

	var hrg_n3 = 0;
	var pj3 = parseInt(c) - parseInt(b1);
	var hrg_n3 = (pj3 * 100) / parseInt(b1);
	document.getElementById('txt_p_harga3').value = hrg_n3;
}
</script>