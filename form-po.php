<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
include 'config/koneksi.php';
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}
?>

<body>
<div id='pesan'></div>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <table align='center'>
                <tr>
                    <td colspan='3'>
                        <b><h3 align='center'>Pesanan Pembelian</h3></b>
                    </td>
                </tr>
            </table>
        </div>
        <div class='modal-body'>
            <div class='table-responsive'>
                <form>
                    <table width='' border='0' align='center' cellpadding='0' cellspacing='0' class=''>
                        <tr>
                            <td colspan='3'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <div style='border: 1px solid'>
                                    <div id='popover_content_wrapper' align='center'>
                                        <span id='cart_details'></span>
                                        <table align='center'>
                                            <tr align='center'>
                                                <td>
                                                    <div id='div_item'>
                                                        <a href='#' class='btn btn-default' id='item_cart' data-toggle='modal' data-target='#itemModal'>
                                                            <span class='glyphicon glyphicon-shopping-cart'>Item</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id='div_kosongkan'>
                                                        <a href='#' class='btn btn-default' id='clear_cart' />
                                                            <span class='glyphicon glyphicon-trash'></span>Kosongkan
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id='div_cek'>
                                                        <a href='#' class='btn btn-default' id='order_cart'>
                                                            <span class='glyphicon glyphicon-ok-circle'>Cek</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class='modal-footer'>

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
            <div class='modal-body' id='display_item'>

            </div>
            <div class='modal-footer'>
                
            </div>
        </div>
    </div>
</div>

</body>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
/*
$(document).ready(function()
{
    $('#myInput').on('keyup', function()
    {
        var value = $(this).val().toLowerCase();
        $('#myList li').filter(function()
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });
});
*/

$(document).ready(function()
{
    frmbody();

    load_product();

    load_cart_data();

    function load_product()
    {
        $.ajax(
        {
            url:'fetch_item.php',
            method:'POST',
            success:function(data)
            {
                $('#display_item').html(data);
            }
        });
    }

    function load_cart_data()
    {
        $.ajax(
        {
            url:'fetch_cart.php',
            method:'POST',
            //data: data,
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
        product_id = $(this).attr("id");
        product_jenis = $('#jenis'+product_id+'').val();
        product_merk = $('#merk'+product_id+'').val();
        product_quantity = $('#quantity'+product_id).val();
        action = 'add';
        if(product_quantity > 0)
        {
            $.ajax({
                url:'action.php',
                method:'POST',
                data:
                {
                    product_id:product_id,
                    product_jenis:product_jenis, 
                    product_merk:product_merk,
                    product_quantity:product_quantity, 
                    action:action
                },
                success:function(data)
                {
                    load_cart_data();
                    alert('Item ditambah');
                    //alert(product_id+'   '+product_quantity);
                }
            });
        }
        else
        {
            //alert('Masukan jumlah');
            alert(product_id+'   '+product_quantity);
        }
    });

    $(document).on('click', '.delete', function()
    {

        var product_id = $(this).attr('id');
        var action = 'remove';
        if(confirm('Yakin dibuang ?'))
        {
            $.ajax(
            {
                url:'action.php',
                method:'POST',
                data:
                {
                    product_id: product_id, 
                    action: action
                },
                success:function()
                {
                    load_cart_data();
                    //$('#cart-popover').popover('hide');
                    alert('Item dihapus');
                    //location.href = 'home.php?page=pesanan-beli';
                    window.location = 'home.php?page=pesanan-beli';
                }
            });
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
            url:'action.php',
            method:'POST',
            data:{action:action},
            success:function()
            {
                load_cart_data();
                ////$('#cart-popover').popover('hide');
                alert('Pesanan dikosongkan');
            }
        });
    });

    $(document).on('click', '#order_cart', function()
    {
        var action = 'review';
        $.ajax
        ({
            url:'action.php',
            method:'POST',
            data:{action:action},
            success:function()
            {
                ////$('#cart-popover').popover('hide');
                ////alert('Barang siap di pesan');
                location.href = 'home.php?page=lihat-cart';
            }
        });
    });

});

</script>
