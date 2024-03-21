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
<form action='tambah-satuan.php' method='post' enctype='multipart/form-data'>
    <div class='modal-dialog'>
 	    <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM TAMBAH DATA UNIT&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
				<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
						<td>Kode Unit</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                        	<input type='text' id='txt_kode_satuan' class='form-control' >
                        </td>
					</tr>
					<tr align='center'>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>
					        <span id='pesan'></span>
					    </td>
					</tr>
					<tr>
						<td>Nama Unit/Satuan</td>
                		<td>&nbsp;:&nbsp;</td>
						<td>
                        	<input type='text' id='txt_nama_satuan' class='form-control' >
                        </td>
					</tr>
            		<tr>
                		<td>Keterangan</td>
                		<td>&nbsp;:&nbsp;</td>
              			<td>
                        	<textarea cols='50' rows='6' id='txt_ket' class='form-control' ></textarea>
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
<script>
$(document).ready(function()
{
    $('#txt_kode_satuan').focus(function()
    {
        $('#pesan').html('');        
    });

    $('#txt_kode_satuan').blur(function()
    {
        
        var kodesatuan = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_satuan.php',
            data : 'txt_kode_satuan='+kodesatuan,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
});
</script>