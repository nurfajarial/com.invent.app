<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();
include 'config/koneksi.php';
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}


if (isset($_GET['kode_barang']) && isset($_GET['kode_lokasi']))
{
	$kode_barang = $_GET['kode_barang'];
    $kode_lokasi = $_GET['kode_lokasi'];
} 
else 
{
	die ('Error. No Kode Selected! ');	
}
//Tampilkan data dari tabel barang
	//$query = $sql = mysqli_query($buka, "SELECT * FROM barang a, lokasi b, satuan c, stok d WHERE d.kode_barang = '$kode_barang' and d.kode_lokasi = '$kode_lokasi'");
    $query = $sql = mysqli_query($buka, "SELECT * FROM stok JOIN barang ON barang.kode_barang = stok.kode_barang JOIN lokasi ON lokasi.kode_lokasi = stok.kode_lokasi JOIN satuan ON satuan.kode_satuan = stok.kode_satuan WHERE stok.kode_barang = '$kode_barang' AND stok.kode_lokasi = '$kode_lokasi'");
	$hasil = mysqli_fetch_array ($query);
	//$kode_barang = $hasil['kode_barang'];
	//$lokasi = $hasil['kode_lokasi'];
    $nama_lokasi = $hasil['nama_lokasi'];
    $stok_awal = $hasil['stok_awal'];
    $min_stok = $hasil['min_stok'];
    $total = $hasil['total'];
	$satuan = $hasil['kode_satuan'];
    $nama_satuan = $hasil['nama_satuan'];

//proses edit data barang
if (isset($_POST['Edit']))
{
	$kode_barang1 = $_POST['cmb_barang'];
	$lokasi1 = $_POST['cmb_lokasi'];
    $stok_awal1 = $_POST['txt_stok_awal'];
    $min_stok1 = $_POST['txt_min_stok'];
    $total1 = $_POST['txt_total'];
	$satuan1 = $_POST['cmb_satuan'];

	//update data
	$update = "UPDATE stok
	SET
    kode_barang='$kode_barang1',
    kode_lokasi='$lokasi1',
    stok_awal='$stok_awal1',
    min_stok='$min_stok1',
    total='$total1',
    kode_satuan='$satuan1'
	WHERE
	kode_barang = '$kode_barang' and kode_lokasi = '$kode_lokasi'";
	$sql = mysqli_query ($buka, $update);

    //setelah berhasil update
	if ($sql) 
	{
		echo "<script>alert('Data berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=stok-lihat'</script>";
	}
	else 
	{
		echo "<script>alert('Data gagal diedit')</script>";
		echo "<script>document.location='home.php?page=stok-lihat'</script>";
	}
}

echo "
<form action='#' method='POST' name='ubah-data-stok' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <b>UBAH STOK</b>
                </div>
            </div>
            <div class='modal-body'>
				<table border='0' align='center' cellpadding='0' cellspacing='0'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_barang' name='cmb_barang' class='form-control' >
                                <option value='".$kode_barang."' selected='selected' >".$kode_barang."</option>";
                                $data1 = mysqli_query($buka, "SELECT * FROM barang order by kode_barang");
                                while($dt_b = mysqli_fetch_array($data1, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_b['kode_barang']."'>".$dt_b['kode_barang']."|".$dt_b['merk']."</option>";
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Lokasi</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_lokasi' name='cmb_lokasi' class='form-control' >
                                <option value='".$kode_lokasi."' selected='selected' >".$nama_lokasi."</option>
                                <option>- pilih - </option>";
                                $data2 = mysqli_query($buka, "SELECT * FROM lokasi order by kode_lokasi");
                                while($dt_g = mysqli_fetch_array($data2, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$dt_g['kode_lokasi']."' >".$dt_g['nama_lokasi']."</option>";
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok Awal</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_stok_awal' name='txt_stok_awal' class='form-control' value='".$stok_awal."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Minimal Stok</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_min_stok' name='txt_min_stok' class='form-control' value='".$min_stok."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_total' name='txt_total' maxlength='15' class='form-control' value='".$total."' >
                        </td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_satuan' name='cmb_satuan' class='form-control' >
                                <option value='".$satuan."' selected='selected'>".$nama_satuan."</option>
                                <option disabled='disabled'>- pilih -</option>";
                                $data3 = mysqli_query($buka, "SELECT * FROM satuan");
                                while( $row = mysqli_fetch_array($data3, MYSQLI_BOTH))
                                {
                                    echo "<option value='".$row['kode_satuan']."'>".$row['nama_satuan']."</option>";    
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
					<tr>
						<td colspan='3' height=''>&nbsp;</td>
					</tr>
                </table>
            </div>                    
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
				    <input type='button' value='Cancel' onclick=location.href='home.php?page=stok-detil&&kode_barang=".$kode_barang."&&kode_lokasi=".$kode_lokasi."' title='kembali ke lihat data barang' class='btn btn-default'>
                </div>
            </div>
        </div>
    </div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
?>