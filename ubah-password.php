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

if (isset($_SESSION['user']))
{
	$usr = $dsa['user'];
}
else 
{
	die ('Error. No Kode Selected! ');	
}

include 'config/koneksi.php';
$cek = mysqli_query($buka, "SELECT * FROM karyawan WHERE user='$usr'" );
$dtu = mysqli_fetch_array($cek);

    $kd_usr = $dtu['kode_user'];
    $user = $dtu['user'];
    $pass = $dtu['password'];
    $tmp_pass = $dtu['temp_pass'];
    $lvl = $dtu['kode_level'];
    $nm_usr = $dtu['nama_karyawan'];
    $tgl_lhr = $dtu['tanggal_lahir'];
    $gndr = $dtu['jenis_kelamin'];
    $nik = $dtu['nik'];
    $alamat = $dtu['alamat'];
    $status = $dtu['status'];
    $hp1 = $dtu['no_hp1'];
    $hp2 = $dtu['no_hp2'];


if(isset($_POST['txt_simpan']))
{
	//$kd_usr1 = $kd_usr;
	//$user1 = $user;
	$pass1 = md5($_POST['txt_pass_lama']);
	$n_pass1 = md5($_POST['txt_pass_new1']);
	$n_pass2 = md5($_POST['txt_pass_new2']);
	$tmp_pass1 = $_POST['txt_pass_new1'];
	//$lvl = $lvl;
	//$nm_usr1 = $nm_usr;
	//$tgl_lhr1 = $tgl_lhr;
	//$gndr1 = $gndr;
	//$nik1 = $nik;
	//$alamat1 = $alamat;
	//$status1 = $status;
	//$hp11 = $hp1;
	//$hp21 = $hp2;
	
	//update password di tabel karyawan
	$upd_u = 
	"UPDATE karyawan
	SET kode_user = '$kd_usr',
	user = '$user',
	password = '$n_pass1',
	temp_pass = '$tmp_pass1',
	kode_level = '$lvl',
	nama_karyawan = '$nm_usr',
	tanggal_lahir = '$tgl_lhr',
	jenis_kelamin = '$gndr',
	nik = '$nik',
	alamat = '$alamat',
	status = '$status',
	no_hp1 = '$hp1',
	no_hp2 = '$hp2'
	WHERE kode_user = '$kd_usr'";
	
	if( $pass == $pass1 )
	{
		if ($n_pass1 == $n_pass2)
		{
			
			mysqli_query($buka, $upd_u);

			echo "<script>alert('Password sudah dirubah')</script>";
			echo "<script>document.location='home.php'</script>";
		}
		else
		{
			echo "<script>alert('Password baru tidak sama')</script>";
			echo "<script>document.location='home.php?page=pengguna-ubah-pass'</script>";
		}
	}
	else 
	{
	    echo "<script>alert(' Password lama tidak sama')</script>";
	    echo "<script>document.location='home.php?page=pengguna-ubah-pass'</script>";
	}
	
}

echo "
<form action='#' method='post' enctype='multipart/form-data' >
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE;' >
                    <h4><b>Ubah Password</b></h4>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td>Password Lama</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='password' id='txt_pass_lama' name='txt_pass_lama' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Password Baru</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='password' id='txt_pass_new1' name='txt_pass_new1' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                        <td>
                            <input type='password' id='txt_pass_new2' name='txt_pass_new2' class='form-control' />
                        </td>
                    </tr>
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='txt_simpan' value='Simpan' class='btn btn-primary' />
                    <a href='home.php' class='btn btn-default'>Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>";

?>