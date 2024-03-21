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
if (isset($_GET['kode_retur']))
{
	$kode_retur = $_GET['kode_retur'];
}
else
{
	die ('Error. No Kode Selected! ');
}

//Tampilkan data dari tabel retur
$query = mysqli_query($buka, "SELECT * FROM retur JOIN barang ON barang.kode_barang = retur.kode_barang JOIN pelanggan ON pelanggan.kode_pelanggan = retur.kode_pelanggan WHERE kode_retur='$kode_retur'");
$hasil = mysqli_fetch_array($query);
$kd_retur = $hasil['kode_retur'];
$tgl_retur = $hasil['tanggal_retur'];
$kd_faktur = $hasil['kode_faktur'];
$kd_brg = $hasil['kode_barang'];
$nm_brg = $hasil['nama_barang'];
$kd_cus = $hasil['kode_pelanggan'];
$nm_cus = $hasil['nama_pelanggan'];
$kd_usr = $hasil['kode_user'];
$jumlah = $hasil['jumlah'];
$status = $hasil['status'];
$keterangan = $hasil['keterangan'];

//proses edit data user
if (isset($_POST['Edit']))
{
	//
	$kd_retur1 = $_POST['txt_kd_retur'];
	$tgl_retur1 = $_POST['txt_tgl_retur'];
	$kd_beli1 = $_POST['cmb_kd_beli'];
	$kd_brg1 = $_POST['cmb_kd_brg'];
    $kd_supp1 = $_POST['txt_nm_supp'];
	$kd_cust1 = $_POST['txt_nm_cust'];
	$penerima1 = $_POST['txt_penerima'];
	$jumlah1 = $_POST['txt_jumlah'];
    $harga1 = $_POST['txt_harga'];
    $status1 = $_POST['r_button'];
	$keterangan1 = $_POST[''];

	//update data
	$update = "UPDATE retur
	SET kode_retur = '$kode_retur1',
	tanggal_retur = '$tgl_retur1',
	kode_faktur = '$kode_faktur1',
	kode_barang = '$kode_barang1',
	nama_barang = '$nama_barang1',
	kode_customer = '$kode_customer1',
	nama_customer = '$nama_customer1',
	penerima = '$penerima1',
	jumlah = '$jumlah1',
	keterangan = '$keterangan1'
	WHERE
	kode_retur='$kode_retur'";
	$sql = mysqli_query($buka, $update);

	//setelah berhasil update
	if ($sql)
	{
        echo "<script>alert('Data Retur Berhasil dirubah')</script>";
		echo "<script>document.location='home.php?page=retur-lihat'</script>";
	}
	else
	{
		echo "<script>alert('Data Retur gagal diedit')</script>";
		echo "<script>document.location='home.php?page=retur-lihat'</script>";
	}
}

echo "
<form method='post' name='form-tambah-data-retur' enctype='multipart/form-data'> 
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b><center>&nbsp;UBAH DATA RETUR&nbsp;</center></b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table align='center'>
                    <tr>
                        <td>Jenis Retur</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='center'>
                            <input type='radio' name='r_button' id='r_button_R' checked class='form-check-input' onclick='ret_nor()' />
                            Retur
                            <input type='radio' name='r_button' id='r_button_F' class='form-check-input' onclick='ret_fktr()' />
                            Faktur
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Retur</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kd_retur' name='txt_kd_retur' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Retur</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_retur' name='txt_tgl_retur'  class='form-control' />
                        </td>
                    </tr>
                    <tr id='tr_kdbeli'>
                        <td>Kode Beli</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select name='cmb_kd_beli' id='cmb_kd_beli' class='form-control' onchange='opsi_kdbeli(this.value)' >
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                    include 'config/koneksi.php';
                                    $query = mysqli_query($buka, "SELECT * FROM pembelian JOIN pemasok ON pemasok.kode_pemasok = pembelian.kode_pemasok");
                                    while($p = mysqli_fetch_array($query, MYSQLI_BOTH))
                                    {
                                        echo "<option value='".$p['kode_po']."'>".$p['kode_beli']."</option>";
                                        $jsArrSup .= "prdSup['".$p['kode_po']."'] = {sup: '".$p['nama_pemasok']."'};\n";
                                        $jsArrHrg .= "prdHrg['".$p['kode_po']."'] = {hrg: '".$p['jumlah']."'};\n";
                                    }
                                    echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select name='cmb_kd_brg' id='cmb_kd_brg' class='form-control' >
                                <option selected='selected' disabled='disabled'>- pilih -</option>
                            </select>
                        </td>
                    </tr>
                    <tr id='tr_kdsup'>
                        <td>Nama Pemasok</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input id='txt_nm_supp' name='txt_nm_supp' class='form-control' readonly />
                            <script>";
                            echo $jsArrSup;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='txt_nm_cust' name='txt_nm_cust' class='form-control' />
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                    $q_cus = mysqli_query($buka, "SELECT * FROM pelanggan");
                                    while($pa = mysqli_fetch_array($q_cus))
                                    {
                                        echo "<option value='".$pa['kode_pelanggan']."'>".$pa['nama_pelanggan']."</option>";
                                    }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Penerima</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='txt_penerima' name='txt_penerima' class='form-control' >
                                <option value='' selected='selected' disabled='disabled'>- pilih -</option>";
                                    $q_usr = mysqli_query($buka, "SELECT * FROM karyawan");
                                    while($pb = mysqli_fetch_array($q_usr))
                                    {
                                        echo "<option value='".$pb['kode_user']."'>".$pb['nama_karyawan']."</option>";
                                    }
                                    echo "
                            </select>
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
                        <td>Harga</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_harga' name='txt_harga' class='form-control' readonly />
                            <script>";
                                echo $jsArrHrg;
                                echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea id='txt_ket' name='txt_ket' class='form-control'></textarea>
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
                    <input type='button' value='Cancel' onclick=location.href='home.php' class='btn btn-default'>               
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
	$('#txt_tgl_retur').datepicker({dateFormat: 'dd-mm-yy'});
});

$(function()
{
   	$( '#txt_nama_barang' ).autocomplete(
	{
		minLength: 3,
   		source: 'ambil_data_barang.php'
	});
});

$(function()
{
   	$( '#txt_nama_customer' ).autocomplete(
	{
		minLength: 3,
   		source: 'ambil_data_customer.php'
	});
});

$(document).ready(function()
{
	// KETIKA ISI DARI FIEL 'Nama' BERUBAH MAKA ......
	$('#txt_nama_barang').change(function()
	{
  		// AMBIL isi dari fiel Nama masukkan ke variabel 'kodefromfield'
		var namafromfield2 = $('#txt_nama_barang').val();
  		// Memulai ajax
		$.ajax(
		{
    		method: 'POST',
    		// file PHP yang akan merespon ajax
			url: 'ajaxresponse_barang_retur.php',
			// data POST yang akan dikirim
    		data: {nama_barang: namafromfield2}
  		})
    // KETIKA PROSES Ajax Request Selesai
		.done(function( hasilajax2 )
		{
			// Isikan hasil dari ajak ke field 'kode'
			$('#txt_kode_barang').val(hasilajax2);

    	});
 	})
});

$(document).ready(function()
{
	// KETIKA ISI DARI FIEL 'Nama' BERUBAH MAKA ......
	$('#txt_nama_customer').change(function()
	{
  		// AMBIL isi dari fiel Nama masukkan ke variabel 'kodefromfield'
		var namafromfield1 = $('#txt_nama_customer').val();
  		// Memulai ajax
		$.ajax(
		{
    		method: 'POST',
    		// file PHP yang akan merespon ajax
			url: 'ajaxresponse_customer_retur.php',
			// data POST yang akan dikirim
    		data: {nama_customer: namafromfield1}
  		})
    // KETIKA PROSES Ajax Request Selesai
		.done(function( hasilajax1 )
		{
			// Isikan hasil dari ajak ke field 'kode'
			$('#txt_kode_customer').val(hasilajax1);

    	});
 	})
});
</script>