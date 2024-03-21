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

$jsA = "var prdMerk = new Array();\n";
$jsB = "var prdModel = new Array();\n";
$jsC = "var prdTipe = new Array();\n";
$jsD = "var prdSeri = new Array();\n";
$jsE = "var prdUkuran = new Array();\n";
$jsF = "var prdJenis = new Array();\n";
$jsG = "var prdWarna = new Array();\n";

echo "
<form action='tambah-barang.php' method='post' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
                    <font><b>&nbsp;FORM DATA BARANG&nbsp;</b></font>
                </div>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td colspan='3'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Merk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_merk' name='cmb_merk' required='required' class='form-control' onchange='opsi_merk(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_merk = mysqli_query($buka, "SELECT * FROM merk_barang ORDER BY nama_merk ASC");
                                while($row1 = mysqli_fetch_array($qry_merk, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row1["kode_merk"]}'>{$row1["nama_merk"]}</option>";
                                    $jsA .= "prdMerk['".$row1['kode_merk']."'] = {merk: '".$row1['kode_merk']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_merk' name='txt_merk' />
                            <script>";
                            echo $jsA;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>&nbsp;:&nbsp;
                        <td>
                            <select id='cmb_model' name='cmb_model' required='required' required='required' class='form-control' onchange='opsi_model(this.value);kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_model = mysqli_query($buka, "SELECT * FROM model_barang ORDER BY nama_model ASC");
                                while($row2 = mysqli_fetch_array($qry_model, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row2["kode_model"]}'>{$row2["nama_model"]}</option>";
                                    $jsB .= "prdModel['".$row2['kode_model']."'] = {model: '".$row2['kode_model']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_model' name='txt_model' />
                            <script>";
                            echo $jsB;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipe</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_tipe' name='cmb_tipe' required='required' class='form-control' onchange='opsi_tipe(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_tipe = mysqli_query($buka, "SELECT * FROM tipe_barang ORDER BY nama_tipe ASC");
                                while($row3 = mysqli_fetch_array($qry_tipe, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row3["kode_tipe"]}'>{$row3["nama_tipe"]}</option>";
                                    $jsC .= "prdTipe['".$row3['kode_tipe']."'] = {tipe: '".$row3['kode_tipe']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_tipe' name='txt_tipe' />
                            <script>";
                            echo $jsC;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Seri</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_seri' name='cmb_seri' required='required' class='form-control' onchange='opsi_seri(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_seri = mysqli_query($buka, "SELECT * FROM seri_barang ORDER BY nama_seri ASC");
                                while($row4 = mysqli_fetch_array($qry_seri, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row4["kode_seri"]}'>{$row4["nama_seri"]}</option>";
                                    $jsD .= "prdSeri['".$row4['kode_seri']."'] = {seri: '".$row4['kode_seri']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_seri' name='txt_seri' />
                            <script>";
                            echo $jsD;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Ukuran</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_ukuran' name='cmb_ukuran' required='required' class='form-control' onchange='opsi_ukuran(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_ukuran = mysqli_query($buka, "SELECT * FROM ukuran_barang");
                                while($row5 = mysqli_fetch_array($qry_ukuran, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row5["kode_ukuran"]}'>{$row5["nama_ukuran"]}</option>";
                                    $jsE .= "prdUkuran['".$row5['kode_ukuran']."'] = {ukuran: '".$row5['kode_ukuran']."'};\n";
                                }
                            echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_ukuran' name='txt_ukuran' />
                            <script>";
                            echo $jsE;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis / Nama</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_jenis' name='cmb_jenis' required='required' class='form-control' onchange='opsi_jenis(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_jenis = mysqli_query($buka, "SELECT * FROM jenis_barang ORDER BY nama_jenis ASC");
                                while($row6 = mysqli_fetch_array($qry_jenis, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row6["kode_jenis"]}'>{$row6["nama_jenis"]}</option>";
                                    $jsF .= "prdJenis['".$row6['kode_jenis']."'] = {jenis: '".$row6['kode_jenis']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_jenis' name='txt_jenis' />
                            <script>";
                            echo $jsF;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Warna</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_warna' name='cmb_warna' required='required' class='form-control' onchange='opsi_warna(this.value); kdbrg()' >
                                <option disabled='disabled' selected='selected'>- pilih -</option>";
                                $qry_warna = mysqli_query($buka, "SELECT * FROM warna_barang ORDER BY nama_warna ASC");
                                while($row7 = mysqli_fetch_array($qry_warna, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row7['kode_warna']}'>{$row7['nama_warna']}</option>";
                                    $jsG .= "prdWarna['".$row7['kode_warna']."'] = {warna: '".$row7['kode_warna']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                            <input type='hidden' id='txt_warna' name='txt_warna' />
                            <script>";
                            echo $jsG;
                            echo "
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_barang' name='txt_kode_barang' required='required' class='form-control' >
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align='center'><span id='pesan1'></span></td>
                    </tr>
                    <tr>
                        <td>Kode Serial</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_serial' name='txt_kode_serial' required='required' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='20' rows='3' id='txt_deskripsi' name='txt_deskripsi' required='required' class='form-control' ></textarea>
                        </td>
                    </tr>          
                    <tr>
                        <td colspan='3' align='center'>
                            <br />
                            <input type='file'  accept='image/*' name='foto' id='foto'  onchange='loadFile(event)' style='display: none;'>
                            <label for='foto' style='cursor: pointer;'>Gambar / Foto :
                            <br /><img id='output' src='images/img/no-img.png' width='110' height='80' ></label>
                            <br /><br />
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>
                            <span>File name :</span>&nbsp;<span id='gambar'></span>
                        </td>
                    </tr>
                    <tr><td colspan='3'>&nbsp;</td></tr>
                </table>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <input type='submit' name='submit' value='Submit' class='btn btn-primary'>&nbsp;
                    <input type='button' value='Cancel' onclick=location.href='home.php' class='btn btn-default'>
                </div>
            </div>
        </div>
    </div>
</form>";
?>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
$(document).ready(function()
{
    $('#txt_kode_serial').focus(function()
    {
        var kode_barang = $('#txt_kode_barang').val();

        $.ajax(
        {
            type : 'POST',
            url : 'cek_kode_barang.php',
            data : 'txt_kode_barang='+kode_barang,
            success : function(data)
            {
                $('#pesan1').html(data);
            }
        });
    });
    
});

var loadFile = function(event) 
{
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);

    var fullPath = document.getElementById('foto').value;

    if(fullPath) 
    {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if(filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) 
        {
            filename = filename.substring(1);
        }
        $('#gambar').html(filename);
    }
};

function opsi_merk(x)
{
	<?php echo $jsA; ?>
	document.getElementById('txt_merk').value = prdMerk[x].merk;
};

function opsi_model(x)
{
	<?php echo $jsB; ?>
	document.getElementById('txt_model').value = prdModel[x].model;
};

function opsi_tipe(x)
{
	<?php echo $jsC; ?>
	document.getElementById('txt_tipe').value = prdTipe[x].tipe;
};

function opsi_seri(x)
{
	<?php echo $jsD; ?>
	document.getElementById('txt_seri').value = prdSeri[x].seri;
};

function opsi_ukuran(x)
{
	<?php echo $jsE; ?>
	document.getElementById('txt_ukuran').value = prdUkuran[x].ukuran;
};

function opsi_jenis(x)
{
	<?php echo $jsF; ?>
	document.getElementById('txt_jenis').value = prdJenis[x].jenis;
};

function opsi_warna(x)
{
    <?php echo $jsG; ?>
    document.getElementById('txt_warna').value = prdWarna[x].warna;
};

function kdbrg()
{
    var A = $('#cmb_merk').val();
    if(A == null){A = '';}
    var B = $('#cmb_model').val();
    if(B == null){B = '';}
    var C = $('#cmb_tipe').val();
    if(C == null){C = '';}
    var D = $('#cmb_seri').val();
    if(D == null){D = '';}
    var E = $('#cmb_ukuran').val();
    if(E == null){E = '';}
    var F = $('#cmb_jenis').val();
    if(F == null){F = '';}
    var G = $('#cmb_warna').val();
    if(G == null){G = '';}
    var all = A+B+C+D+E+F+G;
    
    //$('#txt_kode_barang').value = A;
    document.getElementById('txt_kode_barang').value = all;
};

</script>