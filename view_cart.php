<?php
include 'config.inc.php';
session_start();
?>
<div class="container">
    <h3 style="text-align:center">Review Pesanan Pembelian</h3>
    <?php
    if(isset($_SESSION["products"]) && count($_SESSION["products"])>0)
    {
    	$total 			= 0;
    	$list_tax 		= '';
    	$cart_box 		= '<ul class="view-cart">';

    	foreach($_SESSION["products"] as $product)
        {
            //Cetak setiap item, kuantitas dan harga.
    		$product_name = $product["product_name"];
    		$product_qty = $product["product_qty"];
    		//$product_price = $product["product_price"];
    		$product_code = $product["product_code"];
    		//$product_color = $product["product_color"];
    		//$product_size = $product["product_size"];
            $jumlah[] = $product_qty;
            $total = array_sum($jumlah);

    		//$item_price 	= convert_to_rupiah($product_price * $product_qty);  // Harga x qty = Total harga barang

    		$cart_box .= '
                <li>
                    '.$product_name.'&nbsp;&nbsp;'.$product_qty.'
                </li>';
            $query = "INSERT INTO temp_po
            (
            kode_barang,
            nama_barang,
            jumlah_beli
            )
            VALUES
            (
            '$product_code',
            '$product_name',
            '$product_qty'
            )";
            $query_input = mysqli_query($mysqli_conn, $query);

    		//$subtotal 		= ($product_price * $product_qty); //Multiply  kuantitas * harga
    	   //$total 			= ($product_qty); //Add up to total harga
    	}

    	//$grand_total = $total + $shipping_cost; //Menjumlahkan total

        /*
        foreach($taxes as $key => $value)
        {
            //menghitung semua pajak dalam array
    			$tax_amount 	= round($total * ($value / 100));
    			$tax_item[$key] = $tax_amount;
    			$grand_total 	= $grand_total + $tax_amount;
    	}
        */

        /*
        foreach($tax_item as $key => $value)
        {
            //List Pajak
    		$list_tax .= $key. ' '. convert_to_rupiah($value).'<br />';
    	}
        */

    	//$shipping_cost = ($shipping_cost)?'Biaya Pengiriman: '.convert_to_rupiah($shipping_cost).'<br />':'';

    	//Menampilkan pajak, biaya pengiriman & Total Belanja
    	$cart_box .= '<li class="view-cart-total"><hr>Total Belanja Anda : '.$total.'</li>';
    	$cart_box .= "</ul>";

    	echo $cart_box;
        echo '<div align="center"><a href="home.php?page=pembelian-tambah" class="btn btn-primary" data-code="$product_code">Lanjut</a>&nbsp;<a href="home.php?page=pesanan-tambah" class="btn btn-primary">Kembali</a></div>';
    }
    else
    {
    	echo "Keranjang beranda anda Kosong";
    }
    ?>
</div>