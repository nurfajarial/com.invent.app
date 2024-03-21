<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';

echo "
<form action='tambah-tagihan.php' method='post' name='form-tambah-data-tagihan' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <center><font><b>&nbsp;FORM DATA TAGIHAN&nbsp;</b></font></center>
                </div>
            </div>
            <div class='modal-body'>
    			<table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
            		<tr>
            			<td colspan='3'>&nbsp;</td>
            		</tr>
					<tr>
            			<td>Kode Tagihan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='text' id='txt_kode_tagihan' name='txt_kode_tagihan' maxlength='15' class='form-control'>
                        </td>
            		</tr>                    
					<tr>
            			<td>Nama Pelanggan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<select id='cmb_pelanggan' name='cmb_pelanggan' class='form-control'>
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                $q_cus = mysqli_query($buka, "SELECT * FROM pelanggan");
                                while($dt_c = mysqli_fetch_array($q_cus, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_c['kode_pelanggan']."'>".$dt_c['nama_pelanggan']."</option>";
                                }
                            echo "
                            </select>
                        </td>
            		</tr>
            		<tr>
            			<td>Pembayaran</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<select id='cmb_pembayaran' name='cmb_pembayaran' class='form-control'>
                				<option selected='selected' disabled='disabled'>- pilih -</option>";
                                $q_byr = mysqli_query($buka, "SELECT * FROM pembayaran");
                                while($dt_byr = mysqli_fetch_array($q_byr, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_byr['kode_bayar']."'>".$dt_byr['keterangan']."</option>";
                                }
                                echo "
                			</select>
                        </td>
            		</tr>            		
            		<tr>
            			<td>Tanggal Tagihan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='date' id='txt_tgl_tagihan' name='txt_tgl_tagihan' class='form-control'>
                        </td>
            		</tr>
            		<tr>
            			<td>Tanggal Pelunasan</td>
                		<td>&nbsp;:&nbsp;</td>
                		<td>
                        	<input type='date' id='txt_tgl_pelunasan' name='txt_tgl_pelunasan' class='form-control'>
                        </td>
            		</tr>
            		<tr>
            		    <td>Jumlah</td>
            		    <td>&nbsp;:&nbsp;</td>
            		    <td>
            		        <input type='number' id='txt_jumlah' name='txt_jumlah' class='form-control' />
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

</script>
