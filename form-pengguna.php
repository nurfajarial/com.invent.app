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
<form action='tambah-pengguna.php' method='post' name='form-tambah-data-user' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <center><font><b>&nbsp;FORM DATA PENGGUNA&nbsp;</b></font></center>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_user' name= 'txt_user' required class='form-control' >&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>&nbsp;&nbsp;<span id='pesan'>&nbsp;&nbsp;</span></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_password' name='txt_password' required class='form-control' >
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <div>
                                <select id='cmb_level' name='cmb_level' required class='form-control'>
                                    <option value=''>- pilih -</option>
                                    <option value='1'>Admin</option>
                                    <option value='2'>Manager</option>
                                    <option value='3'>Gudang</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_nama' name='txt_nama'required class='form-control' >
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_lahir' name='txt_tgl_lahir' class='form-control' />
                        </td>
                    <tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_seks' name='cmb_seks' class='form-control'>
                                <option selected='selected' disabled='disabled'>- pilih -</option>
                                <option value='Pria'>Pria</option>
                                <option value='Wanita'>Wanita</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_nik' name='txt_nik' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_alamat' name='txt_area' class='form-control'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_status' name='cmb_status' class='form-control'>
                                <option>-pilih-</option>
                                <option value='Belum Kawin'>Belum Kawin</option>
                                <option value='Kawin'>Kawin</option>
                                <option value='Duda'>Duda</option>
                                <option value='Janda'>Janda</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>HP1</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_hp1' name='txt_hp1' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>HP2</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_hp2' name='txt_hp2' class='form-control' />
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
    $('#txt_user').focus(function()
    {
        $('#pesan').html('');
    });

    $('#txt_user').blur(function()
    {

        var username = $('#txt_user').val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_pengguna.php',
            data : 'txt_user='+username,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
    
});
</script>