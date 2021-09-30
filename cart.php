<?php
 include('include/head.php');
if(isset($_GET["action"]))
{    
	//supprimer un article de panier
	if($_GET["action"] == "delete")
	{
		$cookie_data = stripslashes($_COOKIE['cart']);
		$cart_data = json_decode($cookie_data, true);
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]['item_id'] == $_GET["id"])
			{
				unset($cart_data[$keys]);
				$item_data = json_encode($cart_data);
				setcookie("cart", $item_data, time() + (86400 * 30));
				redirect("cart.php");
			}
		}
	}
	//vider le panier
	if($_GET["action"] == "clearall")
	{
		setcookie("cart", "", time() - 3600);
		redirect("cart.php");
	}
}
?>
<style type="text/css">
	table{
		width: 100%;
		border: 1;
		caption-side: bottom;
	}
	th,td{
		border: none;
		padding: 10px;
		text-align: center;
	}
	th{
		background-color: #DC143C;
		color: #ffffff;
	}
</style>
<body>
<?php include('include/navbar.php');?>
<center>
<div id="container">
  <div id="board">
  	<p style="float: right;"><a href="cart.php?action=clearall"><b>Clear Cart</b></a></p>
	<table>
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Unit Price</th>
			<th>Total</th>
			<th>Action</th>
		</tr>
		<?php
		if(isset($_COOKIE["cart"]))
		{
			$total = 0;
			$cookie_data = stripslashes($_COOKIE['cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values)
			{
		?>
			<tr>
				<td><?php echo $values["item_name"]; ?></td>
				<td><?php echo $values["item_quantity"]; ?></td>
				<td>$<?php echo $values["item_price"]; ?></td>
				<?php $totalpro = $values["item_quantity"] * $values["item_price"]; ?>
				<td>$<?php echo $totalpro;?></td>
				<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><i class="fas fa-trash"></i></a></td>
			</tr>
		<?php	
				$total += $values["item_quantity"] * $values["item_price"];
			}
		?>
			<tr>
				<td colspan="3"></td>
				<th align="right">$<?php echo $total; ?></th>
				<td></td>
			</tr>
			<tr><td colspan="5"><button><a href="validate-order.php?total=<?php echo $total; ?>">Purchase</a></button></td></tr>
		<?php
		}else{
		?>
			<tr><td colspan="5" align="center">Your cart is empty</td></tr>
		<?php
		}
		?>
	</table>
 </div>
</div>
</center>
<?php include('include/footer.php'); ?>