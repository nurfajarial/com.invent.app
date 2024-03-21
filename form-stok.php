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
<form action='tambah-stok.php' method='post' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                     <font><b>&nbsp;FORM TAMBAH DATA STOK&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_barang' name='cmb_barang' class='form-control'>
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                include 'config/koneksi.php';
                                $data1 = mysqli_query($buka, "SELECT * FROM barang WHERE status = '1'");
                                while($dt_b = mysqli_fetch_array($data1, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_b['kode_barang']."'>".$dt_b['kode_barang']."</option>";
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Lokasi</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_lokasi' name='cmb_lokasi' class='form-control'>
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                include 'config/koneksi.php';
                                $data2 = mysqli_query($buka, "SELECT * FROM lokasi order by kode_lokasi");
                                while($dt_g = mysqli_fetch_array($data2, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_g['kode_lokasi']."'>".$dt_g['nama_lokasi']."</option>";
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok Awal</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_stok_awal' name='txt_stok_awal' class='form-control'>
                        </td>
                    </tr>
                    <tr>
                        <td>Minimal Stok</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_min_stok' name='txt_min_stok' class='form-control'>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_total' name='txt_total' class='form-control'>
                        </td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_satuan' name='cmb_satuan' class='form-control'>
                                <option selected='selected' disabled='disabled'>- pilih- </option>";
                                include 'config/koneksi.php';
                                $data3 = mysqli_query($buka, "SELECT * FROM satuan order by kode_satuan");
                                while($dt_s = mysqli_fetch_array($data3, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_s['kode_satuan']."'>".$dt_s['nama_satuan']."</option>";
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