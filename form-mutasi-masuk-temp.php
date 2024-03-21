<?php
include 'config/koneksi.php';
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
<form action='tambah-mutasi-masuk-temp.php' method='post' name='form-mutasi-masuk-temp' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM MUTASI MASUK&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                    	<td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>Kode Mutasi Masuk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>";
                            date_default_timezone_set('Asia/Jakarta');
                            //$no = date("Hi");
                            echo "
                        	<input type='text' id='txt_kode_mutasi_masuk' name='txt_kode_mutasi_masuk' class='form-control' value=''>
                        </td>
                    </tr>
                    <tr>
                    	<td>Tanggal Masuk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='date' id='txt_tgl_mutasi_masuk' name='txt_tgl_mutasi_masuk' class='form-control' required='required'>
                        </td>
                    </tr>
                    <tr>
                    	<td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        	<select id='cmb_kode_barang' name='cmb_kode_barang' class='form-control' required='required'>
                        	    <option selected='selected' disabled='disabled'>- pilih -</option>";
                                $q_brg = mysqli_query($buka, "SELECT * FROM barang");
                                while($dt_b = mysqli_fetch_array($q_brg, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_b['kode_barang']."'>".$dt_b['kode_barang']."</option>";
                                }
                                echo "
                        	</select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Jumlah</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='number' id='txt_jumlah_masuk' name='txt_jumlah_masuk' class='form-control' required='required'>
                        </td>
                    </tr>
                    <tr>
                    	<td>Pengirim</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_pengirim' name='cmb_pengirim' class='form-control' required='required'>
                            	<option selected='selected' disabled='disabled'>- pilih -</option>";
                                $q_usr = mysqli_query($buka, "SELECT * FROM karyawan");
                                while ($dt_u = mysqli_fetch_array($q_usr, MYSQLI_BOTH))
                                {
                                	echo "<option value='".$dt_u['kode_user']."'>".$dt_u['nama_karyawan']."</option>";
                                }
                                echo "
                            </select>
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

<script>
window.setTimeout("waktu()", 1000);

function waktu()
{
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    var a = document.getElementById("txt_kode_mutasi_masuk");
    a.value = moment(waktu).format('H') + moment(waktu).minutes();   
}
</script>
