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
if (isset($_GET['kode_pemasok']))
{
    $kode_pemasok = $_GET['kode_pemasok'];
}
else
{
    die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel supplier
$query = mysqli_query($buka, "SELECT * FROM pemasok WHERE kode_pemasok='$kode_pemasok' order by kode_pemasok");
$hasil = mysqli_fetch_array($query);
$kode_pemasok = $hasil['kode_pemasok'];
$nama_pemasok = $hasil['nama_pemasok'];
$alamat_pemasok = $hasil['alamat_pemasok'];
$npwp = $hasil['npwp'];
$kontak = $hasil['kontak'];
$email = $hasil['email'];
$telp = $hasil['telp'];
$hp = $hasil['hp'];
$rek1 = $hasil['rek1'];
$rek2 = $hasil['rek2'];
$rek3 = $hasil['rek3'];

//proses edit data supplier
if (isset($_POST['Edit']))
{
    //
    $kode_pemasok1 = $_POST['txt_kode_pemasok'];
    $nama_pemasok1 = $_POST['txt_nama_pemasok'];
    $alamat_pemasok1 = $_POST['txt_alamat_pemasok'];
    $npwp1 = $_POST['txt_npwp'];
    $kontak1 = $_POST['txt_kontak'];
    $email1 = $_POST['txt_email'];
    $telp1 = $_POST['txt_telp'];
    $hp1 = $_POST['txt_hp'];
    $rek11 = $_POST['txt_rek1'];
    $rek21 = $_POST['txt_rek2'];
    $rek31 = $_POST['txt_rek3'];

    //update data
    $update = "UPDATE pemasok
    SET
    kode_pemasok = '$kode_pemasok1',
    nama_pemasok = '$nama_pemasok1',
    alamat_pemasok = '$alamat_pemasok1',
    npwp = '$npwp',
    kontak = '$kontak1',
    email = '$email1',
    telp = '$telp1',
    hp = '$hp',
    rek1 = '$rek11',
    rek2 = '$rek21',
    rek3 = '$rek31'
    WHERE
    kode_pemasok='$kode_pemasok'";
    $sql = mysqli_query($buka, $update);

    //setelah berhasil update
    if ($sql)
    {
        echo "<script>alert('Data berhasil dirubah')</script>";
        echo "<script>document.location='home.php?page=pemasok-lihat'</script>";
    }
    else
    {
        echo "<script>alert('Data gagal diedit')</script>";
        echo "<script>document.location='home.php?page=pemasok-lihat'</script>";
    }
}

echo "
<form action='#' method='POST' name='ubah-data-supplier' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font size='3'><b>FORM UBAH DATA PEMASOK</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td nowrap>&nbsp;Kode Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
              			<td>
                        	<input type='text' id='txt_kode_supplier' name='txt_kode_pemasok' maxsize='15' class='form-control' value='$kode_pemasok'>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap>&nbsp;Nama Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='text' id='txt_nama_supplier' name='txt_nama_pemasok' maxsize='30' class='form-control' value='$nama_pemasok'>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap>&nbsp;Alamat Pemasok</td>
                		<td>&nbsp;:&nbsp;</td>
                        <td>
                			<textarea id='txt_alamat_supplier' name='txt_alamat_pemasok' cols='20' class='form-control'>$alamat_pemasok</textarea>
                		</td>
                    </tr>
                    <tr>
                        <td>&nbsp;No. NPWP</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_npwp' name='txt_npwp' class='form-control' value='$hp' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;Kontak</td>
                		<td>&nbsp;:&nbsp;</td>
                        <td>
                			<input type='text' id='txt_kontak' name='txt_kontak' maxsize='20' class='form-control' placeholder='20 digit' value='$kontak'>
                		</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Email</td>
                		<td>&nbsp;:&nbsp;</td>
                        <td>
                			<input type='text' id='txt_email' name='txt_email' maxsize='30' class='form-control' value='$email'>
                		</td>
                    </tr>
                    <tr>
                        <td>&nbsp;Telephone</td>
                		<td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='text' id='txt_email' name='txt_telp' maxsize='20' class='form-control' value='$telp'>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;No. HP</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_hp' name='txt_hp' class='form-control' value='$hp' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;No Rekening 1&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_rek1' name='txt_rek1' maxsize='15' class='form-control' required value='$rek1' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;No Rekening 2&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_rek2' name='txt_rek2' maxsize='15' class='form-control' value='$rek2' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;No Rekening 3&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_rek3' name='txt_rek3' maxsize='15' class='form-control' value='$rek3' />
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
                    <input type='button' value='Cancel' onclick=location.href='home.php?page=pemasok-detil&&kode_pemasok=".$kode_pemasok."' title='kembali ke lihat data supplier' class='btn btn-default'>
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
        $('#txt_tgl_faktur').appendDtpicker(
        {
            'autodateOnStart': false,
            'dateFormat': 'DD-MM-YYYY',
            'dateOnly': true,
        });
    });

    $(function()
    {
        $('#txt_tgl_pelunasan').appendDtpicker(
        {
            'autodateOnStart': false,
            'dateFormat': 'DD-MM-YYYY',
            'dateOnly': true,
        });
    });

</script>
