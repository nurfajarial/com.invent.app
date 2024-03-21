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
            
if (isset($_GET['kode_user']))
{
    $kode_user = $_GET['kode_user'];
}
else
{
    die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel user
include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM karyawan JOIN level ON level.kode_level = karyawan.kode_level WHERE kode_user='$kode_user'");
$hasil = mysqli_fetch_array($query, MYSQLI_BOTH);
$kode_user = $hasil['kode_user'];
$user = $hasil['user'];
$pass = $hasil['temp_pass'];
$level = $hasil['kode_level'];
$nama = $hasil['nama_karyawan'];
$tgl_lahir = $hasil['tanggal_lahir'];
$kelamin = $hasil['jenis_kelamin'];
$nik = $hasil['nik'];
$alamat = $hasil['alamat'];
$status = $hasil['status'];
$hp1 = $hasil['no_hp1'];
$hp2 = $hasil['no_hp2'];

//proses edit data user
if (isset($_POST['Edit']))
{
    
    $kode_user1 = $kode_user;
    $user1  = $_POST['txt_user'];
    $pass1  = $_POST['txt_password'];
    $pwd = md5($pass1);
    $level1 = $_POST['cmb_level'];
    $nama1  = $_POST['txt_nama'];
    $tgl_lahir1 = $_POST['txt_tgl_lahir'];
    $kelamin1 = $_POST['cmb_seks'];
    $nik1 = $_POST['txt_nik'];
    $alamat1 = $_POST['txt_alamat'];
    $status1 = $_POST['cmb_status'];
    $hp11 = $_POST['txt_hp1'];
    $hp21 = $_POST['txt_hp2'];

    //update data
    $update = "UPDATE karyawan
    SET
    kode_user='$kode_user1',
    user='$user1',
    password='$pwd',
    temp_pass='$pass1',
    kode_level='$level1',
    nama_karyawan='$nama1',
    tanggal_lahir='$tgl_lahir1',
    jenis_kelamin='$kelamin1',
    nik='$nik1',
    alamat='$alamat1',
    status='$status1',
    no_hp1='$hp11',
    no_hp2='$hp21'
    WHERE
    kode_user='$kode_user'";
    
    //echo $update;
    $sql1 = mysqli_query($buka, $update);
    include 'audit/edit-pengguna.php';

    //setelah berhasil update
    if($sql1)
    {
        echo "<script>alert('Data User Berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=pengguna-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data User gagal diedit')</script>";
        echo "<script>document.location='home.php?page=pengguna-lihat'</script>";
    }

}

echo "
<form action='#' method='POST' name='ubah-pengguna' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font color='black' size='3' face='arial'><b>&nbsp;Ubah Data Pengguna&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td colspan='3' align='center'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_user' name='txt_user' required class='form-control' value='".$user."' />
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
                        <td>Password</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_password' name='txt_password' required class='form-control' value='".$pass."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <div>
                                <select id='cmb_level' name='cmb_level' required class='form-control'>";
                                    $query1 = mysqli_query($buka, "SELECT * FROM karyawan a, level b WHERE b.kode_level='".$level."'" );
                                    $hasil1 = mysqli_fetch_array($query1);
                                    $jns_level = $hasil1['jenis_level'];
                                    echo '<option value="'.$level.'">'.$jns_level.'</option>';
                                    echo "
                                    <option disabled='disabled'>- pilih -</option>
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
                            <input type='text' id='txt_nama' name='txt_nama' class='form-control' value='".$nama."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_lahir' name='txt_tgl_lahir' class='form-control' value='".$tgl_lahir."' />
                        </td>
                    <tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_seks' name='cmb_seks' class='form-control'>
                                <option value='$kelamin' selected='selected'>$kelamin</option>
                                <option value disabled='disabled'>- pilih -</option>
                                <option value='Pria'>Pria</option>
                                <option value='Wanita'>Wanita</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_nik' name='txt_nik' class='form-control' value='".$nik."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_alamat' name='txt_alamat' class='form-control' rows='5'>".$alamat."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_status' name='cmb_status' class='form-control'>
                                <option value='".$status."' selected='selected'>".$status."</option>
                                <option disabled='disabled'>- pilih -</option>
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
                            <input type='text' id='txt_hp1' name='txt_hp1' class='form-control' value='".$hp1."' />
                        </td>
                    </tr>
                    <tr>
                        <td>HP2</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_hp2' name='txt_hp2' class='form-control' value='".$hp2."' />
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>  
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <button type='submit' name='Edit' value='' class='btn btn-default glyphicon glyphicon-floppy-disk'></button>&nbsp;
                    <a href='home.php?page=pengguna-detil&&kode_user=".$kode_user."' title='kembali ke lihat data Pengguna' class='btn btn-default glyphicon glyphicon-repeat'></a>
                </div>
            </div>
        </div>
    </div>
</form>";


//Tutup koneksi engine MySQL
mysqli_close($buka);
?>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
$(document).ready(function()
{
    $('#txt_kode_barang').focus(function()
    {
        $('#pesan').html('');        
    });

    $('#txt_kode_barang').blur(function()
    {
        
        var kode_barang = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_barang.php',
            data : 'txt_kode_barang='+kode_barang,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
});
</script>