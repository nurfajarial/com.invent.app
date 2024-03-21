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
<form action='' method='' enctype=''>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <center><font size='3'><b>&nbsp;Form DO&nbsp;</b></font></center></td>
                </div>
		    </div>
		    <div class='modal-body'>
			    <table align='center'>
				    <tbody>
					    <tr>
						    <td>Kode DO</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <select id='cmb_kd_do' name='cmb_kd_do' class='form-control'>
								    <option value='' disabled='disabled' selected='selected'>- pilih -</option>";
								    $qry_sale = mysqli_query($buka, "SELECT * FROM penjualan");
								    while($dt = mysqli_fetch_array($qry_sale))
								    {
									    echo "<option value='".$dt['kode_jual']."'>".$dt['kode_jual']."</option>";
								    }	
								    echo "
							    </select>
						    </td>
					    </tr>
					    <tr>
						    <td>Tanggal DO</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <input type='date' id='txt_tgl_do' name='txt_tgl_do' class='form-control' />
						    </td>
					    </tr>
					    <tr>
						    <td>Kode Barang</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <select id='cmb_kd_brg' name='cmb_kd_brg' class='form-control'>
								    <option value='' selected='selected'>- pilih -</option>";
								    $qry_brg = mysqli_query($buka, "SELECT do_detail.kode_barang FROM do_detail  WHERE do_detail.kode_do = '$kd_do'");
								    while($dt2 = mysqli_fetch_array($qry_brg))
								    {
									    echo "<option value='".$dt2['kode_barang']."'>".$dt2['nama_barang']."</option>";
								    }
								    echo "
							    </select>
						    </td>
					    </tr>
					    <tr>
						    <td>Kode Pelanggan</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <select id='cmb_kd_cust' name='cmb_kd_cust' class='form-control'>
								    <option value='' selected='selected'>- pilih -</option>
							    </select>
						    </td>
					    </tr>
					    <tr>
						    <td>Alamat</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <textarea id='txt_alamat' name='txt_alamat' class='form-control'>

							    </textarea>
						    </td>
					    </tr>
					    <tr>
						    <td>Plat</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <input type='text' id='txt_plat' name='txt_plat' class='form-control' />
						    </td>
					    </tr>
					    <tr>
						    <td>Supir</td>
						    <td>&nbsp;:&nbsp;</td>
						    <td>
							    <input type='text' id='txt_supir' name='txt_supir' class='form-control' />
						    </td>
					    </tr>
					    <tr>
						    <td>&nbsp;</td>
					    </tr>
				    </tbody>
			    </table>
		    </div>
		    <div class='modal-footer'>
			    <div align='center'>
				    <a class='btn btn-primary'>Submit</a>
				    <a href='home.php' class='btn btn-default'>Cancel</a>
			    </div>
		    </div>
	    </div>
    </div>
</form>
";
?>