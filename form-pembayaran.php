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
// Cek Kode
if (isset($_GET['kode_po']) && isset($_GET['sesi']))
{
    $kode_po = $_GET['kode_po'];
    $sesi = $_GET['sesi'];
    $kd_brg = $_GET['l_kd_brg'];
    $qry_pemb1 = mysqli_query($buka, "SELECT * FROM po_detail WHERE kode_po='$kode_po' AND sesi='$sesi'")or die(mysqli_error);;
    while($daftar1 = mysqli_fetch_assoc($qry_pemb1))
    {
        $tgl_pemb = $daftar1['tanggal'];

    }
}

echo "
<form action='tambah-pembayaran.php' method='post'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM TAMBAH DATA PEMBAYARAN&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td height='' colspan='3' align='center'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Jumlah Hari</td>
                        <td>:</td>
                        <td>
                            <input type='text' id='txt_hari' name='txt_hari' class='form-control' placeholder='jumlah hari dalam angka' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align='center'>    
                            <span id='pesan'></span>&nbsp;&nbsp;
                        </td>
                    </tr>                                        
                    <tr>
                        <td>Keterangan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_keterangan' name='txt_keterangan' class='form-control'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td height='' colspan='3' align='center'>&nbsp;</td>
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
    $('#txt_hari').focus(function()
    {
        $('#pesan').html('');        
    });

    $('#txt_hari').blur(function()
    {
        
        var hari = $(this).val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_hari_bayar.php',
            data : 'txt_hari='+hari,
            success : function(data)
            {
                $('#pesan').html(data);
            }
        });
       
    });
});
</script>