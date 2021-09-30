<?php 
include('include/functions.php');
if (isset($_GET['add_to_cart'])) {
	$id = $_GET['hidden_id'];
if(isset($_COOKIE["cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['cart']);

		$cart_data = json_decode($cookie_data, true);
	}
	else
	{
		$cart_data = array();
	}

	$item_id_list = array_column($cart_data, 'item_id');

	if(in_array($id, $item_id_list))
	{
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $id)
			{
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_GET["quantity"];
			}
		}
	}
	else
	{   
		$sql = "SELECT p.pro_name, p.pro_price,c.cat_id FROM products p JOIN categories c ON pro_id = '$id'";
		$result = mysqli_query($connection, $sql);
		if (!$result) {
			 echo("Error description: " . mysqli_error($connection));
		}
		$row = mysqli_fetch_array($result);
		$item_array = array(
			'item_id'			=>	$id,
			'item_name'			=>	$row['pro_name'],
			'item_price'		=>	$row['pro_price'],
			'item_quantity'		=>	$_GET["quantity"],
			'item_cat'          =>  $row['cat_id']
		);
		$cart_data[] = $item_array;
	}
	$item_data = json_encode($cart_data);
	setcookie('cart', $item_data, time() + (86400 * 30));
	redirect("home.php");
}
?>