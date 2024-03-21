<?php
//fetch_cart.php
session_start();
include 'config/koneksi.php';
$nomor = 0;
//$total_price = 0;
$item = 0;

$output = "
<div class='table-responsive' id='order_table'>
	<table class='table table-bordered table-striped' align='center'>
		<tr>
            <th align='center'>No</th>
            <th align='center'>Nama Barang</th>
            <th align='center'>Merk</th>
            <th align='center'>Jumlah</th>
            <th align='center'>Action</th>
        </tr>";

        if(!empty($_SESSION['shopping_cart']))
        {
            foreach($_SESSION['shopping_cart'] as $keys => $values)
            {
                $nomor++;
                $output .= "
                <tr>
                    <td align='center'>$nomor</td>
                    <td>{$values['product_jenis']}</td>                
                    <td>
                        <span style=visibility:hidden;>{$values['product_id']}</span>
       
                    </td>
                    <td>".$values['product_quantity']."</td>
                    <td>
                        <button name='delete' class='btn btn-danger btn-xs delete' id='". $values['product_id']."'>
                            Hapus
                        </button>
                    </td>
                </tr>";
                $item = $item + 1;
                $jumlah[] = $values['product_quantity'];
                $total = array_sum($jumlah);
        	}
        	$output .= "
        	<tr>
                <td colspan='3' align='right'><b>Total Item</b></td>
                <td colspan='2'>{$nomor}</td>
            </tr>";
        }
        else
        {
        	$output .= "
            <tr>
            	<td colspan='6' align='center'>
            		Pesanan kosong!
            	</td>
            </tr>";
        }
$output .= "
        </table>
    </div>";

$data = array(
	'cart_details' => $output,
	'item' => $item
);	

echo json_encode($data);