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
<form action='tambah-customer.php' method='POST' name='form-tambah-data-customer' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font size='3'><b>&nbsp;FORM DATA PELANGGAN&nbsp;</b></font>
                </div>
            </div>
            <div class="modal-body">
                <table align="center">
                    <tr>
                        <td colspan='3' align='center'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_pelanggan' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align='center'><span id='pesan'></span></td>
                    </tr>                    
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_nama_pelanggan' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='30' rows='5' id='txt_alamat_pelanggan' class='form-control'></textarea>
                        </td>
                    <tr>
                    <tr>
                        <td>Alamat Pengiriman</td>
                        <td>&nbsp;:&nbsp;
                        <td>
                            <textarea cols='30' rows='5' id='txt_alamat_pengiriman' class='form-control'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Penagihan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='30' rows='5' id='txt_alamat_penagihan' class='form-control'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>&nbsp;:&nbsp;
                        <td>
                            <input type='text' id='txt_telp' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Handphone;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_mobile' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_fax' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_email' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div align="center">
                    <input type='submit' name='Submit' value='Submit' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php' class='btn btn-default'>
                </div>
            </div>
        </div>
    </div>
</form>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
$(document).ready(function()
{
    $('#txt_kode_pelanggan').focus(function()
    {
        $('#pesan').html('');        
    });

    $('#txt_kode_pelanggan').blur(function()
    {

        var kodepelanggan = $('#txt_kode_pelanggan').val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_pelanggan.php',
            data : 'txt_kode_pelanggan='+kodepelanggan,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
});
</script>