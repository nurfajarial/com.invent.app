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

?>

<div class="container">
    <table align="center">
        <tr>
            <td>Pesanan Pembelian</td>
        </tr>
        <tr>
            <td>
                <div style="border: 1px solid">
                    <div id="popover_content_wrapper">
                        <span id="cart_details"></span>
                            <div align="center">
                            <a href="#" class="btn btn-default" id="item_cart" data-toggle='modal' data-target='#itemModal'>
                                <span class="glyphicon glyphicon-trash"></span> Item
                            </a>
                            <a href="#" class="btn btn-default" id="clear_cart">
                                <span class="glyphicon glyphicon-trash"></span> Kosongkan
                            </a>
                            <a href="#" class="btn btn-default" id="order_cart">
                                <span class="glyphicon glyphicon-ok-circle"></span> Cek
                            </a>
                            </div>
                        <span>&nbsp;</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class='modal fade' id='itemModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='exampleModalLabel'><b><center>Item Barang</center></b></h4>
            </div>
            <div class='modal-body'>
                <!-- item list -->
                <div id="display_item">
                </div>
                <!-- /. itemlist -->
            </div>
            <div class='modal-footer'>
                <button class='btn btn-secondary' type='button' data-dismiss='modal'>Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    load_product();

    load_cart_data();

    function load_product()
    {
        $.ajax({
            url:"fetch_item.php",
            method:"POST",
            success:function(data)
            {
                $('#display_item').html(data);
            }
        });
    }

    function load_cart_data()
    {
        $.ajax({
            url:"fetch_cart.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                $('#cart_details').html(data.cart_details);
                $('.badge').text(data.item);
            }
        });
    }

    $('#cart-popover').popover(
    {
        html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
    });

    $(document).on('click', '.add_to_cart', function(){
        var product_id = $(this).attr("id");
        var product_name = $('#name'+product_id+'').val();
        var product_quantity = $('#quantity'+product_id).val();
        var action = "add";
        if(product_quantity > 0)
        {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{product_id:product_id, product_name:product_name, product_quantity:product_quantity, action:action},
                success:function(data)
                {
                    load_cart_data();
                    alert("Item ditambah");
                }
            });
        }
        else
        {
            alert("Masukan jumlah");
        }
    });

    $(document).on('click', '.delete', function()
    {
        var product_id = $(this).attr("id");
        var action = 'remove';
        if(confirm("Yakin dibuang ?"))
        {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{product_id:product_id, action:action},
                success:function()
                {
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    alert("Item dihapus");
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
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function()
            {
                load_cart_data();
                $('#cart-popover').popover('hide');
                alert("Pesanan dikosongkan");
            }
        });
    });

    $(document).on('click', '#order_cart', function()
    {
        var action = 'review';
        $.ajax
        ({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function()
            {
                $('#cart-popover').popover('hide');
                //alert("Barang siap di pesan");
                location.href = "home.php?page=pesanan-lihat";
            }
        });
    });

});

</script>