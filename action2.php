<?php

//action.php
include 'config/koneksi.php';
session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		if(isset($_SESSION["shopping_cart2"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart2"] as $keys => $values)
			{
				if($_SESSION["shopping_cart2"][$keys]['product_id'] == $_POST["product_id"])
				{
					$is_available++;
					$_SESSION["shopping_cart2"][$keys]['product_quantity'] = $_SESSION["shopping_cart2"][$keys]['product_quantity'] + $_POST["product_quantity"];
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'               =>     $_POST["product_id"],
					'product_name'             =>     $_POST["product_name"],
					'product_quantity'         =>     $_POST["product_quantity"]
				);
				$_SESSION["shopping_cart2"][] = $item_array;
			}
		}
		else
		{
			$item_array = array(
				'product_id'               =>     $_POST["product_id"],  
				'product_name'             =>     $_POST["product_name"],
				'product_quantity'         =>     $_POST["product_quantity"]
			);
			$_SESSION["shopping_cart2"][] = $item_array;
		}
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["shopping_cart2"] as $keys => $values)
		{
			if($values["product_id"] == $_POST["product_id"])
			{
				unset($_SESSION["shopping_cart2"][$keys]);
                
			}
		}
	}

    if($_POST["action"] == 'empty')
	{
        //if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])>0)
        //{
            unset($_SESSION["shopping_cart2"]);
        //}
        //else
        //{
        //    echo "<script>alert('data masih kosong')</script>";
        //    echo "<script>document.location='home.php?page=pesanan-beli'</script>";
        //}
	}

    if($_POST["action"] == 'review')
    {
        /*
        if(isset($_SESSION["shopping_cart"]))
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {

            }
        }
        */
    }
}

?>