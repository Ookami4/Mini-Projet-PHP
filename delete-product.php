<?php include('include/head.php');?>
<?php 
  if (isset($_GET['delete_item'])) {
  	$item_id = $_GET['delete_item'];
  	$delete = "DELETE FROM `products` WHERE pro_id='$item_id'";
  	$result = mysqli_query($connection, $delete);

  }
  if ($result) {
  	redirect("admin-space.php");
  }else{
    echo("Error description: " . mysqli_error($connection));
  }
?>