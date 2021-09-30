<?php include('include/head.php'); 
?>
<body>
<?php include('include/navbar.php');?>
<center>
<div style="top:10%;margin:10px;padding:5px;box-shadow: 0 0 20px 0 rgba(0,0,0,.2) 0 5px 5px 0 rgba(0,0,0,.25);width: 70%;min-height: 100px;vertical-align: middle;border: 1px solid #f1f1f1;background-color: #fff;">
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT p.pro_id, p.pro_name, p.pro_brand, c.cat_name, p.cat_id, p.pro_quantity, p.pro_price, p.pro_picture,p.pro_description FROM products p JOIN categories c ON (p.cat_id = c.cat_id) AND pro_id = $id LIMIT 1";
	$result = mysqli_query($connection, $sql);
  if(!$result){
    echo("Error description: " . mysqli_error($connection));
  }
	$row = mysqli_fetch_array($result);
?>
	<table style="border:none;">
    <tr>
   <td colspan="3" style="text-align:center; background-color:crimson;">Item card</td>
    </tr>
    <tr>
      <td rowspan="5" width="160px"><img src="<?php echo $row['pro_picture'] ?>" style="width:300px;height:500px"></td>
      <th>Product Name</th>
      <td><?php echo $row['pro_name']; ?></td>
    </tr>
    <tr>
    	<th>Brand</th>
      <td><?php echo $row['pro_brand']; ?></td>
    </tr>
    <tr>
      <th>Price</th>
      <td><?php echo number_format($row['pro_price'], 2); ?></td>
    </tr>
    <tr>
      <th>Stock</th>
      <td><?php echo $row['pro_quantity']; ?></td>
    </tr>
    <tr>
    <th>Category</th>
    <td><?php echo $row['cat_name']; ?></td>
    </tr>
    <tr>
       <td colspan="3" style="background-color:crimson;text-align: center;"><font color="white">Description</font></td>
    </tr>
    <tr>
       <td colspan="3">
           <p><?php echo $row['pro_description']; ?></p>
       </td>
    </tr>
        <form method="get" action="check_cart.php">
          <tr><td align="center" colspan="3"><input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $row['pro_id']; ?>"></td></tr>
          <tr><td align="center" colspan="3"><input style="width: 90px" min="1" type="number" id="quantity" name="quantity" value="1"></td></tr>
          <tr><td align="center" colspan="3"><button type='submit' id="submit" name='add_to_cart'>Add To <i class="fas fa-cart-plus"></i></button></td></tr> 
        </form>
</table> 
<?php } ?>
</div>
</center>
<?php include('include/footer.php'); ?>

