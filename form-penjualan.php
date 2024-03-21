
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
<form action='tambah-penjualan.php' method='post' enctype='multipart/form-data'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <table align='center'>
                    <tr bgcolor='#B0C4DE'>
                        <td height='36' colspan='3'>
                            <font><b>&nbsp;FORM TAMBAH DATA PENJUALAN&nbsp;</b></font>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='modal-body'>
                <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                    <tr>
                        <td colspan='3' height=''>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kode Jual</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input name='txt_kd_jual' id='txt_kd_jual' type='text' class='form-control' />                           
                        </td>
                    </tr>
                    <tr>
                        <td>Kode Faktur</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kd_faktur' name='txt_kd_faktur' class='form-control' required />
                        </td>
                    </tr>
                    <tr id='tr_pel1'>
                        <td>Pelanggan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_pelanggan' name='cmb_pelanggan' class='form-control' onchange='txt_cust()'>
                            	<option disabled='disabled' selected='selected'>- pilih -</option>
                            	<option value='baru'>...baru...</option>";
                            		$qry_pel = mysqli_query($buka, "SELECT * FROM pelanggan");
                            		$n = 0;
                            		while($rs = mysqli_fetch_array($qry_pel))
                            		{
                            			$n++;
                            			echo "<option value='".$rs['kode_pelanggan']."'>".$rs['nama_pelanggan']."</option>";
                            		}
                            	echo "
                            </select>&nbsp;
                        </td>
                    </tr>
                    <tr id='tr_pel2'>
                    	<td>Pelanggan</td>
                    	<td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_pelanggan' name='txt_pelanggan' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                        	<input type='date' id='txt_tgl_jual' name='txt_tgl_jual' class='form-control' required onchange='hasil()' />
                        </td>
                    </tr>
                    <tr>
                        <td>Kode DO</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='text' id='txt_kd_do' name='txt_kd_do' class='form-control' value='' />
                        </td>
                    </tr>
                    <tr>
                    	<td>Kode PO</td>
                    	<td>&nbsp;:&nbsp;</td>
                    	<td>
                    		<input type='text' id='txt_kd_po' name='txt_kd_po' class='form-control' />
                    	</td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <div id='popover_content_wrapper'>
                                <span id='cart_details'></span>
                                <table align='center'>
                                    <tr>
                                        <td>
                                            <div>
                                                <a href='#' class='btn btn-default' id='item_cart' data-toggle='modal' data-target='#itemModal'>
                                                    <span class='glyphicon glyphicon-trash'></span> Item
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href='#' class='btn btn-default' id='clear_cart'>
                                                    <span class='glyphicon glyphicon-trash'></span> Kosongkan
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_jml' name='txt_jml' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                    	<td>Diskon</td>
                    	<td>&nbsp;:&nbsp;</td>
                    	<td>
                    		<input type='number' id='txt_dis' name='txt_dis' class='form-control' onkeyup='ttl_harga()' />
                    	</td>
                    </tr>
                   <tr>
                        <td>Total Harga</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_ttl_hrg' name='txt_ttl_hrg' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td>Bayar</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_bayar' name='txt_bayar' class='form-control' onkeyup='kembalian()' />
                        </td>
                    </tr>
                    <tr>
                        <td>Kembali</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='number' id='txt_kembali' name='txt_bayar' class='form-control' />
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>";
                            $kd_user = $dsa['kode_user'];
                            echo "<input type='hidden' id='txt_user' name='txt_user' class='form-control' value='$kd_user' />
                        </td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <select id='cmb_bayar' name='cmb_bayar' class='form-control' onchange='document.getElementById(\"prod_name\").value = prdName[this.value]; hasil(); ubah_kd()'>
                                <option selected='selected' disabled='disabled'>- pilih -</option>";
                                include 'config/koneksi.php';
                                $query2 = "SELECT * FROM pembayaran";
                                $tampil2 = mysqli_query($buka, $query2);
                                $jsArray = "var prdName = new Array();\n";
                                while($dtbyr = mysqli_fetch_array($tampil2))
                                {
                                    echo "
                                    <option value='".$dtbyr['kode_bayar']."'>".$dtbyr['keterangan']."</option>";
                                    $jsArray .= "prdName['".$dtbyr['kode_bayar']."'] = '".$dtbyr['hari']."';\n";
                                }
                                echo "
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <input type='hidden' name='prod_name' id='prod_name' class='form-control' readonly onchange='ubah_kd()' />
                            <script>";
                                echo $jsArray;
                                echo "
                            </script>
                        </td>
                    </tr>                    
                    <tr id='tr_tempo'>
                        <td>Tempo</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>
                            <input type='date' id='txt_tempo' name='txt_tempo' class='form-control'/>
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
</form>

<div class='modal' id='custModal' tabindex='-1' role='dialog'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-edit'></i> Input Data Transaksi Penjualan</h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<form id='frmPelanggan'>
			<div class='modal-body'>
				<div class='form-group'>
					<label>Kode Pelanggan</label>
					<input type='text' id='kode_pelanggan' name='kode_pelanggan' class='form-control' />
				</div>
			</div>
			</form>
            <div class='modal-footer'>
            	<button type='button' class='btn btn-info btn-submit' id='btnSimpan'>Simpan</button>
                <button type='button' class='btn btn-secondary btn-reset' data-dismiss='modal'>Batal</button>
            </div>
		</div>
	</div>
</div>

<div class='modal' id='itemModal' tabindex='-1' role='dialog'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div>
                    <button class='close' type='button' data-dismiss='modal'><span>&times;</span></button>
                    <h4 class='modal-title' id='exampleModalLabel'><b><center>Item Barang</center></b></h4>
                </div>
            </div>
            <div class='modal-body'>
                <div id='display_item'>
                <!-- item list -->
                <!-- /. itemlist -->
                </div>
            </div>
            <div class='modal-footer'>
                <div><button class='close' type='button' data-dismiss='modal'><span>&times;</span></button></div>
            </div>
        </div>
    </div>
</div>";
?>                

<script>
window.setTimeout("waktu()", 1000);

function waktu()
{
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    var a = document.getElementById("txt_kd_jual");
    a.value = moment(waktu).format('DDMM-HH') + waktu.getMinutes();   
}

$(document).ready(function()
{
    //document.getElementById('row_tempo').style.visibility = 'hidden';
    var a = new Date();
    //var b = moment(a).format('DDMMYYYY');
    var c = moment(a).format('DDMM-HHmm');
    var d = '-';
    var e = c;
    document.getElementById('txt_jml').value = 0;
    document.getElementById('txt_dis').value = 0;
    document.getElementById('txt_ttl_hrg').value = 0;
    document.getElementById('txt_kembali').value = 0;
    document.getElementById('tr_pel2').style.visibility = 'hidden';

});

function txt_cust()
{
	if(document.getElementById('cmb_pelanggan').value == 'baru')
	{
		document.getElementById('tr_pel2').style.visibility = 'visible';
		document.getElementById('tr_pel1').style.visibility = 'hidden';
	}
	else
	{
		document.getElementById('tr_pel1').style.visibility = 'visible';
	}
}

function ttl_harga()
{
    var jml2 = document.getElementById('txt_jml');
    var dis2 = document.getElementById('txt_dis');
    var ttl_hrg2 = document.getElementById('txt_ttl_hrg');
    
    if(dis2.value == 0)
    {
        ttl_hrg2.value = jml2.value;
    }
    else
    {
        var sum4 = (parseFloat(jml2.value) * parseFloat(txt_dis.value)) / 100;
        ttl_hrg2.value = parseFloat(ttl_hrg2.value) - parseFloat(sum4)
    }
};

function kembalian()
{
    var ttl_hrg3 = document.getElementById('txt_ttl_hrg');
    var byr = document.getElementById('txt_bayar');
    var kmbl = document.getElementById('txt_kembali');
    kmbl.value = parseFloat(byr.value) - parseFloat(ttl_hrg3.value);
}

function hasil()
{
    var a = new Date(document.getElementById('txt_tgl_jual').value);
    var b = document.getElementById('prod_name').value;
    var c = moment(a).format('MM/DD/YYYY');
    var d = moment(a).add(b, 'day').format('YYYY-MM-DD');
    document.getElementById('txt_tempo').value = d;
};

$(document).ready(function(){

    load_product();

    load_cart_data();

    function load_product()
    {
        $.ajax({
            url:'fetch_item2.php',
            method:'POST',
            success:function(data)
            {
                $('#display_item').html(data);
            }
        });
    }

    function load_cart_data()
    {
        $.ajax({
            url:'fetch-cart-jual.php',
            method:'POST',
            dataType:'json',
            success:function(data)
            {
                $('#cart_details').html(data.cart_details);
                $('.badge').text(data.item);
            }
        });
    }


    $(document).on('click', '.add_to_cart', function()
    {
        var product_id = $(this).attr('id');
        var product_name = $('#name'+product_id+'').val();
        var product_quantity = $('#quantity'+product_id).val();
        var action = 'add';
        if(product_quantity > 0)
        {
            $.ajax({
                url:'action2.php',
                method:'POST',
                data:{product_id:product_id, product_name:product_name, product_quantity:product_quantity, action:action},
                success:function(data)
                {
                    load_cart_data();
                    alert('Item ditambah');
                }
            });
        }
        else
        {
            alert('Masukan jumlah');
        }
    });

    $(document).on('click', '.delete', function()
    {

        var product_id = $(this).attr('id');
        var action = 'remove';
        if(confirm('Yakin dibuang ?'))
        {
            $.ajax({
                url:'action2.php',
                method:'POST',
                data:{product_id:product_id, action:action},
                success:function()
                {
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    alert('Item dihapus');
                    location.href = 'home.php?page=penjualan-tambah';
                }
            })
        }
        else
        {
            return false;
        }
    });

    $(document).on('click', '#clear_cart', function()
    {
        var action = 'empty';
        $.ajax
        ({
            url:'action2.php',
            method:'POST',
            data:{action:action},
            success:function()
            {
                load_cart_data();
                $('#cart-popover').popover('hide');
                alert('Pesanan dikosongkan');
            }
        });
    });

});

</script>