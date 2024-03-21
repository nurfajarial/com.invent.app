
<?php
include "config/koneksi.php";
session_start();
$nomor = 1;
//$total_price = 0;
$item = 0;

$output = "";
$output = "
<div class='table-responsive'>
    <table class='table table-striped' align='center'>
        <thead>
            <tr bgcolor='#B0C4DE' align='center'>
                <th width=''><center>Nama Barang</center></th>
                <th width=''><center>Qty</center></th>
                <th width=''><center>Harga</center></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>";
        if(!empty($_SESSION["shopping_cart2"]))
        {
            foreach($_SESSION["shopping_cart2"] as $keys => $values)
            {
                $output .="
                <tr>
                    <td>
                        <input type='hidden' name='txt_kd_brg[]' value='".$values["product_id"]."' />".$values["product_name"]."
                    </td>
                    <td>
                        <input type='hidden' name='txt_qtybrg[]'  value='".$values["product_quantity"]."' />".$values["product_quantity"]."
                    </td>
                    <td>
                        <select name='cmb_harga[]' class='form-control' onchange='kalkulasi(); ttl_harga()'>
                            <option value='' disabled selected='selected'>- Pilih -</option>;
                            <option value='' disabled>Harga Jual 1</option>";
                            $qry_harga1 = "SELECT harga_jual1 FROM modal WHERE kode_barang = '".$values["product_id"]."' ORDER BY tanggal_jual1 DESC LIMIT 2";
                            $l_hrg1 = mysqli_query($buka, $qry_harga1);
                            $no1 = 0;
                            while($row1 = mysqli_fetch_array($l_hrg1))
                            {
                                $hrg1 = $row1['harga_jual1'];
                                $no1++;
                                $output .= "<option value='$hrg1'>$hrg1</option>";
                            }
                            $output .= "<option value='' disabled>Harga Jual 2</option>";
                            $qry_harga2 = "SELECT harga_jual2 FROM modal WHERE kode_barang = '".$values["product_id"]."' ORDER BY tanggal_jual2 DESC LIMIT 2";
                            $l_hrg2 = mysqli_query($buka, $qry_harga2);
                            $no2 = 0;
                            while($row2 = mysqli_fetch_array($l_hrg2))
                            {
                                $hrg2 = $row2['harga_jual2'];
                                $no2++;
                                $output .= "<option value='$hrg2'>$hrg2</option>";
                            }
                            $output .= "<option value='' disabled>Harga Jual 3</option>";
                            $qry_harga3 = "SELECT harga_jual3 FROM modal WHERE kode_barang = '".$values["product_id"]."' ORDER BY tanggal_jual3 DESC LIMIT 2";
                            $l_hrg3 = mysqli_query($buka, $qry_harga3);
                            $no3 = 0;
                            while($row3 = mysqli_fetch_array($l_hrg3))
                            {
                                $hrg3 = $row3['harga_jual3'];
                                $no3++;
                                $output .= "<option value='$hrg3'>$hrg3</option>";
                            }                             
                            $output .="
                            </script>
                        </select>
                    </td>
                    <td>
                        <button name='delete' class='btn btn-danger btn-xs delete' id='".$values["product_id"]."'>Hapus</button>
                    </td>
                </tr>
                <tr style='display: none;'>
                    <td align='center' colspan='4'>
                        <input type='text' name='txt_ttl[]' class='form-control' />
                    </td>
                </tr>                
                ";
                $item = $item + 1;
                $jumlah[] = $values["product_quantity"];
                $ttl_qty = array_sum($jumlah);                
            }
        }

        $output .= "
        </tbody>
    </table>    
</div>
<script>
function kalkulasi()
{
    var sum = 0;
    var sum2 = 0;
    var qty = document.getElementsByName('txt_qtybrg[]');
    var cost = document.getElementsByName('cmb_harga[]');
    var ttl = document.getElementsByName('txt_ttl[]');
    var jml = document.getElementById('txt_jml');
    for (var i = 0; i < cost.length; i++)
    {
        sum = parseFloat(cost[i].value) * parseFloat(qty[i].value);
        sum2 += parseFloat(cost[i].value) * parseFloat(qty[i].value);
        ttl[i].value = sum;
        jml.value = sum2;        
    }
};

</script>";

$data = array(
    'cart_details' => $output,
    'item' => $item
);  

echo json_encode($data);

?>