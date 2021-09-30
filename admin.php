<?php include('include/head.php');?>
<link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body style="background-image: url('logo/cover.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: 100%;">
<?php include('include/navbar.php');?>
<div style="height: 100%;">
<div style="position:absolute;top:45%;;margin-top:-100px;width: 100%;">
<div  class="form">
<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php 
if(isset($_POST['login'])){
  $email = $_POST['email'];
 $passe = $_POST['password'];
  $admin = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_pass = '$passe'";
  $result = mysqli_query($connection, $admin);
  if(!$result){
    echo("Error description: " . mysqli_error($connection));
  }
  $admin = mysqli_fetch_array($result);
  if($admin != null)
  {
    $_SESSION['logged1'] = true;
    redirect("admin-space.php");
  }else{
   $msg = "<div class=\"error\" id=\"alert1\"><span class='closebtn' onclick='document.getElementById(\"alert1\").style.display=\"none\";'>&times;</span>Email or Password is incorrect.</div>";
  }
}   
?>
<center>
  <?php echo @$msg; ?>
  <table>
    <tr><th><h1>Admin</h1></th></tr>
    <tr>
      <td>
        <label>Email</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="email" id="email" name="email" placeholder="someone@example.com"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Password</label>
      </td>
    </tr>
    <tr>
      <td>
        <input type="password" id="password" name="password" min="8"/>
      </td>
    </tr>
    <tr>
        <td>
         <input type="checkbox" onclick="myFunction()" style="width:20px;height:15px;">Show Password
        </td>
      </tr>
    <script type="text/javascript">
      function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
    <tr>
      <td>
        <input type="submit" name="login" value="login"/>
      </td>
    </tr>
  </table>
 </center>     
</form>
<br>
</div>
</div>
</div>
<?php include('include/footer.php');?>