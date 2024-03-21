<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

echo "
<form action='tambah-pemasok.php' method='POST' name='form-tambah-data-supplier' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font size='3'><b>&nbsp;FORM DATA PEMASOK&nbsp;</b></font>
			    </div>
		    </div>
		    <div class='modal-body'>
				<table align='center'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td nowrap>Kode Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
			  			<td>
                        	<input type='text' id='txt_kode_pemasok' class='form-control'>
                        </td>
					</tr>
					<tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
						<td align='center'><span id='pesan'></span></td>
					</tr>
					<tr>
						<td nowrap>Nama Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                        	<input type='text' id='txt_nama_supplier' class='form-control'>
                        </td>
					</tr>
					<tr>
						<td nowrap>Alamat Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                			<textarea id='txt_alamat_supplier' cols='20' class='form-control'></textarea>
                		</td>
					</tr>
					<tr>
						<td>No. NPWP</td>
						<td>&nbsp;:&nbsp</td>
						<td>
							<input type='text' id='txt_npwp' class='form-control' />
						</td>
					</tr>
					<tr>
						<td>Sales</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                			<input type='text' id='txt_kontak' class='form-control'>
                		</td>
					</tr>
					<tr>
						<td>Email</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                			<input type='text' id='txt_email' class='form-control'>
                		</td>
					</tr>
					<tr>
						<td>Telephone</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                        	<input type='text' id='txt_email' class='form-control'>
                        </td>
					</tr>
					<tr>
						<td>HP</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input type='text' id='txt_hp' class='form-control' />
						</td>
					</tr>
					<tr>
						<td>Rekening</td>
						<td>&nbsp;:&nbsp;</td>
						<td>
							<input id='txt_rek1' class='form-control' />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>
							<input id='txt_rek2' class='form-control' />
						</td>
					</tr>
                    <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>					
                    	<td>
							<input id='txt_rek3' class='form-control' />
						</td>
                    </tr>
					<tr>
						<td colspan='3'>&nbsp;</td>
					<tr>
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
<script>
$(document).ready(function()
{
	$('#txt_kode_pemasok').focus(function()
	{
        $('#pesan').html('');		
	});

    $('#txt_kode_pemasok').blur(function()
    {

        var kodepemasok = $('#txt_kode_pemasok').val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_pemasok.php',
            data : 'txt_kode_pemasok='+kodepemasok,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
});
</script>