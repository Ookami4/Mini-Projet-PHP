<?php include('include/head.php');?>
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
<link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body>
<?php include('include/navbar.php');?>
<div style="justify-content: center;align-items: center; margin-bottom: 5%;">
<div id="container">
	<div id="admin-profil">
    <table width="20%">
      <tr><th colspan="3">BEST BUYER</th></tr>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Amount</th>
      </tr>
	  <?php
      $bestbuyer = mysqli_query($connection, "SELECT o.user_id, u.user_name, SUM(o.order_total) AS Amount FROM orders o JOIN users u ON (o.user_id = u.user_id) GROUP BY o.user_id ORDER BY Amount DESC");
      if(!$bestbuyer)
      {
       echo("Error description: ". mysqli_error($connection));
      }
      while ($buyerlist = mysqli_fetch_array($bestbuyer)) 
      {
    ?>
        <tr>
          <td><?php echo $buyerlist['user_id'];?></td>
          <td><?php echo $buyerlist['user_name']; ?></td>
          <td>$<?php echo number_format($buyerlist['Amount'], 2); ?></td>
        </tr> 
    <?php  
      }      
    ?>
    </table>
	</div>
	<div id="board">
	<?php 
      $sql = "SELECT p.pro_id, p.pro_name, p.pro_brand, c.cat_name, p.pro_quantity, p.pro_price, p.pro_picture,p.pro_description FROM products p JOIN categories c ON (p.cat_id = c.cat_id)";
      $result = mysqli_query($connection, $sql);
      if(!$result){
        echo("Error description: " . mysqli_error($connection));
      }
      $number = mysqli_num_rows($result);
       echo "<p>".$number." Products | ";?>
      <a href="add-product.php"><i class="fas fa-plus"></i>Add more items</a>
      <?php
      // ajouter une catégorie
        $msg = null;
        if(isset($_POST['add'])){
         if(empty($_POST['cat_name'])){
            $msg.="<div class=\"error\" id=\"alert3\"><span class='closebtn' onclick='document.getElementById(\"alert3\").style.display=\"none\";'>&times;</span>fill in the field</div>";
            $error['3'] = "3";
         }else{
            $catname = $_POST['cat_name'];
            $result1 = mysqli_query($connection, "SELECT cat_name FROM `categories` WHERE cat_name = '$catname'");
            if ($result1) {
               echo("Error description: ". mysqli_error($connection));
            }
            $cat = mysqli_fetch_array($result1);
            if ($cat == NULL) {
              $add = "INSERT INTO `categories` (cat_id,cat_name) VALUES ('','$catname')";
              $result2 = mysqli_query($connection, $add);
              if($result2){
                $msg ="<div class=\"done\" id=\"suc\"><span class='closebtn' onclick='document.getElementById(\"suc\").style.display=\"none\";'>&times;</span>category created successfully.</div>";
              }else{
              $msg ="<div class=\"error\" id=\"alert1\"><span class='closebtn' onclick='document.getElementById(\"alert1\").style.display=\"none\";'>&times;</span>There was a problem retry again</div>";
              }  
            }elseif ($cat != null) {
              $msg ="<div class=\"done\" id=\"alert2\"><span class='closebtn' onclick='document.getElementById(\"alert2\").style.display=\"none\";'>&times;</span>category already exist.</div>";
            }
         }
        }
      ?>
      <form id="form" action="" method="post">
           <label style="color:black;">Category Name</label>
           <input type="text" id="cat_name" name="cat_name"/>
           <input type="submit" id="add" name="add" value="Add"/></form>
           <?php
             if ($msg != null) echo "<br>".$msg;
           ?> 
       </form>
      </p>
    <table>
    	<tr>
        <th>ID</th>
    		<th style="width: 110px;">Picture</th>
    		<th>Name</th>
    		<th>Brand</th>
  	    <th>Category</th>
  	    <th>Stock</th>
  	    <th>Price</th>
  	    <th>Delete</th>
  	    <th>Modify</th>
    	</tr>
    	 <?php  while ($row = mysqli_fetch_assoc($result)){ ?>
    		<tr>
        <td><?php echo $row['pro_id']; ?></td>
        <td><img style="width: 100px; height: 80px;" class="pro_img" src='<?php echo $row['pro_picture'];?>'></td>
    		<td><?php echo $row['pro_name']; ?></td>
    		<td><?php echo $row['pro_brand']; ?></td>
    		<td><?php echo $row['cat_name']; ?></td>
    		<td><?php echo $row['pro_quantity']; ?></td>
    		<td>$ <?php echo number_format($row['pro_price'], 2); ?></td>
    		<td><a href="delete-product.php?delete_item=<?php echo $row['pro_id']; ?>"><i class="fas fa-trash"></i></a></td>
    		<td><a href="edit-product.php?edit_item=<?php echo $row['pro_id']; ?>"><i class="fas fa-edit"></i></a></td>
    		</tr>
    	    <?php } ?> 
    </table>
    </div>
</div>
<div style="top:10%;bottom:5%; margin:auto;padding:5px;box-shadow: 0 0 20px 0 rgba(0,0,0,.2) 0 5px 5px 0 rgba(0,0,0,.25);width: 80%;min-height: 100px;vertical-align: middle;border: 1px solid #f1f1f1;background-color: #fff;">
  <table>
    <tr><th colspan="5">Products sorted by most selled</th></tr>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Stock</th>
      <th>Price</th>
      <th>Quantity Selled</th>
    </tr>
    <?php 
     $winning = mysqli_query($connection, "SELECT o.pro_id, p.pro_name,p.pro_quantity,p.pro_price, SUM(o.quantity) AS selled FROM orderdetails o JOIN products p ON (o.pro_id = p.pro_id) GROUP BY o.pro_id ORDER BY selled DESC");
      if (!$winning) {
        echo("Error description: " . mysqli_error($connection));
      }
      while ($winpro = mysqli_fetch_array($winning)) {
    ?>
      <tr>
      <td><?php echo $winpro['pro_id']; ?></td>
      <td><?php echo $winpro['pro_name']; ?></td>
      <td><?php echo $winpro['pro_quantity']; ?></td>
      <td>$ <?php echo number_format($winpro['pro_price'], 2, ',', ' ');?></td>
      <td><?php echo $winpro['selled']; ?></td>
    </tr>
    <?php
      }
    ?>
  </table>
</div>
</div>
<?php include('include/footer.php');?>