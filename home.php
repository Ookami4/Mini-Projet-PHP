<?php include('include/head.php');?>
<body>
<?php include('include/navbar.php'); ?>
<div id="header">
	<?php if (isset($_SESSION['logged'])):?>
	<h1 align="center">Welcome <?php echo @$_SESSION['username']; ?></h1>
    <?php endif ?>
	<img src="logo/cover.png" />
</div>
<?php 
if(isset($_COOKIE["buy"]))
{
?>
	<center><h3>Recommendations</h3></center>
	<div id="suggestion">
		<?php
			$buy_data = stripslashes($_COOKIE['buy']);
			$cat_data = json_decode($buy_data, true);
			foreach ($cat_data as $values) 
			{
	         $suggestion = "SELECT pro_id, pro_name, pro_price, pro_picture FROM products WHERE cat_id = $values";
	           $rec =mysqli_query($connection, $suggestion);
	           if (!$rec) {
	           	  echo("Error description: " . mysqli_error($connection));
	           	  break;
	           }
	           while ($col = mysqli_fetch_array($rec)); 
	           {  
	    ?>
	           	  <a href="product-details.php?id=<?php echo $col['pro_id'];?>">
	           	   <div id="item-list">
	           	   	 <img src="<?php echo $col['pro_picture'];?>">
	           	   	 <center>
	           	   	 	<p><?php echo $col['pro_name'];?></p>
					    <p>$ <?php echo $col['pro_price'];?></p>
	           	   	 </center>
	           	   </div>
	           	   </a> 
	    <?php
	            }
		    }
		?>
    </div>
<?php
}
?>
	
<center><h3>Products</h3></center>
<div id="items">
<?php
	$sql = "SELECT pro_id, pro_name, pro_price, pro_picture FROM `products` WHERE 1";
	$result = mysqli_query($connection, $sql);
	if(!$result){
		echo("Error description: " . mysqli_error($connection));
	}
    while ($products = mysqli_fetch_array($result)){ 
    ?>
    <a href="product-details.php?id=<?php echo $products['pro_id']; ?>">
		<div id="item-list">
			<img src="<?php echo $products['pro_picture'] ?>">
			<center>
				<p><?php echo $products['pro_name'];?></p>
				<p>$ <?php echo $products['pro_price'];?></p>
			</center>
		</div>
	</a>
<?php } ?> 
</center>
</div>
<?php include('include/footer.php');?>
