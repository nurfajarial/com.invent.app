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
if (isset($_GET['kd_byr']))
{
    $kd_byr = $_GET['kd_byr'];
}
else
{
    die ('Error. No Kode Selected! '); 
}
//Tampilkan data dari tabel

include 'config/koneksi.php';
$query = mysqli_query($buka, "SELECT * FROM pembayaran WHERE kode_bayar = '$kd_byr'");
$hasil = mysqli_fetch_array($query);
$kd_byr = $hasil['kode_bayar'];
$hari = $hasil['hari'];
$ket = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kd_byr1 = $_POST['txt_kode_bayar'];
    $hari1 = $_POST['txt_hari'];
    $ket1 = $_POST['txt_keterangan'];

    //update data
    $update = "UPDATE pembayaran
    SET kode_bayar = '$kd_byr1', hari = '$hari1', keterangan = '$ket1' WHERE kode_bayar = '$kd_byr'";

    $sql1 = mysqli_query($buka, $update);
    
    //setelah berhasil update
    if ($sql1)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=pembayaran-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data User gagal diedit')</script>";
        echo "<script>document.location='home.php?page=pengguna-ubah'</script>";
    }
}

echo "
<form action='#' method='POST' name='ubah-pembayaran' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM UBAH DATA PEMBAYARAN&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td height='' colspan='3' align='center'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Bayar</td>
                        <td>:</td>
                        <td>";
                            $cek_no = "SELECT kode_bayar from pembayaran ORDER BY kode_bayar";

                            echo "
                            <input type='text' id='txt_kode_bayar' name='txt_kode_bayar' class='form-control' value='".$kd_byr."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Hari</td>
                        <td>:</td>
                        <td>
                            <input type='text' id='txt_jumlah' name='txt_jumlah' class='form-control' value='".$hari."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_keterangan' name='txt_keterangan' class='form-control'>".$ket."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td height='' colspan='3' align='center'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>

                        </td>
                    </tr>                                        
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='Edit' value='Update' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=pembayaran-lihat&&kd_byr=".$kd_byr."' class='btn btn-default'>                
                </div>
            </div>
        </div>
    </div>
</form>";

?>