<?php include('include/head.php'); ?> 
<?php
$failure = "";
$error = array();
$succes = "";
if(isset($_POST['add'])){
 if(empty($_POST['proname'])){
    $failure.="<div class=\"error\" id=\"alert1\"><span class='closebtn' onclick='document.getElementById(\"alert1\").style.display=\"none\";'>&times;</span>fill in the product name</div>";
    $error['1'] = "1";
 }else{
    $proname = $_POST['proname'];
 }
 if(empty($_POST['braname'])){
    $failure.="<div class=\"error\" id=\"alert2\"><span class='closebtn' onclick='document.getElementById(\"alert2\").style.display=\"none\";'>&times;</span>fill in the Brand name</div>";
    $error['2'] = "2";
 }else{
    $braname = $_POST['braname'];
 }
 if(empty($_POST['catname'])){
    $failure.="<div class=\"error\" id=\"alert3\"><span class='closebtn' onclick='document.getElementById(\"alert3\").style.display=\"none\";'>&times;</span>Choose the product category</div>";
    $error['3'] = "3";
 }else{
    $catid = $_POST['catname'];
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
    $propicture = $_FILES['propicture']['name'];
    $path = "img/products/".$_FILES['propicture']['name'];
    move_uploaded_file($propicture, $path);
  }
  if (empty($_POST['description'])) {
  	$failure.="<div class=\"error\" id=\"alert7\"><span class='closebtn' onclick='document.getElementById(\"alert7\").style.display=\"none\";'>&times;</span>Fill in the description</div>";
    $error['7'] = "7";
  }else{
  	$description = $_POST['description'];
  }
 if ($error == NULL) 
 {
    $add = "INSERT INTO `products` (pro_id,pro_name,pro_brand,cat_id,pro_quantity,pro_price,pro_picture,pro_description) VALUES ('','$proname','$braname','$catid','$proquantity','$proprice','$path','$description')";
    $result = mysqli_query($connection, $add);
    if ($result) {
      $succes ="<div class=\"done\" id=\"suc\"><span class='closebtn' onclick='document.getElementById(\"suc\").style.display=\"none\";'>&times;</span>Item $proname added successfully to the store.</div>";
    }else{
      $failure.="<div class=\"error\" id=\"alert8\"><span class='closebtn' onclick='document.getElementById(\"alert8\").style.display=\"none\";'>&times;</span>There was a problem retry again</div>";
      $failure.= "Error description: " . mysqli_error($connection);
    }
 }
}
?>
<link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body style="background-image: url('logo/cover.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: 100%;">
<?php include('include/navbar.php');?>
<div style="height: 200%;">
  <div  class="form">
  <br>
    <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multiprt/form-data">
      <center>
        <?php
          echo @$failure;
          echo @$succes;
        ?>
        <table>
            <tr>
              <th>
                <span style="color: #ff0000; float: left;">*required</span>
              </th>
            </tr>
            <tr>
              <td>
                <label>Product Name<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" id="proname" name="proname"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Brand Name<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" id="braname" name="braname"/>
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
                    while ($ligne1 = mysqli_fetch_array($cat)) {
                  ?>
                  <option value="<?php echo $ligne1['cat_id'];?>"><?php echo $ligne1['cat_name']; ?></option>
                  <?php
                   }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Picture<span>*</span></label>
              </td>
            </tr> 
            <tr>
              <td>
                <input type="file" id="propicture" name="propicture"/>
              </td> 
            </tr>
            <tr>
              <td>
                <label>Product Quantity<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="number" id="proquantity" name="proquantity" min="0"/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Price<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" id="proprice" name="proprice" />
              </td>
            </tr>
            <tr>
              <td>
                <label>Product Description<span>*</span></label>
              </td>
            </tr>
            <tr>
              <td>
                <textarea type="text" id="description" name="description"></textarea>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" id="add" name="add" value="Add"/>
              </td>
            </tr>
        </table>
       </center>     
    </form>
    <br><br>
  </div>
</div>
<?php include('include/footer.php');?>