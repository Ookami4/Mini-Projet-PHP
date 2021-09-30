<?php include('include/head.php');?>
<body>
<?php include('include/navbar.php');?>
<div id="items">
	<?PHP
		if(isset($_GET['idcat']))
		{
			$cat = $_GET['idcat'];
			$res_cat = mysqli_query($connection, "SELECT p.pro_id, p.pro_name, p.pro_price, p.pro_picture FROM products p JOIN categories c ON (p.cat_id = c.cat_id) AND p.cat_id = '$cat'");
			if(!$res_cat){
				echo("Error description: " . mysqli_error($connection));
			}
	    }
	    while ($row = mysqli_fetch_array($res_cat)) {
    ?>   
	        <a href="product-details.php?id=<?php echo $row['pro_id']; ?>">
	            <div id="item-list"> 
	            	<img src="<?php echo $row['pro_picture']; ?>"> 
	            	<center>
	            		<p><?php echo $row['pro_name']; ?></p>
	            		<p><?php echo $row['pro_price']; ?></p>
	            	</center>
	            </div>
        	</a>
	<?php
	    }
    ?>
</div>
<?php include('include/footer.php'); ?>
