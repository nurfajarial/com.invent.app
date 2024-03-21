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
if (isset($_GET['kode_mutasi_keluar']))
{
    $kode_mutasi_keluar = $_GET['kode_mutasi_keluar'];
}
else
{
    die ('Error. No Kode Selected! ');
}

$query1 = mysqli_query($buka, "SELECT * FROM temp_mutasi_keluar a, barang b, karyawan c WHERE kode_mutasi_keluar = '$kode_mutasi_keluar' AND b.kode_barang = a.kode_barang AND c.kode_user = a.kode_user");
$data1 = mysqli_fetch_array($query1);
$kode_mutasi_keluar = $data1['kode_mutasi_keluar'];
//$kode_keluar = substr($kode_mutasi_keluar,11);
$tgl_mutasi_keluar = $data1['tanggal_mutasi_keluar'];
$kode_barang = $data1['kode_barang'];
$nama_barang = $data1['nama_barang'];
$jumlah_keluar = $data1['jumlah_keluar'];
$kode_pengambil = $data1['kode_user'];
$pengambil = $data1['nama_karyawan'];
$status_keluar = $data1['status_keluar'];

//proses edit data user
if (isset($_POST['Edit']))
{
    $kode_mutasi_keluar1 = $kode_mutasi_keluar;
    $tgl_mutasi_keluar1 = $_POST['txt_tgl_mutasi_keluar'];
    //$a_kode = 'MK-';
    $tgl_mutasi = date_create($tgl_mutasi_keluar1);
    //$b_kode = date_format($tgl_mutasi, 'dmY');
    //$c_kode = $kode_keluar;
    $all_kode = $kode_mutasi_keluar1;

    $kode_barang1 = $_POST['cmb_kode_barang'];
    $jumlah_keluar1 = $_POST['txt_jumlah_keluar'];
    $pengambil1 = $_POST['cmb_pengambil'];
    $status_keluar1 = $_POST['cmb_status'];

    if($_POST['cmb_status'] == 'Tunggu')
    {
        $update_mutasi_keluar = "UPDATE temp_mutasi_keluar
        SET kode_mutasi_keluar = '$all_kode',
        tanggal_mutasi_keluar = '$tgl_mutasi_keluar1',
        kode_barang = '$kode_barang1',
        jumlah_keluar = '$jumlah_keluar1',
        kode_user = '$pengambil1',
        status_keluar = '$status_keluar1'
        WHERE
        kode_mutasi_keluar = '$kode_mutasi_keluar1'";
        mysqli_query($buka, $update_mutasi_keluar);

        echo "<script>alert('data berhasil di update')</script>";
        echo "<script>document.location = 'home.php?page=mutasi-keluar-temp-detil&&kode_mutasi_keluar=$all_kode'</script>";
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
            //mengurangi jumlah di stok gudang;
            $stok_akhir3 = $data3['total'];
            $stok_min1 = $data3['min_stok'];
            $total_stok_g = ($stok_akhir3 - $jumlah_keluar1);
            if($total_stok_g <= $stok_min1)
            {
                echo "<script>alert('Stok minimal tercapai')</script>";
                echo "<script>document.location='home.php?page=mutasi-keluar-temp-ubah&&kode_mutasi_keluar=$all_kode'</script>";
            }
            else
            {
                //update stok gudang
                $upd_stok_g = "UPDATE stok
                SET total = '$total_stok_g'
                WHERE kode_barang = '$kode_barang1' and kode_lokasi = '1'";
                mysqli_query($buka, $upd_stok_g);

                //menambah stok toko
                $stok_akhir4 = $data4['total'];
                $total_stok_t = ($stok_akhir4 + $jumlah_keluar1);
                $upd_stok_t = "UPDATE stok
                SET total = '$total_stok_t'
                WHERE kode_barang = '$kode_barang1' and kode_lokasi = '2'";
                mysqli_query($buka, $upd_stok_t);

                //menginput ke mutasi keluar
                $salin = "INSERT INTO mutasi_keluar
                (
        		kode_mutasi_keluar,
        		tanggal_mutasi_keluar,
        		kode_barang,
        		jumlah_keluar,
        		kode_user,
        		status_keluar
                )
                VALUES
                (
                '$all_kode',
                '$tgl_mutasi_keluar1',
                '$kode_barang1',
                '$jumlah_keluar1',
                '$pengambil1',
                '$status_keluar1'
                )";
                mysqli_query($buka, $salin);

                //menghapus mutasi sementara
                $hapus_data = "DELETE FROM temp_mutasi_keluar WHERE kode_mutasi_keluar='$all_kode'";
                mysqli_query($buka, $hapus_data);

                echo "<script>alert('mutasi di setujui dan stok berhasil di update')</script>";
                echo "<script>document.location='home.php?page=mutasi-keluar-lihat'</script>";
            }
        }
    }
}
?>

<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                <font><b>&nbsp;UBAH DATA MUTASI KELUAR&nbsp;</b></font>
            </div>
        </div>
        <div class='modal-body'>
            <form action='#' method='POST' name='ubah-data-temp-mutasi-keluar' enctype='multipart/form-data'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td height='36' colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Mutasi Keluar</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_mutasi_keluar' name='txt_kode_mutasi_keluar' class='form-control' value="<?= $kode_mutasi_keluar ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Keluar</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tgl_mutasi_keluar' name='txt_tgl_mutasi_keluar' class='form-control' value="<?= $tgl_mutasi_keluar ?>">
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
                                while($dt_brg = mysqli_fetch_array($hasil, MYSQLI_BOTH))
                                {
                                    echo "<option value=".$dt_brg['kode_barang'].">".$dt_brg['kode_barang']."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_jumlah_keluar' name='txt_jumlah_keluar' class='form-control' value="<?= $jumlah_keluar ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Pengambil</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        <select id='cmb_pengambil' name='cmb_pengambil' class='form-control'>
                            <option disabled='disabled' >- pilih -</option>
                            <option value="<?= $pengambil ?>" selected="selected"><?= $pengambil ?></option>
                            <?php
                            include 'config/koneksi.php';
                            $query = 'select * from karyawan order by nama_karyawan';
                            $tampil = mysqli_query($buka, $query);
                            while ($dt_u = mysqli_fetch_array($tampil))
                            {
                                echo "<option value='".$dt_u['kode_user']."'>".$dt_u['nama_karyawan']."</option>";
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
                                echo "<option value=".$status_keluar."selected='selected'>".$status_keluar."</option>";
                                echo "<option value='Tunggu'>Tunggu</option>";
                                echo "<option value='OK'>OK</option>";
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>
                            <input type='submit' name='Edit' value='Submit' class='btn btn-primary'>&nbsp;
                            <input type='button' value='Cancel' onclick=location.href='home.php?page=pesanan-keluar-detail&&kode_pesanan_keluar=<?= $kode_pesanan_keluar ?>' class='btn btn-default'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                </table>
            </form>
        </div>
        <div class='modal-footer'>
            <div align='center'>

            </div>
        </div>
    </div>
</div>