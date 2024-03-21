<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if(!isset($_SESSION['user']))
{
    //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';
if (isset($_GET['kode_mutasi_masuk']))
{
    $kode_mutasi_masuk = $_GET['kode_mutasi_masuk'];
}
else
{
    die ('Error. No Kode Selected! ');
}

$query1 = mysqli_query($buka, "SELECT * FROM temp_mutasi_masuk a, barang b, karyawan c WHERE kode_mutasi_masuk = '$kode_mutasi_masuk' AND b.kode_barang = a.kode_barang AND c.kode_user = a.kode_user");
$data1 = mysqli_fetch_array($query1);
$kode_mutasi_masuk = $data1['kode_mutasi_masuk'];
//$kode_masuk = substr($kode_mutasi_masuk,11);
$tgl_mutasi_masuk = $data1['tanggal_mutasi_masuk'];
$kode_barang = $data1['kode_barang'];
$nama_barang = $data1['nama_barang']; 
$jumlah_masuk = $data1['jumlah_masuk'];
$kode_pengirim = $data1['kode_user'];
$pengirim = $data1['nama_karyawan'];
$status_masuk = $data1['status_masuk'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_mutasi_masuk1 = $kode_mutasi_masuk;
    $tgl_mutasi_masuk1 = $_POST['txt_tgl_mutasi_masuk'];
    //$a_kode = 'MM-';
    $tgl_mutasi = date_create($tgl_mutasi_masuk1);
    //$b_kode = date_format($tgl_mutasi, 'dmY');
    //$c_kode = $kode_masuk;
    $all_kode = $kode_mutasi_masuk1;

    $kode_barang1 = $_POST['cmb_kode_barang'];
    $jumlah_masuk1 = $_POST['txt_jumlah_masuk'];
    $pengirim1 = $_POST['cmb_pengirim'];
    $status_masuk1 = $_POST['cmb_status'];

    if($_POST['cmb_status'] == 'Tunggu')
    {
        $update_mutasi_masuk = "UPDATE temp_mutasi_masuk
        SET kode_mutasi_masuk = '$all_kode',
        tanggal_mutasi_masuk = '$tgl_mutasi_masuk1',
        kode_barang = '$kode_barang1',
        jumlah_masuk = '$jumlah_masuk1',
        kode_user = '$pengirim1',
        status_masuk = '$status_masuk1'
        WHERE
        kode_mutasi_masuk = '$kode_mutasi_masuk1'";
        mysqli_query($buka, $update_mutasi_masuk);

        echo "<script>alert('data berhasil di update')</script>";
        echo "<script>document.location = 'home.php?page=mutasi-masuk-temp-detil&&kode_mutasi_masuk=$all_kode'</script>";
    }
    else
    {
        $query3 = mysqli_query($buka, "SELECT * FROM stok WHERE kode_barang = '$kode_barang1' and kode_lokasi = '1'");
        $data3 = mysqli_fetch_array($query3);
        $query4 = mysqli_query($buka, "SELECT * FROM stok WHERE kode_barang = '$kode_barang1' and kode_lokasi = '2'");
        $data4 = mysqli_fetch_array($query4);
        if($data3['kode_barang'] == null)
        {
            echo "<script>alert('Barang tidak ada')</script>";
            echo "<script>document.location='home.php?page=mutasi-masuk-temp-detil&&kode_mutasi_masuk=$all_kode'</script>";
        }
        else
        {
            //mengurangi jumlah di stok toko;
            $stok_akhir4 = $data4['total'];
            $stok_min2 = $data4['min_stok'];
            $total_stok_t = ($stok_akhir4 - $jumlah_masuk1);
            if($total_stok_t <= $stok_min2)
            {
                echo "<script>alert('Stok minimal tercapai')</script>";
                echo "<script>document.location='home.php?page=mutasi-masuk-temp-ubah&&kode_mutasi_masuk=$all_kode'</script>";
            }
            else
            {
                //update stok toko
                $upd_stok_t = "UPDATE stok
                SET total = '$total_stok_t'
                WHERE kode_barang = '$kode_barang1' and kode_lokasi = '2'";
                mysqli_query($buka, $upd_stok_t);

                //menambah stok gudang
                $stok_akhir3 = $data3['total'];
                $total_stok_g = ($stok_akhir3 + $jumlah_masuk1);
                $upd_stok_g = "UPDATE stok
                SET total = '$total_stok_g'
                WHERE kode_barang = '$kode_barang1' and kode_lokasi = '1'";
                mysqli_query($buka, $upd_stok_g);

                //menginput ke mutasi masuk
                $salin = "INSERT INTO mutasi_masuk
                (
        		kode_mutasi_masuk,
        		tanggal_mutasi_masuk,
        		kode_barang,
        		jumlah_masuk,
        		kode_user,
        		status_masuk
                )
                VALUES
                (
                '$all_kode',
                '$tgl_mutasi_masuk1',
                '$kode_barang1',
                '$jumlah_masuk1',
                '$pengirim1',
                '$status_masuk1'
                )";
                mysqli_query($buka, $salin);

                //menghapus mutasi sementara
                $hapus_data = "DELETE FROM temp_mutasi_masuk WHERE kode_mutasi_masuk='$all_kode'";
                mysqli_query($buka, $hapus_data);

                echo "<script>alert('mutasi di setujui dan stok berhasil di update')</script>";
                echo "<script>document.location='home.php?page=mutasi-masuk-lihat'</script>";
            }
        }
    }
}
?>
<form action='#' method='POST' name='ubah-data-temp-mutasi-masuk' enctype='multipart/form-data'>
	<div class='modal-dialog'>
	    <div class='modal-content'>
	        <div class='modal-header'>
	            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
	                <font><b>&nbsp;UBAH DATA MUTASI MASUK&nbsp;</b></font>
	            </div>
	        </div>
	        <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td height='36' colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Mutasi Masuk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_mutasi_masuk' name='txt_kode_mutasi_masuk' class='form-control' value="<?= $kode_mutasi_masuk ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_mutasi_masuk' name='txt_tgl_mutasi_masuk' class='form-control' value="<?= $tgl_mutasi_masuk ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id="cmb_kode_barang" name="cmb_kode_barang" class="form-control">
                                <option disabled='disabled'>- pilih -</option>
                                <option value='<?= $kode_barang ?>' selected='selected'><?= $kode_barang ?></option>
                                <?php
                                include 'config/koneksi.php';
                                $query_barang = "SELECT * FROM barang";
                                $hasil = mysqli_query($buka, $query_barang);
                                while($row_brg = mysqli_fetch_array($hasil, MYSQLI_BOTH))
                                {
                                    echo "<option value=".$row_brg['kode_barang'].">".$row_brg['kode_barang']."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_jumlah_masuk' name='txt_jumlah_masuk' class='form-control' value="<?= $jumlah_masuk ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Pengirim</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        <select id='cmb_pengirim' name='cmb_pengirim' class='form-control'>
                            <option disabled='disabled'>- pilih -</option>
                            <option value="<?= $kode_pengirim ?>" selected="selected"><?= $pengirim ?></option>
                            <?php
                            include 'config/koneksi.php';
                            $query = 'select * from karyawan';
                            $tampil = mysqli_query($buka, $query);
                            while ($hasil = mysqli_fetch_array($tampil, MYSQLI_BOTH))
                            {
                                $kode = stripslashes();
                                $nama = stripslashes ();
                                echo "<option value='".$hasil['kode_user']."'>".$hasil['nama_karyawan']."</option>";
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id="cmb_status" name="cmb_status" class="form-control">
                                <?php
                                echo "<option value=".$status_masuk."selected='selected'>".$status_masuk."</option>";
                                echo "<option disabled='disabled'>- pilih -</option>";
                                echo "<option value='Tunggu'>Tunggu</option>";
                                echo "<option value='OK'>OK</option>";
                                ?>
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
	                <input type='submit' name='Edit' value='Submit' class='btn btn-primary'>&nbsp;
	                <input type='button' value='Cancel' onclick=location.href='home.php?page=pesanan-masuk-detail&&kode_pesanan_masuk=<?= $kode_pesanan_masuk ?>' class='btn btn-default'>
	            </div>
	        </div>
	    </div>
	</div>
</form>