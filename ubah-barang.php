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

$rand = rand();
$dir = 'images/img/';

$jsA = "var prdMerk = new Array();\n";
$jsB = "var prdModel = new Array();\n";
$jsC = "var prdTipe = new Array();\n";
$jsD = "var prdSeri = new Array();\n";
$jsE = "var prdUkuran = new Array();\n";
$jsF = "var prdJenis = new Array();\n";

if (isset($_GET['kode_barang'])) 
{
	$kode_barang = $_GET['kode_barang'];
} 
else 
{
	die ('Error. No Kode Selected! ');	
}
//Tampilkan data dari tabel barang
	$query = mysqli_query($buka, "SELECT * FROM barang 
    JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis 
    JOIN merk_barang ON merk_barang.kode_merk = barang.kode_merk 
    JOIN model_barang ON model_barang.kode_model = barang.kode_model 
    JOIN tipe_barang ON tipe_barang.kode_tipe = barang.kode_tipe
    JOIN seri_barang ON seri_barang.kode_seri = barang.kode_seri 
    JOIN ukuran_barang ON ukuran_barang.kode_ukuran = barang.kode_ukuran 	
	WHERE kode_barang='$kode_barang'");
	$hasil = mysqli_fetch_array($query, MYSQLI_BOTH);
	$kode_barang = $hasil['kode_barang'];
    $kode_serial = $hasil['kode_serial'];
	$deskripsi = $hasil['deskripsi'];
	$gambar = $hasil['idgambar'];
	$status = $hasil['status'];
	
//proses edit data barang
if (isset($_POST['Edit']))
{
    $kode_merk1 = $_POST['cmb_merk'];
    $kode_model1 = $_POST['cmb_model'];
    $kode_tipe1 = $_POST['cmb_tipe'];
    $kode_seri1 = $_POST['cmb_seri'];
    $kode_ukuran1 = $_POST['cmb_ukuran'];
    $kode_jenis1 = $_POST['cmb_jenis'];
	$kode_barang1 = $_POST['txt_kode_barang'];
    $kode_serial1 = $_POST['txt_kode_serial'];
	$deskripsi1 = $_POST['txt_deskripsi'];
	$status1 = $_POST['cmb_status'];
    $imagename = $_FILES['foto']['name'];
    $imagetemp = $_FILES['foto']['tmp_name'];
    $ukuran = $_FILES['foto']['size'];
	
    if($imagename == '')
    {
        echo "<script>alert('kosong')</script>";
        $gambar1 = $gambar;
    }
    else
    {
        //echo "<script>alert('tidak kosong')</script>";
        if($imagename == $gambar)
        {
            echo "<script>alert('sama')</script>";
            $gambar1 = $gambar;
        }
        else
        {
            //echo "<script>alert('tidak sama')</script>";
            $maxDim = 800;
            $source = $dir.$imagename;
            $sumber = pathinfo($source);
            $target = $rand.'_'.$sumber['filename'].'.png';
            move_uploaded_file($imagetemp,$source);
            list($width, $height, $type, $attr) = getimagesize($source);
            if($width > $maxDim || $height > $maxDim)
            {
                $rasio = 0.50;
                if($rasio > 1)
                {
                    $n_width = $maxDim;
                    $n_height = $maxDim/$rasio;                
                }
                else
                {
                    $n_width = $maxDim*$rasio;
                    $n_height = $maxDim;                
                }
                $n_width = $width * $rasio;
                $n_height = $height * $rasio;

            }
            else
            {
                $n_width = $width;
                $n_height = $height;
            }

            $src = imagecreatefromstring(file_get_contents($source));
            $dst = imagecreatetruecolor($n_width, $n_height);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
            imagedestroy($src);
            imagepng($dst, $dir.$target);
            imagedestroy($dst);
            unlink($source);
            $gambar1 = $target;
        }
    }

	//update data tabel barang
	$edit = "UPDATE barang
	SET
    kode_merk='$kode_merk1',
    kode_model='$kode_model1',
    kode_tipe='$kode_tipe1',
    kode_seri='$kode_seri1',
    kode_ukuran='$kode_ukuran1',
    kode_jenis='$kode_jenis1',
    kode_barang='$kode_barang1',
    kode_serial='$kode_serial1',
	deskripsi='$deskripsi1',
	idgambar='$gambar1',
	status='$status1'
	WHERE
	kode_barang='$kode_barang'";

    echo $edit."<br /><br />";
    //mysqli_query($buka, $edit);
    include 'audit/edit-barang.php';
    
    //echo "<script>alert('Data berhasil dirubah')</script>";
	//echo "<script>document.location='home.php?page=barang-lihat'</script>";
}

echo "
<form action='#' method='POST' name='ubah-barang' enctype='multipart/form-data'>
    <div class='modal-dialog'>
	    <div class='modal-content'>
		    <div class='modal-header'>
			    <div align='center' style='background-color:#B0C4DE; height:36px; line-height:36px;'>
				    <b>UBAH DATA BARANG</b>
			    </div>
		    </div>
		    <div class='modal-body'>
				<table border='0' align='center' cellpadding='0' cellspacing='0'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
                    <tr>
                        <td>Merk</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_merk' name='cmb_merk' required='required' class='form-control' onchange='opsi_merk(this.value); kdbrg()' >
                                <option value='{$hasil["kode_merk"]}' selected='selected'>{$hasil["nama_merk"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
                                $qry_merk = mysqli_query($buka, "SELECT * FROM merk_barang ORDER BY kode_merk");
                                while($row1 = mysqli_fetch_array($qry_merk, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row1["kode_merk"]}'>{$row1["nama_merk"]}</option>";
                                    $jsA .= "prdMerk['".$row1['kode_merk']."'] = {merk: '".$row1['kode_merk']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_merk' name='txt_merk' value='{$hasil["kode_merk"]}' />
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
                            <select id='cmb_model' name='cmb_model' required='required' class='form-control' onchange='opsi_model(this.value);kdbrg()' >
                                <option value='{$hasil["kode_model"]}' selected='selected'>{$hasil["nama_model"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
                                $qry_model = mysqli_query($buka, "SELECT * FROM model_barang");
                                while($row2 = mysqli_fetch_array($qry_model, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row2["kode_model"]}'>{$row2["nama_model"]}</option>";
                                    $jsB .= "prdModel['".$row2['kode_model']."'] = {model: '".$row2['kode_model']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_model' name='txt_model' value='{$hasil["kode_model"]}' />
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
                            <select id='cmb_tipe' name='cmb_tipe' class='form-control' onchange='opsi_tipe(this.value); kdbrg()' >
                                <option selected='selected' value='{$hasil["kode_tipe"]}' >{$hasil["nama_tipe"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
                                $qry_tipe = mysqli_query($buka, "SELECT * FROM tipe_barang");
                                while($row3 = mysqli_fetch_array($qry_tipe, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row3["kode_tipe"]}'>{$row3["nama_tipe"]}</option>";
                                    $jsC .= "prdTipe['".$row3['kode_tipe']."'] = {tipe: '".$row3['kode_tipe']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_tipe' name='txt_tipe' value='{$hasil["kode_tipe"]}' />
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
                            <select id='cmb_seri' name='cmb_seri' class='form-control' onchange='opsi_seri(this.value); kdbrg()' >
                                <option selected='selected' value='{$hasil["kode_seri"]}' >{$hasil["nama_seri"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
                                $qry_seri = mysqli_query($buka, "SELECT * FROM seri_barang");
                                while($row4 = mysqli_fetch_array($qry_seri, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row4["kode_seri"]}'>{$row4["nama_seri"]}</option>";
                                    $jsD .= "prdSeri['".$row4['kode_seri']."'] = {seri: '".$row4['kode_seri']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_seri' name='txt_seri' value='{$hasil["kode_seri"]}' />
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
                            <select id='cmb_ukuran' name='cmb_ukuran' class='form-control' onchange='opsi_ukuran(this.value); kdbrg()' >
                                <option selected='selected' value='{$hasil["kode_ukuran"]}' >{$hasil["nama_ukuran"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
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
                        	<input type='hidden' id='txt_ukuran' name='txt_ukuran' value='{$hasil["kode_ukuran"]}' />
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
                            <select id='cmb_jenis' name='cmb_jenis' class='form-control' onchange='opsi_jenis(this.value); kdbrg()' >
                                <option selected='selected' value='{$hasil["kode_jenis"]}' >{$hasil["nama_jenis"]}</option>
                                <option disabled='disabled' >- pilih -</option>";
                                $qry_jenis = mysqli_query($buka, "SELECT * FROM jenis_barang");
                                while($row6 = mysqli_fetch_array($qry_jenis, MYSQLI_BOTH))
                                {
                                    echo "<option value='{$row6["kode_jenis"]}'>{$row6["nama_jenis"]}</option>";
                                    $jsF .= "prdJenis['".$row6['kode_jenis']."'] = {jenis: '".$row6['kode_jenis']."'};\n";
                                }
                                echo "
                            </select>
                        </td>
                        <td>
                        	<input type='hidden' id='txt_jenis' name='txt_jenis' value='{$hasil["kode_jenis"]}' />
                        	<script>";
                        	echo $jsF;
                        	echo "
                        	</script>
                        </td>
                    </tr>
		            <tr>
		                <td>Kode Barang</td>
                        <td>&nbsp;:&nbsp;</td>
			            <td>
                            <input type='text' id='txt_kode_barang' name='txt_kode_barang' class='form-control' value='{$hasil["kode_barang"]}' >
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><span id='pesan1'></span></td>
                    </tr>
                    <tr>
                        <td>Kode Serial</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kode_serial' name='txt_kode_serial' class='form-control' value='{$hasil["kode_serial"]}' />
                        </td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <textarea cols='50' rows='6' id='txt_deskripsi' name='txt_deskripsi' class='form-control'>{$hasil["deskripsi"]}</textarea>
                        </td>
                    </tr>
                    <tr>
                    	<td>Status</td>
                    	<td>&nbsp;:&nbsp;</td>
                    	<td>
                    		<select class='form-control' name='cmb_status' class='form-control' >
                    			<option value='{$hasil['status']}' selected='selected' >";
                                if($hasil['status']='1'){echo "Aktif || 1";}else{echo "Tidak aktif || 0";}
                                echo "
                                </option>
                    			<option disabled='disabled'>- pilih -</option>
                    			<option value='1'>Aktif || 1 </option>
                    			<option value='0'>Tidak AKtif || 2 </option>
                    		</select>
                    	</td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>
                            <br />
                            <input type='file'  accept='image/*' name='foto' id='foto'  onchange='loadFile(event)' style='display: none;'>
                            <label for='foto' style='cursor: pointer;'>Gambar / Foto :
                            <br /><img id='output' src='".$dir.$gambar."' width='110' height='80' ></label>
                            <br /><br />
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>
                            <span>File name :</span>&nbsp;<span id='gambar'></span>
                        </td>
                    </tr>
				</table>
		    </div>
		    <div class='modal-footer'>
			    <div align='center'>
                    <input type='submit' name='Edit' value='Simpan' class='btn btn-primary'>&nbsp;
				    <input type='button' value='Cancel' onclick=location.href='home.php?page=barang-detil&&kode_barang=".$kode_barang."' title='kembali ke lihat data barang' class='btn btn-default'>
			    </div>
		    </div>
		</div>
	</div>
</form>";

//Tutup koneksi engine MySQL
mysqli_close($buka);
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

    if (fullPath) 
    {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) 
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

function kdbrg()
{
    var A = $('#cmb_merk').val();
    var B = $('#cmb_model').val();
    if(B == null){B = ''}
    var C = $('#cmb_tipe').val();
    if(C == null){C = ''}
    var D = $('#cmb_seri').val();
    if(D == null){D = ''}
    var E = $('#cmb_ukuran').val();
    if(E == null){E = ''}
    var F = $('#cmb_jenis').val();
    if(F == null){F = ''}
    var all = A+B+C+D+E+F;
    
    //$('#txt_kode_barang').value = A;
    document.getElementById('txt_kode_barang').value = all;
};

</script>