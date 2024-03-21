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

if(isset($_GET['kode_po']) && isset($_GET['sesi']))
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
    <form action='tambah-pembelian.php' method='post' enctype='multipart/form-data'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <table align='center'>
                        <tr bgcolor='#B0C4DE'>
                            <td height='36' colspan='3' align='center'>
                                <font><b>&nbsp;FORM TAMBAH DATA PEMBELIAN&nbsp;</b></font>
                            </td>
                        </tr>
                    <table>
                </div>
                <div class='modal-body'>
                    <table align='center'>
                        <tr>
                            <td>Kode Beli</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>";
                                date_default_timezone_set('Asia/Jakarta');
                                $b = substr($kode_po, 3, 8).$sesi;
                                $c = date('Hi');
                                $kd_beli = $b.'-'.$c;
                                echo "<input type='text' name='txt_kode_beli' readonly value='$kd_beli' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Kode Faktur</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><input type='text' id='txt_kode_faktur' name='txt_kode_faktur' class='form-control' /></td>
                        </tr>
                        <tr>
                            <td>Kode DO</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='text' id='txt_kode_do' name='txt_kode_do' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Kode Pemasok</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <select id='cmb_pemasok' name='cmb_pemasok' class='form-control' >";
                                    echo "<option></option>";
                                    $qry_supp = mysqli_query($buka, "SELECT * FROM pemasok");
                                    while($dt_bl = mysqli_fetch_array($qry_supp))
                                    {
                                        echo "<option value='".$dt_bl['kode_pemasok']."'>".$dt_bl['name']."</option>";
                                    }
                                    echo "
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Beli</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='date' id='txt_tanggal' name='txt_tanggal' class='form-control' required />
                            </td>
                        </tr>
                        <tr>
                            <td>Kode PO</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='text' name='txt_kode_po' value='$kode_po' class='form-control' />
                                <input type='hidden' name='txt_sesi' value='$sesi' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                               <div>
                                    <table align='center'>
                                        <thead>
                                            <tr bgcolor='#B0C4DE' align='center' height='36'>
                                                <td>Nama Barang</td>
                                                <td>Jumlah</td>
                                                <td>Harga</td>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                        $qry_pemb2 = mysqli_query($buka, "SELECT * FROM po_detail JOIN barang ON barang.kode_barang=po_detail.kode_barang WHERE kode_po='$kode_po' AND sesi='$sesi' AND status='OK'");
                                        while($daftar2 = mysqli_fetch_array($qry_pemb2))
                                        {
                                            $pemb_kd_brg = $daftar2['kode_barang'];
                                            $pemb_nm_brg = $daftar2['nama_barang'];
                                            $pemb_jml_brg = $daftar2['jumlah_beli'];
                                            echo "<tr><td><input type='hidden' name='txt_kdbrg[]' value='".$pemb_kd_brg."' />".$pemb_nm_brg."</td>";
                                            echo "<td align='center'><input type='text' name='txt_qtybrg[]' value='".$pemb_jml_brg."' class='form-control' readonly size='3'></td>";
                                            echo "<td><input type='text' name='txt_harga[]' class='form-control' value='0' onkeyup='kalkulasi()' /></td></tr>";
                                        }
                                        echo "
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>Jumlah Harga</td>
                        	<td>&nbsp;:&nbsp;</td>
                        	<td>
                        		<input type='text' id='txt_jml_harga' name='txt_jml_harga' class='form-control' />
                        	</td>
                        </tr>
                        <tr>
                        	<td>Diskon&nbsp;</td>
                        	<td>&nbsp;:&nbsp;</td>
                        	<td>
                        		<input type='text' id='txt_diskon' name='txt_diskon' class='form-control' onkeyup='diskon()' />
                        	</td>
                        </tr>                                                
                        <tr>
                            <td>Total Harga</td>
                            <td>&nbsp;:&nbsp</td>
                            <td>
                                <input type='text' id='txt_ttl_harga' name='txt_ttl_harga' class='form-control' />
                            </td>
                        </tr>                        
                        <tr>
                            <td>Pengirim</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <select id='cmb_pengirim' name='cmb_pengirim' class='form-control'>";
                                    echo "<option selected='selected' disabled='disabled'>- pilih -</option>";
                                    $query = 'select * from karyawan order by nama_karyawan';
                                    $tampil = mysqli_query($buka, $query);
                                    while ($dt_u = mysqli_fetch_array($tampil))
                                    {
                                        echo "<option value='".$dt_u['kode_user']."'>".$dt_u['nama_karyawan']."</option>";
                                    }
                                echo "
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <select id='cmb_bayar' name='cmb_bayar' class='form-control' onchange='document.getElementById(\"prod_name\").value = prdName[this.value]; hasil()'>
                                    <option></option>";
                                    include 'config/koneksi.php';
                                    $query2 = "SELECT * FROM pembayaran";
                                    $tampil2 = mysqli_query($buka, $query2);
                                    $nomor2 = 0;
                                    $jsArray = "var prdName = new Array();\n";
                                    while($dtbyr = mysqli_fetch_array($tampil2))
                                    {
                                        echo "
                                        <option value='".$dtbyr['kode_bayar']."'>".$dtbyr['keterangan']."</option>";
                                        $jsArray .= "prdName['" .$dtbyr['kode_bayar']. "'] = '".addslashes(".$dtbyr['hari'].")."';\n";
                                    }

                                echo "
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <input type='hidden' id='prod_name' name='prod_name' id='prod_name' class='form-control' readonly />
                                <script>";
                                    echo $jsArray;
                                    echo "
                                </script>
                            </td>
                        </tr>                        
                        <tr id='tr_tempo'>
                            <td>Tanggal Tempo</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='text' id='txt_tempo' name='txt_tempo' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>No Plat</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='text' id='txt_no_plat' name='txt_no_plat' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Supir</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <input type='text' id='txt_nama_supir' name='txt_nama_supir' class='form-control' />
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class='modal-footer'>
                    <div align='center'>
                        <input type='submit' name='Submit' value='Submit' class='btn btn-primary btn-icon-split'>&nbsp;
                        <input type='button' value='Cancel' onclick=location.href='home.php?page=pembelian-temp' class='btn btn-danger btn-icon-split'>
                    </div>
                </div>
            </div>
        </div>
    </form>";
?>

<script>
$(document).ready(function()
{
    document.getElementById('txt_jml_harga').value = 0;
    document.getElementById('txt_diskon').value = 0;
    document.getElementById('txt_ttl_harga').value = 0;
    hilang();
});

function muncul()
{
    document.getElementById('tr_tempo').style.visibility = 'visible';
}

function hilang()
{
    document.getElementById('tr_tempo').style.visibility = 'hidden';
}

function kalkulasi()
{
    var sum = 0;
    var qty = document.getElementsByName('txt_qtybrg[]');
    var cost = document.getElementsByName('txt_harga[]');
    for (var i = 0; i < cost.length; i++)
    {
        sum += parseFloat(cost[i].value) * parseFloat(qty[i].value);
    }
    document.getElementById('txt_jml_harga').value = sum;
    document.getElementById('txt_ttl_harga').value = sum;
}

function hasil()
{
    var a = new Date(document.getElementById('txt_tanggal').value);
	var b = document.getElementById('prod_name').value;
	var c = moment(a).format('MM/DD/YYYY');
    var d = moment(a).add(b, 'day').format('YYYY-MM-DD');
    document.getElementById('txt_tempo').value = d;
    muncul();
}

function diskon()
{
	var ttl_sum = 0;
	var jum = document.getElementById('txt_jml_harga').value;
	var disc = document.getElementById('txt_diskon').value;
	ttl_sum = (parseFloat(jum) - (parseFloat(jum) * parseFloat(disc)) / 100);
	document.getElementById('txt_ttl_harga').value = ttl_sum;
}

</script>
</html>
";
?>