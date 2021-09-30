<?php include('include/head.php');?>
<link rel="stylesheet" type="text/css" href="css/contact-css.css">
<body style="background-image: url('logo/cover.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: 100%;">
<?php include('include/navbar.php');?>
<div style="min-height: 100%;">
<div style="position:absolute;top:45%;margin-top:-100px;width: 100%; vertical-align: center;">
<div class="form">  
<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
<?php 
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $passe = $_POST['password'];
  $sql = "SELECT * FROM users WHERE user_email ='$email' AND user_pass = '$passe' LIMIT 1";
  $result = mysqli_query($connection, $sql);
  if(!$result){
    echo("Error description: " . mysqli_error($connection));
  }
  $user = mysqli_fetch_array($result);
  if($user != null){
      $_SESSION['logged'] = true;
      $_SESSION['userid'] = $user['user_id'];
      $_SESSION['username'] = $user['user_name'];
      $_SESSION['useradress'] = $user['user_adress'];
      $_SESSION['userzip'] = $user['user_zip'];
      redirect("home.php");
    }else{
      $msg = "<div class=\"error\" id=\"alert1\"><span class='closebtn' onclick='document.getElementById(\"alert1\").style.display=\"none\";'>&times;</span>Email or Password are incorrect.</div>";
  }
}   
?>
<center>
  <table>
      <th><h1>Login</h1></th>
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
      <tr>
        <td>
          <?php echo @$msg; ?>
        </td>
      </tr>
      <tr>
        <td style="color: white;">
          Don't have an account yet?<a href="signup.php" style="color: red;">create one</a>
        </td>
      </tr>
      </table>
  </table>
 </center>     
</form>
<br>
</div>
</div>
</div>
<?php include('include/footer.php');?>