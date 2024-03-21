<?php
error_reporting (E_ALL ^ E_NOTICE);

session_start();
//cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}
?>

<form action='' method='post' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center'>
                    <font><bPESANAN&nbsp;</b></font>
                </div>
            </div>
            <div class='modal'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Beli</td>
                        <td>:</td>
                        <td><input type="text" id="txt_kode_beli" class="form-control"></td>
                        <td><label id="err_kodebeli" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Tanggal Beli</td>
                        <td>:</td>
                        <td><input type="text" id="txt_tgl_beli" class="form-control"></td>
                        <td><label id="err_tgl_beli" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>:</td>
                        <td>
                            <select id="cmb_kode_barang" name="cmb_kode_barang[]" multiple class="form-control">
                                <?php
                                include 'config/koneksi.php';
                                $qry_brg = 'SELECT * FROM barang';
                                $list_cmb1 = mysqli_query($buka, $qry_brg);
                                echo "<option value=''></option>";
                                while ($row_kd1 = mysqli_fetch_array($list_cmb1, MYSQLI_BOTH)) {
                                    $kd_brg = stripslashes($row_kd1['kode_barang']);
                                    $nm_brg = stripslashes($row_kd1['nama_barang']);
                                    echo "<option value='$kd_brg'>$nm_brg</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><label id="err_cmb_barang" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Kode Pemasok</td>
                        <td>:</td>
                        <td>
                            <select id="cmb_kode_pemasok" class="form-control">
                                <?php
                                include 'config/koneksi.php';
                                $qry_supp = 'SELECT * FROM pemasok';
                                $list_cmb2 = mysqli_query($buka, $qry_supp);
                                echo "<option></option>";
                                while ($row_kd2 = mysqli_fetch_array($list_cmb2, MYSQLI_BOTH)) {
                                    $kd_sup = stripslashes($row_kd2['kode_pemasok']);
                                    $nm_sup = stripslashes($row_kd2['nama_pemasok']);
                                    echo "<option value='$kd_sup'>$nm_sup</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><label id="err_cmb_pemasok" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pelunasan</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txt_tgl_pelunasan" class="form-control">
                        </td>
                        <td><label id="err_txt_tglpelunasan" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Jenis Pembayaran</td>
                        <td>:</td>
                        <td>
                            <select id="cmb_jenispembayaran" class="form-control">
                                <?php
                                include 'config/koneksi.php';
                                $qry_byr = 'SELECT * FROM pembayaran';
                                $list_cmb3 = mysqli_query($buka, $qry_byr);
                                echo "<option></option>";
                                while ($row_kd3 = mysqli_fetch_array($list_cmb3, MYSQLI_BOTH)) {
                                    $kd_byr = stripslashes($row_kd3['kode_pembayaran']);
                                    $nm_byr = stripslashes($row_kd3['jenis_pembayaran']);
                                    echo "<option value='$kd_byr'>$nm_byr</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><label id="err_jnspembayaran" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txt_jumlah_beli" class="form-control">
                        </td>
                        <td><label id="err_jumlahbeli" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <select id="cmb_status_beli" class="form-control">
                                <option></option>
                                <option value="Tunggu">Tunggu</option>
                                <option value="OK">OK</option>
                            </select>
                        </td>
                        <td><label id="err_txt_jumlahbeli" class="error"></label></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <textarea id="txt_ket" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>
                            <input type='submit' name='Submit' value='Submit' class='button'>&nbsp;
                            <input type='button' value='Cancel' onclick=location.href='home.php' class=''>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>

            </form>
            <script type="text/javascript">
                $(function() {
                    $('#txt_tgl_beli').appendDtpicker(
                        {
                            'autodateOnStart': false,
                            'dateFormat': 'YYYY-MM-DD',
                            'dateOnly': true,
                        });
                });

                $(function() {
                    $('#txt_tgl_pelunasan').appendDtpicker(
                        {
                            'autodateOnStart': false,
                            'dateFormat': 'YYYY-MM-DD',
                            'dateOnly': true,
                        });
                });

                $(document).ready(function() {
                    $('#cmb_kode_barang').select2(
                        {
                            placeholder: "pilih barang",
                            allowClear: yes,
                            language: id
                        });
                });
            </script>