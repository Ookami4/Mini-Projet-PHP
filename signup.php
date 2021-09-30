<?php include('include/head.php'); ?>
<link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body style="background-image: url('logo/cover.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: 100%;">
<?php include('include/navbar.php');?>
<div style="min-height: 130%;">
<div  class="form">
  <br>
<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
if(isset($_POST['sign'])){
  $failure="";
  $error = array();
  $succes="";

 if(empty($_POST['fname']) && empty($_POST['lname'])) {
    $failure .= "<div class=\"error\" id=\"alert1\"><span class='closebtn' onclick='document.getElementById(\"alert1\").style.display=\"none\";'>&times;</span>fill in your name</div>";
    $error['1'] ="no null";
 }else{
    $nom = $_POST['fname']." ".$_POST['lname'];
    $name = $nom;
 }

  $mail =$_POST['email'];
  $checkemail = "SELECT * FROM `users` WHERE user_email = '$mail' LIMIT 1";
  $result = mysqli_query($connection, $checkemail);
  if(!$result){
    echo("Error description: " . mysqli_error($connection));
  }
  $table = mysqli_fetch_array($result);


  if(empty($mail)){
    $failure .= "<div class=\"error\" id=\"alert2\"><span class='closebtn' onclick='document.getElementById(\"alert2\").style.display=\"none\";'>&times;</span>fill in your email</div>";
    $error['2'] ="no null";
  }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    $failure .="<div class=\"error\" id=\"alert3\"><span class='closebtn' onclick='document.getElementById(\"alert3\").style.display=\"none\";'>&times;</span>invalid email!</div>";
    $error['3'] ="no null";
  }elseif ($table != 0) {
    $failure .="<div class=\"error\" id=\"alert4\"><span class='closebtn' onclick='document.getElementById(\"alert3\").style.display=\"none\";'>&times;</span>Email already exist</div>";
    $error['4'] ="no null";
 }else{
    $email = $_POST['email'];
 }


  if (empty($_POST['password'])&& empty($_POST['re_password'])) {
    $failure .="<div class=\"error\" id=\"alert5\"><span class='closebtn' onclick='document.getElementById(\"alert5\").style.display=\"none\";'>&times;</span>Type the password</div>";
    $error['5'] ="no null";
  }else{

    if ($_POST['password'] != $_POST['re_password']) {
     $failure .="<div class=\"error\" id=\"alert6\"><span class='closebtn' onclick='document.getElementById(\"alert6\").style.display=\"none\";'>&times;</span>the retype password didn't match the password</div>";
     $error['6'] ="no null";
    }else{
     $pass = $_POST['password'];
     $password = $pass;
    }
  }


  if (empty($_POST['adress'])) {
     $failure .= "<div class=\"error\" id=\"alert7\"><span class='closebtn' onclick='document.getElementById(\"alert7\").style.display=\"none\";'>&times;</span>enter your adress please</div>";
     $error['7'] = 'no null';
  }else{
    $adress = $_POST['adress']; 
  }


  if (empty($_POST['zip'])) {
  $failure.="<div class=\"error\" id=\"alert8\"><span class='closebtn' onclick='document.getElementById(\"alert8\").style.display=\"none\";'>&times;</span>enter your ZIP code please</div>";
    $error['8'] = "no null";
  }else{
    $zip = $_POST['zip'];
  }


  if($error == NULL){
   $sql="INSERT INTO users (user_id, user_name, user_email, user_pass, user_adress, user_zip) VALUES ('','$name','$email','$password','$adress','$zip')";
   if (mysqli_query($connection ,$sql)){
     $succes ="<div class=\"done\" id=\"suc\"><span class='closebtn' onclick='document.getElementById(\"suc\").style.display=\"none\";'>&times;</span>Dear ".$name." your acount is successfully created.</div>";
  }else{
  $failure.="<div class=\"error\" id=\"alert9\"><span class='closebtn' onclick='document.getElementById(\"alert9\").style.display=\"none\";'>&times;</span>Error! retry again.</div>";
  }
}
}
?>
<center>
  <?php 
    echo @$succes;
    echo @$failure;
    echo "<br>"; 
  ?>
  <table>
      <th><span style="color: #ff0000;float: left;">*required</span></th>
      <tr>
        <td>
          <label>First Name<span>*</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" id="fname" name="fname" placeholder="your first name"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Last Name<span>*</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" id="lname" name="lname" placeholder="your last name"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Email<span>*</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="email" id="email" name="email" placeholder="someone@example.com"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Password<span>*</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="password" id="password" name="password" min="8" />
        </td>
      </tr>
      <tr>
        <td>
          <label>Retype Password<span>*</span></label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="password" id="re_password" name="re_password" min="8" />
        </td>
      </tr>
      <tr>
        <td>
          <label>Adress</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" name="adress" id="adress"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>ZIP code</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" name="zip" id="zip" />
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" id="sign" name="sign" value="Sign up"/>
        </td>
      </tr>
      <tr>
        <td style="color: #ffffff;">You already have an account?<a href="login.php" style="color: #ff0000;">Login</a></td>
      </tr>
  </table>
 </center>     
</form>
<br>
</div>
</div>
<?php include('include/footer.php'); ?>