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

echo "
<form action='tambah-omset.php' method='post' name='form-tambah-data-omset' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <center><font size='3'><b>&nbsp;FORM OMSET&nbsp;</b></font></center>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
            		<tr>
            			<td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>Kode Omset</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_omset' name='txt_kode_omset' maxlength='15' class='form-control'>
                        </td>
                    </tr>
		            <tr>
            			<td>Tanggal</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>&nbsp;<input type='text' id='txt_tanggal' name='txt_tanggal' maxlength='2' class='form-control'>&nbsp;</td>
                    </tr>
                    <tr>
            			<td>Bulan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                		    <input type='text' id='txt_bulan' name='txt_bulan' maxlength='2' class='form-control'>
                		</td>
                    </tr>
                    <tr>
            			<td>Tahun</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='text' id='txt_tahun' name='txt_tahun' maxlength='4' class='form-control'>
                        </td>
                    </tr>
                    <tr>
            			<td>Jumlah</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                		    <input type='text' name='txt_jumlah' maxlength='10' class='form-control'>
                		</td>
                    </tr>
                    <tr>
            			<td>Harga</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                		    <input type='text' name='txt_harga' maxlength='10' class='form-control'>
                		</td>
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

<script>
$(function()
{
	$('#txt_tanggal').datepicker(
	{
		dateFormat: 'dd',
		changeMonth: true,
		changeYear: false,
		showButtonPanel: true,
	})
	
	.focus(function()
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
  	})
		
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
	})
	.attr('readonly', false);
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
    	},
    	beforeShow: function(input, inst)
		{
      		if ($(this).val()!='')
			{
        		var tmpyear = $(this).val();
        		$(this).datepicker('option','defaultDate',new Date(tmpyear, 0, 1));
     		}
   		}
  	})
	
	.focus(function() 
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
	})
	.attr('readonly', false);
});

$(document).ready(function()
{
	// KETIKA ISI DARI FIEL 'Nama' BERUBAH MAKA ......
	$('#txt_nama_supplier').change(function()
	{
    	// AMBIL isi dari fiel Nama masukkan ke variabel 'kodefromfield'
		var namafromfield1 = $('#txt_nama_supplier').val();
    		// Memulai ajax
		$.ajax(
		{
        	method: 'POST',
        	// file PHP yang akan merespon ajax
			url: 'ajaxresponse_supplier_order.php',
			// data POST yang akan dikirim
        	data: {nama_supplier: namafromfield1}
    	})
        // KETIKA PROSES Ajax Request Selesai
		.done(function( hasilajax1 )
		{
			// Isikan hasil dari ajak ke field 'kode'
			$('#txt_kode_supplier').val(hasilajax1);

        });
 	})
});
</script>
