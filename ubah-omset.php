<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}
?>
<?php
include 'config/koneksi.php';
if (isset($_GET['kode_omset']))
{
    $kode_omset = $_GET['kode_omset'];
}
else
{
    die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel omset
include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM omset WHERE kode_omset='$kode_omset'");
$hasil = mysqli_fetch_array($query);
$kode_omset = $hasil['kode_omset'];
$tanggal = $hasil['tanggal'];
$bulan = $hasil['bulan'];
$tahun = $hasil['tahun'];
$jumlah = $hasil['jumlah'];
$harga = $hasil['harga'];

//proses edit data omset
if (isset($_POST['Edit']))
{
//
    $kode_omset1 = $_POST['txt_kode_omset'];
	$tanggal1 = $_POST['txt_tanggal'];
	$bulan1 = $_POST['txt_bulan'];
	$tahun1 = $_POST['txt_tahun'];
	$jumlah1 = $_POST['txt_jumlah'];
	$harga1 = $_POST['txt_harga'];

	//update data
	$update = "UPDATE omset
	SET kode_omset='$kode_omset1',
	tanggal='$tanggal1',
	bulan='$bulan1',
	tahun='$tahun1',
	jumlah='$jumlah1',
	harga='$harga1'
	WHERE
	kode_omset='$kode_omset'";
	$sql1 = mysqli_query($buka, $update);

	//setelah berhasil update
	if ($sql1)
	{
    	echo "<script>alert('Data Omset Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=omset-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Data Omset gagal diedit')</script>";
		echo "<script>document.location='home.php?page=omset-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-omset' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <font color='black' face='arial'><b>&nbsp;UBAH DATA OMSET&nbsp;</b></font>
			    </div>
		    </div>
		    <div class='modal-body'>
				<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
	                <tr>
	                	<td colspan='3'>&nbsp;</td>
	                </tr>
					<tr>
						<td>Kode Omset</td>
	                    <td>&nbsp;:&nbsp;</td>
						<td>
	                    	<input type='text' id='txt_kode_omset' name='txt_kode_omset' class='form-control' maxlength='15' value='".$kode_omset."' />
	                    </td>
					</tr>
	    			<tr>
	        			<td>Tanggal</td>
	        			<td>&nbsp;:&nbsp;</td>
	        			<td>
	                    	<input type='text' id='txt_tanggal' name='txt_tanggal' class='form-control' maxlength='2' value='".$tanggal."' />
	                    </td>
	    			</tr>
					<tr>
						<td>Bulan</td>
	        			<td>&nbsp;:&nbsp;</td>
						<td>
	                    	<input type='text' id='txt_bulan' name='txt_bulan' class='form-control' maxlength='2' value='".$bulan."' />
	                    </td>
					</tr>
					<tr>
						<td>Tahun</td>
	        			<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='text' id='txt_tahun' name='txt_tahun' class='form-control' maxlength='4' value='".$tahun."' />
	                    </td>
					</tr>
					<tr>
						<td>Jumlah</td>
	        			<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='text' id='txt_jumlah' name='txt_jumlah' class='form-control' maxlength='10' value='".$jumlah."' />
	                    </td>
					</tr>
	                <tr>
						<td>Harga</td>
	        			<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='text' id='txt_harga' name='txt_harga' class='form-control' maxlength='10' value='".$harga."' />
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
	                <input type='button' value='Cancel' onclick=location.href='home.php?page=omset-detil&&kode_omset=".$kode_omset."' title='kembali ke lihat data Omset' class='btn btn-default'>
	            </div>
	        </div>
	    </div>
    </div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>

<script>
$(function()
{
	$('#txt_tanggal').datepicker(
	{
		dateFormat: 'dd',
		changeMonth: false,
		changeYear: false,
		showButtonPanel: true,
	})
	
	.focus(function ()
	{
		$('.ui-datepicker-year').hide();
		$('.ui-datepicker-month').hide();
	}).attr('readonly', false);
});
	
$(function() 
{ 
  	$('#txt_bulan').datepicker( 
	{
    	changeMonth: true,
    	changeYear: false,
    	showButtonPanel: true,
    	closeText:'Pilih',
    	currentText: 'Bulan ini',
		onClose: function(dateText, inst)
		{
			var month = $('#ui-datepicker-div .ui-datepicker-month :selected').val();
			$(this).val($.datepicker.formatDate('mm', new Date(1, month, 1)));
		}
  	});
			
	.focus(function () 
	{
    	$('.ui-datepicker-year').hide();
    	$('.ui-datepicker-calendar').hide();
    	$('.ui-datepicker-current').hide();
    	/*$('.ui-datepicker-close').hide();*/
    	/*$('.ui-datepicker-prev').hide();*/
    	/*$('.ui-datepicker-next').hide();*/
    	$('#ui-datepicker-div').position(
		{
      		my: 'left top',
      		at: 'left bottom',
      		of: $(this)
    	});
	}).attr('readonly', false);
});
	
$(function() 
{ 
  	$('#txt_tahun').datepicker( 
	{
   		yearRange: 'c-100:c',
    	changeMonth: false,
    	changeYear: true,
    	showButtonPanel: true,
    	closeText:'Pilih',
    	currentText: 'Tahun ini',
    	onClose: function(dateText, inst) 
		{
      		var year = $('#ui-datepicker-div .ui-datepicker-year :selected').val();
      		$(this).val($.datepicker.formatDate('yy', new Date(year, 0, 1)));
    	}
  	})
			
	.focus(function () 
	{
    	$('.ui-datepicker-month').hide();
    	$('.ui-datepicker-calendar').hide();
    	$('.ui-datepicker-current').hide();
    	/*$('.ui-datepicker-close').hide();*/
    	$('.ui-datepicker-prev').hide();
    	$('.ui-datepicker-next').hide();
    	$('#ui-datepicker-div').position(
		{
      		my: 'left top',
      		at: 'left bottom',
      		of: $(this)
    	});
	}).attr('readonly', false);
});
</script>