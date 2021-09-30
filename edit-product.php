<?php 
include('include/head.php'); 
$failure = "";
$error = array();
$succes = "";
if(isset($_POST['update'])){

 if(empty($_POST['proname'])){
    $failure.="<div class=\"error\" id=\"alert4\"><span class='closebtn' onclick='document.getElementById(\"alert4\").style.display=\"none\";'>&times;</span>fill in the product name</div>";
    $error['1'] = "1";
 }else{
    $proname = $_POST['proname'];
 }
 if(empty($_POST['braname'])){
    $failure.="<div class=\"error\" id=\"alert4\"><span class='closebtn' onclick='document.getElementById(\"alert4\").style.display=\"none\";'>&times;</span>fill in the Brand name</div>";
    $error['2'] = "2";
 }else{
    $braname = $_POST['braname'];
 }
 if(empty($_POST['catname'])){
    $failure.="<div class=\"error\" id=\"alert4\"><span class='closebtn' onclick='document.getElementById(\"alert4\").style.display=\"none\";'>&times;</span>fill in the product category</div>";
    $error['3'] = "3";
 }else{
    $catname = $_POST['catname'];
 }
 if(empty($_POST['proquantity'])){
    $failure.="<div class=\"error\" id=\"alert4\"><span class='closebtn' onclick='document.getElementById(\"alert4\").style.display=\"none\";'>&times;</span>fill in the Quantity</div>";
    $error['4'] = "4";
 }else{
    $proquantity = $_POST['proquantity'];
 }
 if(empty($_POST['proprice'])){
    $failure.="<div class=\"error\" id=\"alert5\"><span class='closebtn' onclick='document.getElementById(\"alert5\").style.display=\"none\";'>&times;</span>fill in the Price</div>";
    $error['5'] = "5";
 }else{
    $proprice = $_POST['proprice'];
 }
 if(empty($_POST['propicture'])){
    $failure.="<div class=\"error\" id=\"alert6\"><span class='closebtn' onclick='document.getElementById(\"alert6\").style.display=\"none\";'>&times;</span>Upload the product picture</div>";
    $error['6'] = "6";
 }else{
    $propicture = $_FILES['propicture']['tmp_name'];
    $path = "img/products/".$_FILES['propicture']['tmp_name'];
    move_uploaded_file($propicture, $path);
  }
  if (empty($_POST['prodescpription'])) {
    $failure.="<div class=\"error\" id=\"alert7\"><span class='closebtn' onclick='document.getElementById(\"alert7\").style.display=\"none\";'>&times;</span>Upload the product picture</div>";
    $error['7']="7";
  }else{
    $description = $_POST['prodescpription'];
  }
 if ($error == NULL) 
 {  
    $id = $_GET['edit_item'];
    $edit="UPDATE `products` SET pro_name = '$proname', pro_brand = '$braname', pro_category = '$catname' ,pro_quantity 
    '$proquantity', pro_price = '$proprice' , pro_picture = '$path' , pro_description = '$description' WHERE pro_id = '$pro_id'";
    $result = mysqli_query($connection, $add);
    if ($result) {
      $succes ="<div class=\"done\" id=\"suc\"><span class='closebtn' onclick='document.getElementById(\"suc\").style.display=\"none\";'>&times;</span>Item updated successfully.</div>";
    }else{
      $failure.="<div class=\"error\" id=\"alert8\"><span class='closebtn' onclick='document.getElementById(\"alert8\").style.display=\"none\";'>&times;</span>There was a problem retry again</div>";
    }
 }
}
?>
 <link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body style="background-image: url('logo/cover.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: 100%;">
 <?php include('include/navbar.php');?>
  <div style="height: 100%;">
    <div  class="form">
        <br>
      <form id="form" action="" method="post" enctype="multiprt/form-data">
        <center>
          <table>
            <?php
             echo @$failure;
             echo @$succes;
              if(isset($_GET['edit_item']))
              { 
              $pro_id = $_GET['edit_item'];
              $sql = "SELECT * FROM `products` WHERE pro_id = '$pro_id'";
              $res = mysqli_query($connection, $sql);
              if(!$res){
                echo ("Error description: " . mysqli_error($connection));
              } 
              $row = mysqli_fetch_array($res);
            ?>
            <th><span style="color: red;float: left;">*required</span></th>
            <tr>
              <td>
                <label>Product Name<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" id="proname" name="proname" value="<?php echo $row['pro_name'];?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Brand Name<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" id="braname" name="braname" value="<?php echo $row['pro_brand'];?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Category<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <select id="catname" name="catname">
                  <?php
                    $cat = mysqli_query($connection, "SELECT * FROM `categories` WHERE 1");
                    while ($ligne = mysqli_fetch_array($cat)) {
                  ?>
                  <option value="<?php echo $ligne['cat_id'];?>"><?php echo $ligne['cat_name']; ?></option>
                  <?php
                   }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Quantity<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="number" id="proquantity" name="proquantity" min=0 value="<?php echo $row['pro_quantity'];?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Price<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="number" id="proprice" name="proprice" min=0 value="<?php echo $row['pro_price'];?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Picture<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="file" id="propicture" name="propicture" value="<?php echo $row['pro_picture'];?>"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Description</label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" name="prodescpription" id="prodescpription" value="<?php echo $row['pro_description']; ?>" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" id="update" name="update" value="Update"/>
              </td>
            </tr>
          </table>
        <?php } ?>
         </center>     
      </form>
      <br><br>
    </div>
  </div>
<?php include('include/footer.php');?>